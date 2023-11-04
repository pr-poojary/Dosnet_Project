<?php 
    session_start();
    $con=mysqli_connect("localhost","root","","ecommerce");
    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/Dosnet_Project/');
    define('SITE_PATH','http://localhost:80/Dosnet_Project/');

    define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
    define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

    define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'media/product_images/');
    define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'media/product_images/');
    
    define('BANNER_IMAGE_SERVER_PATH',SERVER_PATH.'media/banner/');
    define('BANNER_IMAGE_SITE_PATH',SITE_PATH.'media/banner/');
?>