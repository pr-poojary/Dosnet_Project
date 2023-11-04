<?php
include('../vendor/autoload.php');
require('connection.inc.php');
require('functions.inc.php');

$order_id = get_safe_value($con, $_GET['id']);

$coupon_details = mysqli_fetch_assoc(mysqli_query($con, "select coupon_value from `order` where id = '$order_id'"));
$coupon_value = $coupon_details['coupon_value'];


$css = file_get_contents('css/bootstrap.min.css');
$css .= file_get_contents('css/cust1.css');
$html = '
<div class="table-responsive w-100 m-auto mb-15">
<table class="table table-bordered text-center mb-0">
    <thead class="bg-secondary text-dark">
        <tr>
            <th class="align-middle align-content-center m-1 p-3">Product Name</th>
            <th class="align-middle align-content-center m-1 p-3">Product Image</th>
            <th class="align-middle align-content-center m-1 p-3">Quatity</th>
            <th class="align-middle align-content-center m-1 p-3">Price</th>
            <th class="align-middle align-content-center m-1 p-3">Total Price</th>
        </tr>
    </thead>
    <tbody class="align-middle">';
$res = mysqli_query($con, "select distinct(order_details.id), order_details.*, product.name, product.image from order_details, 
                    product, `order` where order_details.order_id='$order_id' and product.id = order_details.product_id");
$total_price = 0;
if(mysqli_num_rows($res)==0){
    die(); 
}
while ($row = mysqli_fetch_assoc($res)) {
    $total_price = $total_price + ($row['price'] * $row['qty']);
    $tp = $row['price'] * $row['qty'];
    $html .= '<tr>
            <td class="align-middle">' . $row['name'] . '</td>
            <td class="align-middle"><img src="' . PRODUCT_IMAGE_SITE_PATH . $row['image'] . '" alt="" style="width: 300px; height: 250px;"></td>
            <td class="align-middle">' . $row['qty'] . '</td>
            <td class="align-middle">' . $row['price'] . '</td>
            <td class="align-middle">' . $tp . '</td>
        </tr>';
}
if ($coupon_value != '') {

    $htmi .= '<tr>
            <td colspan="3" class="align-middle"></td>
            <td class="align-middle p-2">Coupon Value</td>
            <td class="align-middle p-2">' . $coupon_value . '</td>
        </tr>';
}
$html .= '<tr>
            <td colspan="3" class="align-middle"></td>
            <td class="align-middle p-3">Total Price</td>
            <td class="align-middle p-3">' . $total_price . '</td>
        </tr>
    </tbody>
</table>
</div>
';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html, 2);
$file = time() . '.pdf';
$mpdf->Output($file, 'D');
