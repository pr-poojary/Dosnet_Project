<?php
require ('top.php');
$resBanner = mysqli_query($con, "select * from banner where status='1' order by order_no asc");
?>

<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <?php
if (mysqli_num_rows($resBanner) > 0) {
?>
        <div class="carousel-inner">
            <?php
    while ($rowBanner = mysqli_fetch_assoc($resBanner)) {
        if ($rowBanner['order_no'] == 1) {
?>
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="<?php echo BANNER_IMAGE_SITE_PATH . $rowBanner['image'] ?>" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3"><?php echo $rowBanner['heading1'] ?></h4>
                                <?php
            if ($rowBanner['btn_txt'] != '' && $rowBanner['btn_link'] != '') {
?>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?php echo $rowBanner['heading2'] ?></h3>
                                <a href="<?php echo $rowBanner['btn_link'] ?>" class="btn btn-light py-2 px-3"><?php echo $rowBanner['btn_txt'] ?></a>
                                <?php
            } ?>
                            </div>
                        </div>
                    </div>
                <?php
        } else {
?>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="<?php echo BANNER_IMAGE_SITE_PATH . $rowBanner['image'] ?>" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3"><?php echo $rowBanner['heading1'] ?></h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?php echo $rowBanner['heading2'] ?></h3>
                                <a href="<?php echo $rowBanner['btn_link'] ?>" class="btn btn-light py-2 px-3"><?php echo $rowBanner['btn_txt'] ?></a>
                            </div>
                        </div>
                    </div>
                <?php
        }
?>
            <?php
    }
?>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    <?php
}
?>
</div>
</div>
</div>
</div>
<!-- Navbar End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">New Arrival</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
$get_product = get_product($con, '', '');
foreach ($get_product as $list) {
?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-1 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border-1 p-0">
                        <img class="w-100" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?>" alt="" style="width:300px; height:300px;">
                    </div>

                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?php echo $list['name'] ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6><?php echo $list['price'] ?></h6>
                            <h6 class="text-muted ml-2"><del><?php echo $list['mrp'] ?></del></h6>
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
} ?>
    </div>
</div>
<!-- Products End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Best sellers</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
$get_product = get_product($con, '', '', '', '', '', 'yes');
foreach ($get_product as $list) {
?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-1 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border-1 p-0">
                        <img class="w-100" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?>" alt="" style="width:300px; height:300px;">
                    </div>

                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?php echo $list['name'] ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6><?php echo $list['price'] ?></h6>
                            <h6 class="text-muted ml-2"><del><?php echo $list['mrp'] ?></del></h6>
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
                        <input type="number" class="form-control bg-secondary text-center" value="1" id="upqty" hidden>
                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add')" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-shopping-cart text-primary mr-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php
} ?>
    </div>
</div>
<!-- Products End -->


<?php
require ('footer.php');
?>