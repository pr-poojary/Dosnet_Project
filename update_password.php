<?php
require('connection.inc.php');
require('functions.inc.php');
if (!isset($_SESSION['USER_LOGIN'])) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}

$current_password = get_safe_value($con, $_POST['current_password']);
$new_password = get_safe_value($con, $_POST['new_password']);
$user_id = $_SESSION['USER_ID'];

$row = mysqli_fetch_assoc(mysqli_query($con, "select password from users where id='$user_id' "));

if ($row['password'] != $current_password) {
    echo "Please enter your current vaild password";
} else {
    mysqli_query($con, "update users set password ='$new_password' where id='$user_id' ");
    echo "Password Updated";
}


?>