<?php


/**
 * Settings for the backups report
 *
 * @package    report
 * @subpackage template
 * @copyright  2023 paruls <>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', new admin_externalpage('report_template', get_string('pluginname', 'report_template'), "$CFG->wwwroot/report/template/index.php"));

// no report settings
$settings = null;