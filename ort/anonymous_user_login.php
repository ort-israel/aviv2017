<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Super user login page.
 *
 * @package    core
 * @subpackage auth
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../login/lib.php');

class course_login {

    public function run() {

        global $CFG, $DB, $PAGE, $OUTPUT, $USER, $SESSION;
// Try to prevent searching for sites that allow sign-up.
        if (!isset($CFG->additionalhtmlhead)) {
            $CFG->additionalhtmlhead = '';
        }

        $CFG->additionalhtmlhead .= '<meta name="robots" content="noindex" />';

// Lea 16/08/2015 - Do not upgrade Moodle when visiting a specific site
//redirect_if_major_upgrade_required();

// Lea 16/08/2015 - Take the course id as a parameter and check if it exists in DB
        $courseid = required_param('courseid', PARAM_INT); // course id
        if (!($course = $DB->get_record('course', array('id' => $courseid)))) {
            print_error('invalidcourseid', 'error');
        }

        $testsession = optional_param('testsession', 0, PARAM_INT); // test session works properly

//HTTPS is required in this page when $CFG->loginhttps enabled
        $PAGE->https_required();

        $context = context_system::instance();
        $PAGE->set_url("$CFG->httpswwwroot/login/index.php");
        $PAGE->set_context($context);
        $PAGE->set_pagelayout('login');

/// Initialize variables
        $errormsg = '';
        $errorcode = 0;

// login page requested session test
        if ($testsession) {
            if ($testsession == $USER->id) {
                if (isset($SESSION->wantsurl)) {
                    $urltogo = $SESSION->wantsurl;
                } else {
                    $urltogo = $CFG->wwwroot . '/';
                }
                unset($SESSION->wantsurl);
                // Lea 16/08/2015 - Cancel redirect
                // redirect($urltogo);
            } else {
                // TODO: try to find out what is the exact reason why sessions do not work
                $errormsg = get_string("cookiesnotenabled");
                $errorcode = 1;
            }
        }

/// Check for timed out sessions
        if (!empty($SESSION->has_timed_out)) {
            $session_has_timed_out = true;
            unset($SESSION->has_timed_out);
        } else {
            $session_has_timed_out = false;
        }

/// auth plugins may override these - SSO anyone?
        $frm = false;
        $user = false;

        $authsequence = get_enabled_auth_plugins(true); // auths, in sequence
        foreach ($authsequence as $authname) {
            $authplugin = get_auth_plugin($authname);
            $authplugin->loginpage_hook();
        }


/// Define variables used in page
        $site = get_site();

// Ignore any active pages in the navigation/settings.
// We do this because there won't be an active page there, and by ignoring the active pages the
// navigation and settings won't be initialised unless something else needs them.
        $PAGE->navbar->ignore_active();
        $loginsite = get_string("loginsite");
        $PAGE->navbar->add($loginsite);

        if ($user !== false or $frm !== false or $errormsg !== '') {
            // some auth plugin already supplied full user, fake form data or prevented user login with error message

        } else if (!empty($SESSION->wantsurl) && file_exists($CFG->dirroot . '/login/weblinkauth.php')) {
            // Handles the case of another Moodle site linking into a page on this site
            //TODO: move weblink into own auth plugin
            include($CFG->dirroot . '/login/weblinkauth.php');
            if (function_exists('weblink_auth')) {
                $user = weblink_auth($SESSION->wantsurl);
            }
            if ($user) {
                $frm->username = $user->username;
            } else {
                $frm = data_submitted();
            }

        } else {
            $frm = data_submitted();
        }

/// Check if the user has actually submitted login data to us

        if ($frm and isset($frm->username)) {                             // Login WITH cookies

            $frm->username = trim(core_text::strtolower($frm->username));

            if (is_enabled_auth('none')) {
                if ($frm->username !== core_user::clean_field($frm->username, 'username')) {
                    $errormsg = get_string('username') . ': ' . get_string("invalidusername");
                    $errorcode = 2;
                    $user = null;
                }
            }

            if ($user) {
                //user already supplied by aut plugin prelogin hook
            } else if (($frm->username == 'guest') and empty($CFG->guestloginbutton)) {
                $user = false;    /// Can't log in as guest if guest button is disabled
                $frm = false;
            } else {
                if (empty($errormsg)) {
                    $user = authenticate_user_login($frm->username, $frm->password, false, $errorcode);
                }
            }

            // Intercept 'restored' users to provide them with info & reset password
            if (!$user and $frm and is_restored_user($frm->username)) {
                $PAGE->set_title(get_string('restoredaccount'));
                $PAGE->set_heading($site->fullname);
                echo $OUTPUT->header();
                echo $OUTPUT->heading(get_string('restoredaccount'));
                echo $OUTPUT->box(get_string('restoredaccountinfo'), 'generalbox boxaligncenter');
                require_once(__DIR__ . '/../login/restored_password_form.php'); // Use our "supplanter" login_forgot_password_form. MDL-20846
                $form = new login_forgot_password_form();
                $form->display();
                echo $OUTPUT->footer();
                die;
            }

            if ($user) {

                // language setup
                if (isguestuser($user)) {
                    // no predefined language for guests - use existing session or default site lang
                    unset($user->lang);

                } else if (!empty($user->lang)) {
                    // unset previous session language - use user preference instead
                    unset($SESSION->lang);
                }

                if (empty($user->confirmed)) {       // This account was never confirmed
                    $PAGE->set_title(get_string("mustconfirm"));
                    $PAGE->set_heading($site->fullname);
                    echo $OUTPUT->header();
                    echo $OUTPUT->heading(get_string("mustconfirm"));
                    echo $OUTPUT->box(get_string("emailconfirmsent", "", $user->email), "generalbox boxaligncenter");
                    echo $OUTPUT->footer();
                    die;
                }

                /// Let's get them all set up.
                complete_user_login($user);

                \core\session\manager::apply_concurrent_login_limit($user->id, session_id());

                // sets the username cookie
                if (!empty($CFG->nolastloggedin)) {
                    // do not store last logged in user in cookie
                    // auth plugins can temporarily override this from loginpage_hook()
                    // do not save $CFG->nolastloggedin in database!

                } else if (empty($CFG->rememberusername) or ($CFG->rememberusername == 2 and empty($frm->rememberusername))) {
                    // no permanent cookies, delete old one if exists
                    set_moodle_cookie('');

                } else {
                    set_moodle_cookie($USER->username);
                }

                $urltogo = core_login_get_return_url();

                /// check if user password has expired
                /// Currently supported only for ldap-authentication module
                $userauth = get_auth_plugin($USER->auth);

                if (!isguestuser() and !empty($userauth->config->expiration) and $userauth->config->expiration == 1) {
                    if ($userauth->can_change_password()) {
                        $passwordchangeurl = $userauth->change_password_url();
                        if (!$passwordchangeurl) {
                            $passwordchangeurl = $CFG->httpswwwroot . '/login/change_password.php';
                        }
                    } else {
                        $passwordchangeurl = $CFG->httpswwwroot . '/login/change_password.php';
                    }
                    $days2expire = $userauth->password_expire($USER->username);
                    $PAGE->set_title("$site->fullname: $loginsite");
                    $PAGE->set_heading("$site->fullname");
                    if (intval($days2expire) > 0 && intval($days2expire) < intval($userauth->config->expiration_warning)) {
                        echo $OUTPUT->header();
                        echo $OUTPUT->confirm(get_string('auth_passwordwillexpire', 'auth', $days2expire), $passwordchangeurl, $urltogo);
                        echo $OUTPUT->footer();
                        exit;
                    } elseif (intval($days2expire) < 0) {
                        echo $OUTPUT->header();
                        echo $OUTPUT->confirm(get_string('auth_passwordisexpired', 'auth'), $passwordchangeurl, $urltogo);
                        echo $OUTPUT->footer();
                        exit;
                    }
                }

                // Discard any errors before the last redirect.
                unset($SESSION->loginerrormsg);

                // test the session actually works by redirecting to self
                $SESSION->wantsurl = $urltogo;
                // Lea 16/08/2015 - Cancel redirect
                // redirect(new moodle_url(get_login_url(), array('testsession'=>$USER->id)));

            } else {
                if (empty($errormsg)) {
                    if ($errorcode == AUTH_LOGIN_UNAUTHORISED) {
                        $errormsg = get_string("unauthorisedlogin", "", $frm->username);
                    } else {
                        $errormsg = get_string("invalidlogin");
                        $errorcode = 3;
                    }
                }
            }
        }

/// Detect problems with timedout sessions
        if ($session_has_timed_out and !data_submitted()) {
            $errormsg = get_string('sessionerroruser', 'error');
            $errorcode = 4;
        }

/// Redirect to alternative login URL if needed
        if (!empty($CFG->alternateloginurl)) {
            $loginurl = new moodle_url($CFG->alternateloginurl);

            $loginurlstr = $loginurl->out(false);

            if (strpos($SESSION->wantsurl, $loginurlstr) === 0) {
                // We do not want to return to alternate url.
                $SESSION->wantsurl = null;
            }

            if ($errorcode) {
                $loginurl->param('errorcode', $errorcode);
            }

            // Lea 16/08/2015 - Cancel redirect
            // redirect($loginurl);
        }

// make sure we really are on the https page when https login required
        $PAGE->verify_https_required();

/// Generate the login page with forms

        if (!isset($frm) or !is_object($frm)) {
            $frm = new stdClass();
        }

        if (empty($frm->username) && $authsequence[0] != 'shibboleth') {  // See bug 5184
            if (!empty($_GET["username"])) {
                // we do not want data from _POST here
                $frm->username = clean_param($_GET["username"], PARAM_RAW); // we do not want data from _POST here
            } else {
                $frm->username = get_moodle_cookie();
            }

            $frm->password = "";
        }

        if (!empty($SESSION->loginerrormsg)) {
            // We had some errors before redirect, show them now.
            $errormsg = $SESSION->loginerrormsg;
            unset($SESSION->loginerrormsg);

        } else if ($testsession) {
            // No need to redirect here.
            unset($SESSION->loginerrormsg);

        } else if ($errormsg or !empty($frm->password)) {
            // We must redirect after every password submission.
            if ($errormsg) {
                $SESSION->loginerrormsg = $errormsg;
            }
            // Lea 25/08/2014 - Disable redirect
            //redirect(new moodle_url('/login/index.php'));
        }

// Lea 25/08/2014 - Do not show the login form !
//$PAGE->set_title("$site->fullname: $loginsite");
//$PAGE->set_heading("$site->fullname");

//echo $OUTPUT->header();

//// if (isloggedin() and !isguestuser()) {
////prevent logging when already logged in, we do not want them to relogin by accident because sesskey would be changed
//// echo $OUTPUT->box_start();
//// $logout = new single_button(new moodle_url($CFG->httpswwwroot.'/login/logout.php', array('sesskey'=>sesskey(),'loginpage'=>1)), get_string('logout'), 'post');
//// $continue = new single_button(new moodle_url($CFG->httpswwwroot.'/login/index.php', array('cancel'=>1)), get_string('cancel'), 'get');
//// echo $OUTPUT->confirm(get_string('alreadyloggedin', 'error', fullname($USER)), $logout, $continue);
//// echo $OUTPUT->box_end();
//// } else {
//// include("index_form.html");
//// if ($errormsg) {
//// $PAGE->requires->js_init_call('M.util.focus_login_error', null, true);
//// } else if (!empty($CFG->loginpageautofocus)) {
////focus username or password
//// $PAGE->requires->js_init_call('M.util.focus_login_form', null, true);
//// }
//// }
//
//// echo $OUTPUT->footer();
//
// Lea 25/08/2014 - Take the section id as a parameter

        $sectionid = optional_param('section', 0, PARAM_INT); // section id
// Lea 25/08/2014 - Activate the redirect command accroding to if logged in or not
        if (isloggedin()) { // take the user to the section in the course id, accroding to the parameters sent from the refferer
            redirect($CFG->wwwroot . '/course/view.php?id=' . $courseid . '&amp;section=' . $sectionid);// Lea 2015/08 - &amp; needed in order to prevent &sect from becoming §
        } else {
            /* User isn't logged in, redirect them back to the site they came from.
             * Differentiate between development and production servers */
            $course_portal = strpos($CFG->wwwroot, 'campusdev') ? $this->get_redirect_link_development_server($courseid) : $this->get_redirect_link_production_server($courseid);

            $redirect_url = $course_portal . '#courseid=' . $courseid . '&amp;section=' . $sectionid; // Lea 2015/08 - &amp; needed in order to prevent &sect from becoming §

            redirect($redirect_url);
        }
    }

