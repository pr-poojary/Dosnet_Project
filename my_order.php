<?php
require('top.php');
if ((!isset($_SESSION['USER_LOGIN']))) {
    ?>
        <script>
            window.location.href = 'index.php';
        </script>
    <?php
}
?>

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">My Orders</p>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Order Id</th>
                        <th>Order Date</th>
                        <th>Address</th>
                        <th>Payement Type</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $uid = $_SESSION['USER_ID'];
                    $res = mysqli_query($con, "select `order`.*, order_status.name as order_status_str from `order`, order_status where order.user_id='$uid' and order_status.id=`order`.order_statu");
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td class="align-middle">
                                <a href="my_order_detail.php?id=<?php echo $row['id'] ?>" class="text-dark p-0">
                                    <button class="btn btn-md btn-primary">
                                        <?php echo $row['id'] ?>
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle"><?php echo $row['added_on'] ?></td>
                            <td class="align-middle"><?php echo $row['address'] ?></td>
                            <td class="align-middle"><?php echo $row['payment_type'] ?></td>
                            <td class="align-middle"><?php echo $row['payment_status'] ?></td>
                            <td class="align-middle"><?php echo $row['order_status_str'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
require('footer.php');
?>