<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Staff Login Module for Perfex CRM - A tool for administrators to log in as other staff members for troubleshooting and management.">
<meta name="keywords" content="Perfex CRM, Staff Login, Module, Open Source, Administrator, Impersonation">
<title>Staff Login Module for Perfex CRM</title>
</head>
<body>
<h1>Staff Login Module for Perfex CRM</h1>
<h2>Overview</h2>
<p>The Staff Login module for Perfex CRM is a powerful tool that allows administrators to log in as other staff members. This feature is particularly useful for troubleshooting, training, and managing user accounts. The module is designed with security and usability in mind, ensuring that only authorized users can access its features.</p>
<h2>Features</h2>
<ul>
<li><strong>Login as Staff</strong>: Allows administrators to log in as any staff member.</li>
<li><strong>Return to Original Account</strong>: Easily switch back to the original account after impersonation.</li>
<li><strong>Activity Logging</strong>: Logs all impersonation activities for security and auditing purposes.</li>
<li><strong>Permission Control</strong>: Fine-grained permissions to control who can use the module.</li>
<li><strong>Impersonation Indicator</strong>: Visual indicator when logged in as another user.</li>
</ul>
<h2>Installation</h2>
<h3>Prerequisites</h3>
<ul>
<li>Perfex CRM version 2.3. or higher</li>
<li>Administrator access to the Perfex CRM instance</li>
</ul>
<h3>Installation Steps</h3>
<ol>
<li><strong>Download the Module</strong>: Clone or download the module from the <a href="https://github.com/your-repo/staff-login-module">GitHub repository</a>.</li>
<li><strong>Upload the Module</strong>: Place the <code>staff_login</code> directory into the <code>modules</code> directory of your Perfex CRM installation.</li>
<li><strong>Activate the Module</strong>:
<ul>
<li>Log in to your Perfex CRM admin panel.</li>
<li>Navigate to <code>Setup</code> > <code>Modules</code>.</li>
<li>Find the "Staff Login" module and click "Activate".</li>
</ul>
</li>
<li><strong>Set Permissions</strong>:
<ul>
<li>Go to <code>Setup</code> > <code>Roles</code>.</li>
<li>Edit the roles that should have access to the Staff Login module.</li>
<li>Enable the "View Staff Login" and "Login as Staff Member" permissions.</li>
</ul>
</li>
</ol>
<h3>Troubleshooting Installation</h3>
<p>If you encounter the error "Migrations has been loaded but is disabled or set up incorrectly" during installation, you can try the following solutions:</p>
<ol>
<li>Access the Staff Login Test page at <code>http://your-domain.com/admin/staff_login_test</code></li>
<li>Click on "Run Migration" to manually run the migration</li>
<li>After successful migration, click on "Activate Module" to activate the module</li>
</ol>
<p>Alternatively, you can try these steps:</p>
<ol>
<li>Temporarily enable migrations in <code>application/config/migration.php</code> by setting <code>$config['migration_enabled'] = true;</code></li>
<li>Activate the module again from the Modules page</li>
<li>After successful activation, you can set <code>$config['migration_enabled'] = false;</code> again</li>
</ol>
<h2>Usage</h2>
<h3>Logging in as Another Staff Member</h3>
<ol>
<li>Navigate to the "Staff Login" section in the admin panel.</li>
<li>Select a staff member from the dropdown list.</li>
<li>Click "Login as Staff" to switch to the selected account.</li>
</ol>
<h3>Returning to the Original Account</h3>
<p>A "Return to Original Account" button will appear in the admin panel when impersonating another user. Click the button to switch back to your original account.</p>
<h2>Security Considerations</h2>
<ul>
<li><strong>Permission Control</strong>: Ensure only trusted administrators have access to the module.</li>
<li><strong>Activity Logging</strong>: All impersonation actions are logged for auditing purposes.</li>
<li><strong>Session Management</strong>: Sessions are securely managed to prevent unauthorized access.</li>
</ul>
<h2>Customization</h2>
<p>The module is designed to be easily customizable. You can modify the language files, views, and controllers to fit your specific needs.</p>
<h2>Contributing</h2>
<p>We welcome contributions to the Staff Login module. If you have suggestions, bug reports, or feature requests, please open an issue or submit a pull request on our <a href="https://github.com/your-repo/staff-login-module">GitHub repository</a>.</p>
<h2>License</h2>
<p>This module is open-source and available under the MIT License. See the <a href="https://github.com/your-repo/staff-login-module/blob/main/LICENSE">LICENSE</a> file for more information.</p>
<h2>Contact</h2>
<p>For support or inquiries, please contact us at <a href="mailto:info@uygarduzgun.com">info@uygarduzgun.com</a>.</p>
</body>
</html>