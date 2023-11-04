<?php
require('top.php');
?>

<head>
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/cust.css" rel="stylesheet">
</head>

<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="post" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" />

                        </div>
                        <span class="field_error" id="name_error"></span>

                        <div class="form-group flex">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" />
                            <input type="button" name="signup" class="form-submit btn-verify email_sent_otp" onclick="email_sent_otp()" value="Send OTP" />
                        </div>
                        <span class="field_error" id="email_error"></span>

                        <div class="form-group flex m-0">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email_otp" class="email_verify_otp" placeholder="Enter OTP" />
                            <input type="button" name="signup" class="form-submit btn-verify email_verify_otp" onclick="email_verify_otp()" value="Verify" />
                        </div>
                        <span class="field_error" id="email_otp_result"></span>

                        <div class="form-group flex mt-2">
                            <label for="mobile"><i class="zmdi zmdi-email"></i></label>
                            <input type="tel" name="mobile" id="mobile" class="" placeholder="Your Phone Number " />
                            <input type="button" name="signup" class="form-submit btn-verify" onclick="mobile_sent_otp()" value="Send OTP" />
                        </div>
                        <span class="field_error" id="mobile_error"></span>
                        <div class="form-group flex m-0">
                            <label for="mobile"><i class="zmdi zmdi-email"></i></label>
                            <input type="tel" name="mobile" id="mobile_otp" class="mobile_verify_otp" placeholder="Enter OTP " />
                            <input type="button" name="signup" class="form-submit btn-verify mobile_verify_otp" onclick="mobile_verify_otp()" value="Verify" />
                        </div>
                        <span class="field_error" id="mobile_otp_result"></span>

                        <div class="form-group mt-2">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" />

                        </div>
                        <span class="field_error" id="pass_error"></span>
                        <!-- <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div> -->
                        <!-- <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div> -->
                        <div class="form-group form-button">
                            <input type="button" name="signup" id="signup" class="form-submit" value="Register" onclick="user_register()" disabled />
                        </div>
                        <span class="field_error register_error"></span>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="" alt="sing up image"></figure>
                    <a href="login.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="textbox" id="is_email_verified" class="w-25" hidden />
<input type="textbox" id="is_mobile_verified" class="w-25" hidden />

<script>
    
</script>

<?php
require('footer.php');
?>