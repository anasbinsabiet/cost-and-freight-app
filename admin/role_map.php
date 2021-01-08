<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Role Map List</h4>
    <ol class="breadcrumb">
      <a href="role_map_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Role Map</a>
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
                                    <th> ID </th>
                                    <th> Role ID </th>
                                    <th> Role Name </th>
                                    <th> Role Position </th>
                                    <!-- <th> Status</th>
                                    <th> Edit</th>
                                    <th> Delete</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM role_map ORDER BY role_postion ASC");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                // print_r($result);
                                // echo $rowno;
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    // if ($row['bank_delete'] == 0) {
                                    //     $location_status = "Active";
                                    // } else {
                                    //     $location_status = "Inactive";
                                    // }

                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <?php echo $row['role_map_id']; ?>
                                        </td>
                                        <td class="py-1"><?php echo $row['role_id']; ?></td>
                                        <td class="py-1"><?php echo $row['role_name']; ?></td>
                                        <td class="py-1"><?php echo $row['role_postion']; ?></td>
                                       
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <!-- closing the if mysqli_num_rows if statement -->
                                <?php } else {
                                    echo "Sorry, No record found!";
                                } ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../footer.php';

        ?>

        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $('#myTable').dataTable({
                    "aaSorting": [[3, 'asc']]
                });
            });
            // //////////////////////////////////////////// DELETE
            // $(document).on('click', '.delete', function () {
            //     var bank_id = $(this).attr('id');
            //     var status = $(this).data("status");
            //     var btn_action = 'delete';
            //     if (confirm("Are you sure you want to change status?")) {
            //         $.ajax({
            //             url: "bank_action.php",
            //             method: "POST",
            //             data: {bank_id: bank_id, status: status, btn_action: btn_action},
            //             success: function (data) {
            //                 $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
            //                 // myTable.ajax.reload();
            //                 location.reload();
            //             }
            //         })
            //     } else {
            //         return false;
            //     }
            // });
        </script>

