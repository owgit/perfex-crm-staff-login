<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Staff Login module migration
 */
class Migration_Version_100 extends App_module_migration
{
    /**
     * Apply migration
     */
    public function up()
    {
        // No database tables needed for this module
        // We're using the existing activity_log table for logging

        // Add module permissions
        $capabilities = [
            'view'     => _l('permission_view'),
            'login_as' => 'Login as Staff Member'
        ];

        $this->add_permission('staff_login', $capabilities, _l('staff_login'));

        return true;
    }

    /**
     * Revert migration
     */
    public function down()
    {
        // Remove permissions
        $this->db->where('feature', 'staff_login');
        $this->db->delete(db_prefix() . 'permissions');

        return true;
    }
} 