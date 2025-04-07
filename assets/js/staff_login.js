$(function() {
    appValidateForm($('#staff-login-form'), {
        staff_id: 'required'
    });

    $('#staff-login-form').on('submit', function(e) {
        e.preventDefault();
        
        if (!confirm(app.lang.confirm_staff_login)) {
            return false;
        }
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        
        // Add loading state
        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ' + submitBtn.html());
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert_float('success', response.message);
                    setTimeout(function() {
                        window.location.href = response.redirect_url;
                    }, 1000);
                } else {
                    alert_float('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = app.lang.invalid_login;
                if (status === 'timeout') {
                    errorMessage = app.lang.request_timeout;
                }
                alert_float('danger', errorMessage);
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(app.lang.login_as_staff);
            }
        });
    });
});

// Add session checker
function checkSession() {
    $.ajax({
        url: admin_url + 'staff_login/check_session',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success && response.extended) {
                console.log('Session extended');
            }
        }
    });
}

// Check session every 5 minutes
setInterval(checkSession, 5 * 60 * 1000);

// Also check when user shows activity
let activityTimeout;
$(document).on('mousemove keypress', function() {
    clearTimeout(activityTimeout);
    activityTimeout = setTimeout(checkSession, 1000);
}); 