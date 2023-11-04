<?php
require('top.php');
?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $cart_total = 0;
                    if (isset($_SESSION['cart'])) {
                        if (count($_SESSION['cart']) > 0) {
                            foreach ($_SESSION['cart'] as $key => $val) {
                                $productArr = get_product($con, '', '', $key);
                                $pname = $productArr['0']['name'];
                                $mrp = $productArr['0']['mrp'];
                                $price = $productArr['0']['price'];
                                $image = $productArr['0']['image'];
                                $qty = $val['qty'];
                                $cart_total = $cart_total + ($qty * $price);
                    ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="" style="width: 50px;">
                                        <?php echo $pname ?>
                                    </td>
                                    <td class="align-middle"><?php echo $price ?></td>
                                    <td class="align-middle">
                                        <?php
                                        $productSoldQtyByProductId = productSoldQtyByProductId($con, $productArr['0']['id']);
                                        $productQty = productQty($con, $productArr['0']['id']);

                                        $pending_qty = $productQty - $productSoldQtyByProductId;
                                        ?>
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" onclick="decrement()">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" class="form-control form-control-sm bg-secondary text-center " id="<?php echo $key ?>upqty" value="<?php echo $qty ?>" min="1" max="<?php echo $pending_qty ?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus" onclick="increment()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?php echo $qty * $price ?></td>
                                    <td class="align-middle">
                                        <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td class="align-middle" colspan="5">
                                    <div class="input-group quantity justify-content-center">
                                        <p>No item added to cart.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td class="align-middle" colspan="5">
                                <div class="input-group quantity justify-content-center">
                                    <p>No item added to cart.</p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">

            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold"><span id="order_total_price"><?php echo $cart_total ?></span></h5>
                    </div>
                    <a href="<?php echo SITE_PATH ?>checkout.php"><button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid ml-2">
            <a href="<?php echo SITE_PATH ?>"><button class="btn btn-primary mr-2 px-3"><i class="fa fa-shopping-cart mr-1"></i>
                    Continue Shopping
                </button></a>
        </div>
    </div>
</div>
<!-- Cart End -->

<?php
require('footer.php');
?>