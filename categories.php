<?php
require('top.php');
$cat_id = get_safe_value($con, $_GET['id']);

$sub_categories = '';
if (isset($_GET['sub_categories'])) {
    $sub_categories = get_safe_value($con, $_GET['sub_categories']);
}

$sort_order = "";
$price_high_selected = "";
$price_low_selected = "";
$new_selected = "";
$old_selected = "";
$default_selected = "";

if (isset($_GET['sort'])) {
    $sort = get_safe_value($con, $_GET['sort']);
    if ($sort == "price_high") {
        $sort_order = " order by product.name desc ";
        $price_high_selected = "selected";
    }
    if ($sort == "price_low") {
        $sort_order = " order by product.name asc ";
        $price_low_selected = "selected";
    }
    if ($sort == "new") {
        $sort_order = " order by product.id desc ";
        $new_selected = "selected";
    }
    if ($sort == "old") {
        $sort_order = " order by product.id asc ";
        $old_selected = "selected";
    }
    if ($sort == "default_selected") {
        $sort_order = " order by product.name ";
        $default_selected = "selected";
    }
}

if ($cat_id > 0) {
    $get_product = get_product($con, '', $cat_id, '', '', $sort_order, '', $sub_categories);
} else {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Product</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="row align-items-center py-3 px-xl-5">
    </ <!-- Shop Product Start -->
    <div class="col-lg-12 col-md-12">
        <?php if (count($get_product) > 0) { ?>
            <div class="row pb-3 pr-3 pl-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="dropdown mr-2">
                            <select class="btn border dropdown-toggle" onchange="sort_product_drop('<?php echo $cat_id ?>', '<?php echo SITE_PATH ?>')" value="default_selected" id="sort_product_id">
                                <option value="default_selected" <?php echo $default_selected ?>>Sort by</option>
                                <option value="price_low" <?php echo $price_low_selected ?>>Sort by price low to high</option>
                                <option value="price_high" <?php echo $price_high_selected ?>>Sort by price high to low</option>
                                <option value="new" <?php echo $new_selected ?>>Sort by new first</option>
                                <option value="old" <?php echo $old_selected ?>>Sort by old first</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($get_product as $list) {
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
                                <input type="number" class="form-control bg-secondary text-center" value="1" id="upqty" hidden>
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add')" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-12 pb-1 pt-1 mt-2">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } else {
            echo "Data Not Found";
        } ?>
    </div>
    <!-- Shop Product End -->

</div>

<script>
    function sort_product_drop(cat_id, site_path) {
        var sort_product_id = jQuery('#sort_product_id').val();
        window.location.href = site_path + "categories.php?id=" + cat_id + "&sort=" + sort_product_id;
    }
</script>

<?php
require('footer.php');
?>