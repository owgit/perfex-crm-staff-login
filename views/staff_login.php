<?php defined('BASEPATH') or exit('no direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="text-center"><?php echo _l('staff_login'); ?></h4>
                        <hr />
                        <?php echo form_open(admin_url('staff_login/login_as'), ['id' => 'staff-login-form']); ?>
                        <div class="form-group">
                            <label for="staff_id"><?php echo _l('select_staff_member'); ?></label>
                            <select name="staff_id" id="staff_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value=""><?php echo _l('select_staff_member'); ?></option>
                                <?php foreach($staff_members as $staff) { ?>
                                    <option value="<?php echo $staff['staffid']; ?>">
                                        <?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">
                                <?php echo _l('login_as_staff'); ?>
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
    // Add language strings for JavaScript
    app.lang.confirm_staff_login = '<?php echo _l("confirm_staff_login"); ?>';
    app.lang.invalid_login = '<?php echo _l("invalid_login"); ?>';
    app.lang.request_timeout = '<?php echo _l("request_timeout"); ?>';
    app.lang.login_as_staff = '<?php echo _l("login_as_staff"); ?>';
</script>
<script src="<?php echo module_dir_url(STAFF_LOGIN_MODULE_NAME, 'assets/js/staff_login.js'); ?>"></script> 