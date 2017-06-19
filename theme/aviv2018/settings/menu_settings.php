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
 * Heading and course images settings page file.
 *
 * @package    theme_aviv2018
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @licensehttp://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_aviv2018_menusettings', get_string('menusettings', 'theme_aviv2018'));

// Show hide Course Activity Menu toggle.
$name = 'theme_aviv2018/activitymenu';
$title = get_string('activitymenu', 'theme_aviv2018');
$description = get_string('activitymenu_desc', 'theme_aviv2018');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// Show hide user enrollment toggle.
$name = 'theme_aviv2018/userenrollmenu';
$title = get_string('userenrollmenu', 'theme_aviv2018');
$description = get_string('userenrollmenu_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// Show hide user enrollment toggle.
$name = 'theme_aviv2018/groupmanagemenu';
$title = get_string('groupmanagemenu', 'theme_aviv2018');
$description = get_string('groupmanagemenu_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// Show hide user enrollment toggle.
$name = 'theme_aviv2018/questionbankmenu';
$title = get_string('questionbankmenu', 'theme_aviv2018');
$description = get_string('questionbankmenu_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// Show hide user enrollment toggle.
$name = 'theme_aviv2018/questioncategorymenu';
$title = get_string('questioncategorymenu', 'theme_aviv2018');
$description = get_string('questioncategorymenu_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// Show hide user enrollment toggle.
$name = 'theme_aviv2018/activitylistingmenu';
$title = get_string('activitylistingmenu', 'theme_aviv2018');
$description = get_string('activitylistingmenu_desc', 'theme_aviv2018');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// This is the descriptor for nav drawer
$name = 'theme_aviv2018/mycoursesmenuinfo';
$heading = get_string('mycoursesinfo', 'theme_aviv2018');
$information = get_string('mycoursesinfodesc', 'theme_aviv2018');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Toggle courses display in custommenu.
$name = 'theme_aviv2018/displaymycourses';
$title = get_string('displaymycourses', 'theme_aviv2018');
$description = get_string('displaymycoursesdesc', 'theme_aviv2018');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Set terminology for dropdown course list
$name = 'theme_aviv2018/mycoursetitle';
$title = get_string('mycoursetitle','theme_aviv2018');
$description = get_string('mycoursetitledesc', 'theme_aviv2018');
$default = 'course';
$choices = array(
	'course' => get_string('mycourses', 'theme_aviv2018'),
	'unit' => get_string('myunits', 'theme_aviv2018'),
	'class' => get_string('myclasses', 'theme_aviv2018'),
	'module' => get_string('mymodules', 'theme_aviv2018')
);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);


//Drawer Menu
// This is the descriptor for nav drawer
$name = 'theme_aviv2018/drawermenuinfo';
$heading = get_string('setting_removenodesheading', 'theme_aviv2018');
$information = get_string('setting_removenodesperformancehint', 'theme_aviv2018');
$setting = new admin_setting_heading($name, $heading, $information);
$page->add($setting);

// Toggle Marketing Spots.
$name = 'theme_aviv2018/toggledrawermenu';
$title = get_string('toggledrawermenu' , 'theme_aviv2018');
$description = get_string('toggledrawermenu_desc', 'theme_aviv2018');
$alwaysdisplay = get_string('activateonboth', 'theme_aviv2018');
$displayhome = get_string('activateonhomepage', 'theme_aviv2018');
$displaycourse = get_string('activateoncoursepage', 'theme_aviv2018');
$default = '1';
$choices = array('1'=>$alwaysdisplay, '2'=>$displayhome, '3'=>$displaycourse);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/removehomenode';
$title = get_string('setting_removehomenode', 'theme_aviv2018');
$description = get_string('setting_removehomenode_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/removecalendarnode';
$title = get_string('setting_removecalendarnode', 'theme_aviv2018');
$description = get_string('setting_removecalendarnode_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/removeprivatefilesnode';
$title = get_string('setting_removeprivatefilesnode', 'theme_aviv2018');
$description = get_string('setting_removeprivatefilesnode_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/removemycoursesnode';
$title = get_string('setting_removemycoursesnode', 'theme_aviv2018');
$description = get_string('setting_removemycoursesnode_desc', 'theme_aviv2018');
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = 'theme_aviv2018/adddrawermenu';
$title = get_string('adddrawermenu', 'theme_aviv2018');
$description = get_string('adddrawermenu_desc', 'theme_aviv2018');
$setting = new admin_setting_configtextarea($name, $title, $description, '', PARAM_RAW, '50', '10');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