    /**
     * @param $courseid
     * @return string
     */
    protected function get_redirect_link_development_server($courseid) {
        /* The url is made up of 3 parts:
                    1. The domain name
                    2. The specific site name
                    3. The page on the site */

        // 1. The domain name
        $course_portal = 'https://mapa-linux-test.ort.org.il/';

        // 2. The specific site name
        switch ($courseid) {
            case 28:
                $course_portal .= 'brain_login';
                break;
            case 266:
                $course_portal .= 'heart_login';
                break;
            case 144:
            case 145:
                $course_portal .= 'madait-login';
                break;
            case 399:
                $course_portal .= 'hshmal_login';
                break;
            case 192:
                $course_portal .= 'philosophy_login';
                break;
            case 518:
                $course_portal .= 'money2016';
                break;
            default:
                $course_portal .= 'madait-login';
                break;
        }

        //3. The page on the site
        switch ($courseid) {
            case 518:
                $course_portal .= '/בחן-את-עצמך';
                break;
            default:
                $course_portal .= '/login.html';
        }
        return $course_portal;
    }

    function get_redirect_link_production_server($courseid) {
        /* The url is usually only the domain name.
        In cases where the login is from a WordPress site, we also add the specific page */

        // 1. Initialize the url variable
        $course_portal = '';

        // 2. The specific site url
        switch ($courseid) {
            case 28:
                $course_portal .= 'https://brain.ort.org.il';
                break;
            case 266:
                $course_portal .= 'https://lev.ort.org.il';
                break;
            case 144:
            case 145:
                $course_portal .= 'https://bigbrain.ort.org.il';
                break;
            case 399:
                $course_portal .= 'https://electri.ort.org.il';
                break;
            case 192:
                $course_portal .= 'https://philosophy.ort.org.il';
                break;
            case 1105:
            case 1286:
                $course_portal .= 'https://money.ort.org.il';
                break;
            case 1116:
            case 1269:
                $course_portal .= 'https://catch-cash.ort.org.il';
                break;
            case 1268:
                $course_portal .= 'https://finteacher.ort.org.il';
                break;
            default:
                $course_portal .= 'https://brain.ort.org.il';
                break;
        }

        //3. The page on the site (relevant in WordPress sites. Otherwise the default is /login.html )
        switch ($courseid) {
            case 1105:
            case 1286:
                $course_portal .= '/בחן-את-עצמך';
                break;
            case 1116:
            case 1269:
                $course_portal .= '/?page_id=1838';
                break;
            case 1268:
                $course_portal .= '/חדש-mooc-פיננסי-למורים';
                break;
            default:
                $course_portal .= '/login.html';
        }
        return $course_portal;
    }
}

$course_login_anonymous_user = new course_login();
$course_login_anonymous_user->run();