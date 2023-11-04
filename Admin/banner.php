<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "update banner set status='$status' where id='$id'";
        mysqli_query($con, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from banner where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from banner order by id asc";
$res = mysqli_query($con, $sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">Banner</h3>
            <h4 class="m-0 text-primary"><a href="manage_banner.php">Add Banner</a></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-dark">
                        <tr>
                            <th>Heading1</th>
                            <th>Heading2</th>
                            <th>Btn Txt</th>
                            <th>Btn Link</th>
                            <th>Image</th>
                            <th>Order No</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($res)) { ?>
                        <tr>
                            <td><?php echo $row['heading1'] ?></td>
                            <td><?php echo $row['heading2'] ?></td>
                            <td><?php echo $row['btn_txt'] ?></td>
                            <td><?php echo $row['btn_link'] ?></td>
                            <td><img src="<?php echo BANNER_IMAGE_SITE_PATH . $row['image'] ?>" alt="" width="300px" height="100px"></</td>
                            <td><?php echo $row['order_no'] ?></td>
                            <td>
                                <?php
                                    if ($row['status'] == 1) {
                                        echo "<a class='btn btn-primary mb-3' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp";
                                    } else {
                                        echo "<a class='btn btn-secondary mb-3' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp";
                                    }
                                    echo "&nbsp<a class='btn btn-success mb-3' href='manage_banner.php?id=" . $row['id'] . "'>Edit</a>&nbsp";
                                    echo "&nbsp<a class='btn btn-danger mb-1' href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp";
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
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