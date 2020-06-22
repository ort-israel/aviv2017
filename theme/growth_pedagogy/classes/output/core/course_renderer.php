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
 * Course renderer.
 *
 * @package    theme_noanme
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_growth_pedagogy\output\core;
defined('MOODLE_INTERNAL') || die();

use moodle_url;
use lang_string;
use coursecat_helper;
use coursecat;
use stdClass;
use course_in_list;
use context_course;
use pix_url;
use html_writer;
use heading;
use pix_icon;
use image_url;
use single_select;
use completion_info;
use cm_info;

require_once($CFG->dirroot . '/course/renderer.php');

/**
 * Course renderer class.
 *
 * @package    theme_noanme
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {


    /**
     * Displays one course in the list of courses.
     *
     * Lea 2017 - My changes are:
     * 1. Image before course name
     * 2. Display course metadata
     * 3. Display course summary
     * 4. Display course tags
     * 5. Show courses of category and hide courses of sub categories by changing conditions from COURSECAT_SHOW_COURSES_COLLAPSED to COURSECAT_SHOW_COURSES_COUNT
     * 6. Remove unnecessary divs with class info and class moreinfo
     *
     * This is an internal function, to display an information about just one course
     * please use {@link core_course_renderer::course_info_box()}
     *
     * @param coursecat_helper $chelper various display options
     * @param course_in_list|stdClass $course
     * @param string $additionalclasses additional classes to add to the main <div> tag (usually
     *    depend on the course position in list - first/last/even/odd)
     * @return string
     */
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        global $CFG;
        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }
        /* Lea - change form <= to < , since it's what's preventing the display of courses in category. */
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }

        if ($course instanceof stdClass) {
            require_once($CFG->libdir . '/coursecatlib.php');
            $course = new course_in_list($course);
        }
        $content = '';
        $classes = trim('card coursebox ' . $additionalclasses);
        /* Lea - change form COURSECAT_SHOW_COURSES_COLLAPSED to COURSECAT_SHOW_COURSES_COUNT , since it's what's preventing the display of courses in category. */
        if ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_COUNT) {
            $nametag = 'h3';
        } else {
            $classes .= ' collapsed';
            $nametag = 'div';
        }

        // .coursebox
        $content .= html_writer::start_tag('div', array(
            'class' => $classes,
            'data-courseid' => $course->id,
            'data-type' => self::COURSECAT_TYPE_COURSE,
        ));

        // Lea 2017 - remove the div with class info, it's not needed.
        //$content .= html_writer::start_tag('div', array('class' => 'info'));

        // Lea 2017/11 - move image from coursecat_coursebox_content to before the course name
        $contentimages = $contentfiles = '';
        $course_files = $course->get_course_overviewfiles();
        foreach ($course_files as $file) {
            $isimage = $file->is_valid_image();
            $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(),
                $file->get_filearea(), null, $file->get_filepath(), $file->get_filename());
            if ($isimage) {
                $contentimages .= html_writer::tag('div',
                    html_writer::empty_tag('img', array('src' => $url)),
                    array('class' => 'courseimagewrapper'));
            } else {
                $image = $this->output->pix_icon(file_file_icon($file, 24), $file->get_filename(), 'moodle');
                $filename = html_writer::tag('span', $image, array('class' => 'fp-icon')) .
                    html_writer::tag('span', $file->get_filename(), array('class' => 'fp-filename'));
                $contentfiles .= html_writer::tag('span',
                    html_writer::link($url, $filename),
                    array('class' => 'coursefile fp-filename-icon'));
            }
        }
        // if no image file, use default.
        if (count($course_files) == 0) {
            $url = new moodle_url('/blocks/featuredcourses/img/default.jpg');
            $contentimages .= html_writer::tag('div',
                html_writer::empty_tag('img', array('src' => $url)),
                array('class' => 'courseimagewrapper'));
        }

        $content .= $contentimages . $contentfiles;

        $content .= html_writer::start_div('courseinfowrapper card-block');

        // course name
        $coursename = $chelper->get_course_formatted_name($course);
        $coursenamelink = html_writer::link(new moodle_url('/course/view.php', array('id' => $course->id)),
            $coursename, array('class' => $course->visible ? '' : 'dimmed'));
        $content .= html_writer::tag($nametag, $coursenamelink, array('class' => 'coursename'));
        // If we display course in collapsed form but the course has summary or course contacts, display the link to the info page.
        // Lea 2017 - no need to wrap in div with class moreinfoinfo
        // $content .= html_writer::start_tag('div', array('class' => 'moreinfo'));
        /* Lea - change form COURSECAT_SHOW_COURSES_COLLAPSED to COURSECAT_SHOW_COURSES_COUNT , since it's what's preventing the display of courses in category. */
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_COUNT) {
            if ($course->has_summary() || $course->has_course_contacts() || $course->has_course_overviewfiles()) {
                $url = new moodle_url('/course/info.php', array('id' => $course->id));
                $image = $this->output->pix_icon('i/info', $this->strings->summary);
                $content .= html_writer::link($url, $image, array('title' => $this->strings->summary));
                // Make sure JS file to expand course content is included.
                $this->coursecat_include_js();
            }
        }

        $content .= $this->coursecat_coursebox_content($chelper, $course);

        // $content .= html_writer::end_tag('div'); // .moreinfo

        $content .= html_writer::end_div(); //courseinfowrapper

        // Display TAGS
        $content .= html_writer::start_div('tagswrapper card-footer');
        $tags = \core_tag_tag::get_item_tags('core', 'course', $course->id);
        foreach ($tags as $tag) {
            $content .= html_writer::link(\core_tag_tag::make_url($tag->tagcollid, $tag->rawname),
                    \core_tag_tag::make_display_name($tag)) . ' ';
        }
        $content .= html_writer::end_div(); // tagswrapper


        // print enrolmenticons
        if ($icons = enrol_get_course_info_icons($course)) {
            $content .= html_writer::start_tag('div', array('class' => 'enrolmenticons'));
            foreach ($icons as $pix_icon) {
                $content .= $this->render($pix_icon);
            }
            $content .= html_writer::end_tag('div'); // .enrolmenticons
        }

        //$content .= html_writer::end_tag('div'); // .info

