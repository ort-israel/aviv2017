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
 * SCSS Lib file.
 *
 * @package    theme_aviv2020
 * @copyright  2016 Chris Kenniburg
 * 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Post process the CSS tree.
 *
 * @param string $tree The CSS tree.
 * @param theme_config $theme The theme config object.
 */
function theme_aviv2020_css_tree_post_processor($tree, $theme) {
    $prefixer = new theme_aviv2020\autoprefixer($tree);
    $prefixer->prefix();
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_aviv2020_get_main_scss_content($theme) {
    global $CFG;

    /* Lea 10/2017 - No more presets. There is only one color scheme for this theme */

    $scss = file_get_contents($CFG->dirroot . '/theme/aviv2020/scss/moodle.scss');
    return $scss;
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_aviv2020_get_pre_scss($theme) {
    global $CFG;

    $prescss = '';

    $configurable = [
    // Config key => variableName, ....
        'brandprimary' => ['brand-primary'],
        'brandsuccess' => ['brand-success'],
        'brandinfo' => ['brand-info'],
        'brandwarning' => ['brand-warning'],
        'branddanger' => ['brand-danger'],
        'brandgraybase' => ['gray-base'],
        'bodybackground' => ['body-bg'],
        'breadcrumbbkg' => ['breadcrumb-bg'],
        'navbarbkg' => ['navbar-light-color'],
        'cardbkg' => ['card-bg'],
        'drawerbkg' => ['drawer-bg'],
        'fpstartwrap' => ['fpstartwrap-bg'],
        'fpiconnavhover' => ['fpicon-hover'],
        'fpiconcolour' => ['fpicon-colour'],
        'headerimagepadding' => ['headerimagepadding'],
        'navbarurl' => ['navbarurl'],
        'footerbg' => ['footer-bg'],
        'headerscreen' => ['headerfade-bg'],
        'iconwidth' =>  ['fpicon-width'],
        'headingcolor'  => ['headings-color'],
        'headercolor'  => ['header-color'],
        'bodycolor'  => ['body-color'],
        'linkcolor'  => ['link-color'],
        'sectionicon'  => ['sectionicon'],
        'headericon'  => ['headericon'],
        'courseboxheight'  => ['courseboxheight']
    ];

    // Add settings variables.
    foreach ($configurable as $configkey => $targets) {
        $value = $theme->settings->{$configkey};
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$prescss, $value) {
            $prescss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $prescss .= $theme->settings->scsspre;
    }

    // Set the default image for the header.
    $headerbg = $theme->setting_file_url('headerdefaultimage', 'headerdefaultimage');
    if (isset($headerbg)) {
        // Add a fade in transition to avoid the flicker on course headers ***.
        $prescss .= 'header#page-header {background-image: url("'.$headerbg.'"); background-size:cover; background-position:center;}';
    }

    // Set the background image for the page.
    $pagebg = $theme->setting_file_url('backgroundimage', 'backgroundimage');
    if (isset($pagebg)) {
        $prescss .= 'body {background-image: url("'.$pagebg.'"); background-size:cover; background-position:center;}';
    }

    // Set the background image for the login page.
    $loginbg = $theme->setting_file_url('loginimage', 'loginimage');
    if (isset($loginbg)) {
        $prescss .= 'body#page-login-index {background-image: url("'.$loginbg.'") !important; background-size:cover; background-position:center;}';
    }


    return $prescss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_aviv2020_get_extra_scss($theme) {
    // Adapted from Boost to allow other changes or settings if required.
    $extrascss = '';
    if (!empty($theme->settings->scss)) {
        $extrascss .= $theme->settings->scss;
    }

    return $extrascss;
}

