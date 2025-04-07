# Staff Login Module Activation

If you're having trouble activating the Staff Login module through the normal Perfex CRM module activation process, you can use one of the following methods:

## Method 1: Direct Activation Script (Recommended)

1. Access the direct activation script in your browser:
   ```
   http://your-domain.com/modules/staff_login/activate_module.php
   ```
2. This script will activate the module in the database
3. **Important**: Delete the `activate_module.php` file after successful activation for security reasons.

## Method 2: Manual Database Update

If the direct activation script doesn't work, you can manually update the database:

1. Access phpMyAdmin through your hosting control panel
2. Navigate to your Perfex CRM database
3. Find the `tblmodules` table (or the table with your custom prefix)
4. Find the row with `module_name = 'staff_login'`
5. Change the `active` column value from `0` to `1`

## After Activation

Once the module is activated:
1. Go to `Setup` > `Staff` > `Roles` to assign the Staff Login permissions to appropriate roles
2. Test the module functionality by trying to log in as another staff member
3. Delete the `activate_module.php` file for security reasons

## Need Help?

If you continue to experience issues, please contact us at info@uygarduzgun.com. 