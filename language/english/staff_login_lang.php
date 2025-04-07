<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Module name and menu items
$lang['staff_login'] = 'Staff Login';
$lang['staff_login_menu'] = 'Staff Login';
$lang['staff_login_module'] = 'Staff Login Module';

// Permissions
$lang['permission_view_staff_login'] = 'View Staff Login';
$lang['permission_login_as_staff'] = 'Login as Staff Member';
$lang['permission_create_staff_login'] = 'Create Staff Login';
$lang['permission_edit_staff_login'] = 'Edit Staff Login';
$lang['permission_delete_staff_login'] = 'Delete Staff Login';

// Form fields and labels
$lang['select_staff_member'] = 'Select Staff Member';
$lang['login_as_staff'] = 'Login as Staff';
$lang['staff_member'] = 'Staff Member';
$lang['return_to_original_account'] = 'Return to Original Account';
$lang['returned_to_original_account'] = 'Successfully returned to original account';

// Success messages
$lang['logged_in_successfully'] = 'Logged in successfully';
$lang['successfully_logged_in_as'] = 'Successfully logged in as %s';
$lang['login_successful'] = 'Login Successful';

// Error messages
$lang['invalid_login'] = 'Invalid login attempt';
$lang['access_denied'] = 'Access Denied';
$lang['cannot_login_as_admin'] = 'You cannot login as an administrator';
$lang['invalid_staff_member'] = 'Invalid staff member selected';
$lang['already_logged_in_as_other'] = 'You are already logged in as another user';
$lang['insufficient_permissions'] = 'You do not have permission to perform this action';
$lang['cannot_login_as_self'] = 'You cannot login as yourself';
$lang['too_many_attempts'] = 'Too many login attempts. Please try again later.';
$lang['login_as_admin_permission'] = 'Permission to login as administrator';
$lang['invalid_csrf_token'] = 'Invalid security token. Please refresh the page and try again.';

// Activity log messages
$lang['staff_login_activity'] = 'Staff Login Activity';
$lang['staff_login_logged_in_as'] = '%s logged in as %s';
$lang['staff_login_returned_to_original'] = '%s returned to original account';

// Tooltips and help text
$lang['staff_login_select_tooltip'] = 'Select a staff member to login as';
$lang['staff_login_return_tooltip'] = 'Return to your original account';

// Confirmation messages
$lang['confirm_staff_login'] = 'Are you sure you want to login as this staff member?';
$lang['confirm_return_to_original'] = 'Are you sure you want to return to your original account?';

// Module settings
$lang['staff_login_settings'] = 'Staff Login Settings';
$lang['staff_login_enabled'] = 'Enable Staff Login';
$lang['staff_login_log_activity'] = 'Log Staff Login Activity';
$lang['staff_login_require_confirmation'] = 'Require Confirmation Before Login';

// Notifications
$lang['staff_login_notification'] = 'Staff Login Notification';
$lang['staff_login_notification_message'] = '%s has logged in as %s';
$lang['staff_login_return_notification'] = '%s has returned to their original account';

// New language string
$lang['currently_impersonating'] = 'You are currently viewing the system as another user';
  