<?php
require('top.php');
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] == 'yes') {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
?>

<head>
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container m-auto w-50">
            <div class="signin-content m-auto">
                <div class="signin-form m-auto">
                    <h2 class="form-title">Forgot Password</h2>
                    <form method="post" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Your email" />
                        </div>
                        <span class="field_error" id="login_email_error"></span>
                        <div class="form-group form-button">
                            <input type="button" name="signin" id="forgot_btn" class="btn btn-primary" value="Sumbit" onclick="forget_password()" />
                        </div>
                        <span id="email_error"></span>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>


<script>
    function forget_password() {
        jQuery('#email_error').html('');
        jQuery('#email').html('');
        var email = jQuery('#email').val();
        if (email == '') {
            jQuery('#email_error').html('Please enter Your Email ID');
        } else {
            jQuery('#forgot_btn').html('Please wait...');
            jQuery('#forgot_btn').attr('disabled', true);
            jQuery.ajax({
                url: 'forgot_password_submit.php',
                type: 'post',
                data: 'email=' + email,
                success: function(result) {
                    jQuery('#email').val('');
                    jQuery('#email_error').html(result);
                    jQuery('#forgot_btn').html('Submit');
                    jQuery('#forgot_btn').attr('disabled', false);
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>