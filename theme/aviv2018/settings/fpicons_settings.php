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
 * 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Icon Navigation);
$page = new admin_settingpage('theme_aviv2018_iconnavheading', get_string('iconnavheading', 'theme_aviv2018'));

    // This is the descriptor for icon One
    $name = 'theme_aviv2018/iconwidthinfo';
    $heading = get_string('iconwidthinfo', 'theme_aviv2018');
    $information = get_string('iconwidthinfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Icon width setting.
    $name = 'theme_aviv2018/iconwidth';
    $title = get_string('iconwidth', 'theme_aviv2018');
    $description = get_string('iconwidth_desc', 'theme_aviv2018');;
    $default = '100px';
    $choices = array(
        '75px' => '75px',
        '85px' => '85px',
        '95px' => '95px',
        '100px' => '100px',
        '105px' => '105px',
        '110px' => '110px',
        '115px' => '115px',
        '120px' => '120px',
        '125px' => '125px',
        '130px' => '130px',
        '135px' => '135px',
        '140px' => '140px',
        '145px' => '145px',
        '150px' => '150px',
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);



    // This is the descriptor for teacher create a course
    $name = 'theme_aviv2018/createinfo';
    $heading = get_string('createinfo', 'theme_aviv2018');
    $information = get_string('createinfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Creator Icon
    $name = 'theme_aviv2018/createicon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = 'edit';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/createbuttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = get_string('naviconbuttoncreatetextdefault', 'theme_aviv2018');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/createbuttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default =  $CFG->wwwroot.'/course/edit.php?category=1';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for teacher create a course
    $name = 'theme_aviv2018/sliderinfo';
    $heading = get_string('sliderinfo', 'theme_aviv2018');
    $information = get_string('sliderinfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // Creator Icon
    $name = 'theme_aviv2018/slideicon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('naviconslidedesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/slideiconbuttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Slide Textbox.
    $name = 'theme_aviv2018/slidetextbox';
    $title = get_string('slidetextbox', 'theme_aviv2018');
    $description = get_string('slidetextbox_desc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // This is the descriptor for icon One
    $name = 'theme_aviv2018/navicon1info';
    $heading = get_string('navicon1', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    // icon One
    $name = 'theme_aviv2018/nav1icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = 'home';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav1buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = get_string('naviconbutton1textdefault', 'theme_aviv2018');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav1buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default =  $CFG->wwwroot.'/my/';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon One
    $name = 'theme_aviv2018/navicon2info';
    $heading = get_string('navicon2', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav2icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = 'calendar';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav2buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = get_string('naviconbutton2textdefault', 'theme_aviv2018');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav2buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default =  $CFG->wwwroot.'/calendar/view.php?view=month';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon three
    $name = 'theme_aviv2018/navicon3info';
    $heading = get_string('navicon3', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav3icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = 'bookmark';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav3buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = get_string('naviconbutton3textdefault', 'theme_aviv2018');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav3buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default =  $CFG->wwwroot.'/badges/mybadges.php';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon four
    $name = 'theme_aviv2018/navicon4info';
    $heading = get_string('navicon4', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav4icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = 'book';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav4buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = get_string('naviconbutton4textdefault', 'theme_aviv2018');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav4buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default =  $CFG->wwwroot.'/course/';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon four
    $name = 'theme_aviv2018/navicon5info';
    $heading = get_string('navicon5', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav5icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav5buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav5buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon six
    $name = 'theme_aviv2018/navicon6info';
    $heading = get_string('navicon6', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav6icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav6buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav6buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon seven
    $name = 'theme_aviv2018/navicon7info';
    $heading = get_string('navicon7', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav7icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav7buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav7buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for icon eight
    $name = 'theme_aviv2018/navicon8info';
    $heading = get_string('navicon8', 'theme_aviv2018');
    $information = get_string('navicondesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);

    $name = 'theme_aviv2018/nav8icon';
    $title = get_string('navicon', 'theme_aviv2018');
    $description = get_string('navicondesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav8buttontext';
    $title = get_string('naviconbuttontext', 'theme_aviv2018');
    $description = get_string('naviconbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/nav8buttonurl';
    $title = get_string('naviconbuttonurl', 'theme_aviv2018');
    $description = get_string('naviconbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
