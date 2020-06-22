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
 * @package    theme_growth_pedagogy
 * @copyright  2016 Chris Kenniburg
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* Footer Heading Settings */
$page = new admin_settingpage('theme_growth_pedagogy_footer', get_string('footerheading', 'theme_growth_pedagogy'));
$page->add(new admin_setting_heading('theme_growth_pedagogy_footer', get_string('footerheadingsub', 'theme_growth_pedagogy'),
    format_text(get_string('footerdesc', 'theme_growth_pedagogy'), FORMAT_MARKDOWN)));

// Footnote About setting.
$name = 'theme_growth_pedagogy/footnote_about';
$title = get_string('footnoteabout', 'theme_growth_pedagogy');
$description = get_string('footnoteaboutdesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Details
$name = 'theme_growth_pedagogy/details';
$heading = get_string('footerdetails', 'theme_growth_pedagogy');
$information = get_string('footerdetailsdesc', 'theme_growth_pedagogy');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Address
$name = 'theme_growth_pedagogy/address';
$heading = get_string('footeraddress', 'theme_growth_pedagogy');
$information = get_string('footeraddressdesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $heading, $information, $default);
$page->add($setting);

// Website url setting.
$name = 'theme_growth_pedagogy/email';
$title = get_string('footeremail', 'theme_growth_pedagogy');
$description = get_string('footeremaildesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Blog url setting.
$name = 'theme_growth_pedagogy/phone';
$title = get_string('footerphone', 'theme_growth_pedagogy');
$description = get_string('footerphonedesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name = 'theme_growth_pedagogy/tutorials';
$title = get_string('footertutorials', 'theme_growth_pedagogy');
$description = get_string('footertutorialsdesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Flickr url setting.
$name = 'theme_growth_pedagogy/facebook';
$title = get_string('footerfacebook', 'theme_growth_pedagogy');
$description = get_string('footerfacebookdesc', 'theme_growth_pedagogy');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
