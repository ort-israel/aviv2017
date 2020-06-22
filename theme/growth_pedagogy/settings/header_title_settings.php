<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_growth_pedagogy_header_title', get_string('header_title_settings', 'theme_growth_pedagogy'));
$page->add(new admin_setting_heading('theme_growth_pedagogy_header_title', get_string('header_title_headingsub', 'theme_growth_pedagogy'),
    format_text(get_string('header_title_desc', 'theme_growth_pedagogy'), FORMAT_MARKDOWN)));

// Small logo file setting.
$name = 'theme_growth_pedagogy/header_title_primary';
$title = get_string('header_title_primary', 'theme_growth_pedagogy');
$description = get_string('header_title_primary_desc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small header_title file setting.
$name = 'theme_growth_pedagogy/header_title_secondary';
$title = get_string('header_title_secondary', 'theme_growth_pedagogy');
$description = get_string('header_title_secondary_desc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);