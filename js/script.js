function user_register() {
    jQuery('.field_error').html('');
    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var pass = jQuery("#pass").val();
    var is_error = '';

    if (name == "") {
        jQuery('#name_error').html('Please enter name');
        is_error = 'yes';
    } if (email == "") {
        jQuery('#email_error').html('Please enter email');
        is_error = 'yes';
    } if (mobile == "") {
        jQuery('#mobile_error').html('Please enter mobile number');
        is_error = 'yes';
    } if (pass == "") {
        jQuery('#pass_error').html('Please enter password');
        is_error = 'yes';
    }
    if (is_error == '') {
        jQuery.ajax({
            url: 'register_submit.php',
            type: 'post',
            data: 'name=' + name + '&email=' + email + '&mobile=' + mobile + '&pass=' + pass,
            success: function (result) {
                if (result == 'email_present') {
                    jQuery('#email_error').html('Email ID already present');
                }
                if (result == 'mobile_present') {
                    jQuery('mobile_error').html('Mobile Number already present');
                }
                if (result == 'insert') {
                    jQuery('.register_error').html('Thank you for registeration');
                }
            }
        });
    }
}

function email_sent_otp() {
    jQuery('#email_error').html('');
    var email = jQuery('#email').val();
    if (email == '') {
        jQuery('#email_error').html('Please enter Your Email ID');
    } else {
        jQuery('.email_sent_otp').html('Please wait...');
        jQuery('.email_sent_otp').attr('disabled', true);
        jQuery.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: 'email=' + email + '&type=email',
            success: function (result) {
                // if (result == 'done') {
                jQuery('#email').attr('disabled', true);
                jQuery('.email_verify_otp').show();
                jQuery('.email_sent_otp').hide();
                // } else if (result == 'email_present') {
                //     jQuery('.email_sent_otp').html('Sent OTP');
                //     jQuery('.email_sent_otp').attr('disabled', false);
                //     jQuery('#email_error').html('Email ID already exist');
                // } else {
                //     jQuery('.email_sent_otp').html('Sent OTP');
                //     jQuery('.email_sent_otp').attr('disabled', false);
                //     jQuery('#email_error').html('Please try after sometimes');
                // }
            }
        });
    }
}

function email_verify_otp() {
    jQuery('#email_error').html('');
    var email_otp = jQuery('#email_otp').val();
    if (email_otp == '') {
        jQuery('#email_error').html('Please enter OTP');
    } else {
        jQuery.ajax({
            url: 'check_otp.php',
            type: 'post',
            data: 'otp=' + email_otp + '&type=email',
            success: function (result) {
                if (result == 'done') {
                    jQuery('.email_verify_otp').hide();
                    jQuery('#email_otp_result').html('Email ID Verified');
                    jQuery('#is_email_verified').val('1');
                    jQuery('#update_email').show();
                    if (jQuery('#is_mobile_verified').val() == 1) {
                        jQuery('#signup').attr('disabled', false);
                    }
                } else {
                    jQuery('#email_error').html('Please enter vaild OTP');
                }
            }
        });
    }
}

function mobile_sent_otp() {
    jQuery('#mobile_error').html('');
    var mobile = jQuery('#mobile').val();
    if (mobile == '') {
        jQuery('#mobile_error').html('Please enter Your Moblie Number');
    } else {
        jQuery('.mobile_sent_otp').html('Please wait...');
        jQuery('.mobile_sent_otp').attr('disabled', true);
        jQuery.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: 'mobile=' + mobile + '&type=mobile',
            success: function (result) {
                if (result == 'done') {
                    jQuery('#mobile').attr('disabled', true);
                    jQuery('.mobile_verify_otp').show();
                    jQuery('.mobile_sent_otp').hide();
                } else if (result == 'mobile_present') {
                    jQuery('.mobile_sent_otp').html('Sent OTP');
                    jQuery('.mobile_sent_otp').attr('disabled', false);
                    jQuery('#mobile_error').html('Mobile Number already exist');
                } else {
                    jQuery('.mobile_sent_otp').html('Sent OTP');
                    jQuery('.mobile_sent_otp').attr('disabled', false);
                    jQuery('#mobile_error').html('Please try after sometimes');
                }
            }
        });
    }
}

function mobile_verify_otp() {
    jQuery('#mobile_error').html('');
    var mobile_otp = jQuery('#mobile_otp').val();
    if (mobile_otp == '') {
        jQuery('#mobile_error').html('Please enter OTP');
    } else {
        jQuery.ajax({
            url: 'check_otp.php',
            type: 'post',
            data: 'otp=' + mobile_otp + '&type=mobile',
            success: function (result) {
                if (result == 'done') {
                    jQuery('#mobile_error').html('');
                    jQuery('.mobile_verify_otp').hide();
                    jQuery('#mobile_otp_result').html('Mobile Number Verified');
                    jQuery('#is_mobile_verified').val('1');
                    jQuery('#update_mobile').show();
                    if (jQuery('#is_email_verified').val() == 1) {
                        jQuery('#signup').attr('disabled', false);
                    }
                } else {
                    jQuery('#mobile_error').html('Please enter vaild OTP');
                }
            }
        });
    }
}

jQuery('.imageZoom').imgZoom();

function increment() {
    document.getElementById('upqty').stepUp();
}
function decrement() {
    document.getElementById('upqty').stepDown();
}

function manage_cart(pid, type) {
    if (type == 'update') {
        var qty = jQuery("#" + pid + "upqty").val();
    } else {
        var qty = jQuery("#upqty").val();
    }
    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
        success: function (result) {
            if (type == 'update' || type == 'remove') {
                window.location.href = window.location.href;
            }
            if (result == 'not_available') {
                alert("Qty not available")
            } else {
                jQuery('#addbadge').html(result);
                if (is_checkout == 'yes') {
                    window.location.href = 'checkout.php';
                }
            }
        }
    });
}

function wishlist_manage(pid, type) {
    jQuery.ajax({
        url: 'wishlist_manage.php',
        type: 'post',
        data: 'pid=' + pid + '&type=' + type,
        success: function (result) {
            if (result == 'not_login') {
                window.location.href = 'login.php';
            } else {
                jQuery('#wishbadge').html(result);
            }
        }
    });
}