<?php
  
include '../navbar.php';

 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Client List</h4>
    <ol class="breadcrumb">
      <a href="customer_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Client</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            </p>
                            <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Client Name</th>
                                    <th> Address</th>
                                    <th> Mobile Number</th>
                                    <th> Email Address</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM customer");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                // print_r($result);
                                // echo $rowno;
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['customer_delete'] == 0) {
                                        $customer_status = "Active";
                                    } else {
                                        $customer_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo htmlentities($row['customer_id']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['customer_name']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['customer_address']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['customer_mobile']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['customer_email']) ?></td>
                                        <td><?php echo $customer_status; ?></td>
                                        <td><a class="btn btn-primary btn-xs" href="customer_view.php?id=<?php echo $row["customer_id"]; ?>">View</a>
                                            <a class="btn btn-success btn-xs" href="customer_edit.php?id=<?php echo $row["customer_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["customer_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["customer_delete"] ?>">Delete
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
                var customer_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "customer_action.php",
                        method: "POST",
                        data: {customer_id: customer_id, status: status, btn_action: btn_action},
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
        </script>