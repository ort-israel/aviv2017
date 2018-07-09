<?php
/**
 * Language file.
 *
 * @package    theme_aviv2018
 * @copyright  2017 ORT Israel Team
 * @credits    theme_boost - MoodleHQ; theme_fordson - Chris Kenniburg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// The name of our plugin.
$string['pluginname'] = 'Aviv 2018';
// A description shown in the admin theme selector.
$string['choosereadme'] = 'Theme aviv 2018 is a child theme of Fordson. It is customized to ORT ISrael needs.';
$string['configtitle'] = 'Aviv 2018';
$string['region-side-pre'] = 'בצד ימין';
$string['region-in-header'] = 'בכותרת';
$string['region-above-content'] = 'מעל לתוכן';
$string['region-below-content'] = 'מתחת לתוכן';
$string['generalsettings'] = 'General settings';
$string['advancedsettings'] = 'Advanced settings';
$string['iconnavheading'] = 'Icon Navigation';
$string['iconnavheadingsub'] = 'Create Buttons with Icons for use on the homepage.  Links can go anywhere.';


// Presets Settings.
$string['presets_settings'] = 'Presets';
$string['currentinparentheses'] = '(current)';
$string['presetfiles'] = 'Additional theme preset files';
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme.
    See https://docs.moodle.org/dev/Boost_Presets for information on creating and sharing your own preset files.';
$string['preset'] = 'Theme preset';
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';

$string['rawscss'] = 'Raw SCSS';
$string['rawscss_desc'] = 'Use this field to provide SCSS code which will be injected at the end of the style sheet.';
$string['rawscsspre'] = 'Raw initial SCSS';
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else.
    Most of the time you will use this setting to define variables.';

// Image Settings.
$string['imagesettings'] = 'Custom image settings';
$string['headerdefaultimage'] = 'Default header image';
$string['headerdefaultimage_desc'] = 'Default image for course headers and non-course pages';
$string['backgroundimage'] = 'Default page background image';
$string['backgroundimage_desc'] = 'Background image for pages';
$string['loginimage'] = 'Default Login image';
$string['loginimage_desc'] = 'Background image for login page';

// Content settings.
$string['contentsettings'] = 'Content areas';
$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Footnote content editor for main footer';
$string['fptextbox'] = 'Homepage Textbox Authenticated User';
$string['fptextbox_desc'] = 'This textbox appears on the homepage once a user authenticates. It is ideal for putting a welcome message and providing instructions for the learner.';
$string['fptextboxlogout'] = 'Homepage Textbox Visitor';
$string['fptextboxlogout_desc'] = 'This textbox appears on the homepage for visitors and is ideal for putting a welcome message or link to the login page.';
$string['searchtoggle'] = 'Show the Homepage Searchbox';
$string['searchtoggle_desc'] = 'Check this in order to show the homepage searchbox for courses.';
$string['slidetextbox'] = 'Slide Textbox';
$string['slidetextbox_desc'] = 'This textbox content will be displayed when the Slide Button is pressed.';
$string['sectionicon'] = 'Course Section Icon';
$string['sectionicon_desc'] = 'This allows you to change the icon that appears next to each section in a course.  These are Font-Awesome icons. These appear in the following presets: Default and Evolve-D.';
$string['headericon'] = 'Header Title Icon';
$string['headericon_desc'] = 'This allows you to change the icon that appears in the header area next to the page title. These are Font-Awesome icons. These appear in the following presets: Default and Evolve-D.';
$string['enablefrontpageavailablecoursebox'] = 'Enable Enhanced Course Display';
$string['enablefrontpageavailablecoursebox_desc'] = 'Enhanced Course Display will display courses as tiles in a grid and use icons in a grid view for course categories. To use Moodle default presentation uncheck this option.';
$string['courseboxheight'] = 'Frontpage Courses Tile Height';
$string['courseboxheight_desc'] = 'Control the height of the Course tile on the frontpage.';
$string['catsicon'] = 'Category Icon';
$string['catsicon_desc'] = 'Choose an icon to represent course categories.';
$string['trimtitle'] = 'Trim Course Title';
$string['trimtitle_desc'] = 'Enter a number to trim the title length.  This number represents characters that will be displayed.';
$string['trimsummary'] = 'Trim Course Summary';
$string['trimsummary_desc'] = 'Enter a number to trim the summary length.  This number represents characters that will be displayed.';
$string['titletooltip'] = 'Course Title Tooltip';
$string['titletooltip_desc'] = 'If using Trim Course Title you can use tooltips which will display the entire course title in a tooltip.  Check this box to turn on tooltips.';
$string['dashactivityoverview'] = 'ACTIVITIES OVERVIEW';

// Menu Settings
$string['menusettings'] = 'Menu settings';
$string['thiscourse'] = 'This Course';
$string['thiscourseenroll'] = 'User Enrollment';
$string['thiscoursegroups'] = 'Group Management';
$string['thiscoursequestion'] = 'Question Bank';
$string['thiscoursequestioncat'] = 'Question Categories';
$string['headerimagepadding'] = 'Header Image Height';
$string['headerimagepadding_desc'] = 'Control the padding and height of the header image for courses.';
$string['activitymenu'] = 'Show This Course Drop Down Menu';
$string['activitymenu_desc'] = 'Show the This Course drop down menu.  This menu appears next to the breadcrumbs and will display a listing of all activities for the student.  You can also customize the menu by clicking on the menu items below to control what will appear.';

$string['userenrollmenu'] = 'Show Enrollment Link';
$string['userenrollmenu_desc'] = 'Include a link to the Enrollment page in This Course drop down menu.';
$string['groupmanagemenu'] = 'Show Group Management Link';
$string['groupmanagemenu_desc'] = 'Include a link to the Group Management page in This Course drop down menu.';
$string['questioncategorymenu'] = 'Show Question Categories Link';
$string['questioncategorymenu_desc'] = 'Include a link to the Question Categories page in This Course drop down menu.';
$string['questionbankmenu'] = 'Show Question Bank Link';
$string['questionbankmenu_desc'] = 'Include a link to the Question Bank page in This Course drop down menu.';
$string['activitylistingmenu'] = 'Show Activity Listings';
$string['activitylistingmenu_desc'] = 'Include a link to show activities in This Course drop down menu.';

$string['setting_removenodesheading'] = 'Remove Menu Items from the Nav Drawer';
$string['setting_removenodesperformancehint'] = 'Technically, this is done by setting the Menu Item\'s showinflatnavigation attribute to false. Thus, the node will only be hidden from the nav drawer, but it will remain in the navigation tree and can still be accessed by other parts of Moodle.';
$string['setting_removecalendarnode'] = 'Remove "Calendar" Menu Item';
$string['setting_removecalendarnode_desc'] = 'Enabling this setting will remove the "Calendar" Menu Item from Boost\'s nav drawer.';
$string['setting_removehomenode'] = 'Remove "Home" Menu Item';
$string['setting_removehomenode_desc'] = 'Enabling this setting will remove the "Home" Menu Item from Boost\'s nav drawer.';
$string['setting_removesecondhomenode'] = 'Remove second "Home" or "Dashboard" Menu Item';
$string['setting_removesecondhomenode_desc'] = 'Enabling this setting will remove the "Home" or "Dashboard" Menu Item, depending on what the user chose not to be his home page, from Boost\'s nav drawer.';
$string['setting_removedashboardnode'] = 'Remove "Dashboard" Menu Item';
$string['setting_removedashboardnode_desc'] = 'Enabling this setting will remove the "Dashboard" Menu Item from Boost\'s nav drawer.';
$string['setting_removemycoursesnode'] = 'Remove "My courses" Menu Item';
$string['setting_removemycoursesnode_desc'] = 'Enabling this setting will remove the "My courses" Menu Item from Boost\'s nav drawer.';
$string['setting_removemycoursesnodeperformancehint'] = 'Please note: If you enable this setting and have also enabled the setting <a href="/admin/search.php?query=navshowmycoursecategories">navshowmycoursecategories</a>, removing the "My courses" node takes more time and you should consider disabling the navshowmycoursecategories setting.';
$string['setting_removeprivatefilesnode'] = 'Remove "Private files" Menu Item';
$string['setting_removeprivatefilesnode_desc'] = 'Enabling this setting will remove the "Private files" Menu Item from Boost\'s nav drawer.';
$string['adddrawermenu'] = 'Add Custom Items to the Navigation Drawer';
$string['adddrawermenu_desc'] = 'You can add custom items to the Navigation Menu using the following syntax.
Identical to that used in the custom menu at theme settings.
<br>
Example:
<br>
Moodle community|http://moodle.org/support
<br>
Moodle company|http://moodle.com';
$string['toggledrawermenu'] = 'Activate Custom Navigation Drawer';
$string['toggledrawermenu_desc'] = 'Determine where these settings will be applied.';
$string['activateonhomepage'] = 'Activate on Homepage';
$string['activateoncoursepage'] = 'Activate on Coursepage';
$string['activateonboth'] = 'Activate on All Pages';

//FP Icon Nav
$string['navicon1'] = 'Homepage Icon One';
$string['navicon2'] = 'Homepage Icon Two';
$string['navicon3'] = 'Homepage Icon Three';
$string['navicon4'] = 'Homepage Icon Four';
$string['navicon5'] = 'Homepage Icon Five';
$string['navicon6'] = 'Homepage Icon Six';
$string['navicon7'] = 'Homepage Icon Seven';
$string['navicon8'] = 'Homepage Icon Eight';

//FP Icon Nav default text for buttons
$string['naviconbutton1textdefault'] = 'Dashboard';
$string['naviconbutton2textdefault'] = 'Calendar';
$string['naviconbutton3textdefault'] = 'Badges';
$string['naviconbutton4textdefault'] = 'All Courses';
$string['naviconbuttoncreatetextdefault'] = 'Create a Course';

$string['createinfo'] = 'Special Course Creator Button';
$string['createinfodesc'] = 'This button appears on the homepage when a user can create new courses.  Those with the role of Course Creator at the site level will see this button.';
$string['iconwidthinfo'] = 'Icon Button Width Setting';
$string['iconwidthinfodesc'] = 'Select a width that will allow your link text to fit inside the icon navigation buttons.';
$string['sliderinfo'] = 'Special Slide Icon Button';
$string['sliderinfodesc'] = 'This button will show/hide a special textbox which slides down from the icon navigation bar.  This is ideal for featuring courses, providing help, or listing required staff training.';

$string['iconwidth'] = 'Homepage Icon Width';
$string['iconwidth_desc'] = 'Width of the 8 individual icons in the icon navigation bar on the homepage.';

$string['navicon'] = 'Icon';
$string['navicondesc'] = 'Name of the icon you wish to use. List is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>.  Just enter what is after "fa-", e.g. "star".';
$string['naviconslidedesc'] = 'Suggested icon text: arrow-circle-down . Or choose from the list is <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_new">here</a>.  Just enter what is after "fa-", e.g. "star".';

$string['naviconbuttontext'] = 'Link Text';
$string['naviconbuttontextdesc'] = 'Text to appear below the icon.';
$string['naviconbuttonurl'] = 'Link URL';
$string['naviconbuttonurldesc'] = 'URL the button will point to. You can link to anywhere including outside websites  just enter the proper URL.  If your Moodle site is in a subdirectory the default URL will not work.  Please adjust the URL to reflect the subdirectory. Example if "moodle" was your subdirectory folder then the URL would need to be changed to /moodle/my/ ';

//Edit Button Text
$string['editon'] = 'Turn Edit On';
$string['editoff'] = 'Turn Edit Off';

// Footer Settings.
$string['footer_settings'] = 'Footer settings';
$string['footer_headingsub'] = 'Text to appear in footer.';
$string['footer_desc'] = 'Insert the text that should appear in the footer.';
$string['footer1'] = 'Footer Spot One';
$string['footertitle'] = 'Title.';
$string['footertitledesc'] = 'Title to show in this footer spot.';
$string['footercontent'] = 'Content';
$string['footercontentdesc'] = 'Content to show in this footer spot';

// Logos Settings.
$string['logos_settings'] = 'Logos settings';
$string['logos_headingsub'] = 'Primary and Secondary Logos.';
$string['logos_desc'] = 'Insert the primary and secondary logos.';
$string['logo_primary'] = 'Insert the primary logo.';
$string['logo_primary_desc'] = 'Insert the primary logos.';
$string['logo_secondary'] = 'Insert the secondary logo.';
$string['logo_secondary_desc'] = 'Insert the secondary logos.';

// Header Title Settings.
$string['header_title_settings'] = 'Header Title settings';
$string['header_title_headingsub'] = 'Primary and Secondary Header Titles.';
$string['header_title_desc'] = 'Insert the primary and secondary header titles.';
$string['header_title_primary'] = 'Insert the primary header title.';
$string['header_title_primary_desc'] = 'Insert the primary header titles.';
$string['header_title_secondary'] = 'Insert the secondary header title.';
$string['header_title_secondary_desc'] = 'Insert the secondary header titles.';

//Alerts
$string['alert'] = 'Homepage Alert';
$string['alert_desc'] = 'This is a special alert message that will appear on the homepage.';

// Aviv2018 specific strings
$string['statisticstitle'] = 'הקמפוס במספרים';
$string['courses'] = 'קורסים';
$string['teachers'] = 'מורים';
$string['students'] = 'תלמידים';
$string['thecountgoeson'] = 'והספירה ממשיכה';
$string['startlearning'] = 'התחילו ללמוד';


// Footer settings
$string['footerheading'] = 'Footer';
$string['footerheadingsub'] = 'Customize the footer of the homepage';
$string['footerdesc'] = 'The items below allow you provide branding to the theme footer.';
$string['footnoteabout'] = 'Footnote About';
$string['footnoteaboutdesc'] = 'Footnote content editor for About';
$string['footerdetails'] = 'R&D Details';
$string['footerdetailsdesc'] = 'Details about the R&D';
$string['footeraddress'] = 'R&D address';
$string['footnoteabout'] = 'Footnote About';
$string['footnoteaboutdesc'] = 'Footnote content editor for About';
$string['footeraddress'] = 'R&D address';
$string['footeraddressdesc'] = 'Address of the R&D center';
$string['footeremail'] = 'R&D email';
$string['footeremaildesc'] = 'Email of the R&D center';
$string['footerphone'] = 'R&D support phone number';
$string['footerphonedesc'] = 'Phone number of the R&D center support team';
$string['footertutorials'] = 'Moodle Tutorials';
$string['footertutorialsdesc'] = 'Tutorials for using Moodle';
$string['footerfacebook'] = 'ORT Israel\'s facebook';
$string['footerfacebookdesc'] = 'ORT Israel\'s facebook';
$string['footersiteregulation'] = 'תקנון אתר';
$string['footersiteregulationdesc'] = 'כתובת תקנון האתר';

// Footer text in site
$string['contactandsupporttitle'] = 'יצירת קשר ותמיכה';
$string['email'] = 'דוא"ל';
$string['phone'] = 'טלפון';
$string['tutorials'] = 'מדריכים לשימוש ב-moodle';
$string['siteregulation'] = 'תקנון אתר';
$string['footnoteabouttitle'] = 'אודות';
$string['copyrighttext'] =  'Copyright © 2016 - האתר פותח על ידי היחידה לטכנולוגיות אינטרנט, המרכז למו״פ, <a href="http://ort.org.il">אורט ישראל</a> ומבוסס moodle';;

// Course page
$string['about_course'] = 'על הקורס';

