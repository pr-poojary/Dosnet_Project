<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from users where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from users order by id desc";
$res = mysqli_query($con, $sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">Order Master</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-dark">
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
                        $res = mysqli_query($con, "select `order`.*, order_status.name as order_status_str from `order`, order_status where order_status.id=`order`.order_statu");
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td class="align-middle">
                                    <a href="order_master_detail.php?id=<?php echo $row['id'] ?>" class="text-dark p-0">
                                        <button class="btn btn-md btn-primary">
                                            <?php echo $row['id'] ?>
                                        </button>
                                    </a>
                                    <a href="order_pdf.php?id=<?php echo $row['id'] ?>" class="text-dark p-0">
                                        <button class="btn btn-md btn-primary">
                                            PDF
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require('footer.inc.php');
?>