<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_growth_pedagogy_logos', get_string('logos_settings', 'theme_growth_pedagogy'));
$page->add(new admin_setting_heading('theme_growth_pedagogy_logos', get_string('logos_headingsub', 'theme_growth_pedagogy'),
    format_text(get_string('logos_desc' , 'theme_growth_pedagogy'), FORMAT_MARKDOWN)));

// Default header image.
/*$name = 'theme_growth_pedagogy/logo_primary';
$title = get_string('logo_primary', 'theme_growth_pedagogy');
$description = get_string('logo_primary_desc', 'theme_growth_pedagogy');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);*/
// Small logo file setting.
$name = 'theme_growth_pedagogy/logo_primary';
$title = get_string('logo_primary', 'theme_growth_pedagogy');
$description = get_string('logo_primary_desc', 'theme_growth_pedagogy');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small logo file setting.
$name = 'theme_growth_pedagogy/logo_secondary';
$title = get_string('logo_secondary', 'theme_growth_pedagogy');
$description = get_string('logo_secondary_desc', 'theme_growth_pedagogy');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_secondary', 0,
    ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);