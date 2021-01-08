<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Monthly Employee Comments List</h4>
    <ol class="breadcrumb">
      <a href="monthly_employee_comments_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Monthly Employee Comments</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="alert alert-primary" role="alert" id="alert_action">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> Employee  Name</th>
                                    <th> Comments </th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM monthly_employee_comments");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['monthly_employee_comments_delete'] == 0) {
                                        $monthly_employee_comments_status = "Active";
                                    } else {
                                        $monthly_employee_comments_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <?php echo get_employee_name($connect, $row['employee_name']); ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['comments']); ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo date("F-Y",strtotime($row['comments_date'])); ?>
                                        </td>
                                        <td><?php echo $monthly_employee_comments_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="monthly_employee_comments_edit.php?id=<?php echo $row["monthly_employee_comments_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["monthly_employee_comments_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["monthly_employee_comments_delete"] ?>">Delete
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
                    "aaSorting": [[0, 'asc']]
                });
            });
            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var monthly_employee_comments_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "monthly_employee_comments_action.php",
                        method: "POST",
                        data: {monthly_employee_comments_id: monthly_employee_comments_id, status: status, btn_action: btn_action},
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