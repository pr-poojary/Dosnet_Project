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

$user_id = $_SESSION['USER_ID'];
$name = get_safe_value($con, $_POST['name']);

mysqli_query($con, "update users set name='$name' where id='$user_id' ");

echo "Your Name Updated"

?>