<?php
/**
 * Main Lib file
 *
 * @package    theme_bediuk
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.
require(__DIR__ . '/lib/scss_lib.php');
require(__DIR__ . '/lib/filesettings_lib.php');
require(__DIR__ . '/lib/bediuk_lib.php');