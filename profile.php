<?php
require('top.php');
if (!isset($_SESSION['USER_LOGIN'])) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
$user_id = $_SESSION['USER_ID'];

$res = mysqli_query($con, "select * from users where id='$user_id' ");
$row = mysqli_fetch_array($res);
$password = $row['password'];

?>

<head>
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/cust.css" rel="stylesheet">
</head>

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container ">
            <div class="signin-content ">
                <div class="signin-form w-75">
                    <h2 class="form-title h1 font-weight-bold">Profile</h2>
                    <form method="post" class="register-form" id="login-form">
                        <div class="flex mt-4">
                            <label class="cust_label">Name :</label>
                            <input type="text" id="name" class="a1 w-75" placeholder="Enter new name" value="<?php echo $row['name'] ?>" required disabled>
                            <input type="button" id="change_nam" class="form-submit btn-verify " onclick="change_name()" value="Change" />
                            <input type="button" id="update_nam" class="form-submit btn-verify hide" onclick="update_name()" value="Update" />
                        </div>
                        <span class="field_error_pro" id="name_error"></span>

                        <div class="flex mt-4">
                            <label class="cust_label">Email :</label>
                            <input type="email" class="a1 w-75" id="email" placeholder="Enter new Email ID" value="<?php echo $row['email'] ?>" required disabled>
                            <input type="button" name="signup" id="change_id" class="form-submit btn-verify" onclick="change_email()" value="Change" />
                            <input type="button" name="signup" class="form-submit btn-verify email_sent_otp hide" onclick="email_sent_otp()" value="Send OTP" />

                            <div class="form-group m-0">
                                <input type="email" name="email" id="email_otp" class="email_verify_otp w-75" placeholder="Enter OTP" />
                                <input type="button" class="form-submit btn-verify email_verify_otp " onclick="email_verify_otp()" value="Verify" />
                                <input type="button" id="update_email" class="form-submit btn-verify hide" onclick="update_email()" value="update" />
                            </div>
                        </div>
                        <div class="field_error_pro">
                            <span class="field_error" id="email_error"></span>
                            <span class="field_error" id="email_otp_result"></span>
                            <span class="field_error_pro" id="email_error"></span>
                        </div>


                        <div class="flex mt-4">
                            <label class="cust_label">Contact Number :</label>
                            <input type="tel" class="a1 w-75" id="mobile" placeholder="Enter new Mobile number" value="<?php echo $row['mobile'] ?>" required disabled>
                            <input type="button" id="change_no" class="form-submit btn-verify" onclick="change_mobile()" value="Change" />
                            <input type="button" class="form-submit btn-verify mobile_sent_otp hide" onclick="mobile_sent_otp()" value="Send OTP" />
                        </div>
                        <div class="form-group flex m-0">
                            <input type="tel" name="mobile" id="mobile_otp" class="mobile_verify_otp" placeholder="Enter OTP " />
                            <input type="button" name="signup" class="form-submit btn-verify mobile_verify_otp" onclick="mobile_verify_otp()" value="Verify" />
                            <input type="button" id="update_mobile" class="form-submit btn-verify hide" onclick="update_mobile()" value="update" />
                        </div>
                        <div class="field_error_pro">
                            <span class="field_error" id="mobile_error"></span>
                            <span class="field_error" id="mobile_otp_result"></span>
                            <span class="field_error" id="mobile_error"></span>
                        </div>

                        <div class="flex mt-4">
                            <h2 class="cust_label cust_label1 h2 font-weight-bold">Change Password</h2>
                        </div>

                        <div class="flex mt-4">
                            <label class="cust_label cust_label1 w-30">Current Password :</label>
                            <input type="password" id="current_password" class="a1 w-60" placeholder="Enter Your Current Password to change" required>
                        </div>
                        <div class="field_error_pro">
                            <span class="field_error" id="current_password_error"></span>
                        </div>
                        <div class="flex mt-4">
                            <label class="cust_label cust_label1 w-30">New Password :</label>
                            <input type="password" id="new_password" class="a1 w-60" placeholder="Enter Your New Password" required>
                        </div>
                        <div class="field_error_pro">
                            <span class="field_error" id="new_password_error"></span>
                        </div>
                        <div class="flex mt-4">
                            <label class="cust_label cust_label1 w-30 ">Confirm Password :</label>
                            <input type="password" id="confirm_password" class="a1 w-60" placeholder="Confirm Your New Password" required>
                            <input type="button" id="update_pass" class="form-submit btn-verify" onclick="update_password()" value="update" />
                        </div>
                        <div class="field_error_pro">
                            <span class="field_error" id="confirm_password_error"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    function change_name() {
        jQuery('#name_error').html('');
        jQuery('#name').val('');
        jQuery('#name').attr('disabled', false);
        jQuery('#change_nam').hide();
        jQuery('#update_nam').show();
    }

    function change_email() {
        jQuery('#email_error').html('');
        jQuery('#email').val('');
        jQuery('#email').attr('disabled', false);
        jQuery('#change_id').hide();
        jQuery('.email_sent_otp').show();
    }

    function change_mobile() {
        jQuery('#mobile_error').html('');
        jQuery('#mobile').val('');
        jQuery('#mobile').attr('disabled', false);
        jQuery('#change_no').hide();
        jQuery('.mobile_sent_otp').show();
    }

    function update_name() {
        jQuery('#name_error').html('');
        var name = jQuery('#name').val();
        if (name == '') {
            jQuery('#name_error').html('Please enter Name');
        } else {
            jQuery('#update_nam').val('Please wait...');
            jQuery('#update_nam').attr('disabled', true);
            jQuery.ajax({
                url: 'update_profile.php',
                type: 'post',
                data: 'name=' + name,
                success: function(result) {
                    jQuery('#update_nam').val('Update');
                    jQuery('#current_password').attr('disabled', false);
                    jQuery('#update_nam').hide();
                    jQuery('#change_nam').show();
                    jQuery('#name_error').html(result);
                }
            });
        }
    }

    function update_password() {
        jQuery('#current_password_error').html('');
        var current_password = jQuery('#current_password').val();
        var new_password = jQuery('#new_password').val();
        var confirm_password = jQuery('#confirm_password').val();
        var is_error = '';
        jQuery('#new_password_error').html('');
        jQuery('#confirm_password_error').html('');
        jQuery('#current_password_error').html('');
        jQuery('#update_pass').attr('disabled', false);
        if (current_password == '') {
            jQuery('#current_password_error').html('Please enter your Password');
            is_error = 'yes';
        }
        if (new_password == '') {
            jQuery('#new_password_error').html('Please enter your New Password');
            is_error = 'yes';
        }
        if (confirm_password == '') {
            jQuery('#confirm_password_error').html('Please enter Confirm Password');
            is_error = 'yes';
        }
        if (new_password != '' && confirm_password != '' && new_password != confirm_password) {
            jQuery('#current_password_error').html('Please enter same new password and confirm password');
            jQuery('#new_password_error').html('');
            jQuery('#confirm_password_error').html('');
            is_error = 'yes';
        }

        if (is_error == '') {
            jQuery('#new_password_error').html('');
            jQuery('#confirm_password_error').html('');
            jQuery('#current_password_error').html('');
            jQuery('#update_pass').val('Please wait...');
            jQuery('#update_pass').attr('disabled', true);
            jQuery.ajax({
                url: 'update_password.php',
                type: 'post',
                data: 'current_password=' + current_password + '&new_password=' + new_password,
                success: function(result) {
                    jQuery('#update_pass').val('Update');
                    jQuery('#current_pass').attr('disabled', false);
                    jQuery('#change_nam').show();
                    jQuery('#current_password_error').html(result);
                    jQuery('#new_password').val('');
                    jQuery('#confirm_password').val('');
                    jQuery('#current_password').val('');
                }
            });
        } else {

        }
    }
</script>

<?php
require('footer.php');
?>