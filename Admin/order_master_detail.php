<?php
require('top.inc.php');
$order_id = get_safe_value($con, $_GET['id']);

$coupon_details = mysqli_fetch_assoc(mysqli_query($con, "select coupon_value,coupon_code from `order` where id = '$order_id'"));
$coupon_value = $coupon_details['coupon_value'];
$coupon_code = $coupon_details['coupon_code'];

if (isset($_POST['update_order_status'])) {
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con, "update  `order` set order_statu='$update_order_status' where id='$order_id'");
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">Order Detail</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-dark">
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
                        $res = mysqli_query($con, "select distinct(order_details.order_id), order_details.*, product.name, product.image from order_details, product, `order` 
                        where order_details.order_id='$order_id' and order_details.product_id = product.id");
                        $re = mysqli_query($con, "select `order`.*, order_details.* from `order`, order_details where order_id='$order_id'");
                        $ro = mysqli_fetch_assoc($re);
                        $total_price = 0;
                        $address = $ro['address'];
                        $city = $ro['city'];
                        $state = $ro['state'];
                        $pincode = $ro['pincode'];
                        while ($row = mysqli_fetch_assoc($res)) {
                            $total_price = $total_price + ($row['price'] * $row['qty']);
                        ?>
                            <tr>
                                <td class="align-middle"><?php echo $row['name'] ?></td>
                                <td class="align-middle"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="" style="width: 50px;"></td>
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
                                <td class="align-middle"><?php echo $coupon_value."($coupon_code)" ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="3" class="align-middle"></td>
                            <td class="align-middle">Total Price</td>
                            <td class="align-middle"><?php echo $total_price-$coupon_value ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-primary">Address Detail</h3>
                        <?php echo $address ?>, <?php echo $city ?>, <?php echo $state ?>, <?php echo $pincode ?>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-primary">Order Status</h3>
                        <?php
                        $order_status_arr = mysqli_fetch_assoc(mysqli_query($con, "select order_status.name from order_status,
                         `order` where `order`.id='$order_id' and `order`.order_statu=order_status.id"));
                        echo $order_status_arr['name'];
                        ?>
                    </div>
                    <div>
                        <form class="form-group" method="post">
                            <br>
                            <select class="form-control w-50 m-auto p-2" name="update_order_status">
                                <option>Select status</option>
                                <?php
                                $res = mysqli_query($con, "select * from order_status");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    if ($row['id'] == $categories_id) {
                                        echo "<option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                    } else {
                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block w-25 p-1 m-auto ">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require('footer.inc.php');
?>