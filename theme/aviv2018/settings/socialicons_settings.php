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
 * Social networking settings page file.
 *
 * @package    theme_aviv2018
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* Social Network Settings */
$page = new admin_settingpage('theme_aviv2018_social', get_string('socialheading', 'theme_aviv2018'));
$page->add(new admin_setting_heading('theme_aviv2018_social', get_string('socialheadingsub', 'theme_aviv2018'),
        format_text(get_string('socialdesc' , 'theme_aviv2018'), FORMAT_MARKDOWN)));

// Website url setting.
$name = 'theme_aviv2018/website';
$title = get_string('website', 'theme_aviv2018');
$description = get_string('websitedesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Blog url setting.
$name = 'theme_aviv2018/blog';
$title = get_string('blog', 'theme_aviv2018');
$description = get_string('blogdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Facebook url setting.
$name = 'theme_aviv2018/facebook';
$title = get_string(        'facebook', 'theme_aviv2018');
$description = get_string(      'facebookdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Flickr url setting.
$name = 'theme_aviv2018/flickr';
$title = get_string('flickr', 'theme_aviv2018');
$description = get_string('flickrdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Twitter url setting.
$name = 'theme_aviv2018/twitter';
$title = get_string('twitter', 'theme_aviv2018');
$description = get_string('twitterdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Google+ url setting.
$name = 'theme_aviv2018/googleplus';
$title = get_string('googleplus', 'theme_aviv2018');
$description = get_string('googleplusdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// LinkedIn url setting.
$name = 'theme_aviv2018/linkedin';
$title = get_string('linkedin', 'theme_aviv2018');
$description = get_string('linkedindesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Tumblr url setting.
$name = 'theme_aviv2018/tumblr';
$title = get_string('tumblr', 'theme_aviv2018');
$description = get_string('tumblrdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Pinterest url setting.
$name = 'theme_aviv2018/pinterest';
$title = get_string('pinterest', 'theme_aviv2018');
$description = get_string('pinterestdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Instagram url setting.
$name = 'theme_aviv2018/instagram';
$title = get_string('instagram', 'theme_aviv2018');
$description = get_string('instagramdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// YouTube url setting.
$name = 'theme_aviv2018/youtube';
$title = get_string('youtube', 'theme_aviv2018');
$description = get_string('youtubedesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Vimeo url setting.
$name = 'theme_aviv2018/vimeo';
$title = get_string('vimeo', 'theme_aviv2018');
$description = get_string('vimeodesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Skype url setting.
$name = 'theme_aviv2018/skype';
$title = get_string('skype', 'theme_aviv2018');
$description = get_string('skypedesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// General social url setting 1.
$name = 'theme_aviv2018/social1';
$title = get_string('sociallink', 'theme_aviv2018');
$description = get_string('sociallinkdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 1.
$name = 'theme_aviv2018/socialicon1';
$title = get_string('sociallinkicon', 'theme_aviv2018');
$description = get_string('sociallinkicondesc', 'theme_aviv2018');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// General social url setting 2.
$name = 'theme_aviv2018/social2';
$title = get_string('sociallink', 'theme_aviv2018');
$description = get_string('sociallinkdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 2.
$name = 'theme_aviv2018/socialicon2';
$title = get_string('sociallinkicon', 'theme_aviv2018');
$description = get_string('sociallinkicondesc', 'theme_aviv2018');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// General social url setting 3.
$name = 'theme_aviv2018/social3';
$title = get_string('sociallink', 'theme_aviv2018');
$description = get_string('sociallinkdesc', 'theme_aviv2018');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Social icon setting 3.
$name = 'theme_aviv2018/socialicon3';
$title = get_string('sociallinkicon', 'theme_aviv2018');
$description = get_string('sociallinkicondesc', 'theme_aviv2018');
$default = 'home';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