//        $content .= html_writer::start_tag('div', array('class' => 'content'));
//        $content .= $this->coursecat_coursebox_content($chelper, $course);
//        $content .= html_writer::end_tag('div'); // .content

        $content .= html_writer::end_tag('div'); // .coursebox
        return $content;
    }

    /**
     * Returns HTML to display course content (summary, course contacts and optionally category name)
     *
     * Lea 2017 - Removed image, because needs to be displayed by the coursecat_coursebox function
     *
     * This method is called from coursecat_coursebox() and may be re-used in AJAX
     *
     * @param coursecat_helper $chelper various display options
     * @param stdClass|course_in_list $course
     * @return string
     */
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        global $CFG;
//        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
//            return '';
//        }
        if ($course instanceof stdClass) {
            require_once($CFG->libdir . '/coursecatlib.php');
            $course = new course_in_list($course);
        }
        $content = '';


        // Lea 2017 - Add metadata audience
        // Display metadata - AUDIENCE
        require_once($CFG->dirroot . '/ort/ort_util.php');
        $content .= \ort_util::get_metadata_course_by_field_as_list($course->id, 'audience');


        // display course summary
        if ($course->has_summary()) {
            $content .= html_writer::start_tag('div', array('class' => 'summary'));
            $content .= $chelper->get_course_formatted_summary($course,
                array('overflowdiv' => true, 'noclean' => true, 'para' => false));
            $content .= html_writer::end_tag('div'); // .summary
        }


        // display course contacts. See course_in_list::get_course_contacts()
        if ($course->has_course_contacts()) {
            $content .= html_writer::start_tag('ul', array('class' => 'teachers'));
            foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                $name = $coursecontact['rolename'] . ': ' .
                    html_writer::link(new moodle_url('/user/view.php',
                        array('id' => $userid, 'course' => SITEID)),
                        $coursecontact['username']);
                $content .= html_writer::tag('li', $name);
            }
            $content .= html_writer::end_tag('ul'); // .teachers
        }

        // display course category if necessary (for example in search results)
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT) {
            require_once($CFG->libdir . '/coursecatlib.php');
            if ($cat = coursecat::get($course->category, IGNORE_MISSING)) {
                $content .= html_writer::start_tag('div', array('class' => 'coursecat'));
                $content .= get_string('category') . ': ' .
                    html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                        $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
                $content .= html_writer::end_tag('div'); // .coursecat
            }
        }

        return $content;
    }

    /**
     * Renders HTML to display particular course category - list of its subcategories and courses
     * Lea 2017 - overriding the function in order to change HTML and clasees
     *
     * @param int|stdClass|coursecat $category
     */
    public function course_category($category) {
        global $CFG;
        require_once($CFG->libdir . '/coursecatlib.php');
        $coursecat = coursecat::get(is_object($category) ? $category->id : $category);
        $site = get_site();
        $output = '';

        if (can_edit_in_category($coursecat->id)) {
            // Add 'Manage' button if user has permissions to edit this category.
            $managebutton = $this->single_button(new moodle_url('/course/management.php',
                array('categoryid' => $coursecat->id)), get_string('managecourses'), 'get');
            $this->page->set_button($managebutton);
        }
        if (!$coursecat->id) {
            if (coursecat::count_all() == 1) {
                // There exists only one category in the system, do not display link to it
                $coursecat = coursecat::get_default();
                $strfulllistofcourses = get_string('fulllistofcourses');
                $this->page->set_title("$site->shortname: $strfulllistofcourses");
            } else {
                $strcategories = get_string('categories');
                $this->page->set_title("$site->shortname: $strcategories");
            }
        } else {
            $title = $site->shortname;
            if (coursecat::count_all() > 1) {
                $title .= ": " . $coursecat->get_formatted_name();
            }
            $this->page->set_title($title);

            // Lea 2017 - Add category name as title
            $output .= '<h3 class="card-title">' . $coursecat->get_formatted_name() . '</h3>';

            // Print the category selector
            if (coursecat::count_all() > 1) {
                $output .= html_writer::start_tag('div', array('class' => 'categorypicker'));
                $select = new single_select(new moodle_url('/course/index.php'), 'categoryid',
                    coursecat::make_categories_list(), $coursecat->id, null, 'switchcategory');
                $select->set_label(get_string('categories') . ':');
                $output .= $this->render($select);
                $output .= html_writer::end_tag('div'); // .categorypicker
            }
        }

        // Print current category description
        $chelper = new coursecat_helper();
        if ($description = $chelper->get_category_formatted_description($coursecat)) {
            $output .= $this->box($description, array('class' => 'generalbox info'));
        }

        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_COUNT)/* COURSECAT_SHOW_COURSES_AUTO */
        ->set_attributes(array('class' => 'category-browse category-browse-' . $coursecat->id)); // Lea 2017/12 - remove card-group because interferes in categories page, list of subcategories

        $coursedisplayoptions = array();
        $catdisplayoptions = array();
        $browse = optional_param('browse', null, PARAM_ALPHA);
        $perpage = optional_param('perpage', $CFG->coursesperpage, PARAM_INT);
        $page = optional_param('page', 0, PARAM_INT);
        $baseurl = new moodle_url('/course/index.php');
        if ($coursecat->id) {
            $baseurl->param('categoryid', $coursecat->id);
        }
        if ($perpage != $CFG->coursesperpage) {
            $baseurl->param('perpage', $perpage);
        }
        $coursedisplayoptions['limit'] = $perpage;
        $catdisplayoptions['limit'] = $perpage;
        if ($browse === 'courses' || !$coursecat->has_children()) {
            $coursedisplayoptions['offset'] = $page * $perpage;
            $coursedisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $catdisplayoptions['nodisplay'] = true;
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $catdisplayoptions['viewmoretext'] = new lang_string('viewallsubcategories');
        } else if ($browse === 'categories' || !$coursecat->has_courses()) {
            $coursedisplayoptions['nodisplay'] = true;
            $catdisplayoptions['offset'] = $page * $perpage;
            $catdisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $coursedisplayoptions['viewmoretext'] = new lang_string('viewallcourses');
        } else {
            // we have a category that has both subcategories and courses, display pagination separately
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses', 'page' => 1));
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories', 'page' => 1));
        }
        $chelper->set_courses_display_options($coursedisplayoptions)->set_categories_display_options($catdisplayoptions);
        // Add course search form.
        $output .= $this->course_search_form();

        // Display course category tree.
        $output .= $this->coursecat_tree($chelper, $coursecat);

        // Add action buttons
        $output .= $this->container_start('buttons');
        $context = get_category_or_system_context($coursecat->id);
        if (has_capability('moodle/course:create', $context)) {
            // Print link to create a new course, for the 1st available category.
            if ($coursecat->id) {
                $url = new moodle_url('/course/edit.php', array('category' => $coursecat->id, 'returnto' => 'category'));
            } else {
                $url = new moodle_url('/course/edit.php', array('category' => $CFG->defaultrequestcategory, 'returnto' => 'topcat'));
            }
            $output .= $this->single_button($url, get_string('addnewcourse'), 'get');
        }
        ob_start();
        if (coursecat::count_all() == 1) {
            print_course_request_buttons(context_system::instance());
        } else {
            print_course_request_buttons($context);
        }
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= $this->container_end();

        return $output;
    }

    /**
     * Returns HTML to display a tree of subcategories and courses in the given category
     *
     * @param coursecat_helper $chelper various display options
     * @param coursecat $coursecat top category (this category's name and description will NOT be added to the tree)
     * @return string
     */
    protected function coursecat_tree(coursecat_helper $chelper, $coursecat) {
        $categorycontent = $this->coursecat_category_content($chelper, $coursecat, 0);
        if (empty($categorycontent)) {
            return '';
        }

        // Start content generation
        $content = '';
        $attributes = $chelper->get_and_erase_attributes('course_category_tree clearfix');
        $content .= html_writer::start_tag('div', $attributes);

        // Lea 2017 - add check of
        // Only show the collapse/expand if there are children to expand and the setting for showing children is set.
        if ($coursecat->get_children_count() && ($chelper->get_show_courses() > self::COURSECAT_SHOW_COURSES_COUNT)) {
            $classes = array(
                'collapseexpand',
            );

            $content .= html_writer::start_tag('div', array('class' => 'collapsible-actions'));
            $content .= html_writer::link('#', get_string('expandall'),
                array('class' => implode(' ', $classes)));
            $content .= html_writer::end_tag('div');
            $this->page->requires->strings_for_js(array('collapseall', 'expandall'), 'moodle');
        }

        $content .= html_writer::tag('div', $categorycontent, array('class' => 'content'));

        $content .= html_writer::end_tag('div'); // .course_category_tree

        return $content;
    }

    /**
     * Renders the list of courses
     * Lea 2017 - overriding the function in order to change HTML and clasees
     */
    protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
        global $CFG;
        if ($totalcount === null) {
            $totalcount = count($courses);
        }
        if (!$totalcount) {
            // Courses count is cached during courses retrieval.
            return '';
        }

        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_AUTO) {
            // In 'auto' course display mode we analyse if number of courses is more or less than $CFG->courseswithsummarieslimit
            if ($totalcount <= $CFG->courseswithsummarieslimit) {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED);
            } else {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_COLLAPSED);
            }
        }

        // prepare content of paging bar if it is needed
        $paginationurl = $chelper->get_courses_display_option('paginationurl');
        $paginationallowall = $chelper->get_courses_display_option('paginationallowall');
        if ($totalcount > count($courses)) {
            // there are more results that can fit on one page
            if ($paginationurl) {
                // the option paginationurl was specified, display pagingbar
                $perpage = $chelper->get_courses_display_option('limit', $CFG->coursesperpage);
                $page = $chelper->get_courses_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar($totalcount, $page, $perpage,
                    $paginationurl->out(false, array('perpage' => $perpage)));
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => 'all')),
                        get_string('showall', '', $totalcount)), array('class' => 'paging paging-showall'));
                }
            } else if ($viewmoreurl = $chelper->get_courses_display_option('viewmoreurl')) {
                // the option for 'View more' link was specified, display more link
                $viewmoretext = $chelper->get_courses_display_option('viewmoretext', new lang_string('viewmore'));
                $morelink = html_writer::tag('div', html_writer::link($viewmoreurl, $viewmoretext),
                    array('class' => 'paging paging-morelink'));
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // there are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode
            $pagingbar = html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => $CFG->coursesperpage)),
                get_string('showperpage', '', $CFG->coursesperpage)), array('class' => 'paging paging-showperpage'));
        }

        // display list of courses
        $attributes = $chelper->get_and_erase_attributes('courses card-group');
        $content = html_writer::start_tag('div', $attributes);

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }

        $coursecount = 0;
        foreach ($courses as $course) {
            $coursecount++;
            $classes = ($coursecount % 2) ? 'odd' : 'even';
            if ($coursecount == 1) {
                $classes .= ' first';
            }
            if ($coursecount >= count($courses)) {
                $classes .= ' last';
            }
            $content .= $this->coursecat_coursebox($chelper, $course, $classes);
        }

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }
        if (!empty($morelink)) {
            $content .= $morelink;
        }

        $content .= html_writer::end_tag('div'); // .courses
        return $content;
    }

    /**
     * Renders the list of subcategories in a category
     * Lea 2017 - overriding the function in order to change HTML and clasees
     */
    protected function coursecat_subcategories(coursecat_helper $chelper, $coursecat, $depth) {
        global $CFG;
        $subcategories = array();
        if (!$chelper->get_categories_display_option('nodisplay')) {
            $subcategories = $coursecat->get_children($chelper->get_categories_display_options());
        }
        $totalcount = $coursecat->get_children_count();
        if (!$totalcount) {
            // Note that we call coursecat::get_children_count() AFTER coursecat::get_children() to avoid extra DB requests.
            // Categories count is cached during children categories retrieval.
            return '';
        }

        // prepare content of paging bar or more link if it is needed
        $paginationurl = $chelper->get_categories_display_option('paginationurl');
        $paginationallowall = $chelper->get_categories_display_option('paginationallowall');
        if ($totalcount > count($subcategories)) {
            if ($paginationurl) {
                // the option 'paginationurl was specified, display pagingbar
                $perpage = $chelper->get_categories_display_option('limit', $CFG->coursesperpage);
                $page = $chelper->get_categories_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar($totalcount, $page, $perpage,
                    $paginationurl->out(false, array('perpage' => $perpage)));
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => 'all')),
                        get_string('showall', '', $totalcount)), array('class' => 'paging paging-showall'));
                }
            } else if ($viewmoreurl = $chelper->get_categories_display_option('viewmoreurl')) {
                // the option 'viewmoreurl' was specified, display more link (if it is link to category view page, add category id)
                if ($viewmoreurl->compare(new moodle_url('/course/index.php'), URL_MATCH_BASE)) {
                    $viewmoreurl->param('categoryid', $coursecat->id);
                }
                $viewmoretext = $chelper->get_categories_display_option('viewmoretext', new lang_string('viewmore'));
                $morelink = html_writer::tag('div', html_writer::link($viewmoreurl, $viewmoretext),
                    array('class' => 'paging paging-morelink'));
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // there are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode
            $pagingbar = html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => $CFG->coursesperpage)),
                get_string('showperpage', '', $CFG->coursesperpage)), array('class' => 'paging paging-showperpage'));
        }

        // display list of subcategories
        // Lea 2017 - change from div to ul
        $content = html_writer::start_tag('ul', array('class' => 'subcategories card-group'));

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }

        foreach ($subcategories as $subcategory) {
            $content .= $this->coursecat_category($chelper, $subcategory, $depth + 1);
        }

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }
        if (!empty($morelink)) {
            $content .= $morelink;
        }

        // Lea 2017 - change from div to ul
        $content .= html_writer::end_tag('ul');
        return $content;
    }

    /**
     * Returns HTML to display a course category as a part of a tree
     * Lea 2017 - overriding the function in order to change HTML and clasees
     */
    protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {
        // open category tag
        $classes = array('category');
        if (empty($coursecat->visible)) {
            $classes[] = 'dimmed_category';
        }
        if ($chelper->get_subcat_depth() > 0 && $depth >= $chelper->get_subcat_depth()) {
            // do not load content
            $categorycontent = '';
            $classes[] = 'notloaded';
            if ($coursecat->get_children_count() ||
                ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_COLLAPSED && $coursecat->get_courses_count())) {
                $classes[] = 'with_children';
                $classes[] = 'collapsed';
            }
        } else {
            // load category content
            $categorycontent = $this->coursecat_category_content($chelper, $coursecat, $depth);
            $classes[] = 'loaded';
            if (!empty($categorycontent)) {
                $classes[] = 'with_children';
            }
        }

        // Make sure JS file to expand category content is included.
        $this->coursecat_include_js();

        // Lea 2017 - change from div to li
        $content = html_writer::start_tag('li', array(
            'class' => implode(' ', $classes),
            'data-categoryid' => $coursecat->id,
            'data-depth' => $depth,
            'data-showcourses' => $chelper->get_show_courses(),
            'data-type' => self::COURSECAT_TYPE_CATEGORY,
        ));

        $content .= $this->course_category_wrapper_content($chelper, $coursecat, $depth);
        // add category content to the output
        // Lea 2017 - when shown in categories page, no need for content
        if (!empty($categorycontent)) {
            $content .= html_writer::tag('div', $categorycontent, array('class' => 'content'));
        }

        $content .= html_writer::end_tag('li'); // .category

        // Return the course category tree HTML
        return $content;
    }

    /**
     * Returns HTML to display the subcategories and courses in the given category
     *
     * This method is re-used by AJAX to expand content of not loaded category
     *
     * @param coursecat_helper $chelper various display options
     * @param coursecat $coursecat
     * @param int $depth depth of the category in the current tree
     * @return string
     */
    protected function coursecat_category_content(coursecat_helper $chelper, $coursecat, $depth) {
        $content = '';
        // Subcategories
        $content .= $this->coursecat_subcategories($chelper, $coursecat, $depth);

        // AUTO show courses: Courses will be shown expanded if this is not nested category,
        // and number of courses no bigger than $CFG->courseswithsummarieslimit.
        $showcoursesauto = $chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_AUTO;
        if ($showcoursesauto && $depth) {
            // this is definitely collapsed mode
            $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_COLLAPSED);
        }

        // Courses
        //if ($chelper->get_show_courses() > core_course_renderer::COURSECAT_SHOW_COURSES_COUNT) {
        $courses = array();
        if (!$chelper->get_courses_display_option('nodisplay')) {
            $courses = $coursecat->get_courses($chelper->get_courses_display_options());
        }
        if ($viewmoreurl = $chelper->get_courses_display_option('viewmoreurl')) {
            // the option for 'View more' link was specified, display more link (if it is link to category view page, add category id)
            if ($viewmoreurl->compare(new moodle_url('/course/index.php'), URL_MATCH_BASE)) {
                $chelper->set_courses_display_option('viewmoreurl', new moodle_url($viewmoreurl, array('categoryid' => $coursecat->id)));
            }
        }
        $content .= $this->coursecat_courses($chelper, $courses, $coursecat->get_courses_count());
        //}

        if ($showcoursesauto) {
            // restore the show_courses back to AUTO
            $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_AUTO);
        }

        return $content;
    }

    public function course_category_wrapper_content($chelper, $coursecat, $depth) {
        global $CFG, $PAGE;
        // category name
        $categoryname = html_writer::tag('span', $coursecat->get_formatted_name(), array('class' => 'categoryname'));

        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_COUNT
            && ($coursescount = $coursecat->get_courses_count())) {
            $categoryname .= html_writer::tag('span', ' [' . $coursescount . ']',
                array('title' => get_string('numberofcourses'), 'class' => 'numberofcourse'));
        }
        // Lea 2017 - no need for class
