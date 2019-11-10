<?php

namespace block_anonymous_user\task;

class delete_anonymous_users extends \core\task\scheduled_task {

    public function get_name() {
        // Shown on admin screens
        return get_string('deleteanonymoususers', 'block_anonymous_user');
    }

    public function execute() {
        global $DB;
        $users = $DB->get_records_sql('SELECT * FROM {user} WHERE username LIKE \'anonymous_%\'');
        print_object($users);
//        if () {
//            echo "Cool! , no redundant users";
//        }

        foreach ($users as $user) {
            echo "Found username: $user->username , created time = $user->lastaccess <br/>";
        }

        // delete_records
        $deletedusers = $DB->get_records_sql("DELETE FROM {user} WHERE username LIKE 'anonymous_%' AND HOUR( TIMEDIFF( NOW() , FROM_UNIXTIME( lastaccess ) ) ) >=2 ");
        echo $deletedusers;
        // e.k - Please note! php NOW() function and mySQL time are not the same! use the FROM_UNIXTIME() function.
//        if ( ) {
//            echo "Cool! , no redundant users";
//        }
    }
}