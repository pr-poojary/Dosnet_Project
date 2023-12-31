<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$qty = get_safe_value($con, $_POST['qty']);
$type = get_safe_value($con, $_POST['type']);

$productSoldQtyByProductId = productSoldQtyByProductId($con, $pid);
$productQty = productQty($con, $pid);

$pending_qty = $productQty - $productSoldQtyByProductId;

$obj = new add_to_cart();

if ($type == 'add') {
    if ($qty > $pending_qty) {
        echo "not_avaliable";
        die();
    }
    $obj->addProduct($pid, $qty);
}

if ($type == 'remove') {
    $obj->removeProduct($pid);
}

if ($type == 'update') {
    if ($qty > $pending_qty) {
        echo "not_avaliable";
        die();
    }
    $obj->updateProduct($pid, $qty);
}

echo $obj->totalPro();
