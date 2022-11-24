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
 * Local Pages Edit Page
 *
 * @package     local_eschoolapi
 * @author      nekochan
 * @copyright   NeKoChan Inc.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
//require_once($CFG->dirroot . '/local/pages/lib.php');

try {
    $course = optional_param('course', 0, PARAM_INT);
} catch (coding_exception $e) {
}
$context = context_system::instance();

global $USER, $PAGE, $DB;

// Set PAGE variables.
$PAGE->set_context($context);
try {
    $PAGE->set_url($CFG->wwwroot . '/local/eschoolapi/pages.php');
} catch (coding_exception $e) {
}

// Force the user to login/create an account to access this page.
try {
    require_login();
} catch (coding_exception $e) {
} catch (require_login_exception $e) {
} catch (moodle_exception $e) {
}


echo "<html lang=\"\"><head><style>body{font-family: \"comic sans ms\",serif;} td{border: solid black 1px}</style><title></title></head><body>";
echo "hello, world!";
echo "<br>";
echo $USER->id;
echo "<br>";
//var_dump($USER);
echo "<br>";
echo "<div style='display: flex; flex-direction: row;'>";
//id,courseid,idnumber,name,description,descriptionformat,enrolmentkey,picture,hidepicture,timecreated,timemodified

echo "<div>groups<br><table><thead><tr><td>id</td><td>courseid</td><td>idnumber</td><td>name</td><td>description</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {groups}');
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->courseid}</td>";
    echo "<td>{$group->idnumber}</td>";
    echo "<td>{$group->name}</td>";
    echo "<td>{$group->description}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>groups_members<br><table><thead><tr><td>id</td><td>groupid</td><td>userid</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {groups_members}');
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->groupid}</td>";
    echo "<td>{$group->userid}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>cohort<br><table><thead><tr><td>id</td><td>courseid</td><td>idnumber</td><td>name</td><td>description</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {cohort}');
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->courseid}</td>";
    echo "<td>{$group->idnumber}</td>";
    echo "<td>{$group->name}</td>";
    echo "<td>{$group->description}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>cohort_members<br><table><thead><tr><td>id</td><td>cohortid</td><td>userid</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {cohort_members}');
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->cohortid}</td>";
    echo "<td>{$group->userid}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>course<br><table><thead><tr><td>id</td><td>category</td><td>sortorder</td><td>fullname</td><td>showgrades</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {course}');
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->category}</td>";
    echo "<td>{$group->sortorder}</td>";
    echo "<td>{$group->fullname}</td>";
    echo "<td>{$group->showgrades}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>user_enrolments<table><thead><tr><td>id</td><td>status</td><td>enrolid</td><td>userid</td><td>modifierid</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {user_enrolments}');
foreach ($groups as $group){
    echo "<tr>";
    //var_dump($group);
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->status}</td>";
    echo "<td>{$group->enrolid}</td>";
    echo "<td>{$group->userid}</td>";
    echo "<td>{$group->modifierid}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo "<div>enrol<br><table><thead><tr><td>id</td><td>enrol</td><td>courseid</td><td>roleid</td><td>status</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {enrol}'); // groups // course // user_enrolments
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->enrol}</td>";
    echo "<td>{$group->courseid}</td>";
    echo "<td>{$group->roleid}</td>";
    echo "<td>{$group->status}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo "<div>Tables<br><table><thead><tr><td>name</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SHOW TABLES'); // groups // course // user_enrolments
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->tables_in_moodle}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>role<br><table><thead><tr><td>id</td><td>archetype</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {role}'); // groups // course // user_enrolments
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->archetype}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>role_assignments<br><table><thead><tr><td>id</td><td>roleid</td><td>contextid</td><td>userid</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {role_assignments}'); // groups // course // user_enrolments
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->roleid}</td>";
    echo "<td>{$group->contextid}</td>";
    echo "<td>{$group->userid}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "<div>context<br><table><thead><tr><td>id</td><td>contextlevel</td><td>instanceid</td><td>path</td></tr></thead><tbody>";
$groups = $DB->get_recordset_sql('SELECT * FROM {context}'); // groups // course // user_enrolments
foreach ($groups as $group){
    echo "<tr>";
    echo "<td>{$group->id}</td>";
    echo "<td>{$group->contextlevel}</td>";
    echo "<td>{$group->instanceid}</td>";
    echo "<td>{$group->path}</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

echo "</div>";




echo "</body></html>";
