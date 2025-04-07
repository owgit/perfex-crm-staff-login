<?php
/**
 * Direct Module Activation Script
 * 
 * This script directly activates the staff_login module in the database.
 * Permissions will be handled by the module's staff_login_permissions function.
 * 
 * To use it, access this file directly in your browser:
 * http://your-domain.com/modules/staff_login/activate_module.php
 * 
 * IMPORTANT: Delete this file after successful activation for security reasons.
 */

// Define BASEPATH to prevent direct access to CodeIgniter files
define('BASEPATH', 'dummy');

// Load database configuration
require_once '../../application/config/database.php';

// Create database connection
$mysqli = new mysqli(
    $db['default']['hostname'],
    $db['default']['username'],
    $db['default']['password'],
    $db['default']['database']
);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get table prefix
$prefix = isset($db['default']['dbprefix']) ? $db['default']['dbprefix'] : '';

// Update module status
$sql = "UPDATE " . $prefix . "modules SET active = 1 WHERE module_name = 'staff_login'";

if ($mysqli->query($sql) === TRUE) {
    echo "<h1>Module Activated</h1>";
    echo "<p>The staff_login module has been activated successfully.</p>";
    
    if ($mysqli->affected_rows == 0) {
        echo "<p>Note: The module was already active or does not exist in the database.</p>";
    }
} else {
    echo "<h1>Activation Failed</h1>";
    echo "<p>Error updating module status: " . $mysqli->error . "</p>";
}

// Close connection
$mysqli->close();

echo "<p>After activation, go to <strong>Setup > Staff > Roles</strong> to assign the Staff Login permissions to appropriate roles.</p>";
echo "<p><strong>IMPORTANT:</strong> Delete this file (activate_module.php) after successful activation for security reasons.</p>";
echo "<p><a href='../../admin/modules'>Return to Modules</a></p>";
?> 