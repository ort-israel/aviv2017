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
 * Colours settings page file.
 *
 * @package    theme_aviv2018
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @licensehttp://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_aviv2018_colours', get_string('colours_settings', 'theme_aviv2018'));
$page->add(new admin_setting_heading('theme_aviv2018_colours', get_string('colours_headingsub', 'theme_aviv2018'),
        format_text(get_string('colours_desc' , 'theme_aviv2018'), FORMAT_MARKDOWN)));


    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_aviv2018/scsspre',
        get_string('rawscsspre', 'theme_aviv2018'), get_string('rawscsspre_desc', 'theme_aviv2018'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $body-color.
    $name = 'theme_aviv2018/bodycolor';
    $title = get_string('bodycolor', 'theme_aviv2018');
    $description = get_string('bodycolor_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $link-color
    $name = 'theme_aviv2018/linkcolor';
    $title = get_string('linkcolor', 'theme_aviv2018');
    $description = get_string('linkcolor_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brandprimary.
    $name = 'theme_aviv2018/brandprimary';
    $title = get_string('brandprimary', 'theme_aviv2018');
    $description = get_string('brandprimary_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brandsuccess.
    $name = 'theme_aviv2018/brandsuccess';
    $title = get_string('brandsuccess', 'theme_aviv2018');
    $description = get_string('brandsuccess_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brandwarning.
    $name = 'theme_aviv2018/brandwarning';
    $title = get_string('brandwarning', 'theme_aviv2018');
    $description = get_string('brandwarning_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $branddanger.
    $name = 'theme_aviv2018/branddanger';
    $title = get_string('branddanger', 'theme_aviv2018');
    $description = get_string('branddanger_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brandinfo.
    $name = 'theme_aviv2018/brandinfo';
    $title = get_string('brandinfo', 'theme_aviv2018');
    $description = get_string('brandinfo_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $graybase.
    $name = 'theme_aviv2018/brandgraybase';
    $title = get_string('brandgray', 'theme_aviv2018');
    $description = get_string('brandgray_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $headings-color.
    $name = 'theme_aviv2018/headingcolor';
    $title = get_string('headingcolor', 'theme_aviv2018');
    $description = get_string('headingcolor_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $header-color.
    $name = 'theme_aviv2018/headercolor';
    $title = get_string('headercolor', 'theme_aviv2018');
    $description = get_string('headercolor_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // header overlay
    $name = 'theme_aviv2018/headerscreen';
    $title = get_string('headerscreen', 'theme_aviv2018');
    $description = get_string('headerscreen_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // @bodyBackground setting.
    $name = 'theme_aviv2018/bodybackground';
    $title = get_string('bodybackground', 'theme_aviv2018');
    $description = get_string('bodybackground_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // @breadcrumbBackground setting.
    $name = 'theme_aviv2018/breadcrumbbkg';
    $title = get_string('breadcrumbbkg', 'theme_aviv2018');
    $description = get_string('breadcrumbbkg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // navbar.
    $name = 'theme_aviv2018/navbarbkg';
    $title = get_string('navbarbkg', 'theme_aviv2018');
    $description = get_string('navbarbkg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // navbar links.
    $name = 'theme_aviv2018/navbarurl';
    $title = get_string('navbarurl', 'theme_aviv2018');
    $description = get_string('navbarurl_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // icon nav background.
    $name = 'theme_aviv2018/fpstartwrap';
    $title = get_string('fpstartwrap', 'theme_aviv2018');
    $description = get_string('fpstartwrap_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // icon color
    $name = 'theme_aviv2018/fpiconcolour';
    $title = get_string('fpicon-colour', 'theme_aviv2018');
    $description = get_string('fpicon-colour_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // icon rollover
    $name = 'theme_aviv2018/fpiconnavhover';
    $title = get_string('fpiconnavhover', 'theme_aviv2018');
    $description = get_string('fpiconnavhover_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // marketing tile text background
    $name = 'theme_aviv2018/markettextbg';
    $title = get_string('markettextbg', 'theme_aviv2018');
    $description = get_string('markettextbg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // layout card background
    $name = 'theme_aviv2018/cardbkg';
    $title = get_string('cardbkg', 'theme_aviv2018');
    $description = get_string('cardbkg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // layout drawer background
    $name = 'theme_aviv2018/drawerbkg';
    $title = get_string('drawerbkg', 'theme_aviv2018');
    $description = get_string('drawerbkg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // layout footer background
    $name = 'theme_aviv2018/footerbg';
    $title = get_string('footerbg', 'theme_aviv2018');
    $description = get_string('footerbg_desc', 'theme_aviv2018');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

// Raw SCSS to include after the content.
$setting = new admin_setting_configtextarea('theme_aviv2018/scss', get_string('rawscss', 'theme_aviv2018'),
    get_string('rawscss_desc', 'theme_aviv2018'), '', PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);
