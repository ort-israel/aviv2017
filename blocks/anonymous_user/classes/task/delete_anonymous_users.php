<?php

namespace block_anonymous_user\task;

class delete_anonymous_users extends \core\task\scheduled_task {

    public function get_name() {
        // Shown on admin screens
        return get_string('deleteanonymoususers', 'block_anonymous_user');
    }

    public function execute() {
        global $DB;
        $users = $DB->get_records_sql('SELECT * FROM {user} WHERE username LIKE \'anonymous_%\' AND HOUR( TIMEDIFF( NOW() , FROM_UNIXTIME( lastaccess ) ) ) >=2  and deleted=0');


        foreach ($users as $user) {
            $user->deleted = 1;
            user_update_user($user, false);
            // delete_user($user);
            echo "Found username: $user->username , created time = $user->lastaccess <br/>";
        }

    }
}