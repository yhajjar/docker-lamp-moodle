<?php

namespace local_groupmanager\external;

use core_external\external_function_parameters;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use core_external\external_value;

class delete_group extends \core_external\external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function execute_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'id of course'),
            'groupid' => new external_value(PARAM_INT, 'id of group'),
        ]);
    }

    /**
    * Create groups
    * @param array $groups array of group description arrays (with keys groupname and courseid)
    * @return array of newly created groups
    */
    public static function execute(int $courseid, int $groupid) {
        global $CFG, $DB;
        require_once($CFG->dirroot."/group/lib.php");

        $params = self::validate_parameters(self::execute_parameters(), ['courseid' => $courseid, 'groupid' => $groupid]);
        
        $transaction = $DB->start_delegated_transaction(); //If an exception is thrown in the below code, all DB queries in this code will be rollback.

        if (trim($params['courseid']) == '') {
            throw new invalid_parameter_exception('Invalid id course');
        }
        if (trim($params['groupid']) == '') {
            throw new invalid_parameter_exception('Invalid id group');
        }
        if (!$DB->get_record('groups', ['courseid' => $params['courseid'], 'id' => $params['groupid']])) {
            throw new invalid_parameter_exception('No exist group in the course');
        }

        // now security checks
        $context = \context_course::instance($params['courseid']);
        self::validate_context($context);
        require_capability('moodle/course:managegroups', $context);

        // finally delete the group and event, grouping, memebers, conversations
        if (!groups_delete_group($params['groupid'])) {
            throw new invalid_parameter_exception('Error in deleting the group');        
        }

        $transaction->allow_commit();

        return $params;
    }

    public static function execute_returns() {
        return new external_single_structure([
            'courseid' => new external_value(PARAM_INT, 'id of course'),
            'groupid' => new external_value(PARAM_INT, 'id of group'),
        ]);
    }
}