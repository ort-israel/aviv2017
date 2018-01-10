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
 * Course list block settings
 *
 * @package    block_category_list
 * @copyright  2007 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
//todo: add locallib (and define define)
if ($ADMIN->fulltree) {
    $options = array('all'=>get_string('allcourses', 'block_category_list'), 'own'=>get_string('owncourses', 'block_category_list'));

    $settings->add(new admin_setting_configselect('block_category_list_adminview', get_string('adminview', 'block_category_list'),
                       get_string('configadminview', 'block_category_list'), 'all', $options));

    $settings->add(new admin_setting_configcheckbox('block_category_list_hideallcourseslink', get_string('hideallcourseslink', 'block_category_list'),
                       get_string('confighideallcourseslink', 'block_category_list'), 0));

    $settings->add(new admin_setting_configtext('block_category_list_catid', get_string('catid', 'block_category_list'),
                        get_string('configcatid', 'block_category_list'), 2));
}


