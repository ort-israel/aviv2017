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
 * Category list block.
 *
 * @package    block_category_list
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

include_once($CFG->dirroot . '/course/lib.php');
include_once($CFG->dirroot . '/blocks/category_list/locallib.php');

class block_category_list extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_category_list');
    }

    function has_config() {
        return true;
    }

//    function get_content() {
//        global $CFG, $PAGE;
//
//        if ($this->content !== NULL) {
//            return $this->content;
//        }
//
//        $this->content = new stdClass;
//        $this->content->items = array();
//        $this->content->icons = array();
//        $this->content->footer = '';
//
//        $maincatid = (!empty($CFG->block_category_list_catid)) ? $CFG->block_category_list_catid : MAINCATID;
//
//        $categories = \coursecat::get($maincatid)->get_children(array('sort' => array('idnumber' => 1)));  // Parent = 0   ie top-level categories only
//        if ($categories) {   //Check we have categories
//            $categories = array_values($categories);
//            //if (count($categories) > 1 || (count($categories) == 1 && $DB->count_records('course') > 200)) {     // Just print top level category links
//            for ($i = 0; $i < MAXNUMCATEGORIES; $i++) {
//                $category = $categories[$i];
//                $linkcss = $category->visible ? "" : " class=\"dimmed\" ";
//                // Display metadata - IMAGE
//                $metafields = $this->get_metadata_category($category->id);
//                /* Lea 2017/11 - Comment out metadata until it works*/
//                $featuredimage = '';
//                if (!empty($metafields) && count($metafields) > 0
//                    && isset($metafields['thumbnail'])) {
//                    $featuredimage = $metafields['thumbnail'];
//                } else {
//                    /* insert default image */
//                    $headerbg = new moodle_url('/blocks/category_list/img/default.jpg');
//                    $featuredimage = html_writer::img($headerbg, '', array('class' => 'metadata metadatacateimage'));
//                }
//
//                // Lea 2017 - display course count of each category
//                $countid = 'course-count-' . $category->id;
//                $coursecount = html_writer::span(
//                    ' [' . $category->get_courses_count() . ']',
//                    'course-count',
//                    array('aria-labelledby' => $countid)
//                );
//                $categoryname = html_writer::div($category->get_formatted_name() . $coursecount);
//
//                $this->content->items[] = "<a $linkcss href=\"$CFG->wwwroot/course/index.php?categoryid=$category->id\">" . $featuredimage . $categoryname . "</a>";
//            }
//
//            // If we can update any course of the view all isn't hidden, show the view all courses link
//            if (has_capability('moodle/course:update', context_system::instance()) || empty($CFG->block_category_list_hideallcourseslink)) {
//                $this->content->footer .= html_writer::link($CFG->wwwroot . '/course/index.php?categoryid=' . $maincatid, get_string('fulllistofdisciplines', 'block_category_list'), array('class' => 'toslldisciplines campusbutton btn btn-secondary'));
//            }
//            $this->title = get_string('disciplines', 'block_category_list');
//        }
//
//        return $this->content;
//    }

    function get_content() {
        global $PAGE, $CFG;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $maincatid = (!empty($CFG->block_category_list_catid)) ? $CFG->block_category_list_catid : MAINCATID;
        $categories = \coursecat::get($maincatid)->get_children(array('sort' => array('idnumber' => 1)));  // idnumber is defined in the editing screen of category
        $chelper = new coursecat_helper();
        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(\core_course_renderer::COURSECAT_SHOW_COURSES_COUNT)
            ->set_attributes(array('class' => 'category-browse category-browse-' . $maincatid));

        if ($categories) {   //Check we have categories
            $categories = array_values($categories);
            // Lea 2017 - Use the renderer that creates the sub categories on category screen
            $courserenderer = $PAGE->get_renderer('core', 'course');
            $countcategories = count($categories);
            for ($i = 0; $i < MAXNUMCATEGORIES && $i < $countcategories; $i++) {
                $category = $categories[$i];
                if (method_exists($courserenderer, 'course_category_wrapper_content')) {
                    $this->content->items[] = $courserenderer->course_category_wrapper_content($chelper, $category, 1);
                } else {
                    $this->content->items[] = $this->course_category_wrapper_content($category);
                }
            }
        }

        $this->title = get_string('disciplines', 'block_category_list');
        $this->content->footer .= html_writer::link($CFG->wwwroot . '/course/index.php?categoryid=' . $maincatid, get_string('fulllistofdisciplines', 'block_category_list'), array('class' => 'toslldisciplines campusbutton btn btn-secondary'));

        return $this->content;

    }

    function get_remote_courses() {
        global $CFG, $USER, $OUTPUT;

        if (!is_enabled_auth('mnet')) {
            // no need to query anything remote related
            return;
        }

        // shortcut - the rest is only for logged in users!
        if (!isloggedin() || isguestuser()) {
            return false;
        }

        if ($courses = get_my_remotecourses()) {
            $this->content->items[] = get_string('remotecourses', 'mnet');
            $this->content->icons[] = '';
            foreach ($courses as $course) {
                $this->content->items[] = "<a title=\"" . format_string($course->shortname, true) . "\" " .
                    "href=\"{$CFG->wwwroot}/auth/mnet/jump.php?hostid={$course->hostid}&amp;wantsurl=/course/view.php?id={$course->remoteid}\">"
                    . format_string(get_course_display_name_for_list($course)) . "</a>";
            }
            // if we listed courses, we are done
            return true;
        }

        if ($hosts = get_my_remotehosts()) {
            $this->content->items[] = get_string('remotehosts', 'mnet');
            $this->content->icons[] = '';
            foreach ($USER->mnet_foreign_host_array as $somehost) {
                $this->content->items[] = $somehost['count'] . get_string('courseson', 'mnet') . '<a title="' . $somehost['name'] . '" href="' . $somehost['url'] . '">' . $icon . $somehost['name'] . '</a>';
            }
            // if we listed hosts, done
            return true;
        }

        return false;
    }

    /**
     * Returns the role that best describes the course list block.
     *
     * @return string
     */
    public function get_aria_role() {
        return 'navigation';
    }

    public function course_category_wrapper_content($coursecat, $depth = 1) {
        global $CFG;
        // category name
        $categoryname = html_writer::tag('span', $coursecat->get_formatted_name(), array('class' => 'categoryname'));

        $coursescount = $coursecat->get_courses_count();

        $categoryname .= html_writer::tag('span', ' [' . $coursescount . ']',
            array('title' => get_string('numberofcourses'), 'class' => 'numberofcourse'));
        // Display metadata - IMAGE
        $metafields = $this->get_metadata_category($coursecat->id);
        /* Lea 2017/11 - Comment out metadata until it works*/
        $featuredimage = '';
        if (!empty($metafields) && count($metafields) > 0
            && isset($metafields['thumbnail'])) {
            $featuredimage = $metafields['thumbnail'];
        } else {
            /* insert default image */
            $headerbg = new moodle_url($CFG->wwwroot . '/theme/aviv2018/pix/category_default.jpg');
            $featuredimage = html_writer::img($headerbg, '', array('class' => 'metadata metadatacateimage'));
        }
        $content = html_writer::link(new moodle_url('/course/index.php',
            array('categoryid' => $coursecat->id)), $featuredimage . $categoryname);

        return $content;
    }

    /**
     * Gets all metadata associated with given course
     * @param $categoryid
     * @return array
     */
    private function get_metadata_category($categoryid) {
        global $DB;
        $allcategoryfields = $DB->get_records('local_metadata_field', array('contextlevel' => CONTEXT_COURSECAT));
        $ret = array();
        foreach ($allcategoryfields as $coursefield) {
            $fieldvalue = $DB->get_record('local_metadata', array('instanceid' => $categoryid, 'fieldid' => $coursefield->id));
            if ($fieldvalue) {
                $metaobj = new \metadatafieldtype_fileupload\metadata($coursefield->id, $categoryid);
                $ret[$coursefield->shortname] = $metaobj->display_data();
            }
        }
        return $ret;
    }
}


