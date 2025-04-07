<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Staff Login Test Controller
 * 
 * This controller is used for testing the migration and activating the module.
 * Access via: http://your-domain.com/admin/staff_login_test
 */
class Staff_login_test extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        // Only allow admins to run this
        if (!is_admin()) {
            access_denied('Only administrators can run this script');
        }
    }
    
    public function index()
    {
        echo '<h1>Staff Login Module Test</h1>';
        echo '<p>Use one of the following options:</p>';
        echo '<ul>';
        echo '<li><a href="' . admin_url('staff_login_test/run_migration') . '">Run Migration</a></li>';
        echo '<li><a href="' . admin_url('staff_login_test/activate_module') . '">Activate Module</a></li>';
        echo '</ul>';
    }
    
    public function run_migration()
    {
        // Load migration config
        $this->load->config('migration');
        $migration_enabled = $this->config->item('migration_enabled');
        
        // Temporarily enable migrations if they are disabled
        if (!$migration_enabled) {
            $this->config->set_item('migration_enabled', TRUE);
        }
        
        // Load the migration library
        $this->load->library('migration');
        
        // In Perfex CRM, we can't set the migration path directly
        // Instead, we need to modify the config item
        $original_migration_path = $this->config->item('migration_path');
        $this->config->set_item('migration_path', module_dir_path('staff_login', 'migrations/'));
        
        // Run migrations
        if ($this->migration->current() === FALSE) {
            echo '<h1>Migration Error</h1>';
            echo '<p>' . $this->migration->error_string() . '</p>';
        } else {
            echo '<h1>Migration Successful</h1>';
            echo '<p>The staff_login module migration has been successfully applied.</p>';
            echo '<p><a href="' . admin_url('staff_login_test/activate_module') . '">Activate Module</a></p>';
        }
        
        // Restore original migration path
        $this->config->set_item('migration_path', $original_migration_path);
        
        // Restore original migration setting
        if (!$migration_enabled) {
            $this->config->set_item('migration_enabled', FALSE);
        }
    }
    
    public function activate_module()
    {
        // Update module status in database
        $this->db->where('module_name', 'staff_login');
        $this->db->update('tblmodules', ['active' => 1]);
        
        if ($this->db->affected_rows() > 0) {
            echo '<h1>Module Activated</h1>';
            echo '<p>The staff_login module has been activated successfully.</p>';
        } else {
            echo '<h1>Activation Failed</h1>';
            echo '<p>The module could not be activated or is already active.</p>';
        }
        
        echo '<p><a href="' . admin_url('modules') . '">Go to Modules</a></p>';
    }
} 