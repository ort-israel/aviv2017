<?php
/**
 * @package    theme_aviv2018
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_aviv2018_footer', get_string('footer_settings', 'theme_aviv2018'));
$page->add(new admin_setting_heading('theme_aviv2018_footer', get_string('footer_headingsub', 'theme_aviv2018'),
    format_text(get_string('footer_desc' , 'theme_aviv2018'), FORMAT_MARKDOWN)));

// This is the descriptor for Marketing Spot One
$name = 'theme_aviv2018/marketing1info';
$heading = get_string('footer1', 'theme_aviv2018');
$information = get_string('footerinfodesc', 'theme_aviv2018');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Footer Spot One
$name = 'theme_aviv2018/footer1';
$title = get_string('footertitle', 'theme_aviv2018');
$description = get_string('footertitledesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/footer1content';
$title = get_string('footercontent', 'theme_aviv2018');
$description = get_string('footercontentdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);