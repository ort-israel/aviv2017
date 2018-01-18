<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 16/11/2017
 * Time: 13:56
 */

class ort_util {

    /**
     * Gets all metadata associated with given course
     * @param $courseid
     * @return array
     */
    public static function get_metadata_course($courseid) {
        global $DB;
        $allcoursefields = $DB->get_records('local_metadata_field', array('contextlevel' => CONTEXT_COURSE));
        $ret = array();
        foreach ($allcoursefields as $coursefield) {
            $fieldvalue = $DB->get_record('local_metadata', array('instanceid' => $courseid, 'fieldid' => $coursefield->id));
            if ($fieldvalue) {
                $ret[$coursefield->shortname] = $fieldvalue;
                //add the name of field:
                $ret[$coursefield->shortname]->fieldname = $coursefield->name;
            }
        }
//        if (count($allcoursefields) > 0) {
//
//            // select all the id's of this course's meta fields
//            $allcoursefieldsids = array_column($allcoursefields, 'id');
//
//            // create query that gets all the values of all the meta fields in this course
//            $select = "instanceid = " . $courseid . " AND fieldid in (" . implode(',', $allcoursefieldsids) . ")";
//            $allcoursefieldsvalues = $DB->get_records_select('local_metadata', $select);
//
//            /* Make the indices of the returned array be the shortnames of the field.
//             * That way, whomever uses this function doesn't need to know the id of the filed, and can just use its shortname*/
//            if (count($allcoursefieldsvalues) > 0) {
//                foreach ($allcoursefieldsvalues as $coursefieldvalue) {
//
//                    // get the currect field object according to the fieldid of the current
//                    if (isset($allcoursefields[$coursefieldvalue->fieldid])) {
//                        $currfield = $allcoursefields[$coursefieldvalue->fieldid];
//
//                        // insert this item in the shortname index of the new array
//                        if (isset($currfield->shortname)) {
//                            $ret[$currfield->shortname] = $coursefieldvalue;
//                            // add the name of field:
//                            $ret[$currfield->shortname]->fieldname = $currfield->name;
//                        }
//                    }
//                }
//            }
//        }
        return $ret;
    }

    public static function get_metadata_course_by_field_as_list($courseid, $fieldnames) {
        if (!is_array($fieldnames)) {
            $fieldnames = array($fieldnames);
        }
        $ret = '';
        $metafields = \ort_util::get_metadata_course($courseid);
        foreach ($fieldnames as $fieldname) {
            if (!empty($metafields) && count($metafields) > 0) {
                if (isset($metafields[$fieldname]))
                    $ret .= html_writer::tag('dl',
                        html_writer::tag('dt',
                            $metafields[$fieldname]->fieldname . ':&nbsp; ',
                            array('class' => 'fielddefinition')) .
                        html_writer::tag('dd', $metafields[$fieldname]->data,
                            array('class' => 'fieldvalue')),
                        array('class' => 'metadata metadata' . $fieldname));
            }
        }
        return $ret;
    }

    public static function get_metadata_course_by_field_as_link($courseid, $fieldnames) {
        if (!is_array($fieldnames)) {
            $fieldnames = array($fieldnames);
        }
        $ret = '';
        $metafields = \ort_util::get_metadata_course($courseid);
        foreach ($fieldnames as $fieldname) {
            if (!empty($metafields) && count($metafields) > 0) {
                if (isset($metafields[$fieldname]))
                    $ret .= html_writer::link($metafields[$fieldname]->data, $metafields[$fieldname]->fieldname, array('class' => 'metadata metadata' . $fieldname));
            }
        }
        return $ret;
    }
}