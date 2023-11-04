<?php
ob_start();
require('top.php');
$product_id = mysqli_real_escape_string($con, $_GET['id']);
if ($product_id > 0) {
    $get_product = get_product($con, '', '', $product_id);
} else {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
$resMultipleImages = mysqli_query($con, "select * from product_images where product_id='$product_id'");
$MultipleImages = [];
if (mysqli_num_rows($resMultipleImages) > 0) {
    while ($rowMultipleImages = mysqli_fetch_assoc($resMultipleImages)) {
        $MultipleImages[] = $rowMultipleImages['product_image'];
    }
}

if (isset($_POST['reveiw_submit'])) {
    $added_on = date('Y-m-d h:i:s');
    $rating = get_safe_value($con, $_POST['rating']);
    $review = get_safe_value($con, $_POST['review']);
    mysqli_query($con, "insert into product_review(product_id, user_id, rating, review, status, added_on) values('$product_id','" . $_SESSION['USER_ID'] . "', '$rating', '$review', '1', '$added_on')");
    header('location:product.php?id=' . $product_id);
    die();
}

$product_review_res = mysqli_query($con, "select users.name, product_review.id, product_review.rating, product_review.review,
product_review.added_on from users, product_review where product_review.status=1 and product_review.user_id=users.id and 
product_review.product_id='$product_id' order by product_review.added_on asc");
$count = mysqli_num_rows($product_review_res);



?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Detail</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">></p>
            <p class="m-0">
                <a href="categories.php?id=<?php echo $get_product['0']['categories_id'] ?>">
                    <?php echo $get_product['0']['categories'] ?>
                </a>
            </p>
            <p class="m-0 px-2">></p>
            <p class="m-0"><?php echo $get_product['0']['name'] ?></p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row flex px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel " data-ride="carousel">
                <?php
                $imageFilenames = [];
                foreach ($MultipleImages as $list1) {
                    $imageFilenames[] = $list1;
                }
                $numberOfImages = count($imageFilenames); ?>
                <div class="carousel-item active ">
                    <img class="w-100 h-100 imageZoom" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $get_product['0']['image'] ?>" alt="Image">
                </div>
                <?php

                for ($i = 0; $i < $numberOfImages; $i++) {
                ?>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="<?php echo PRODUCT_MULTIPLE_IMAGE_SITE_PATH . $imageFilenames[$i]  ?>" alt='Image'>
                    </div>
                <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                <i class="fa fa-2x fa-angle-left text-dark"></i>
            </a>
            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                <i class="fa fa-2x fa-angle-right text-dark"></i>
            </a>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold h1"><?php echo $get_product['0']['name'] ?></h3>
            <h3 class=" font-weight-light"><del><?php echo $get_product['0']['mrp'] ?></del></h3>
            <h3 class="font-weight-bold h2 mb-3"><?php echo $get_product['0']['price'] ?></h3>
            <p class="mb-4"><?php echo $get_product['0']['short_desc'] ?></p>

            <div>
                <?php
                $productSoldQtyByProductId = productSoldQtyByProductId($con, $get_product['0']['id']);
                $cart_show = 'yes';
                $productQty = productQty($con, $get_product['0']['id']);

                $pending_qty = $productQty - $productSoldQtyByProductId;
                if ($get_product['0']['qty'] > $productSoldQtyByProductId) {
                    $stock = 'In Stock';
                } else {
                    $stock = 'Not in Stock';
                    $cart_show = '';
                }
                ?>
                <div class="sin__desc">
                    <p><span>Availability : </span><?php echo $stock ?></p>
                </div>
                <div class="sin__desc align--left" style="display: flex;">
                    <p><span>Categories : </span></p>
                    <ul class="pro__cat__list">
                        <li><a href="#"><?php echo $get_product['0']['categories'] ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="sin__desc mb-3 flex">
                <?php
                if ($cart_show != '') {
                ?>
                    <p class="pr-3"><span>Quantity : </span></p>
                    <div class="input-group mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" onclick="decrement()">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" class="form-control bg-secondary text-center" value="1" id="upqty" min="1" max="<?php echo $pending_qty ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" onclick="increment()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="d-flex align-items-center mb-4 pt-2">
                <?php
                if ($cart_show != '') {
                ?>
                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add')">
                        <button class="btn btn-primary mr-2 px-3"><i class="fa fa-shopping-cart mr-1"></i>
                            Add To Cart
                        </button>
                    </a>
                <?php
                }
                ?>
                <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')" class="btn btn-primary px-3">
                    <i class="fas fa-heart mr-1"></i>
                    Add To Wishlist
                </a>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (<?php echo $count ?>)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <div class="prag">
                        <span><?php echo $get_product['0']['description'] ?></span>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Additional Information</h4>
                    <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4"><?php echo $count ?> review for "<?php echo $get_product['0']['name'] ?>"</h4>
                            <?php
                            if (mysqli_num_rows($product_review_res) > 0) {
                                while ($product_review_row = mysqli_fetch_assoc($product_review_res)) {
                            ?>
                                    <div class="media mb-4">
                                        <div class="media-body">
                                            <h6><?php echo $product_review_row['name'] ?><small> - <i><?php $added_on = strtotime($product_review_row['added_on']);
                                                                                                        echo date('d M Y', $added_on); ?></i></small></h6>
                                            <div class="text-primary mb-2">
                                                <h6><?php echo $product_review_row['rating'] ?></h6>
                                            </div>
                                            <p><?php echo $product_review_row['review'] ?></p>
                                        </div>
                                    </div>
                            <?php }
                            } else {
                                echo "<span class='review_hint'> No Rveiws added</span>";
                            } ?>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Leave a review</h4>
                            <?php
                            if (isset($_SESSION['USER_LOGIN'])) {
                            ?>
                                <form method="post">
                                    <div class="form-group">
                                        <p class="mb-0 mr-2">Your Rating :</p>
                                        <div class="text-primary">
                                            <select name="rating">
                                                <option value="Select Rating">Select Rating</option>
                                                <option value="Worst">Worst</option>
                                                <option value="Bad">Bad</option>
                                                <option value="Good">Good</option>
                                                <option value="Very Good">Very Good</option>
                                                <option value="Fantastic">Fantastic</option>
                                            </select>
                                            <option><i class="far fa-star"></i></option>
                                        </div>
                                        <label for="message">Your Review : </label>
                                        <textarea cols="30" name="review" rows="5" class="form-control mb-3" required></textarea>
                                        <input type="submit" name="reveiw_submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                <?php } else {
                                echo "<span class='review_hint'>Please <a href='login.php'>login to submit your reveiw</a></span>";
                            } ?>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<!-- Products Start -->
<?php
//unset($_COOKIE['recently_viewed']);
if (isset($_COOKIE['recently_viewed'])) {
    $arrRecentView = unserialize($_COOKIE['recently_viewed']);
    $countRecentView = count($arrRecentView);
    $countStartRecentView = $countRecentView - 4;
    if ($countRecentView > 4) {
        $arrRecentView = array_slice($arrRecentView, $countStartRecentView, 4);
    }

    $recentViewId = implode(",", $arrRecentView);
    $res = mysqli_query($con, "select * from product where id IN ($recentViewId)");
?>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Recently Viewed Product</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            while ($list = mysqli_fetch_assoc($res)) {
            ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-1 mb-3">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="w-100" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?>" alt="" width="300" height="300">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $list['name'] ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6><?php echo $list['price'] ?></h6>
                                <h6 class="text-muted ml-2"><del><del><?php echo $list['mrp'] ?></del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="product.php?id=<?php echo $list['id'] ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>
                                View Detail
                            </a>
                            <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-heart text-primary mr-1"></i>
                                Add To Wishlist
                            </a>
                        </div>
                        <div class="card-footer d-flex justify-content-center bg-light border">
                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')" class="btn btn-sm text-dark p-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                Add To Cart
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
    $arrRec = unserialize($_COOKIE['recently_viewed']);
    if (($key = array_search($product_id, $arrRec)) !== false) {
        unset($arrRec[$key]);
    }
    $arrRec[] = $product_id;
    setcookie('recently_viewed', serialize($arrRec), time() + 60 * 60 * 24 * 365);
} else {
    $arrRec[] = $product_id;
    setcookie('recently_viewed', serialize($arrRec), time() + 60 * 60 * 24 * 365);
}
?>
<!-- Products End -->

<script>
    function showMultipleImage(im) {
        jQuery('#img-tab-1').html("<img class='w-100 h-100' src='" + im + "'>");
    }
</script>

<?php
require('footer.php');
ob_flush();
?>