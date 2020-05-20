<?php
/**
 * Theme config file.
 *
 * @package    theme_aviv2020
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// $THEME is defined before this page is included and we can define settings by adding properties to this global object.

// The first setting we need is the name of the theme. This should be the last part of the component name, and the same
// as the directory name for our theme.
$THEME->name = 'aviv2020';

// Call the theme lib file.
require_once(__DIR__ . '/lib.php');

// This setting list the style sheets we want to include in our theme. Because we want to use SCSS instead of CSS - we won't
// list any style sheets. If we did we would list the name of a file in the /style/ folder for our theme without any css file
// extensions.
$THEME->sheets = array('font-awesome');

// This is a setting that can be used to provide some styling to the content in the TinyMCE text editor. This is no longer the
// default text editor and "Atto" does not need this setting so we won't provide anything. If we did it would work the same
// as the previous setting - listing a file in the /styles/ folder.
$THEME->editor_sheets = [''];

// This is a critical setting. We want to inherit from theme_boost because it provides a great starting point for SCSS bootstrap4
// themes. We could add more than one parent here to inherit from multiple parents, and if we did they would be processed in
// order of importance (later themes overriding earlier ones). Things we will inherit from the parent theme include
// styles and mustache templates and some (not all) settings.
$THEME->parents = ['boost', 'fordson'];

$THEME->layouts = [
    // The site home page.
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('in-header', 'above-content'),
        'defaultregion' => 'above-content',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'mydashboard.php',
        'regions' => array('below-content'),
        'defaultregion' => 'below-content',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Category page
    'coursecategory' => array(
        'file' => 'columns2.php',
        'regions' => array('below-content'),
        'defaultregion' => 'below-content',
    ),
    // Main course page.
    'course' => array(
        'file' => 'course.php',
        'regions' => array('side-pre','below-content'),
        'defaultregion' => 'side-pre',
    ),
    'incourse' => array(
        'file' => 'incourse.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Server administration scripts. We want 2 columns like in classic boost, so copied columns2.php from boost and called ii admin.php
    'admin' => array(
        'file' => 'admin.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
];


// Call css/scss processing functions and renderers.
$THEME->scss = function ($theme) {
    return theme_aviv2020_get_main_scss_content($theme);
};

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->requiredblocks = '';


