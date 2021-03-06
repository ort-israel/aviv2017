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
 * Moodle's Clean_finance theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_clean_finance
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_clean_finance_get_html_for_settings($OUTPUT, $PAGE);

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar <?php echo $html->navbarclass ?> moodle-has-zindex tree-bg">
	<!--Tsofiya 16/2/2015: add an upgrade message for ie9 and lower -->
	<!--[if lte IE 9 ]>
    <a href="http://updateyourbrowser.net/" title="Update Your Browser"><img src="<?php echo $CFG->wwwroot; ?>/theme/clean_finance/pix/browser.png" border="0" alt="Update Your Browser" /></a>
    <![endif]-->
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <!-- Tsofiya 30/12/14: remove default nav and add required logos -->
            <div class="logo-catch-cash-wrapper">
                <a class="logo-catch-cash" target="_blank" href="http://www.catch-cash.ort.org.il">catch cash</a>
                <a class="under-logo" target="_blank" href="http://www.catch-cash.ort.org.il"> <?php echo get_string('back-to-catch-cash',"theme_clean_finance"); ?> </a>
            </div>
            <a class="logo-bank" target="_blank" href="https://www.bankhapoalim.co.il/">bank hapoalim</a>
            <a class="logo-ort" target="_blank" href="http://ort.org.il/">ort israel</a>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">

    <header id="page-header" class="clearfix">
        <!-- Tsofiya 7/1/14: if user can't use the editing button hide it -->
        <div id="page-navbar" class="clearfix <?php echo strlen($PAGE->button)==0?'hide':''; ?> ">
            <!-- Tsofiya 30/12/14: remove breadcrumbs -->
            <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
        </div>
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>

    <div id="page-content" class="row-fluid">
        <!-- Tsofiya 7/1/14: replace the display order of 'span3' & 'span9' to fix design -->
        <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
        <div id="<?php echo $regionbsid ?>" class="span9">
            <div class="row-fluid">
                <section id="region-main" class="span8 pull-right">
                    <?php
                    echo $html->heading;
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
            </div>
        </div>
    </div>

    <!-- Tsofiya 31/12/14: remove footer -->

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
