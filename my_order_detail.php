<?php
require('top.php');
if ((!isset($_SESSION['USER_LOGIN']))) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
$order_id = get_safe_value($con, $_GET['id']);

$coupon_details = mysqli_fetch_assoc(mysqli_query($con, "select coupon_value from `order` where id = '$order_id'"));
$coupon_value = $coupon_details['coupon_value'];
?>

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Order Detail</p>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Quatity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $uid = $_SESSION['USER_ID'];
                    $res = mysqli_query($con, "select distinct(order_details.id), order_details.*, product.name, product.image from order_details, 
                    product, `order` where order_details.order_id='$order_id' and `order`.user_id='$uid' and product.id = 
                    order_details.product_id");
                    $total_price = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $total_price = $total_price + ($row['price'] * $row['qty']);
                    ?>
                        <tr>
                            <td class="align-middle"><?php echo $row['name'] ?></td>
                            <td class="align-middle"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="" style="width: 300px; height: 250px;"></td>
                            <td class="align-middle"><?php echo $row['qty'] ?></td>
                            <td class="align-middle"><?php echo $row['price'] ?></td>
                            <td class="align-middle"><?php echo $row['price'] * $row['qty'] ?></td>
                        </tr>
                    <?php
                    }
                    if ($coupon_value != '') {
                    ?>
                    
                    <tr>
                        <td colspan="3" class="align-middle"></td>
                        <td class="align-middle">Coupon Value</td>
                        <td class="align-middle"><?php echo $coupon_value ?></td>
                    </tr>

                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3" class="align-middle"><a href="order_pdf.php?id=<?php echo $order_id ?>">My Pdf</a></td>
                        <td class="align-middle">Total Price</td>
                        <td class="align-middle"><?php echo $total_price-$coupon_value ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
require('footer.php');
?>