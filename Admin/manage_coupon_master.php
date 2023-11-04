<?php
require('top.inc.php');
$coupon_code = '';
$coupon_value = '';
$coupon_type = '';
$cart_min_value = '';
$status = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from coupon_name where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $coupon_code = $row['coupon_code'];
        $coupon_value = $row['coupon_value'];
        $coupon_type = $row['coupon_type'];
        $cart_min_value = $row['cart_min_value'];
        $status = $row['status'];
    } else {
        header('location:coupon_mater.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $coupon_code = get_safe_value($con, $_POST['coupon_code']);
    $coupon_value = get_safe_value($con, $_POST['coupon_value']);
    $coupon_type = get_safe_value($con, $_POST['coupon_type']);
    $cart_min_value = get_safe_value($con, $_POST['cart_min_value']);
    $status = get_safe_value($con, $_POST['price']);

    $res = mysqli_query($con, "select * from coupon_name where coupon_code='$coupon_code'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Coupon Code already exist";
            }
        } else {
            $msg = "Coupon Code already exist";
        }
    }



    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update coupon_name set coupon_code='$coupon_code', coupon_value ='$coupon_value', coupon_type='$coupon_type', cart_min_value='$cart_min_value', status='$status' where id='$id' ";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "insert into coupon_name(coupon_code,coupon_value,coupon_type,cart_min_value,status) values ('$coupon_code','$coupon_value','$coupon_type','$cart_min_value','$status')");
        }
    }
?>
    <script>
        window.location.href = 'coupon_master.php';
    </script>
<?php
    die();
}
?>
<div class="container-fluid">


    <div class="content pb-0">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow m-auto">
                        <div class="card-header"><strong>Coupon</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="coupon_code" class=" form-control-label">Coupon Code</label>
                                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code" class="form-control" required value="<?php echo $coupon_code ?>">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_value" class=" form-control-label">Coupon Value</label>
                                    <input type="text" name="coupon_value" placeholder="Enter Coupon Value" class="form-control" required value="<?php echo $coupon_value ?>">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_type" class=" form-control-label">Coupon Type</label>
                                    <select type="text" name="coupon_type" class="form-control" required>
                                        <option value=''>Select</option>
                                        <?php
                                        if ($coupon_type == 'Percentage') {
                                            echo '<option value="Percentage" selected>Percentage</option>
                                        <option value="Rupee">Rupee</option>';
                                        } else if ($coupon_type == 'Rupee') {
                                            echo '<option value="Percentage">Percentage</option>
                                        <option value="Rupee" selected>Rupee</option>';
                                        } else {
                                            echo '<option value="1">Percentage</option>
                                        <option value="Rupee">Rupee</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cart_min_value" class="form-control-label">Cart Minimum Value</label>
                                    <input type="text" name="cart_min_value" placeholder="Enter Cart Minimum Value" class="form-control" required value="<?php echo $cart_min_value ?>">
                                </div>

                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                                <div class="field_error">
                                    <?php echo $msg ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<?php
require('footer.inc.php');
?>