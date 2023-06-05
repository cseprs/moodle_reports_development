<?php
// This file is part of Moodle - http://moodle.org/


/**
 * Privacy Subsystem implementation for report_backups.
 *
 * @package    report_template
 * @copyright  2023 paruls <>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace report_template\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for report_backups implementing null_provider.
 *
 * @copyright  2023 paruls <>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}