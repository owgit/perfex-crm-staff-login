# Staff Login Module for Perfex CRM

## Overview

The Staff Login module for Perfex CRM is a powerful tool that allows administrators to log in as other staff members. This feature is particularly useful for troubleshooting, training, and managing user accounts. The module is designed with security and usability in mind, ensuring that only authorized users can access its features.

## Features

- **Login as Staff**: Allows administrators to log in as any staff member.
- **Return to Original Account**: Easily switch back to the original account after impersonation.
- **Activity Logging**: Logs all impersonation activities for security and auditing purposes.
- **Permission Control**: Fine-grained permissions to control who can use the module.
- **Impersonation Indicator**: Visual indicator when logged in as another user.

## Installation

### Prerequisites

- Perfex CRM version 2.3. or higher
- Administrator access to the Perfex CRM instance

### Installation Steps

1. **Download the Module**: Clone or download the module from the [GitHub repository](https://github.com/owgit/perfex-crm-staff-login).
2. **Upload the Module**: Place the `staff_login` directory into the `modules` directory of your Perfex CRM installation.
3. **Activate the Module**:
   - Log in to your Perfex CRM admin panel.
   - Navigate to `Setup` > `Modules`.
   - Find the "Staff Login" module and click "Activate".
4. **Set Permissions**:
   - Go to `Setup` > `Roles`.
   - Edit the roles that should have access to the Staff Login module.
   - Enable the "View Staff Login" and "Login as Staff Member" permissions.

### Troubleshooting Installation

If you encounter the error "Migrations has been loaded but is disabled or set up incorrectly" during installation, you can try the following solutions:

1. Access the Staff Login Test page at `http://your-domain.com/admin/staff_login_test`
2. Click on "Run Migration" to manually run the migration
3. After successful migration, click on "Activate Module" to activate the module

Alternatively, you can try these steps:

1. Temporarily enable migrations in `application/config/migration.php` by setting `$config['migration_enabled'] = true;`
2. Activate the module again from the Modules page
3. After successful activation, you can set `$config['migration_enabled'] = false;` again

## Usage

### Logging in as Another Staff Member

1. Navigate to the "Staff Login" section in the admin panel.
2. Select a staff member from the dropdown list.
3. Click "Login as Staff" to switch to the selected account.

### Returning to the Original Account

A "Return to Original Account" button will appear in the admin panel when impersonating another user. Click the button to switch back to your original account.

## Security Considerations

- **Permission Control**: Ensure only trusted administrators have access to the module.
- **Activity Logging**: All impersonation actions are logged for auditing purposes.
- **Session Management**: Sessions are securely managed to prevent unauthorized access.

## Customization

The module is designed to be easily customizable. You can modify the language files, views, and controllers to fit your specific needs.

## Contributing

We welcome contributions to the Staff Login module. If you have suggestions, bug reports, or feature requests, please open an issue or submit a pull request on our [GitHub repository](https://github.com/owgit/perfex-crm-staff-login).

## License

This module is open-source and available under the MIT License. See the [LICENSE](https://github.com/owgit/perfex-crm-staff-login/blob/main/LICENSE) file for more information.

## Contact

- **Developer**: Uygar Duzgun
- **Email**: [info@uygarduzgun.com](mailto:info@uygarduzgun.com)
- **Website**: [uygarduzgun.com](https://uygarduzgun.com)
- **GitHub**: [owgit](https://github.com/owgit)
- **Buy me a coffee**: [Support my work](https://buymeacoffee.com/uygarduzgun)
