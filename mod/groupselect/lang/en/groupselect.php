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
 * Group self selection
 *
 * @package    mod
 * @subpackage groupselect
 * @copyright  2008-2011 Petr Skoda (http://skodak.org)
 * @copyright  2014 Tampere University of Technology, P. Pyykkönen (pirkka.pyykkonen ÄT tut.fi)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['action'] = 'Action';
$string['assignedteacher'] = 'Supervisor';
$string['assigngroup'] = 'Assign supervisors to groups';
$string['assigngroup_confirm'] = 'This will assign supervisors to groups, overriding possible previous assignment irreversibly. Are you sure?';
$string['assigngroup_help'] = 'If set, enables a button which assigns supervisors to groups (if course has supervisors). Assigned supervisors are not group members, but they show up in export file and in the main view (if set). Useful if course uses assistants to handle groups.';
$string['cannotselectclosed'] = 'You can not become group member any more.';
$string['cannotselectmaxed'] = 'You can not join group {$a} - maximum number of members reached.';
$string['cannotselectnocap'] = 'You are not allowed to select group.';
$string['cannotselectnoenrol'] = 'You need to be enrolled into course in order to become a group member.';
$string['cannotunselectclosed'] = 'You can not leave group any more';
$string['creategroup'] = 'Create a new group';
$string['deleteemptygroups'] = 'Delete group when last student leaves';
$string['deleteemptygroups_help'] = 'If set, automatically deletes group when last student leaves from it';
$string['description'] = 'Group description';
$string['edittooltip'] = 'Click to edit';
$string['eventexportlinkcreated'] = 'Export link created';
$string['eventgroupteacheradded'] = 'Supervisor teacher added';
$string['export'] = 'Create a download link for group data file (CSV)';
$string['export_download'] = 'Download CSV-file';
$string['fromallgroups'] = 'All groups';
$string['globalpassword_help'] = 'Set a global password for group joining. Overrides student set passwords.';
$string['groupid'] = 'Group ID';
$string['groupselect:addinstance'] = 'Add a new group self-selection';
$string['groupselect:assign'] = 'Allow to assign supervisors to groups';
$string['groupselect:create'] = 'Allow creating of group';
$string['groupselect:export'] = 'Allow export of group members';
$string['groupselect:select'] = 'Allow becoming of group member';
$string['groupselect:unselect'] = 'Allow leaving of group';
$string['hidefullgroups'] = 'Hide full groups from the main view';
$string['hidefullgroups_help'] = 'If set, hides all groups, which have reached max member count, from the main list view (excluding user\'s own group). May be useful if the activity has lots of groups.';
$string['incorrectpassword'] = 'Incorrect password';
$string['managegroups'] = 'Manage groups';
$string['maxcharlenreached'] = 'Maximum character number reached';
$string['maxgroupmembership'] = 'Maximum number of groups to participate in';
$string['maxgroupmembership_error_low'] = 'Error: At least 1 group needs to be selectable!';
$string['maxlimitreached'] = 'Maximum number reached';
$string['maxmembers'] = 'Max members per group';
$string['maxmembers_error_low'] = "Error: Use 0 to indicate for unlimited group size!";
$string['maxmembers_error_smaller_minmembers'] = "Error: Needs to be greater than the minimum participants per group!";
$string['maxmembers_help'] = 'Maximum number of members per group, 0 for unlimited.';
$string['maxmembers_icon'] = 'Group has too many members';
$string['maxmembers_notification'] = 'Your group has too many members! Maximum is {$a}.';
$string['member'] = 'Member';
$string['membercount'] = 'Count';
$string['membershidden'] = 'Member list not available';
$string['memberslist'] = 'Members';
$string['minmembers'] = 'Min members per group';
$string['minmembers_error_low'] = "Error: Negative numbers are not allowed for the minimum group size!";
$string['minmembers_error_bigger_maxmembers'] = "Error: The minimum group size needs to be smaller than the maximum participants per group!";
$string['minmembers_help'] = 'Minimum number of members per group. Adds notifications for members of groups which are under this limit. Default is 0 (disabled).';
$string['minmembers_icon'] = 'Group has less members than required';
$string['minmembers_notification'] = 'Your group has less members than required! Minimum is {$a}.';
$string['modulename'] = 'Group self-selection';
$string['modulename_help'] = '<p>Lets students create and select groups. Features: </p><ul><li>Students can create groups, give them a description and set them password protected, if wanted</li><li>Students can select and join groups</li><li>Supervisors may be assigned to groups</li><li>Teacher can export course group list as a csv-file</li><li>Full compatibility with basic Moodle groups: groups may be created by other means if needed, supports group assignment submissions etc.</li></ul>';
$string['modulenameplural'] = 'Group self-selections';
$string['nogroups'] = 'No groups available to select from, sorry.';
$string['notavailableanymore'] = 'Group selection is not available anymore, sorry (since {$a}).';
$string['notavailableyet'] = 'Group selection will be available on {$a}.';
$string['notifyexpiredselection'] = 'Show message, if the open until date is reached';
$string['notifyexpiredselection_help'] = 'If set, a message will appear if the open until date is reached';
$string['ok'] = 'OK';
$string['password'] = 'Requires password';
$string['pluginadministration'] = 'Module administration';
$string['pluginname'] = 'Group self-selection';
$string['saving'] = 'Saving...';
$string['select'] = 'Become member of {$a}';
$string['selectconfirm'] = 'Do you really want to become member of the group <em>{$a}</em>?';
$string['showassignedteacher'] = 'Show assigned supervisors';
$string['showassignedteacher_help'] = 'If set, assigned supervisors will show up in group members. Useful if students need to know their assigned teacher';
$string['studentcancreate'] = 'Students can create groups';
$string['studentcancreate_help'] = 'If set, students without group (in selected grouping) can create groups';
$string['studentcansetdesc'] = 'Students can set and edit group description';
$string['studentcansetdesc_help'] = 'If set, student can set a a group description when creating one and group members can edit it';
$string['studentcansetenrolmentkey'] = 'Students can set passwords for joining groups';
$string['studentcansetenrolmentkey_help'] = 'If set, students can set an enrolment key for joining groups';
$string['studentcansetgroupname'] = 'Students can set the name of new groups';
$string['studentcansetgroupname_help'] = 'If set, students can set the group names';
$string['supervisionrole'] = 'Supervisor role';
$string['supervisionrole_help'] = 'Define the role for supervisors (formally non-editing teachers)';
$string['targetgrouping'] = 'Select groups from grouping';
$string['timeavailable'] = 'Open from';
$string['timeavailable_error_past_timedue'] = 'Error: Cannot start after due date!';
$string['timedue'] = 'Open until';
$string['timedue_error_pre_timeavailable'] = 'Error: Cannot end before start date!';
$string['unselect'] = 'Leave group {$a}';
$string['unselectconfirm'] = 'Do you really want to leave the group <em>{$a}</em>?';
