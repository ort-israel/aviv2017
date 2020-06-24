<?php
//
// !!!!BIG security risk !!!!
//

/* This plugin creates a temporary user with the role of super-user, a special role created so students can
 * enrol and participate in Aviv courses (but it can work in any given course).
 * There user is created by clicking on a button that sends him to this page with a courseid:
 * /blocks/anonymous_user/generateuser.php?courseid=...
 * There are 2 types of values that the courseid parameter can accept:
 * 1. A specific courseid, such as 1384
 * 2. The value -1. We interpret this as "All Aviv Courses", and proceed to take the actual courses list from the translation.
 *      It's not ideal to put the list in the translation since it isn't intuitive, but I wanted the admins to have
 *      control over the list without having to involve a programmer. The best solution would be to create a settings
 *      page, but I'm not sure how to do this when this isn't a real block, meaning it doesn't actually appear as a
 *      block any place, so I don't know how an admin would reach the settings page.  */

include '../../config.php';

class generate_user {

    function run() {

        global $CFG, $DB, $USER;

// e.k 9.12.2012 - Find out How many Guests are currently inside the system.
// If more than Allowed --> Do not proceed to the site!
        $maxGuestsAllowed = $CFG->MaxGuests;
        $numberOfGuests = $DB->count_records_sql('SELECT COUNT(username) FROM {user} WHERE username LIKE \'anonymous_%\' and deleted=0');

        if ($numberOfGuests >= $maxGuestsAllowed) {
            echo "Sorry the Server has reached the maximum limit of guests, please try later .... ";
            echo "<br/>";
            echo '<a href=' . $CFG->wwwroot . '>Return to Moodle home page</a>';
            exit;
        }


// -------------------------------
// Guest can enter to site .....
// -------------------------------

        $courseid = required_param('courseid', PARAM_INT); // course id

        //Tsofiya 02/12/2015: add section as an optional parameter
        $sectionid = optional_param('section', null, PARAM_INT); // section id
        if ($courseid > 0 && !($course = $DB->get_record('course', array('id' => $courseid)))) {
            print_error('invalidcourseid', 'error');
        }

        /* The lang parameter in the user class is required.
         * We used to define it as defined in the specific course that the user wanted to access, but since we added
         * the case where the courseid parameter isn't an actual course, we define it hard-coded in Hebrew. */
        $courselang = $courseid < 0 ? 'he' : $course->lang;

        $newuser = new \stdClass();
        $newuser->id = -1;  // make sure there is no id since we are creating a new user
        $newuser->mnethostid = 1; // always local user
        $newuser->confirmed = 1;
        $newuser->username = 'anonymous_' . time();
        $newuser->firstname = get_string('super', 'block_anonymous_user');
        $newuser->lastname = get_string('guest', 'block_anonymous_user');
        $newuser->middlename = '';
        $newuser->firstnamephonetic = 'Guest';
        $newuser->lastnamephonetic = 'User';
        $newuser->alternatename = 'Super User';
        $newuser->language = 'he_IL';
        $newuser->email = 'noemail@email.com';
        $newuser->emailstop = 1;
        $newuser->institution = get_string('institution', 'block_anonymous_user'); // Define institution so these users can be differentiated on reports
        $newuser->city = get_string('city', 'block_anonymous_user');
        $newuser->country = 'IL';
        $newuser->lang = $courselang;
        $newuser->password = hash_internal_user_password('anonymous_questionnaire');
        $newuser->timemodified = time();
        $newuser->lastaccess = time();
        $newuser->auth = 'manual';
        $newuser->policyagreed = true;
        $newuser->deleted = false;
        $newuser->trackforums = 1; // The forum module checks this field and it can't be null, so I gave it the value of 1 because why not...

        if (!$newuser->id = $DB->insert_record('user', $newuser)) {
            error('Error creating user:anonymous_questionnaire record');
        }

        $newuser->picture = $this->get_user_picture($newuser, $CFG);
        $newuser->imagealt = '';

        if (!$enrol_manual = enrol_get_plugin('manual')) {
            throw new coding_exception('Can not instantiate enrol_manual');
        }
        // The case for enrolling the user in all Aviv courses
        if ($courseid === -1) {

            $aviv_course_ids = get_string('aviv_courses', 'block_anonymous_user'); // This is where we keep the list of courseid's to enrol the user in
            if ($aviv_course_ids != null) {
                $aviv_course_ids = explode(",", $aviv_course_ids);
                foreach ($aviv_course_ids as $value) {
                    $curr_courseid = $value;
                    $this->enrol_in_course($curr_courseid, $enrol_manual, $newuser);
                }
            }
        } else {

            $this->enrol_in_course($courseid, $enrol_manual, $newuser);
        }

        $newuser->lang = $courselang; // Display questionnaire aligned to the right direction, depending on course's language.
        $USER = $newuser;

        // e.k - Activate the redirect command !!!

        //Tsofiya 02/12/2015: add redirect to spesific section if specified
        if ($sectionid !== null) { // Assume that if $sectionid is defined then $courseid is defined too. Could be that this will have to change.
            redirect($CFG->wwwroot . '/course/view.php?id=' . $courseid . '&amp;section=' . $sectionid);
        } else {
            if ($courseid === -1) {
                redirect($CFG->wwwroot); // Redirect to main site page
            } else {
                redirect($CFG->wwwroot . '/course/view.php?id=' . $courseid);
            }
        }
    }

    /**
     * @param stdClass $newuser
     * @param stdClass $CFG
     * @return mixed
     */
    private function get_user_picture(stdClass $newuser) {
        global $CFG;
        $fs = get_file_storage();
        $usercontext = context_user::instance($newuser->id, MUST_EXIST);
        $gravatarfile = $fs->get_file($usercontext->id, 'user', 'icon', 0, '/', 'f2.png');
        require_once $CFG->libdir . '/gdlib.php';
        $usericonid = process_new_icon($usercontext, 'user', 'icon', 0, $gravatarfile);
        return $usericonid;
    }

    /**
     * @param int $courseid
     * @param enrol_plugin $enrol_manual
     * @param stdClass $newuser
     * @throws coding_exception
     * @throws dml_exception
     */
    protected function enrol_in_course($courseid, enrol_plugin $enrol_manual, stdClass $newuser) {
        global $DB;
        if (is_number($courseid)) {

            $instance = $DB->get_record('enrol', array('courseid' => $courseid, 'enrol' => 'manual', 'status' => 0), '*', IGNORE_MISSING);

            if ($instance != null) {

                $today = time();
                $startdate = make_timestamp(date('Y', $today), date('m', $today), date('d', $today), date('H', $today), date('i', $today), 0);
                $enddate = make_timestamp(date('Y', $today), date('m', $today), date('d', $today), date('H', $today) + 2, date('i', $today), 0);

                // Tsofiya: - Number 9 is "Supper Guest" from role Student
                // Please pay attention!!! This is not an arbitrary role ! I have created a special role called: SuperGuest
                // which inherent from the Student's role and have some extra Attributes.
                $enrol_manual->enrol_user($instance, $newuser->id, 9, $startdate, $enddate);
            }
        }
    }
}

$generate_user = new generate_user();
$generate_user->run();