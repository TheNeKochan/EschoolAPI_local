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
 * Local Pages Upgrade
 *
 * @package     local_pages
 * @author      Kevin Dibble
 * @copyright   2017 LearningWorks Ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die;


/**
 *
 * This is to upgrade the older versions of the plugin.
 *
 * @param integer $oldversion
 * @return bool
 * @throws ddl_exception
 * @throws ddl_table_missing_exception
 * @throws downgrade_exception
 * @throws upgrade_exception
 * @copyright   2017 LearningWorks Ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
function xmldb_local_eschoolapi_upgrade($oldversion)
{
    global $DB;
    $dbman = $DB->get_manager();

    $XXXXXXXXXX = 2021110404;

    if ($oldversion < $XXXXXXXXXX) {

        // Define table local_eschoolapi_tcm to be created.
        $table = new xmldb_table('local_eschoolapi_tcm');

        // Adding fields to table local_eschoolapi_tcm.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('class', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_tcm.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_tcm.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_cgm to be created.
        $table = new xmldb_table('local_eschoolapi_cgm');

        // Adding fields to table local_eschoolapi_cgm.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('subgroup', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_cgm.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_cgm.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_sgm to be created.
        $table = new xmldb_table('local_eschoolapi_sgm');

        // Adding fields to table local_eschoolapi_sgm.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('subgroupid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('groupid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_sgm.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_sgm.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_cs to be created.
        $table = new xmldb_table('local_eschoolapi_cs');

        // Adding fields to table local_eschoolapi_cs.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);
        $table->add_field('enabled', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);
        $table->add_field('triggertype', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);
        $table->add_field('onend_markmode', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('onend_onclose', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('ondate_date', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('ondate_makrmode', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('ondate_onprocess', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('mark_scale', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);
        $table->add_field('mark_scale_redefined_1', XMLDB_TYPE_INTEGER, '1', null, null, null, null);
        $table->add_field('mark_scale_redefined_2', XMLDB_TYPE_INTEGER, '3', null, null, null, null);
        $table->add_field('mark_scale_redefined_3', XMLDB_TYPE_INTEGER, '3', null, null, null, null);
        $table->add_field('mark_scale_redefined_4', XMLDB_TYPE_INTEGER, '3', null, null, null, null);
        $table->add_field('mark_scale_redefined_5', XMLDB_TYPE_INTEGER, '3', null, null, null, null);

        // Adding keys to table local_eschoolapi_cs.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_cs.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_gdm to be created.
        $table = new xmldb_table('local_eschoolapi_gdm');

        // Adding fields to table local_eschoolapi_gdm.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('groupid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('date', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_gdm.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_gdm.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_tp to be created.
        $table = new xmldb_table('local_eschoolapi_tp');

        // Adding fields to table local_eschoolapi_tp.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('username', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('password', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_tp.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_tp.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_eschoolapi_esmsm to be created.
        $table = new xmldb_table('local_eschoolapi_esmsm');

        // Adding fields to table local_eschoolapi_esmsm.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('username', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('password', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Adding keys to table local_eschoolapi_esmsm.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_eschoolapi_esmsm.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Eschoolapi savepoint reached.
        upgrade_plugin_savepoint(true, $XXXXXXXXXX, 'local', 'eschoolapi');
    }


    return true;
}
