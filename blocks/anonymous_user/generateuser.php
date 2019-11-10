<?php
//
// !!!!BIG security risk !!!!
//

include '../../config.php';

class generate_user {

    function run() {

        global $CFG, $DB, $USER;

// e.k 9.12.2012 - Find out How many Guests are currently inside the system.
// If more than Allowed --> Do not proceed to the site!
        $maxGuestsAllowed = $CFG->MaxGuests;
        $numberOfGuests = $DB->count_records_sql('SELECT COUNT(username) FROM `mdl_user` WHERE username LIKE \'anonymous_%\'');

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
        if (!($course = $DB->get_record('course', array('id' => $courseid)))) {
            print_error('invalidcourseid', 'error');
        }
        $newuser = new \stdClass();
        $newuser->id = -1;  // make sure there is no id since we are creating a new user
        $newuser->mnethostid = 1; // always local user
        $newuser->confirmed = 1;
        $newuser->username = 'anonymous_' . time();
        $newuser->firstname = 'משתמש';
        $newuser->lastname = 'אורח';
        $newuser->middlename = '';
        $newuser->firstnamephonetic = 'Guest';
        $newuser->lastnamephonetic = 'User';
        $newuser->alternatename = 'Super User';
        $newuser->language = 'he_IL';
        $newuser->email = 'noemail@email.com';
        $newuser->emailstop = 1;
        $newuser->city = 'רמת גן';
        $newuser->country = 'IL';
        $newuser->lang = $course->lang;
        $newuser->password = hash_internal_user_password('anonymous_questionnaire');
        $newuser->timemodified = time();
        $newuser->lastaccess = time();
        $newuser->auth = 'manual';
        $newuser->policyagreed = true;
        $newuser->deleted = false;

        if (!$newuser->id = $DB->insert_record('user', $newuser)) {
            error('Error creating user:anonymous_questionnaire record');
        }

        $newuser->picture = $this->get_user_picture($newuser, $CFG);
        $newuser->imagealt = '';

        if (!$enrol_manual = enrol_get_plugin('manual')) {
            throw new coding_exception('Can not instantiate enrol_manual');
        }
        $instance = $DB->get_record('enrol', array('courseid' => $courseid, 'enrol' => 'manual', 'status' => 0), '*', MUST_EXIST);

        $today = time();
        $startdate = make_timestamp(date('Y', $today), date('m', $today), date('d', $today), date('H', $today), date('i', $today), 0);
        $enddate = make_timestamp(date('Y', $today), date('m', $today), date('d', $today), date('H', $today) + 2, date('i', $today), 0);

        // Tsofiya: - Number 9 is "Supper Guest" from role Student
        // Please pay attention!!! This is not an arbitrary role ! I have created a special role called: SuperGuest
        // which inherent from the Student's role and have some extra Attributes.
        $enrol_manual->enrol_user($instance, $newuser->id, 9, $startdate, $enddate);
        //add_to_log($course->id, 'course', 'enrol', '../enrol/users.php?id=' . $course->id, $course->id); //there should be userid somewhere!

        $newuser->lang = $course->lang; // Display questionnaire aligned to the right direction, depending on course's language.
        $USER = $newuser;

        // e.k - Activate the redirect command !!!

        //Tsofiya 02/12/2015: add redirect to spesific section if specified
        if ($sectionid !== null) {
            redirect($CFG->wwwroot . '/course/view.php?id=' . $courseid . '&amp;section=' . $sectionid);
        } else {
            redirect($CFG->wwwroot . '/course/view.php?id=' . $courseid);
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
}

$generate_user = new generate_user();
$generate_user->run();