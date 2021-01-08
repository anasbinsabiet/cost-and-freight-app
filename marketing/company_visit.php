<?php  
include '../navbar.php';
 
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Company Visit List</h4>
    <ol class="breadcrumb">
      <a href="company_visit_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Company Visit</a>
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
                                    <th> Company Name</th>
                                    <th> Company Employee</th>
                                    <th> Company Visit Date</th>
                                    <th> Company Visit Time</th>
                                    <th> Comments</th>
                                    <th> Company Visit Remarks</th>
                                    <th> Company Next Visit Date</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM company_visit");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['company_visit_delete'] == 0) {
                                        $company_visit_status = "Active";
                                    } else {
                                        $company_visit_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <?php echo get_mcompany_name($connect, $row['mcompany_id']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo get_employee_name($connect, $row['employee_id']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['company_visit_date']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['company_visit_time']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['comments']) ?>
                                        </td>
                                        
                                        <td class="py-1">
                                            <?php echo htmlentities($row['company_visit_remarks']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['company_next_visit_date']) ?>
                                        </td>
                                        <td><?php echo $company_visit_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="company_visit_edit.php?id=<?php echo $row["company_visit_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["company_visit_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["company_visit_delete"] ?>">Delete
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
                var company_visit_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "company_visit_action.php",
                        method: "POST",
                        data: {company_visit_id: company_visit_id, status: status, btn_action: btn_action},
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