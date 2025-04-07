<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Staff Login
Description: Advanced staff authentication module that allows administrators to temporarily act as other staff members for streamlined troubleshooting and support. The module includes robust security measures and clear visual indicators to ensure transparency and security throughout the session.
Version: 1.0.0
Requires at least: 2.3.*
Author: Uygar Duzgun
Author URI: https://uygarduzgun.com
*/

define('STAFF_LOGIN_MODULE_NAME', 'staff_login');

// Register activation hook
register_activation_hook(STAFF_LOGIN_MODULE_NAME, 'staff_login_activation_hook');

// Register deactivation hook
register_deactivation_hook(STAFF_LOGIN_MODULE_NAME, 'staff_login_deactivation_hook');

// Register uninstall hook
register_uninstall_hook(STAFF_LOGIN_MODULE_NAME, 'staff_login_uninstall_hook');

// Register language files
register_language_files(STAFF_LOGIN_MODULE_NAME, [STAFF_LOGIN_MODULE_NAME]);

// Add module's CSS and JS files
hooks()->add_action('app_admin_head', 'staff_login_add_head_components');

// Add menu items and permissions
hooks()->add_action('admin_init', 'staff_login_init_menu_items');
hooks()->add_action('admin_init', 'staff_login_permissions');

// Add session management hooks
hooks()->add_action('after_client_login', 'staff_login_check_session');
hooks()->add_action('before_client_logout', 'staff_login_before_logout');

/**
 * Module activation hook
 */
function staff_login_activation_hook()
{
    // No need to add permissions here
    // Permissions are handled by the staff_login_permissions function
    return true;
}

/**
 * Module deactivation hook
 */
function staff_login_deactivation_hook()
{
    // Nothing to do on deactivation
    return true;
}

/**
 * Module uninstall hook
 */
function staff_login_uninstall_hook()
{
    $CI = &get_instance();
    
    // Remove permissions
    $CI->db->where('feature', 'staff_login');
    $CI->db->delete(db_prefix() . 'staff_permissions');
    
    return true;
}

/**
 * Add CSS and JS components to the admin head
 */
function staff_login_add_head_components()
{
    $CI = &get_instance();
    
    // Add CSS
    echo '<link href="' . module_dir_url(STAFF_LOGIN_MODULE_NAME, 'assets/css/staff_login.css') . '?v=' . $CI->app_scripts->core_version() . '"  rel="stylesheet" type="text/css" />';
    
    // Add impersonation indicator if user is impersonating
    if ($CI->session->userdata('original_staff_id')) {
        echo '<div class="impersonating-indicator">';
        echo _l('currently_impersonating') . ' - ';
        echo '<a href="' . admin_url('staff_login/return_to_original') . '" class="return-link">';
        echo _l('return_to_original_account');
        echo '</a>';
        echo '</div>';
    }
}

/**
 * Initialize menu items
 */
function staff_login_init_menu_items()
{
    $CI = &get_instance();

    if (staff_can('view', 'staff_login')) {
        $CI->app_menu->add_sidebar_menu_item('staff-login', [
            'name'     => _l('staff_login'),
            'href'     => admin_url('staff_login'),
            'position' => 30,
            'icon'     => 'fa fa-sign-in',
        ]);
    }
}

/**
 * Register staff permissions for the module
 */
function staff_login_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
        'login_as' => 'Login as Staff Member'
    ];

    register_staff_capabilities('staff_login', $capabilities, _l('staff_login'));
}

/**
 * Check session status
 */
function staff_login_check_session()
{
    $CI = &get_instance();
    
    // Check if session is about to expire
    $session_expires = $CI->session->userdata('session_expires');
    if ($session_expires && time() > $session_expires) {
        // Force logout if session has expired
        $CI->authentication_model->logout();
        redirect(admin_url('authentication'));
    }
}

/**
 * Clean up before logout
 */
function staff_login_before_logout()
{
    $CI = &get_instance();
    
    // Clean up any impersonation data before logout
    if ($CI->session->userdata('original_staff_id')) {
        $CI->session->unset_userdata([
            'original_staff_id',
            'impersonation_expires',
            'staff_previous_session_data'
        ]);
    }
}
  