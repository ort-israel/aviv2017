<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 10/07/2017
 * Time: 15:08
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_bediuk_logos', get_string('logos_settings', 'theme_bediuk'));
$page->add(new admin_setting_heading('theme_bediuk_logos', get_string('logos_headingsub', 'theme_bediuk'),
    format_text(get_string('logos_desc' , 'theme_bediuk'), FORMAT_MARKDOWN)));

// Default header image.
/*$name = 'theme_bediuk/logo_primary';
$title = get_string('logo_primary', 'theme_bediuk');
$description = get_string('logo_primary_desc', 'theme_bediuk');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);*/
// Small logo file setting.
$name = 'theme_bediuk/logo_primary';
$title = get_string('logo_primary', 'theme_bediuk');
$description = get_string('logo_primary_desc', 'theme_bediuk');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_primary');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Small logo file setting.
$name = 'theme_bediuk/logo_secondary';
$title = get_string('logo_secondary', 'theme_bediuk');
$description = get_string('logo_secondary_desc', 'theme_bediuk');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo_secondary', 0,
    ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);