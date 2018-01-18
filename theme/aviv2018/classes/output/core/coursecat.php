<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 11/12/2017
 * Time: 14:32
 */

namespace theme_aviv2018\output\core;

class coursecat extends \coursecat {
   /*
    * Searches courses
    * Lea 2018 - overriden to change positions of search form
    *
    * List of found course ids is cached for 10 minutes. Cache may be purged prior
    * to this when somebody edits courses or categories, however it is very
    * difficult to keep track of all possible changes that may affect list of courses.
    */
    public static function search_courses($search, $options = array(), $requiredcapabilities = array()) {
        global $DB;
        $offset = !empty($options['offset']) ? $options['offset'] : 0;
        $limit = !empty($options['limit']) ? $options['limit'] : null;
        $sortfields = !empty($options['sort']) ? $options['sort'] : array('sortorder' => 1);

        $coursecatcache = \cache::make('core', 'coursecat');
        $cachekey = 's-' . serialize(
                $search + array('sort' => $sortfields) + array('requiredcapabilities' => $requiredcapabilities)
            );
        $cntcachekey = 'scnt-' . serialize($search);

        $ids = $coursecatcache->get($cachekey);
        if ($ids !== false) {
            // We already cached last search result.
            $ids = array_slice($ids, $offset, $limit);
            $courses = array();
            if (!empty($ids)) {
                list($sql, $params) = $DB->get_in_or_equal($ids, SQL_PARAMS_NAMED, 'id');
                $records = self::get_course_records("c.id " . $sql, $params, $options);
                // Preload course contacts if necessary - saves DB queries later to do it for each course separately.
                if (!empty($options['coursecontacts'])) {
                    self::preload_course_contacts($records);
                }
                // If option 'idonly' is specified no further action is needed, just return list of ids.
                if (!empty($options['idonly'])) {
                    return array_keys($records);
                }
                // Prepare the list of course_in_list objects.
                foreach ($ids as $id) {
                    $courses[$id] = new \course_in_list($records[$id]);
                }
            }
            return $courses;
        }

        $preloadcoursecontacts = !empty($options['coursecontacts']);
        unset($options['coursecontacts']);

        // Empty search string will return all results.
        if (!isset($search['search'])) {
            $search['search'] = '';
        }

        if (empty($search['blocklist']) && empty($search['modulelist']) && empty($search['tagid'])) {
            // Search courses that have specified words in their names/summaries.
            $searchterms = preg_split('|\s+|', trim($search['search']), 0, PREG_SPLIT_NO_EMPTY);

            // Lea 2017 - clas our version of get_courses_search
            $courselist = get_courses_search($searchterms, 'c.sortorder ASC', 0, 9999999, $totalcount, $requiredcapabilities);
            self::sort_records($courselist, $sortfields);
            $coursecatcache->set($cachekey, array_keys($courselist));
            $coursecatcache->set($cntcachekey, $totalcount);
            $records = array_slice($courselist, $offset, $limit, true);
        } else {
            if (!empty($search['blocklist'])) {
                // Search courses that have block with specified id.
                $blockname = $DB->get_field('block', 'name', array('id' => $search['blocklist']));
                $where = 'ctx.id in (SELECT distinct bi.parentcontextid FROM {block_instances} bi
                    WHERE bi.blockname = :blockname)';
                $params = array('blockname' => $blockname);
            } else if (!empty($search['modulelist'])) {
                // Search courses that have module with specified name.
                $where = "c.id IN (SELECT DISTINCT module.course " .
                    "FROM {" . $search['modulelist'] . "} module)";
                $params = array();
            } else if (!empty($search['tagid'])) {
                // Search courses that are tagged with the specified tag.
                $where = "c.id IN (SELECT t.itemid " .
                    "FROM {tag_instance} t WHERE t.tagid = :tagid AND t.itemtype = :itemtype AND t.component = :component)";
                $params = array('tagid' => $search['tagid'], 'itemtype' => 'course', 'component' => 'core');
                if (!empty($search['ctx'])) {
                    $rec = isset($search['rec']) ? $search['rec'] : true;
                    $parentcontext = context::instance_by_id($search['ctx']);
                    if ($parentcontext->contextlevel == CONTEXT_SYSTEM && $rec) {
                        // Parent context is system context and recursive is set to yes.
                        // Nothing to filter - all courses fall into this condition.
                    } else if ($rec) {
                        // Filter all courses in the parent context at any level.
                        $where .= ' AND ctx.path LIKE :contextpath';
                        $params['contextpath'] = $parentcontext->path . '%';
                    } else if ($parentcontext->contextlevel == CONTEXT_COURSECAT) {
                        // All courses in the given course category.
                        $where .= ' AND c.category = :category';
                        $params['category'] = $parentcontext->instanceid;
                    } else {
                        // No courses will satisfy the context criterion, do not bother searching.
                        $where = '1=0';
                    }
                }
            } else {
                debugging('No criteria is specified while searching courses', DEBUG_DEVELOPER);
                return array();
            }
            $courselist = self::get_course_records($where, $params, $options, true);
            if (!empty($requiredcapabilities)) {
                foreach ($courselist as $key => $course) {
                    context_helper::preload_from_record($course);
                    $coursecontext = context_course::instance($course->id);
                    if (!has_all_capabilities($requiredcapabilities, $coursecontext)) {
                        unset($courselist[$key]);
                    }
                }
            }
            self::sort_records($courselist, $sortfields);
            $coursecatcache->set($cachekey, array_keys($courselist));
            $coursecatcache->set($cntcachekey, count($courselist));
            $records = array_slice($courselist, $offset, $limit, true);
        }

        // Preload course contacts if necessary - saves DB queries later to do it for each course separately.
        if (!empty($preloadcoursecontacts)) {
            self::preload_course_contacts($records);
        }
        // If option 'idonly' is specified no further action is needed, just return list of ids.
        if (!empty($options['idonly'])) {
            return array_keys($records);
        }
        // Prepare the list of course_in_list objects.
        $courses = array();
        foreach ($records as $record) {
            $courses[$record->id] = new \course_in_list($record);
        }
        return $courses;
    }
}