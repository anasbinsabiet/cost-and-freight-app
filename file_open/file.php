<?php
  
include '../navbar.php';

 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Bill List</h4>
    <ol class="breadcrumb">
      <a href="file_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Bill</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Bill No</th>
                                    <th> Date</th>
                                    <th> Client</th>
                                    <th> Address</th>
                                    <th> Zone</th>
                                    <th> Payment</th>  
                                    <th> Total Bill </th>
                                    <th> Total Expenses </th>
                                    <?php 
                                    if ($_SESSION['user_role'] != "User") {
                                        echo "<th> Approval</th>";
                                    }
                                     ?>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM files");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {
                                    $date = date('j F Y', strtotime($row['file_create']));

                                    if ($row['file_delete'] == 0) {
                                        $file_status = "Active";
                                    } else {
                                        $file_status = "Inactive";
                                    }

                                    if ($row['file_approve'] == 0) {
                                        $file_approve = "Approve";
                                        $color = "";
                                    } else {
                                        $file_approve = "Approved";
                                        $color = "btn-warning";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo $row['file_id']; ?></td>
                                        <td class="py-1"><a href="file_view.php?id=<?php echo $row["file_id"]; ?>"><?php echo $row['bill_no']; ?></a></td>
                                        <!--<td class="py-1"><?php echo $date; ?></td>-->
                                        <td class="py-1"><?php if(!empty($row['bill_no_date'])){ echo date("d-F-Y", strtotime($row['bill_no_date'])); } ?></td>
                                        <td class="py-1"><?php echo get_customer_name($connect, $row['client_name']) ?></td>
                                        <td class="py-1"><?php echo $row['client_address']; ?></td>
                                        <td class="py-1"><?php echo $row['zone']; ?></td>
                                        <td class="py-1"><?php echo get_payment_status1($connect, $row['payment_status']) ?></td>
                                        <td class="py-1"><?php echo $row['bill_total']; ?></td>
                                        <td class="py-1"><?php echo $row['expenses_total']; ?></td>
                                        
                                        <?php   
                                    if ($_SESSION['user_role'] != "User") {
                                        ?>
                                        <td>
                                            <button type="button" name="approve" id="<?php echo $row["file_id"] ?>"
                                                    class="btn btn-primary btn-xs approve <?php echo $color; ?>" data-status="<?php echo $row["file_approve"] ?>"><?php echo $file_approve; ?>
                                            </button>
                                        </td>
                                        <?php } ?>

                                        <td><?php echo $file_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="file_view.php?id=<?php echo $row["file_id"]; ?>">View</a>
                                             <a class="btn btn-success btn-xs"
                                               href="file_edit.php?id=<?php echo $row["file_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["file_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["file_delete"] ?>">Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <!-- closing the if mysqli_num_rows if statement -->
                                <?php } else {
                                    echo "No record found";
                                } ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
  </section> 
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $('#myTable').dataTable({
                    "aaSorting": [[0, 'desc']]
                });
            });
            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var file_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "files_action.php",
                        method: "POST",
                        data: {file_id: file_id, status: status, btn_action: btn_action},
                        success: function (data) {
                            $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                            // myTable.ajax.reload();
                            location.reload();
                        }
                    })
                } else {
                    return false;
                }
            });
            //////////////////////////////////////////// APPROVE
            $(document).on('click', '.approve', function () {
                var file_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'approve';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "files_action.php",
                        method: "POST",
                        data: {file_id: file_id, status: status, btn_action: btn_action},
                        success: function (data) {
                            $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                            // myTable.ajax.reload();
                            
                            setTimeout(function () {
                        location.reload();
                    }, 1500)
                        }
                    })
                } else {
                    return false;
                }
            });
        </script>