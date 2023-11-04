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
        $update_status_sql = "update categories set status='$status' where id='$id'";
        mysqli_query($con, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from categories where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from categories order by categories asc";
$res = mysqli_query($con, $sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary">Categories</h3>
            <h4 class="m-0 text-primary"><a href="manage_categories.php">Add Categoties</a></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-dark">
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Categories</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($res)) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['categories'] ?></td>
                            <td>
                                <?php
                                    if ($row['status'] == 1) {
                                        echo "<a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp";
                                    } else {
                                        echo "<a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp";
                                    }
                                    echo "&nbsp<a href='manage_categories.php?id=" . $row['id'] . "'>Edit</a>&nbsp";
                                    echo "&nbsp<a href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp";
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