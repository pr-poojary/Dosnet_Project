<?php
require ('connection.inc.php');
require ('functions.inc.php');
require ('add_to_cart.inc.php');
$cat_res = mysqli_query($con, "select * from categories where status=1 order by categories asc");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
}
$obj = new add_to_cart();
$totalPro = $obj->totalPro();
if (isset($_SESSION['USER_LOGIN'])) {
    $uid = $_SESSION['USER_ID'];
    if (isset($_GET['wishlist_id'])) {
        $wid = $_GET['wishlist_id'];
        mysqli_query($con, "delete from wishlist where id='$wid' and user_id='$uid'");
    }
    $wishlist_count = mysqli_num_rows(mysqli_query($con, " select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where
    wishlist.product_id=product.id and wishlist.user_id='$uid'"));
}
$script_name = $_SERVER['SCRIPT_NAME'];
$script_name_arr = explode('/', $script_name);
$mypage = $script_name_arr[count($script_name_arr) - 1];
$meta_title = "My E-Com Project";
$meta_desc = "My E-Com Project";
$meta_keyword = "My E-Com Project";
if ($mypage == 'product.php') {
    $product_id = get_safe_value($con, $_GET['id']);
    $product_meta = mysqli_fetch_assoc(mysqli_query($con, " select * from product where id='$product_id' "));
    $meta_title = $product_meta['meta_title'];
    $meta_desc = $product_meta['meta_desc'];
    $meta_keyword = $product_meta['meta_keyword'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $meta_title ?></title>
    <meta name="" content="<?php echo $meta_desc ?>">
    <meta name="" content="<?php echo $meta_keyword ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/cust.css" rel="stylesheet">
    
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid ">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
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
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="search.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="str" placeholder="Search for products">
                        <div class="input-group-append">
                            <button type="submit" class="btn border text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <?php if (isset($_SESSION['USER_LOGIN'])) { ?>
                    <a href="wishlist.php" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge" id="wishbadge"><?php echo $wishlist_count ?></span>
                    </a>
                <?php
} ?>
                <a href="cart.php" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge" id="addbadge"><?php echo $totalPro ?></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
                    <?php
foreach ($cat_arr as $list) {
?>
                        <div class="navbar-nav w-100 overflow-hidden">
                            <div class="nav-item dropdown">
                                <a href="categories.php?id=<?php echo $list['id'] ?>" class="nav-link" data-toggle="dropdown">
                                    <?php echo $list['categories'] ?><i class="fa fa-angle-down float-right mt-1"></i>
                                </a>
                                <?php
    $cat_id = $list['id'];
    $sub_cat_res = mysqli_query($con, "select * from sub_categories where status='1' and categories_id='$cat_id'");
    if (mysqli_num_rows($sub_cat_res) > 0) {
?>
                                    <div class="dropdown-menu bg-secondary border-0 rounded-0 w-100 m-0">
                                        <a href="categories.php?id=<?php echo $list['id'] ?>" class="dropdown-item">
                                            Show All Item
                                        </a>
                                        <?php
        while ($sub_cat_rows = mysqli_fetch_assoc($sub_cat_res)) {
            echo '<a href="categories.php?id=' . $list['id'] . '&sub_categories=' . $sub_cat_rows['id'] . '" class="dropdown-item">' . $sub_cat_rows['sub_categories'] . '</a>';
        }
?>
                                    </div>
                                <?php
    } else { ?>
                                    <div class="dropdown-menu bg-secondary border-0 rounded-0 w-100 m-0">
                                        <?php
        echo '<a href="#" class="dropdown-item">No Sub Categories Found</a>';
?>
                                    </div>
                                <?php
    } ?>
                            </div>
                        </div>
                    <?php
} ?>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <?php if (isset($_SESSION['USER_LOGIN'])) { ?>

                            <div class="navbar-nav ml-auto py-0">

                                <!-- Nav Item - User Information -->
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link" data-toggle="dropdown">
                                        <span class="mr-2 d-none d-lg-inline"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            My Account</span>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right m-0 p-0">
                                        <a href="my_order.php" class="dropdown-item cust_a">
                                            <i class="fas fa-user fa-sm ml-2 mr-2"></i>My Orders
                                        </a>
                                        <a href="profile.php" class="dropdown-item cust_a">
                                            <i class="fas fa-user fa-sm ml-2 mr-2"></i>Profile
                                        </a>
                                        <a href="logout.php" class="dropdown-item cust_a">
                                            <i class="fas fa-user fa-sm ml-2 mr-2"></i>logout
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php
} else { ?>
                            <div class="navbar-nav ml-auto py-0">
                                <a href="login.php" class="nav-item nav-link">Login</a>
                                <a href="register.php" class="nav-item nav-link">Register</a>
                            </div>
                        <?php
} ?>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->