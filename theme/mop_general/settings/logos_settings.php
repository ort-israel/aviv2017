<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_mop_general_logos', get_string('logos_settings', 'theme_mop_general'));
$page->add(new admin_setting_heading('theme_mop_general_logos', get_string('logos_headingsub', 'theme_mop_general'),
    format_text(get_string('logos_desc' , 'theme_mop_general'), FORMAT_MARKDOWN)));

// Default header image.
/*$name = 'theme_mop_general/logo_primary';
$title = get_string('logo_primary', 'theme_mop_general');
$description = get_string('logo_primary_desc', 'theme_mop_general');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);*/
// Small logo file setting.
$name = 'theme_mop_general/logo_primary';
$title = get_string('logo_primary', 'theme_mop_general');
$description = get_string('logo_primary_desc', 'theme_mop_general');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small logo file setting.
$name = 'theme_mop_general/logo_secondary';
$title = get_string('logo_secondary', 'theme_mop_general');
$description = get_string('logo_secondary_desc', 'theme_mop_general');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_secondary', 0,
    ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);