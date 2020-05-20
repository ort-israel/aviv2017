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
 * A two column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockssideprehtml = $OUTPUT->blocks('side-pre');
$hassidepreblocks = strpos($blockssideprehtml, 'data-block=') !== false;
$blocksbelowcontenthtml = $OUTPUT->blocks('below-content');
$hasbelowcontentblocks = strpos($blocksbelowcontenthtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$coursematadatasection = $OUTPUT->course_matadata_section();
$coursesummarysection = $OUTPUT->course_summary_section();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockssideprehtml,
    'hasbsideprelocks' => $hassidepreblocks,
    'belowcontentblocks' => $blocksbelowcontenthtml,
    'hasbelowcontentblocks' => $hasbelowcontentblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'coursematadatasection' => $coursematadatasection,
    'coursesummarysection' => $coursesummarysection,
    'hascourseabout' => !empty($coursematadatasection) || !empty($coursesummarysection)
];

// Lea 2018 - we don't have a toggledrawermenu setting
aviv2020_boostnavigation_extend_navigation($PAGE->navigation);
aviv2020_local_navigation_extend_navigation($PAGE->navigation);

$PAGE->requires->jquery();
$PAGE->requires->js('/theme/aviv2020/javascript/toggleabout.js');

//Tsofiya 2018: add scroll to top link
$PAGE->requires->js('/theme/aviv2020/javascript/scrolltotop.js');


$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_aviv2020/columns2', $templatecontext);

