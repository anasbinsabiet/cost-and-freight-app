<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Marketing Company List</h4>
    <ol class="breadcrumb">
      <a href="marketing_company_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Marketing Company</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <p class="alert alert-primary" role="alert" id="alert_action">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    
                                    <th> Company Name</th>
                                    <th> Company Address</th>
                                    <th> Factory Address</th>
                                    <th> Company Phone</th>
                                    <th> Owner Phone</th>
                                    <th> Company Email</th>
                                    <th> Company Contact person</th>
                                    <th> Employee </th>
                                    <th> Sector </th>
                                    <th> Zone </th>
                                    <th> Remarks </th>
                                    <th> Date </th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM mcompany");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                // print_r($result);
                                // echo $rowno;
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['mcompany_delete'] == 0) {
                                        $location_status = "Active";
                                    } else {
                                        $location_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                         
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_name']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_address']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['factory_address']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_phone']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['owner_phone']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_email']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_contact_person']) ?></td>
                                        <td class="py-1"><?php echo get_employee_name($connect,$row['employee_id']) ?></td>
                                        <td class="py-1"><?php echo get_marketing_sector_name($connect,$row['marketing_sector_id']) ?></td>
                                        <td class="py-1"><?php echo get_marketing_zone_name($connect,$row['marketing_zone_id']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['remarks']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['mcompany_date']) ?></td>
                                        <td><?php echo $location_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="marketing_company_edit.php?id=<?php echo $row["mcompany_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["mcompany_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["mcompany_delete"] ?>">Delete
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../footer.php'; ?>

        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $('#myTable').dataTable({
                    "aaSorting": [[0, 'desc']]
                });
            });
            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var mcompany_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "marketing_company_action.php",
                        method: "POST",
                        data: {mcompany_id: mcompany_id, status: status, btn_action: btn_action},
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