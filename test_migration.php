<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Test Migration Controller
 * 
 * This script can be accessed via:
 * http://your-domain.com/index.php?/staff_login/test_migration
 * or
 * http://your-domain.com/staff_login/test_migration
 * 
 * depending on your URL configuration
 */
class Test_migration extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
        
        // Only allow admins to run this
        if (!is_admin()) {
            show_error('Only administrators can run this script');
        }
    }
    
    public function index()
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
            
            // Update module status in database
            $this->db->where('module_name', 'staff_login');
            $this->db->update('tblmodules', ['active' => 1]);
            
            if ($this->db->affected_rows() > 0) {
                echo '<p>Module has been activated in the database.</p>';
            }
        }
        
        // Restore original migration path
        $this->config->set_item('migration_path', $original_migration_path);
        
        // Restore original migration setting
        if (!$migration_enabled) {
            $this->config->set_item('migration_enabled', FALSE);
        }
    }
} 