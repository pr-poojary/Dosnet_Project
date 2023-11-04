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
    <link href="css/cust.css" rel="stylesheet">
</head>

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="" alt="sing up image"></figure>
                    <a href="register.php" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="post" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Your email" />
                        </div>
                        <span class="field_error" id="login_email_error"></span>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" />
                        </div>
                        <span class="field_error" id="login_pass_error"></span>
                        <div class="text">
                            <a class="small" href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="button" name="signin" id="signin" class="form-submit" value="Log in" onclick="user_login()" />
                        </div>
                        <span class="login_msg_error"></span>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script>
    function user_login() {
        jQuery('.field_error').html('');
        var email = jQuery("#email").val();
        var pass = jQuery("#pass").val();
        var is_error = '';

        if (email == "") {
            jQuery('#login_email_error').html('Please enter your email');
            is_error = 'yes';
        }
        if (pass == "") {
            jQuery('#login_pass_error').html('Please enter password');
            is_error = 'yes';
        }
        if (is_error == '') {
            jQuery.ajax({
                url: 'login_submit.php',
                type: 'post',
                data: 'email=' + email + '&pass=' + pass,
                success: function(result) {
                    if (result == 'wrong') {
                        jQuery('.login_msg_error').html('Please enter valid Login details');
                    }
                    if (result == 'valid') {
                        window.location.href = 'index.php';
                    }
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>