//        $content .= html_writer::start_tag('div'/*, array('class' => 'info')*/);
        // Display metadata - IMAGE
        $metafields = $this->get_metadata_category($coursecat->id);
        $featuredimage = '';
        if (!empty($metafields) && count($metafields) > 0
            && isset($metafields['thumbnail'])) {
            $featuredimage = $metafields['thumbnail'];

        }
        /* Lea 2017/12 - Check if the url defined in $featuredimage works. Right now it doesn't but one day it will, and we don't want to have to change the code then */
        if (!@getimagesize($featuredimage)) { // check taken from here: https://stackoverflow.com/a/29716622/278
            $headerbg = '';
            // check if there is a  dedicated image for this category
            $categoryidnum = $coursecat->idnumber;
            if (!empty($categoryidnum)) {
                $headerbgfile = $PAGE->theme->dir . '/pix/cat_' . $categoryidnum . '.jpg';
                if (file_exists($headerbgfile)) {
                    $headerbg = new moodle_url($CFG->wwwroot . '/theme/growth_pedagogy/pix/cat_' . $categoryidnum . '.jpg');
                }
            }
            if (empty($headerbg)) {
                /* If category doesn't have an idnumber, or there isn't an image to correspond the that number, insert default image */
                $headerbg = new moodle_url($CFG->wwwroot . '/theme/growth_pedagogy/pix/category_default.jpg');
            }
            $featuredimage = html_writer::img($headerbg, '', array('class' => 'metadata metadatacateimage'));
        }
        $content = html_writer::link(new moodle_url('/course/index.php',
            array('categoryid' => $coursecat->id)), $featuredimage . $categoryname);

        return $content;
    }

    /**
     * Renders html to display search result page
     * Lea 2017 - overriding the function in order to change locations of items on page, and add serach query to the title
     * @param array $searchcriteria may contain elements: search, blocklist, modulelist, tagid
     * @return string
     */
    public function search_courses($searchcriteria) {
        global $CFG;
        $content = '';
        if (!empty($searchcriteria)) {
            // print search results
            require_once($CFG->libdir . '/coursecatlib.php');

            $displayoptions = array('sort' => array('displayname' => 1));
            // take the current page and number of results per page from query
            $perpage = optional_param('perpage', 0, PARAM_RAW);
            if ($perpage !== 'all') {
                $displayoptions['limit'] = ((int)$perpage <= 0) ? $CFG->coursesperpage : (int)$perpage;
                $page = optional_param('page', 0, PARAM_INT);
                $displayoptions['offset'] = $displayoptions['limit'] * $page;
            }
            // options 'paginationurl' and 'paginationallowall' are only used in method coursecat_courses()
            $displayoptions['paginationurl'] = new moodle_url('/course/search.php', $searchcriteria);
            $displayoptions['paginationallowall'] = true; // allow adding link 'View all'

            $searchform = '';
            // Lea 2017 - move search form to top
            if (!empty($searchcriteria['search'])) {
                // print search form only if there was a search by search string, otherwise it is confusing
                $searchform = $this->box_start('generalbox mdl-align');
                $searchform .= $this->course_search_form($searchcriteria['search']);
                $searchform .= $this->box_end();
            }

            $class = 'course-search-result';
            foreach ($searchcriteria as $key => $value) {
                if (!empty($value)) {
                    $class .= ' course-search-result-' . $key;
                }
            }
            $chelper = new coursecat_helper();
            $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT)->
            set_courses_display_options($displayoptions)->
            set_search_criteria($searchcriteria)->
            set_attributes(array('class' => $class));

            $courses = \theme_growth_pedagogy\output\core\coursecat::search_courses($searchcriteria, $chelper->get_courses_display_options());
            $totalcount = coursecat::search_courses_count($searchcriteria);
            $courseslist = $this->coursecat_courses($chelper, $courses, $totalcount);

            // Lea 2017 - Add the search query to the title, and put the search form under the title
            if (!$totalcount) {
                if (!empty($searchcriteria['search'])) {
                    $content .= $this->heading(get_string('nocoursesfound', '', $searchcriteria['search']), 2, 'card-title');
                } else {
                    $content .= $this->heading(get_string('novalidcourses'));
                }
                $content .= $searchform;
            } else {
                $searchquery = !empty($searchcriteria['search']) ? " " . get_string('for') . " \"" . $searchcriteria['search'] . "\"" : "";
                $content .= $this->heading(get_string('searchresults') . "$searchquery : $totalcount", 2, 'card-title');
                $content .= $searchform;
                $content .= $courseslist;
            }

        } else {
            // just print search form
            $content .= $this->box_start('generalbox mdl-align');
            $content .= $this->course_search_form();
            $content .= html_writer::tag('div', get_string("searchhelp"), array('class' => 'searchhelp'));
            $content .= $this->box_end();
        }
        return $content;
    }

    /**
     * Gets all metadata associated with given course
     * @param $categoryid
     * @return array
     */
    private function get_metadata_category($categoryid) {
        global $DB;
        $ret = array();
        if ($DB->table_exists('local_metadata_field')) {
            $allcategoryfields = $DB->get_records('local_metadata_field', array('contextlevel' => CONTEXT_COURSECAT));
            foreach ($allcategoryfields as $coursefield) {
                $fieldvalue = $DB->get_record('local_metadata', array('instanceid' => $categoryid, 'fieldid' => $coursefield->id));
                if ($fieldvalue) {
                    $metaobj = new \metadatafieldtype_fileupload\metadata($coursefield->id, $categoryid);
                    $ret[$coursefield->shortname] = $metaobj->display_data();
                }
            }
        }
        return $ret;
    }


    /**
     * Renders HTML to display one course module for display within a section.
     *
     * This function calls:
     * {@link core_course_renderer::course_section_cm()}
     *
     * @param stdClass $course
     * @param completion_info $completioninfo
     * @param cm_info $mod
     * @param int|null $sectionreturn
     * @param array $displayoptions
     * @return String
     */
    public function course_section_cm_list_item($course, &$completioninfo, cm_info $mod, $sectionreturn, $displayoptions = array()) {
        $output = '';
        if ($modulehtml = $this->course_section_cm($course, $completioninfo, $mod, $sectionreturn, $displayoptions)) {
            $modclasses = 'activity ' . $mod->modname . ' modtype_' . $mod->modname . ' ' . $mod->extraclasses;
            $output .= html_writer::tag('li', $modulehtml, array('class' => $modclasses, 'id' => 'module-' . $mod->id));
        }
        return $output;
    }

}