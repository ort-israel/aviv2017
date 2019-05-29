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
 * lifeneighbor block rendrer
 *
 * @package    block_lifeneighbor
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_lifeneighbor\output;
defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;


//echo new Month(Month::June) . PHP_EOL;

/**
 * lifeneighbor block renderer
 *
 * @package    block_lifeneighbor
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    private $courses_info;

    private $all_modules;

    /**
     * Return the main content for the block overview.
     *
     * @return string HTML string
     */
    public function render_main() {
        return $this->render_from_template('block_lifeneighbor/courses-view-course-item', $this->export_for_template($this));
    }


    public function export_for_template() {
        global $CFG, $USER, $DB, $OUTPUT;

        $time_delta = time() - (700 * 24 * 60 * 60);

        /********************************/
        /***   Get all modules table  ***/
        /********************************/

        $this->all_modules = $DB->get_records_sql("select id, name from {$CFG->prefix}modules order by id");

        /* The mdl_course_modules table has all the course modules with their added time. This is the info we start with.
         * We select the module id, its instance and it's type.
         * The type will tell us what table to look that module's info up in, and the instance will be the id of the module in that table.
         * The mdl_context table connects between the mdl_role_assignments table and the mdl_course table:
         * The mdl_role_assignments table has the contextid column, that matches the id in the mdl_context table,
         * and the mdl_context has the instanceid which is the course id.
         * We need the mdl_role & mdl_role_assignments tables in order to determine the courses in which this user is a sharing_cart_teacher.
         * We need the mdl_course table in order to get the course info.
         */
        /* module_id has to be first, because the first column has to be unique */
        $this->courses_info = $DB->get_records_sql("
            SELECT  cm.id AS module_id, course.id AS course_id, course.fullname, cm.INSTANCE, cm.module AS module_type
            FROM {$CFG->prefix}role_assignments AS ra
            inner join {$CFG->prefix}role AS r on r.id=ra.roleid
            INNER JOIN {$CFG->prefix}context AS con ON con.id=ra.contextid
            INNER JOIN {$CFG->prefix}course AS course ON con.instanceid=course.id
            INNER JOIN {$CFG->prefix}course_modules AS cm ON course.id = cm.course
             INNER JOIN {$CFG->prefix}modules AS modu ON cm.module = modu.id
            WHERE r.shortname = 'sharing_cart_teacher' and ra.userid=$USER->id
            AND cm.visible = 1 AND added >= {$time_delta}");


        /********************************/
        /******* Get modules info *******/
        /********************************/

        // array of module instances in all courses
        $all_modules_info = [];
        foreach ($this->all_modules as $current_module) {
            $current_module_id = $current_module->id;
            $all_modules_info[$current_module_id] = $this->get_module_info($current_module_id);
        }

        // create the data form the mustache
        $output = [];
        foreach ($this->courses_info as $course_info) {
            if (property_exists($course_info, 'course_id')) {
                $output[$course_info->course_id]['coursename'] = $course_info->fullname;
                $output[$course_info->course_id]['viewurl'] = new \moodle_url("/course/view.php?id={$course_info-> course_id}");

                // which module type
                $module_type = $this->all_modules[$course_info->module_type]->name;

                // create an object with link and text
                $module_item = new \stdClass();
                $module_item->moduleurl = new \moodle_url("/mod/{$module_type}/view.php?id={$course_info->module_id}");
                $module_item->modulename = $all_modules_info[$course_info->module_type][$course_info->instance]->name;
                $module_item->icon = $OUTPUT->pix_icon('icon', $module_item->modulename, 'mod_' . $module_type);


                // insert into $output
                $output[$course_info->course_id]['coursemodules'][] = $module_item;

            }
        }

        return [
            'coursesview' => array_values($output)
        ];
    }

    protected function get_module_info($module_type) {
        global $CFG, $DB;

        $module_info = [];

        // get the module ids from the instance column in the courses info array
        $module_ids = array_column(
            array_filter($this->courses_info, function ($obj) use ($module_type) {
                return $obj->module_type == $module_type;
            }), 'instance');
        $module_ids = implode(",", $module_ids);

        if (!empty($module_ids)) {
            // decide on the table name
            $current_module = array_values(array_filter($this->all_modules, function ($e) use ($module_type) {
                return $e->id == $module_type;
            }));

            if (count($current_module) > 0) {
                $table_name = $current_module[0]->name;


                $module_info = $DB->get_records_sql("
                                  SELECT * FROM {$CFG->prefix}{$table_name}
                                  WHERE {$CFG->prefix}{$table_name}.id IN ({$module_ids})");
            }
        }
        return $module_info;
    }

}
