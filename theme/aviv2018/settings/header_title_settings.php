<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_aviv2018_header_title', get_string('header_title_settings', 'theme_aviv2018'));
$page->add(new admin_setting_heading('theme_aviv2018_header_title', get_string('header_title_headingsub', 'theme_aviv2018'),
    format_text(get_string('header_title_desc', 'theme_aviv2018'), FORMAT_MARKDOWN)));

// Small logo file setting.
$name = 'theme_aviv2018/header_title_primary';
$title = get_string('header_title_primary', 'theme_aviv2018');
$description = get_string('header_title_primary_desc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small header_title file setting.
$name = 'theme_aviv2018/header_title_secondary';
$title = get_string('header_title_secondary', 'theme_aviv2018');
$description = get_string('header_title_secondary_desc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);