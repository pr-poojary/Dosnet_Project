<?php
require('connection.inc.php');
require('functions.inc.php');

$email = get_safe_value($con, $_POST['email']);
$res = mysqli_query($con, "select * from users where email='$email'");
$check_user = mysqli_num_rows($res);
if ($check_user > 0) {
    $row = mysqli_fetch_assoc($res);
    $pwd = $row['password'];
    $html = "Your password is $pwd ";
    echo "Please check your email id for Password";
} else {
    echo "Email Id not registered with us";
    die();
}