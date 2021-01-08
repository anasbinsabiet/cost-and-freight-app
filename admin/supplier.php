<?php
include '../dashboard/navbar.php'; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include '../sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Supplier List</h3>
                <span id="alert_action"></span>
                <a class="mdi mdi-plus-circle btn btn-primary" href="supplier_add.php"> Add Supplier</a>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="supplier.php">Supplier</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Supplier</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            </p>
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-success alert-dismissible" id="form_response" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-success alert-dismissible" id="alert_action" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> Supplier Name</th>
                                    <th> Address</th>
                                    <th> Mobile Number</th>
                                    <th> Email Address</th>
                                    <th> Status</th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM supplier");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                // print_r($result);
                                // echo $rowno;
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['supplier_delete'] == 0) {
                                        $supplier_status = "Active";
                                    } else {
                                        $supplier_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo htmlentities($row['supplier_name']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['supplier_address']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['supplier_mobile']) ?></td>
                                        <td class="py-1"><?php echo htmlentities($row['supplier_email']) ?></td>
                                        <td><?php echo $supplier_status; ?></td>
                                        <td><a class="btn btn-primary"
                                               href="supplier_edit.php?id=<?php echo $row["supplier_id"]; ?>">Edit</a>
                                        </td>
                                        <!-- <td> <a class="btn btn-danger btn-xs delete" id="<?php echo $row["location_id"]; ?>">Delete</a> </td> -->
                                        <td>
                                            <button type="button" name="delete" id="<?php echo $row["supplier_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["supplier_delete"] ?>">Delete
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
                var supplier_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "supplier_action.php",
                        method: "POST",
                        data: {supplier_id: supplier_id, status: status, btn_action: btn_action},
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