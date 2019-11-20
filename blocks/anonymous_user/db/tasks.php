<?php

/**
 * In this file are specified the timings that Moodle uses with cron in order to
 * periodically launch tasks.
 *
 */
$tasks = array(
    /**
     * Export data
     */
    array(
        'classname' => 'block_anonymous_user\task\delete_anonymous_users',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '*/2',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*'
    )
);