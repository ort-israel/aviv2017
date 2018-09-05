<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_mop_general_header_title', get_string('header_title_settings', 'theme_mop_general'));
$page->add(new admin_setting_heading('theme_mop_general_header_title', get_string('header_title_headingsub', 'theme_mop_general'),
    format_text(get_string('header_title_desc', 'theme_mop_general'), FORMAT_MARKDOWN)));

// Small logo file setting.
$name = 'theme_mop_general/header_title_primary';
$title = get_string('header_title_primary', 'theme_mop_general');
$description = get_string('header_title_primary_desc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small header_title file setting.
$name = 'theme_mop_general/header_title_secondary';
$title = get_string('header_title_secondary', 'theme_mop_general');
$description = get_string('header_title_secondary_desc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);