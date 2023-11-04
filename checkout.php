<?php
require('top.php');
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0 || (!isset($_SESSION['USER_LOGIN']))) {
?>
    <script>
        window.location.href = 'login.php';
    </script>
    <?php
}

$coupon_value = 0;
$final_price = 0;
$cart_total = 0;
$errMsg = '';
foreach ($_SESSION['cart'] as $key => $val) {
    $productArr = get_product($con, '', '', $key);
    $price = $productArr['0']['price'];
    $qty = $val['qty'];
    $cart_total = $cart_total + ($qty * $price);
}

if (isset($_POST['submit'])) {
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $state = get_safe_value($con, $_POST['state']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $user_id = $_SESSION['USER_ID'];
    $total_price = $cart_total;
    $payment_status = 'pending';
    if ($payment_type == 'COD') {
        $payment_status = 'success';
    }
    $order_statu = '1';
    $added_on = date('Y-m-d h:i:s');

    if (isset($_SESSION['COUPON_ID'])) {
        $coupon_id = $_SESSION['COUPON_ID'];
        $coupon_value = $_SESSION['COUPON_VALUE'];
        $coupon_code = $_SESSION['COUPON_CODE'];
        $total_price = $total_price - $coupon_value;
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_VALUE']);
        unset($_SESSION['COUPON_CODE']);
        unset($_SESSION['FINAL_PRODUCT']);
    } else {
        $coupon_id = '';
        $coupon_value = '';
        $coupon_code = '';
    }

    mysqli_query($con, "insert into `order`(user_id, address, city, state, pincode, payment_type, 
    total_price, payment_status, order_statu, coupon_id, coupon_value, coupon_code, added_on) values ('$user_id', '$address','$city',
    '$state','$pincode','$payment_type','$total_price','$payment_status','$order_statu', '$coupon_id', '$coupon_value', '$coupon_code','$added_on')");

    $order_id = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr['0']['price'];
        $qty = $val['qty'];

        mysqli_query($con, "insert into order_details(order_id, product_id, qty, price) 
        values ('$order_id','$key','$qty','$price')");
    }

    if ($payment_type == 'instamojo') {
        $userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id='$user_id'"));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/v2/payment_requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer 4GfJPmiXNjYv6G_RmW2FljO5fqUmoKLvGp6_MXiFFOc.x8IHlKwAmHJTFh3xAIrBGB6mbhFAQH8gWxLrB_9WHFg'));

        $payload = array(
            'purpose' => 'FIFA 16',
            'amount' => $total_price,
            'phone' => $userArr['mobile'],
            'email' => $userArr['email'],
            'buyer_name' => $userArr['name'],
            'redirect_url' => 'http://localhost:8080/Dosnet_Project/payment_complete.php',
            'send_email' => 'false',
            'send_sms' => 'false',
            'allow_repeated_payments' => 'false',
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);
        if (isset($response->id)) {
            unset($_SESSION['cart']);
            $_SESSION['TID'] = $response->id;
            mysqli_query($con, " update `order` set txnid='" . $response->id . "' where id='" . $order_id . "'");
    ?>
            <script>
                window.location.href = '<?php echo $response->longurl ?>';
            </script>
        <?php
            die();
        } else {
            if (isset($response->message)) {
                $errMsg = '<div class="insta_error">';
                foreach ($response->message as $key => $val) {
                    $errMsg .= strtoupper($key) . ':' . $val[0] . '<br>';
                }
                $errMsg = '</div>';
            } else {
                echo "Something went worng.";
            }
        }
    } else {
        //sentInvoice($con, $order_id);    
        unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href = 'thank_you.php';
        </script>
<?php
    }
}
?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form method="post">
        <div class="row px-xl-5">
            <?php echo $errMsg ?>
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" name="address" type="text" placeholder="123 Street" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" name="city" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" name="state" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" name="pincode" type="text" placeholder="123" required>
                        </div>
                        <!-- <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-4">
                <div class="mb-5">
                    <form class="mb-5" action="">
                        <div class="input-group">
                            <input type="text" id="coupon_str" class="form-control p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <input type="button" class="btn btn-primary" onclick="set_coupon()" value="Apply Coupon">
                            </div>
                        </div>
                        <div class="field_error" id="coupon_result">
                        </div>
                    </form>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                        $cart_total = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productArr = get_product($con, '', '', $key);
                            $pname = $productArr['0']['name'];
                            $mrp = $productArr['0']['mrp'];
                            $price = $productArr['0']['price'];
                            $image = $productArr['0']['image'];
                            $qty = $val['qty'];
                            $cart_total = $cart_total + ($qty * $price);
                        ?>
                            <table class="table table-bordered text-center mb-0">
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex  pt-1 ">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="" style="width: 50px;">
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 90px;">
                                            <p><?php echo $pname ?></p>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 90px;">
                                            <p><?php echo $price ?></p>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 30px;">
                                            <button class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
                        <hr class="mt-0">

                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">
                                <p><?php echo $cart_total ?></p>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Coupon value</h6>
                            <h6 class="font-weight-medium"><span id="coupon_price"><?php echo $coupon_value ?></span></h6>
                        </div>
                    </div>

                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><span id="order_total_price"><?php echo $cart_total ?></span></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_type" id="COD" value="COD" required>
                                <label class="custom-control-label" for="COD">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_type" id="instamojo" value="instamojo" required>
                                <label class="custom-control-label" for="instamojo">Instamojo</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <input class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" type="submit" name="submit" id="submit">
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script>
        function set_coupon() {
            var coupon_str = jQuery('#coupon_str').val();
            jQuery('#coupon_result').html('');
            if (coupon_str != '') {
                jQuery.ajax({
                    url: 'set_coupon.php',
                    type: 'post',
                    data: 'coupon_str=' + coupon_str,
                    success: function(result) {
                        var data = jQuery.parseJSON(result);
                        if (data.is_error == 'yes') {
                            jQuery('#coupon_box').hide();
                            jQuery('#coupon_result').html(data.dd);
                            jQuery('#order_total_price').html(data.result);
                        }
                        if (data.is_error == 'no') {
                            jQuery('#coupon_box').show();
                            jQuery('#coupon_price').html(data.dd);
                            jQuery('#order_total_price').html(data.result);
                        }
                    }
                });
            }
        }
    </script>
</div>
<!-- Checkout End -->

<?php
if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['FINAL_PRODUCT']);
}
require('footer.php') ?>