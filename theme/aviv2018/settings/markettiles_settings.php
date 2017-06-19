<?php

defined('MOODLE_INTERNAL') || die();

/* Marketing Spot Settings temp*/
$page = new admin_settingpage('theme_aviv2018_marketing', get_string('marketingheading', 'theme_aviv2018'));

    // Toggle FP Textbox Spots.
    $name = 'theme_aviv2018/togglemarketing';
    $title = get_string('togglemarketing' , 'theme_aviv2018');
    $description = get_string('togglemarketing_desc', 'theme_aviv2018');
    $displaytop = get_string('displaytop', 'theme_aviv2018');
    $displaybottom = get_string('displaybottom', 'theme_aviv2018');
    $default = '2';
    $choices = array('1'=>$displaytop, '2'=>$displaybottom);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for Marketing Spot One
    $name = 'theme_aviv2018/marketing1info';
    $heading = get_string('marketing1', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot One
    $name = 'theme_aviv2018/marketing1';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing1image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing1content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing1buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing1buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing1target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    // This is the descriptor for Marketing Spot Two
    $name = 'theme_aviv2018/marketing2info';
    $heading = get_string('marketing2', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot Two.
    $name = 'theme_aviv2018/marketing2';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing2image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing2content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing2buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing2buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing2target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    // This is the descriptor for Marketing Spot Three
    $name = 'theme_aviv2018/marketing3info';
    $heading = get_string('marketing3', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot Three.
    $name = 'theme_aviv2018/marketing3';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing3image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing3content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing3buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_aviv2018/marketing3buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing3target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for Marketing Spot Four
    $name = 'theme_aviv2018/marketing4info';
    $heading = get_string('marketing4', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot
    $name = 'theme_aviv2018/marketing4';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing4image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing4content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing4buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing4buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing4target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // This is the descriptor for Marketing Spot Four
    $name = 'theme_aviv2018/marketing5info';
    $heading = get_string('marketing5', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot
    $name = 'theme_aviv2018/marketing5';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing5image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing5image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing5content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing5buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing5buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing5target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // This is the descriptor for Marketing Spot Four
    $name = 'theme_aviv2018/marketing6info';
    $heading = get_string('marketing6', 'theme_aviv2018');
    $information = get_string('marketinginfodesc', 'theme_aviv2018');
    $setting = new admin_setting_heading($name, $heading, $information);
    $page->add($setting);
    
    // Marketing Spot
    $name = 'theme_aviv2018/marketing6';
    $title = get_string('marketingtitle', 'theme_aviv2018');
    $description = get_string('marketingtitledesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Background image setting.
    $name = 'theme_aviv2018/marketing6image';
    $title = get_string('marketingimage', 'theme_aviv2018');
    $description = get_string('marketingimage_desc', 'theme_aviv2018');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing6image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing6content';
    $title = get_string('marketingcontent', 'theme_aviv2018');
    $description = get_string('marketingcontentdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing6buttontext';
    $title = get_string('marketingbuttontext', 'theme_aviv2018');
    $description = get_string('marketingbuttontextdesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing6buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_aviv2018');
    $description = get_string('marketingbuttonurldesc', 'theme_aviv2018');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    
    $name = 'theme_aviv2018/marketing6target';
    $title = get_string('marketingurltarget' , 'theme_aviv2018');
    $description = get_string('marketingurltargetdesc', 'theme_aviv2018');
    $target1 = get_string('marketingurltargetself', 'theme_aviv2018');
    $target2 = get_string('marketingurltargetnew', 'theme_aviv2018');
    $target3 = get_string('marketingurltargetparent', 'theme_aviv2018');
    $default = 'target1';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

// Must add the page after definiting all the settings!
$settings->add($page);