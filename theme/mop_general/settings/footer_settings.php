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

/**
 * Footer settings page file.
 *
 * @package    theme_mop_general
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* Footer Heading Settings */
$page = new admin_settingpage('theme_mop_general_footer', get_string('footerheading', 'theme_mop_general'));
$page->add(new admin_setting_heading('theme_mop_general_footer', get_string('footerheadingsub', 'theme_mop_general'),
    format_text(get_string('footerdesc', 'theme_mop_general'), FORMAT_MARKDOWN)));

// Footnote About setting.
$name = 'theme_mop_general/footnote_about';
$title = get_string('footnoteabout', 'theme_mop_general');
$description = get_string('footnoteaboutdesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Details
$name = 'theme_mop_general/details';
$heading = get_string('footerdetails', 'theme_mop_general');
$information = get_string('footerdetailsdesc', 'theme_mop_general');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Address
$name = 'theme_mop_general/address';
$heading = get_string('footeraddress', 'theme_mop_general');
$information = get_string('footeraddressdesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $heading, $information, $default);
$page->add($setting);

// Website url setting.
$name = 'theme_mop_general/email';
$title = get_string('footeremail', 'theme_mop_general');
$description = get_string('footeremaildesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Blog url setting.
$name = 'theme_mop_general/phone';
$title = get_string('footerphone', 'theme_mop_general');
$description = get_string('footerphonedesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name = 'theme_mop_general/tutorials';
$title = get_string('footertutorials', 'theme_mop_general');
$description = get_string('footertutorialsdesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Flickr url setting.
$name = 'theme_mop_general/facebook';
$title = get_string('footerfacebook', 'theme_mop_general');
$description = get_string('footerfacebookdesc', 'theme_mop_general');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
