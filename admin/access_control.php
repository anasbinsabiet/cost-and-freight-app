<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Access Control</h4>
    <ol class="breadcrumb">
      <a href="access_control_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Access</a>
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
                                    <th> Username</th>
                                    <th> User Role</th>
                                    <th> Branch</th>
                                    <th> Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                        $statement = $connect->prepare("SELECT * FROM  access_control");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo get_user_name($connect, $row['user_id']) ?></td>
                                        
                                        <td class="py-1"><?php echo get_user_role($connect, $row['user_role_id']) ?></td>

                                        <td class="py-1"><?php echo get_branch_name($connect, $row['location_id']) ?></td>

                                        <td><a class="btn btn-primary"
                                               href="access_control_edit.php?id=<?php echo $row["access_control_id"]; ?>">Edit</a>
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../footer.php'; ?>

        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $('#myTable').dataTable({
                    "aaSorting": [[1, 'asc']]
                });
            });
            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var access_control_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "access_control_action.php",
                        method: "POST",
                        data: {access_control_id: access_control_id, status: status, btn_action: btn_action},
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