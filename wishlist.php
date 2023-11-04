<?php
require('top.php');
if ((!isset($_SESSION['USER_LOGIN']))) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}

$uid = $_SESSION['USER_ID'];


$res = mysqli_query($con, " select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where
 wishlist.product_id=product.id and wishlist.user_id='$uid'");
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
        <div class="col-lg-11 m-auto table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name of Product</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td class="align-middle">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="" style="width: 200px; height: 200px;">
                            </td>
                            <td class="align-middle">
                                <h5 class="text-truncate mb-3"><?php echo $row['name'] ?></h5>
                                <div class="d-flex justify-content-center">
                                    <h6><?php echo $row['price'] ?></h6>
                                    <h6 class="text-muted ml-2"><del><del><?php echo $row['mrp'] ?></del></h6>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a class="btn btn-sm btn-primary" href="wishlist.php?wishlist_id=<?php echo $row['id'] ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container-fluid ml-2 mt-3">
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