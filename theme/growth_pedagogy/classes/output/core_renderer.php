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

namespace theme_growth_pedagogy\output;

use context_course;
use html_writer;
use moodle_url;
use theme_config;

defined('MOODLE_INTERNAL') || die;

global $CFG;

require_once($CFG->dirroot . "/course/renderer.php");
require_once($CFG->libdir . '/coursecatlib.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_growth_pedagogy
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_fordson\output\core_renderer {

    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();
        $output .= "<link href=\"https://fonts.googleapis.com/css?family=Assistant:200,400,700,800&amp;subset=hebrew\" rel=\"stylesheet\">\n";
        return $output;
    }


    /**
     * Add role to body class
     * @return string
     * @throws \coding_exception
     */
    public function header() {
        global $COURSE;
        $course = $this->page->course;
        $coursecontext = context_course::instance($course->id);
        if (is_siteadmin()) {
            $this->page->add_body_class('courserole-admin');
        }
        /* code taken from: https://moodle.org/mod/forum/discuss.php?d=362674#p1462631*/
        if ($roles = get_user_roles($coursecontext)) {
            foreach ($roles as $role) {
                $this->page->add_body_class('courserole-' . $role->shortname);
            }
        } else {
            if (count($roles) === 0 && !is_guest($coursecontext) && !is_siteadmin() && $COURSE->category > 0) {
                $this->page->add_body_class('courserole-none');
            }

        }
        return parent::header();

    }

    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {

        global $PAGE, $COURSE, $OUTPUT;

        $html = html_writer::start_tag('header', array('id' => 'page-header', 'class' => 'clearfix')); /* took it out for front page: , 'class' => 'row'*/
        //$html .= html_writer::start_div('col-xs-12 p-a-1');
        //$html .= html_writer::start_div('card');
        //$html .= html_writer::start_div('card-block');
        /*if (!$PAGE->theme->settings->coursemanagementtoggle) {
            $html .= html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        } else*/
        if (isset($COURSE->id) && $COURSE->id == 1) {
            $html .= html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        }
        $html .= html_writer::start_div('pull-xs-left');
        $html .= $this->context_header();
        $html .= html_writer::end_div();
        if ($this->is_homepage()) {
            $html .= html_writer::start_div('col-xs-12', array('id' => 'region-in-header-blocks'));
            $html .= $OUTPUT->blocks('in-header');
            $html .= html_writer::end_div();
        }
        $pageheadingbutton = $this->page_heading_button();
        if (empty($PAGE->layout_options['nonavbar'])) {
            $html .= html_writer::start_div('clearfix w-100 pull-xs-left', array('id' => 'page-navbar'));
            if ($this->page->navbar->has_items()) {
                $html .= html_writer::tag('div', $this->navbar(), array('class' => 'breadcrumb-nav'));
            }
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button pull-xs-right');
            $html .= html_writer::end_div();
        } else if ($pageheadingbutton) {
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button nonavbar pull-xs-right');
        }

        $html .= html_writer::end_tag('header');
        return $html;
    }

    public function headerimage() {
        global $CFG, $COURSE, $PAGE, $OUTPUT;

        // Get course overview files as images - set $courseimage.
        $courseimage = $this->get_image_from_area_files('cover');

        $headerbg = $PAGE->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage');
        $headerbgimgurl = $PAGE->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage', true);
        $defaultimgurl = $OUTPUT->image_url('headerbg', 'theme');

        // Create html for header.
        $html = html_writer::start_div('headerbkg');
        // If course image display it in separate div to allow css styling of inline style.
        if (theme_fordson_get_setting('showcourseheaderimage') && $courseimage) {
            $html .= html_writer::start_div('withimage', array(
                'style' => 'background-image: url("' . $courseimage . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'));
            $html .= html_writer::end_div(); // End withimage inline style div.
        } elseif (theme_fordson_get_setting('showcourseheaderimage') && !$courseimage && isset($headerbg)) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'));
            $html .= html_writer::end_div(); // End withoutimage inline style div.
        } elseif ($courseimage && isset($headerbg) && !theme_fordson_get_setting('showcourseheaderimage')) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'));
            $html .= html_writer::end_div(); // End withoutimage inline style div.
        } elseif (!$courseimage && isset($headerbg) && !theme_fordson_get_setting('showcourseheaderimage')) {
            $html .= html_writer::start_div('customimage', array(
                'style' => 'background-image: url("' . $headerbgimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'));
            $html .= html_writer::end_div(); // End withoutimage inline style div.
        } else {
            $html .= html_writer::start_div('default', array(
                'style' => 'background-image: url("' . $defaultimgurl . '"); background-size: cover; background-position:center;
                width: 100%; height: 100%;'));
            $html .= html_writer::end_div(); // End default inline style div.
        }

        $html .= html_writer::end_div();

        return $html;

    }

    /**
     * Override to inject the header titles.
     *
     * @param array $headerinfo The header info.
     * @param int $headinglevel What level the 'h' tag will be.
     * @return string HTML for the header bar.
     */
    public function context_header($headerinfo = null, $headinglevel = 1) {
        global $CFG, $PAGE, $COURSE;

        // Tsofiya 2018: In course page and inside a course we should display course logo instead course name
        $logo = $this->get_image_from_area_files('logo');

        if (empty($logo)) {
            $logo = new moodle_url($CFG->wwwroot . '/theme/growth_pedagogy/pix/logo.png');
        }

        $sitename = format_string($COURSE->fullname, true);
        $ret = html_writer::img($logo, $sitename, array('class' => 'logo'));

        return $ret;
    }

    public function teacherdash() {
        global $PAGE, $COURSE, $CFG, $DB, $OUTPUT;

        require_once($CFG->dirroot . '/completion/classes/progress.php');
        $togglebutton = '';
        $togglebuttonstudent = '';
        $hasteacherdash = '';
        $hasstudentdash = '';
        if (isloggedin() && isset($COURSE->id) && $COURSE->id > 1) {
            $course = $this->page->course;
            $context = context_course::instance($course->id);
            $hasteacherdash = has_capability('moodle/course:viewhiddenactivities', $context);
            $hasstudentdash = !has_capability('moodle/course:viewhiddenactivities', $context);
            if (has_capability('moodle/course:viewhiddenactivities', $context)) {
                $togglebutton = get_string('coursemanagementbutton', 'theme_fordson');
            } else {
                $togglebuttonstudent = get_string('studentdashbutton', 'theme_fordson');
            }
        }
        $course = $this->page->course;
        $context = context_course::instance($course->id);
        $coursemanagementmessage = (empty($PAGE->theme->settings->coursemanagementtextbox)) ? false : format_text($PAGE->theme->settings->coursemanagementtextbox);
        $haseditcog = true; //$PAGE->theme->settings->courseeditingcog;

        // Lea 2017 - add class if there is a link to enroll so in CSS we can display it unhidden
        $classenrol = '';
        $coursecontext = context_course::instance($course->id);
        $instances = enrol_get_instances($course->id, true);
        $plugins = enrol_get_plugins(true);
        if (!isguestuser() && isloggedin()) {
            if ((is_enrolled($coursecontext))) {
                // unenrol link if possible
                foreach ($instances as $instance) {
                    if (!isset($plugins[$instance->enrol])) {
                        continue;
                    }
                    $plugin = $plugins[$instance->enrol];
                    if ($unenrollink = $plugin->get_unenrolself_link($instance)) {
                        $classenrol = 'has-unenrol-link';
                        break;
                        //TODO. deal with multiple unenrol links - not likely case, but still...
                    }
                }
            } else {
                // enrol link if possible
                if (is_viewing($coursecontext)) {
                    // better not show any enrol link, this is intended for managers and inspectors
                } else {
                    foreach ($instances as $instance) {
                        if (!isset($plugins[$instance->enrol])) {
                            continue;
                        }
                        $plugin = $plugins[$instance->enrol];
                        if ($plugin->show_enrolme_link($instance)) {
                            $classenrol = 'has-enrol-link';
                            break;
                        }
                    }
                }
            }
        }

        $editcog = html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu ');
        /* Add this if to remove editcog div if it is empty */
        if (empty($this->context_header_settings_menu())) {
            $haseditcog = false;
        };
        $thiscourse = $this->thiscourse_menu();
        $showincourseonly = isset($COURSE->id) && $COURSE->id > 1 /*&& $PAGE->theme->settings->coursemanagementtoggle */ && isloggedin() && !isguestuser();
        $globalhaseasyenrollment = enrol_get_plugin('easy');
        $coursehaseasyenrollment = '';
        if ($globalhaseasyenrollment) {
            $coursehaseasyenrollment = $DB->record_exists('enrol', array('courseid' => $COURSE->id, 'enrol' => 'easy'));
            $easyenrollinstance = $DB->get_record('enrol', array('courseid' => $COURSE->id, 'enrol' => 'easy'));
        }

        //link catagories
        $haspermission = has_capability('enrol/category:config', $context) /*&& $PAGE->theme->settings->coursemanagementtoggle*/ && isset($COURSE->id) && $COURSE->id > 1;
        $userlinks = get_string('userlinks', 'theme_fordson');
        $userlinksdesc = get_string('userlinks_desc', 'theme_fordson');
        $qbank = get_string('qbank', 'theme_fordson');
        $qbankdesc = get_string('qbank_desc', 'theme_fordson');
        $badges = get_string('badges', 'theme_fordson');
        $badgesdesc = get_string('badges_desc', 'theme_fordson');
        $coursemanage = get_string('coursemanage', 'theme_fordson');
        $coursemanagedesc = get_string('coursemanage_desc', 'theme_fordson');
        $coursemanagementmessage = (empty($PAGE->theme->settings->coursemanagementtextbox)) ? false : format_text($PAGE->theme->settings->coursemanagementtextbox);
        $studentdashboardtextbox = (empty($PAGE->theme->settings->studentdashboardtextbox)) ? false : format_text($PAGE->theme->settings->studentdashboardtextbox);

        //user links
        if ($coursehaseasyenrollment && isset($COURSE->id) && $COURSE->id > 1) {
            $easycodetitle = get_string('header_coursecodes', 'enrol_easy');
            $easycodelink = new moodle_url('/enrol/editinstance.php', array('courseid' => $PAGE->course->id, 'id' => $easyenrollinstance->id, 'type' => 'easy'));
        }
        $gradestitle = get_string('gradesoverview', 'gradereport_overview');
        $gradeslink = new moodle_url('/grade/report/grader/index.php', array('id' => $PAGE->course->id));
        $enroltitle = get_string('enrolledusers', 'enrol');
        $enrollink = new moodle_url('/enrol/users.php', array('id' => $PAGE->course->id));
        $grouptitle = get_string('groups', 'group');
        $grouplink = new moodle_url('/group/index.php', array('id' => $PAGE->course->id));
        $enrolmethodtitle = get_string('enrolmentinstances', 'enrol');
        $enrolmethodlink = new moodle_url('/enrol/instances.php', array('id' => $PAGE->course->id));

        //user reports
        $logstitle = get_string('logs', 'moodle');
        $logslink = new moodle_url('/report/log/index.php', array('id' => $PAGE->course->id));
        $livelogstitle = get_string('loglive:view', 'report_loglive');
        $livelogslink = new moodle_url('/report/loglive/index.php', array('id' => $PAGE->course->id));
        $participationtitle = get_string('participation:view', 'report_participation');
        $participationlink = new moodle_url('/report/participation/index.php', array('id' => $PAGE->course->id));
        $activitytitle = get_string('outline:view', 'report_outline');
        $activitylink = new moodle_url('/report/outline/index.php', array('id' => $PAGE->course->id));

        //questionbank
        $qbanktitle = get_string('questionbank', 'question');
        $qbanklink = new moodle_url('/question/edit.php', array('courseid' => $PAGE->course->id));
        $qcattitle = get_string('questioncategory', 'question');
        $qcatlink = new moodle_url('/question/category.php', array('courseid' => $PAGE->course->id));
        $qimporttitle = get_string('import', 'question');
        $qimportlink = new moodle_url('/question/import.php', array('courseid' => $PAGE->course->id));
        $qexporttitle = get_string('export', 'question');
        $qexportlink = new moodle_url('/question/export.php', array('courseid' => $PAGE->course->id));

        //manage course
        $courseadmintitle = get_string('courseadministration', 'moodle');
        $courseadminlink = new moodle_url('/course/admin.php', array('courseid' => $PAGE->course->id));
        $coursecompletiontitle = get_string('coursecompletion', 'moodle');
        $coursecompletionlink = new moodle_url('/course/completion.php', array('id' => $PAGE->course->id));
        $courseresettitle = get_string('reset', 'moodle');
        $courseresetlink = new moodle_url('/course/reset.php', array('id' => $PAGE->course->id));
        $coursebackuptitle = get_string('backup', 'moodle');
        $coursebackuplink = new moodle_url('/backup/backup.php', array('id' => $PAGE->course->id));
        $courserestoretitle = get_string('restore', 'moodle');
        $courserestorelink = new moodle_url('/backup/restorefile.php', array('contextid' => $PAGE->context->id));
        $courseimporttitle = get_string('import', 'moodle');
        $courseimportlink = new moodle_url('/backup/import.php', array('id' => $PAGE->course->id));
        $courseedittitle = get_string('editcoursesettings', 'moodle');
        $courseeditlink = new moodle_url('/course/edit.php', array('id' => $PAGE->course->id));

        //badges
        $badgemanagetitle = get_string('managebadges', 'badges');
        $badgemanagelink = new moodle_url('/badges/index.php?type=2', array('id' => $PAGE->course->id));
        $badgeaddtitle = get_string('newbadge', 'badges');
        $badgeaddlink = new moodle_url('/badges/newbadge.php?type=2', array('id' => $PAGE->course->id));

        //misc
        $recyclebintitle = get_string('pluginname', 'tool_recyclebin');
        $recyclebinlink = new moodle_url('/admin/tool/recyclebin/index.php', array('contextid' => $PAGE->context->id));
        $filtertitle = get_string('filtersettings', 'filters');
        $filterlink = new moodle_url('/filter/manage.php', array('contextid' => $PAGE->context->id));

        //Student Dash
        if (\core_completion\progress::get_course_progress_percentage($PAGE->course)) {
            $comppc = \core_completion\progress::get_course_progress_percentage($PAGE->course);
            $comppercent = number_format($comppc, 0);
            $hasprogress = true;
        } else {
            $comppercent = 0;
            $hasprogress = false;
        }
        $progresschartcontext = [
            'hasprogress' => $hasprogress,
            'progress' => $comppercent
        ];
        $progresschart = $this->render_from_template('block_myoverview/progress-chart', $progresschartcontext);
        $gradeslink = new moodle_url('/grade/report/user/index.php', array('id' => $PAGE->course->id));


        $hascourseinfogroup = array(
            'title' => get_string('courseinfo', 'theme_fordson'),
            'icon' => 'map'
        );
        $summary = theme_growth_pedagogy_strip_html_tags($COURSE->summary);
        $summarytrim = theme_growth_pedagogy_course_trim_char($summary, 300);
        $courseinfo = array(
            array(
                'content' => format_text($summarytrim),
            )
        );
        $hascoursestaff = array(
            'title' => get_string('coursestaff', 'theme_fordson'),
            'icon' => 'users'
        );
        $courseteachers = array();
        $courseother = array();
        $role = $DB->get_record('role', array('shortname' => 'editingteacher'));
        $context = context_course::instance($PAGE->course->id);
        $teachers = get_role_users($role->id, $context, false,
            'u.id, u.firstname, u.middlename, u.lastname, u.alternatename,
                u.firstnamephonetic, u.lastnamephonetic, u.email, u.picture,
                u.imagealt');

        foreach ($teachers as $staff) {
            $picture = $OUTPUT->user_picture($staff, array('size' => 50));
            $messaging = new moodle_url('/message/index.php', array('id' => $staff->id));
            $hasmessaging = $CFG->messaging == 1;
            $courseteachers[] = array(
                'name' => $staff->firstname . ' ' . $staff->lastname . ' ' . $staff->alternatename,
                'email' => $staff->email,
                'picture' => $picture,
                'messaging' => $messaging,
                'hasmessaging' => $hasmessaging
            );
        }
        $role = $DB->get_record('role', array('shortname' => 'teacher'));
        $context = context_course::instance($PAGE->course->id);
        $teachers = get_role_users($role->id, $context, false,
            'u.id, u.firstname, u.middlename, u.lastname, u.alternatename,
                u.firstnamephonetic, u.lastnamephonetic, u.email, u.picture,
                u.imagealt');
        foreach ($teachers as $staff) {
            $picture = $OUTPUT->user_picture($staff, array('size' => 50));
            $messaging = new moodle_url('/message/index.php', array('id' => $staff->id));
            $hasmessaging = $CFG->messaging == 1;
            $courseother[] = array(
                'name' => $staff->firstname . ' ' . $staff->lastname,
                'email' => $staff->email,
                'picture' => $picture,
                'messaging' => $messaging,
                'hasmessaging' => $hasmessaging
            );
        }

        $activitylinkstitle = get_string('activitylinkstitle', 'theme_fordson');
        $activitylinkstitle_desc = get_string('activitylinkstitle_desc', 'theme_fordson');
        $mygradestext = get_string('mygradestext', 'theme_fordson');
        $myprogresstext = get_string('myprogresstext', 'theme_fordson');
        $studentcoursemanage = get_string('courseadministration', 'moodle');

        //permissionchecks for teacher access
        $hasquestionpermission = has_capability('moodle/question:add', $context);
        $hasbadgepermission = has_capability('moodle/badges:awardbadge', $context);
        $hascoursepermission = has_capability('moodle/backup:backupcourse', $context);
        $hasuserpermission = has_capability('moodle/course:viewhiddenactivities', $context);
        $hasgradebookshow = $PAGE->course->showgrades == 1 /*&& $PAGE->theme->settings->showstudentgrades == 1*/
        ;
        $hascompletionshow = $PAGE->course->enablecompletion == 1 /*&& $PAGE->theme->settings->showstudentgrades == 1*/
        ;


        //send to template
        $dashlinks = [
            'showincourseonly' => $showincourseonly,
            'haspermission' => $haspermission,
            'thiscourse' => $thiscourse,
            'haseditcog' => $haseditcog,
            'editcog' => $editcog,
            'togglebutton' => $togglebutton,
            'togglebuttonstudent' => $togglebuttonstudent,
            'userlinkstitle' => $userlinks,
            'userlinksdesc' => $userlinksdesc,
            'qbanktitle' => $qbank,
            'activitylinkstitle' => $activitylinkstitle,
            'activitylinkstitle_desc' => $activitylinkstitle_desc,
            'qbankdesc' => $qbankdesc,
            'badgestitle' => $badges,
            'badgesdesc' => $badgesdesc,
            'coursemanagetitle' => $coursemanage,
            'coursemanagedesc' => $coursemanagedesc,
            'coursemanagementmessage' => $coursemanagementmessage,
            'progresschart' => $progresschart,
            'gradeslink' => $gradeslink,
            'hascourseinfogroup' => $hascourseinfogroup,
            'courseinfo' => $courseinfo,
            'hascoursestaffgroup' => $hascoursestaff,
            'courseteachers' => $courseteachers,
            'courseother' => $courseother,
            'myprogresstext' => $myprogresstext,
            'mygradestext' => $mygradestext,
            'studentdashboardtextbox' => $studentdashboardtextbox,
            'hasteacherdash' => $hasteacherdash,
            'teacherdash' => array('hasquestionpermission' => $hasquestionpermission, 'hasbadgepermission' => $hasbadgepermission, 'hascoursepermission' => $hascoursepermission, 'hasuserpermission' => $hasuserpermission),
            'hasstudentdash' => $hasstudentdash,
            'hasgradebookshow' => $hasgradebookshow,
            'hascompletionshow' => $hascompletionshow,
            'studentcourseadminlink' => $courseadminlink,
            'studentcoursemanage' => $studentcoursemanage,
            'hasenrollinkclass' => $classenrol,

            'dashlinks' => array(
                array('hasuserlinks' => $gradestitle, 'title' => $gradestitle, 'url' => $gradeslink),
                array('hasuserlinks' => $enroltitle, 'title' => $enroltitle, 'url' => $enrollink),
                array('hasuserlinks' => $grouptitle, 'title' => $grouptitle, 'url' => $grouplink),
                array('hasuserlinks' => $enrolmethodtitle, 'title' => $enrolmethodtitle, 'url' => $enrolmethodlink),
                array('hasuserlinks' => $logstitle, 'title' => $logstitle, 'url' => $logslink),
                array('hasuserlinks' => $livelogstitle, 'title' => $livelogstitle, 'url' => $livelogslink),
                array('hasuserlinks' => $participationtitle, 'title' => $participationtitle, 'url' => $participationlink),
                array('hasuserlinks' => $activitytitle, 'title' => $activitytitle, 'url' => $activitylink),
                array('hasqbanklinks' => $qbanktitle, 'title' => $qbanktitle, 'url' => $qbanklink),
                array('hasqbanklinks' => $qcattitle, 'title' => $qcattitle, 'url' => $qcatlink),
                array('hasqbanklinks' => $qimporttitle, 'title' => $qimporttitle, 'url' => $qimportlink),
                array('hasqbanklinks' => $qexporttitle, 'title' => $qexporttitle, 'url' => $qexportlink),
                array('hascoursemanagelinks' => $courseedittitle, 'title' => $courseedittitle, 'url' => $courseeditlink),
                array('hascoursemanagelinks' => $coursecompletiontitle, 'title' => $coursecompletiontitle, 'url' => $coursecompletionlink),
                array('hascoursemanagelinks' => $courseadmintitle, 'title' => $courseadmintitle, 'url' => $courseadminlink),
                array('hascoursemanagelinks' => $courseresettitle, 'title' => $courseresettitle, 'url' => $courseresetlink),
                array('hascoursemanagelinks' => $coursebackuptitle, 'title' => $coursebackuptitle, 'url' => $coursebackuplink),
                array('hascoursemanagelinks' => $courserestoretitle, 'title' => $courserestoretitle, 'url' => $courserestorelink),
                array('hascoursemanagelinks' => $courseimporttitle, 'title' => $courseimporttitle, 'url' => $courseimportlink),
                array('hascoursemanagelinks' => $recyclebintitle, 'title' => $recyclebintitle, 'url' => $recyclebinlink),
                array('hascoursemanagelinks' => $filtertitle, 'title' => $filtertitle, 'url' => $filterlink),
                array('hasbadgelinks' => $badgemanagetitle, 'title' => $badgemanagetitle, 'url' => $badgemanagelink),
                array('hasbadgelinks' => $badgeaddtitle, 'title' => $badgeaddtitle, 'url' => $badgeaddlink),
            ),
        ];

        //attach easy enrollment links if active
        if ($globalhaseasyenrollment && $coursehaseasyenrollment) {
            $dashlinks['dashlinks'][] = array('haseasyenrollment' => $coursehaseasyenrollment, 'title' => $easycodetitle, 'url' => $easycodelink);

        }
        return $this->render_from_template('theme_growth_pedagogy/teacherdash', $dashlinks);

    }

    public function course_matadata_section() {
        global $COURSE, $CFG;
        $ret = '';
        // get course summary

        // Display metadata - AUDIENCE
        require_once($CFG->dirroot . '/ort/ort_util.php');
        $ret .= \ort_util::get_metadata_course_by_field_as_list($COURSE->id, array('discipline', 'topic', 'audience', 'language', 'development'));
        $ret .= \ort_util::get_metadata_course_by_field_as_link($COURSE->id, array('contact'));
        return $ret;
    }

    public function course_summary_section() {
        global $COURSE;
        return $COURSE->summary;
    }

    /**
     * @return string
     */
    public function fp_statistics() {
        global $DB;
        /* Get Cours Count*/
        $coursecount = $DB->count_records('course'); // Get course count

        /* Get teacher count - editingteacher + teacher */
        $teacherrole = $DB->get_records_list('role', 'shortname', array('editingteacher', 'teacher'), '', 'id');
        $teacherroleids = array_column($teacherrole, 'id');
        // because we want to get the count of 2 kinds of teachers, we create the sql query ourselves
        //list($cnd, $params) = $DB->get_in_or_equal($teacherroleids);
        $teachercountsql = "SELECT id FROM mdl_role_assignments WHERE roleid in (" . implode($teacherroleids, ',') . ")";
        $teachercount = isset($teacherrole) ? count($DB->get_records_sql($teachercountsql, $teacherroleids)) : '';

        /* Get student count - student */
        $studentrole = $DB->get_record('role', array('shortname' => 'student'), 'id');
        $studentcount = isset($teacherrole) ? $DB->count_records('role_assignments', array('roleid' => $studentrole->id)) : '';

        /* Get strings*/
        $statisticstitle = get_string('statisticstitle', 'theme_growth_pedagogy');
        $statisticscourses = get_string('courses', 'theme_growth_pedagogy');
        $statisticsteachers = get_string('teachers', 'theme_growth_pedagogy');
        $statisticsstudents = get_string('students', 'theme_growth_pedagogy');

        /* Build object to be read by mustache */
        $fp_statistics = ['statisticstitle' => $statisticstitle,
            'statisticscourses' => $statisticscourses, 'statisticsteachers' => $statisticsteachers, 'statisticsstudents' => $statisticsstudents,
            'coursecount' => $coursecount, 'teachercount' => $teachercount, 'studentcount' => $studentcount];
        return $this->render_from_template('theme_growth_pedagogy/fpstatistics', $fp_statistics);
    }

    /**
     * Put logo in top menu. Called from header.mustache
     * Lea 2017/7. Code taken from earlier function context_header.
     * In order for it to return the file, a condition is added to function theme_growth_pedagogy_pluginfile in theme/growth_pedagogy/lib/filesettings_lib.php
     */
    public function get_campus_primary_logo_url() {
        global $PAGE;
        $headerbg = $PAGE->theme->setting_file_url('logo_primary', 'logo_primary');
        return $headerbg;
    }

    /**
     * Put logo in top menu. Called from header.mustache
     * Lea 2017/7. Code taken from earlier function context_header
     * In order for it to return the file, a condition is added to function theme_growth_pedagogy_pluginfile in theme/growth_pedagogy/lib/filesettings_lib.php
     */
    public function get_campus_secondary_logo_url() {
        global $PAGE;
        $headerbg = $PAGE->theme->setting_file_url('logo_secondary', 'logo_secondary');
        return $headerbg;
    }

    /**
     * Lea 2017/8 - get the primary title for the header
     */
    public function get_campus_header_title_primary() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->header_title_primary;
        return $setting != '' ? $setting : '';
    }

    /**
     * Lea 2017/8 - get the secondary title for the header
     */
    public function get_campus_header_title_secondary() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->header_title_secondary;
        return $setting != '' ? $setting : '';
    }

    public function is_logged_in() {
        return isloggedin();
    }

    public function is_logged_in_and_not_guest() {
        return isloggedin() && !isguestuser();
    }

    public function footer_about() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->footnote_about;
        return $setting != '' ? $setting : '';
    }

    public function footer_details_title() {
        return get_string('contactandsupporttitle', 'theme_growth_pedagogy');
    }

    public function footer_address() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->address;
        return $setting != '' ? $setting : '';
    }

    public function footer_email() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->email;
        return $setting != '' ? $setting : '';
    }

    public function footer_phone() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->phone;
        return $setting != '' ? $setting : '';
    }

    public function footer_tutorials_link_url() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->tutorials;
        return $setting != '' ? $setting : '';
    }

    public function footer_facebook() {
        $theme = theme_config::load('growth_pedagogy');
        $setting = $theme->settings->facebook;
        return $setting != '' ? $setting : '';
    }

    /**
     * Render the contents of a block_list.
     * Lea 2017/9 - I overrid this function so I could add BS classes to the html elements
     */
    public function list_block_contents($icons, $items) {
        $row = 0;
        $lis = array();
        foreach ($items as $key => $string) {
            $item = html_writer::start_tag('li', array('class' => 'r' . $row . ' '));
            $item .= $string;
            //$item .= html_writer::tag('div', $string, array('class' => 'column c1'));
            $item .= html_writer::end_tag('li');
            $lis[] = $item;
            $row = 1 - $row; // Flip even/odd.
        }
        return html_writer::tag('ul', implode("\n", $lis), array('class' => 'card-group content'));
    }

    public function grades_url() {
        global $USER, $COURSE;

        return user_mygrades_url($USER->id, $COURSE->id);
    }

    /**
     * Taken from: https://moodle.org/mod/forum/discuss.php?d=324948#p1305540
     * @return bool
     * @throws Exception
     * @throws dml_exception
     */
    private function is_homepage() {
        global $PAGE, $ME, $CFG;
        $result = false;

        $url = null;
        if ($PAGE->has_set_url()) {
            $url = $PAGE->url;
        } else if ($ME !== null) {
            $url = new moodle_url(str_ireplace('/index.php', '/', $ME));
        }

        if ($url !== null) {
            $result = $url->compare(\context_system::instance()->get_url(), URL_MATCH_BASE);
        }

        return $result;
    }

    /**
     * @param \stdClass $CFG
     * @param \stdClass $COURSE
     * @return string
     * @throws \coding_exception
     */
    private function get_image_from_area_files($imgname) {
        global $CFG, $COURSE;
        require_once($CFG->libdir . '/filestorage/file_storage.php');
        require_once($CFG->dirroot . '/course/lib.php');

        // Get course overview files.

        if (empty($CFG->courseoverviewfileslimit)) {
            return '';
        }

        $fs = get_file_storage();
        $context = context_course::instance($COURSE->id);
        $files = $fs->get_area_files($context->id, 'course', 'overviewfiles', false, 'filename', false);
        if (count($files)) {
            $overviewfilesoptions = course_overviewfiles_options($COURSE->id);
            $acceptedtypes = $overviewfilesoptions['accepted_types'];
            if ($acceptedtypes !== '*') {
                // Filter only files with allowed extensions.
                require_once($CFG->libdir . '/filelib.php');
                foreach ($files as $key => $file) {
                    if (!file_extension_in_typegroup($file->get_filename(), $acceptedtypes)) {
                        unset($files[$key]);
                    }
                }
            }
            if (count($files) > $CFG->courseoverviewfileslimit) {
                // Return no more than $CFG->courseoverviewfileslimit files.
                $files = array_slice($files, 0, $CFG->courseoverviewfileslimit, true);
            }
        }
        $image = '';
        foreach ($files as $file) {
            $isimage = $file->is_valid_image();
            if ($isimage) {
                if (strpos($file->get_filename(), $imgname) !== false) {
                    $image = new moodle_url("$CFG->wwwroot/pluginfile.php" .
                        '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                        $file->get_filearea() . $file->get_filepath() . $file->get_filename());
                }
            }
        }
        return $image;
    }

}
