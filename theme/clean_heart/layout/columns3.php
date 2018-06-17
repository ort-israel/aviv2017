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
 * Moodle's Clean_heart theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_clean_heart
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_clean_heart_get_html_for_settings($OUTPUT, $PAGE);

// Set default (LTR) layout mark-up for a three column page.
$regionmainbox = 'span9';
$regionmain = 'span8 pull-right';
$sidepre = 'span4 desktop-first-column';
$sidepost = 'span3 pull-right';
// Reset layout mark-up for RTL languages.
if (right_to_left()) {
    $regionmainbox = 'span9 pull-right';
    $regionmain = 'span8';
    $sidepre = 'span4 pull-right';
    $sidepost = 'span3 desktop-first-column';
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

<header role="banner" class="top-header navbar <?php echo $html->navbarclass ?> moodle-has-zindex">
    <!-- Tsofiya 05/11/15: remove default header and dispay ours -->
    <div class="logos">
        <a class="biosense-logo" href="https://www.biosensewebster.com/">Biosense Webster</a>
        <a class="ort-logo" href="http://www.ort.org.il"><?php echo get_string('ort-site','theme_clean_heart') ?></a>
    </div>
    <div class="titles cf">
        <h1 class="site-title">
            <a href="http://www.lev.ort.org.il/">
                <?php echo get_string('site-title','theme_clean_heart') ?>
            </a>
        </h1>
        <h2 class="site-sub-title"> <?php echo get_string('site-sub-title','theme_clean_heart') ?> </h2>
    </div>
</header>

<div id="page" class="container-fluid">
    <div class="page-header-wrapper cf" role="presentation">
        <?php echo $OUTPUT->full_header(); ?>
        <?php echo $OUTPUT->user_menu(); ?>
    </div>
    <div id="page-content" class="row-fluid">
        <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
            <div class="row-fluid">
                <?php echo $OUTPUT->blocks('side-pre', $sidepre); ?>
                <section id="region-main" class="<?php echo $regionmain; ?>">
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>

            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', $sidepost); ?>
    </div>

    <footer id="page-footer">
        <!-- Tsofiya 05/11/15: remove default footer and dispay ours -->
        <?php echo get_string('copyright','theme_clean_heart') ?>
        <a href="http://www.ort.org.il"> <?php echo get_string('ort-israel','theme_clean_heart') ?> </a> |
        <a class="link" href="http://www.lev.ort.org.il/about.html"> <?php echo get_string('about','theme_clean_heart') ?> </a> |
        <a class="link" href="http://www.lev.ort.org.il/credits.html"> <?php echo get_string('credits','theme_clean_heart') ?> </a> |
        <a class="link" href="https://www.ort.org.il/right/rights/"> <?php echo get_string('site-rules','theme_clean_heart') ?> </a>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
