<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Employee List</h4>
    <ol class="breadcrumb">
      <a href="employee_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            </p>
                            <p class="alert alert-primary" role="alert" id="alert_action">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Employee Name</th>
                                    <th> Employee Address</th>
                                    <th> Employee Mobile</th>
                                    <th> Employee Email</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM employee");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                // print_r($result);
                                // echo $rowno;
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['employee_delete'] == 0) {
                                        $customer_status = "Active";
                                    } else {
                                        $customer_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo htmlentities($row['employee_id']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['employee_name']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['employee_address']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['employee_mobile']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['employee_email']) ?></td>
                                        <td><?php echo $customer_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="employee_edit.php?id=<?php echo $row["employee_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["employee_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["employee_delete"] ?>">Delete
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
                var employee_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "employee_action.php",
                        method: "POST",
                        data: {employee_id: employee_id, status: status, btn_action: btn_action},
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