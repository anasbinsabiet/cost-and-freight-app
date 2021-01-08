<?php include '../navbar.php';

 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Bank Type</h4>
    <ol class="breadcrumb">
      <a href="bank_type_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Bank Type</a>
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
                                    <th> Bank Type</th>
                                    <th> Status</th>
                                    <th> Edit</th>
                                    <th> Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM bank_type");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['bank_type_delete'] == 0) {
                                        $bank_type_status = "Active";
                                    } else {
                                        $bank_type_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['bank_type_name']) ?>
                                        </td>
                                        <td><?php echo $bank_type_status; ?></td>
                                        <td><a class="btn btn-gradient-primary"
                                               href="bank_type_edit.php?id=<?php echo $row["bank_type_id"]; ?>">Edit</a>
                                        </td>
                                        <!-- <td> <a class="btn btn-gradient-danger delete" id="<?php echo $row["bank_type_id"]; ?>">Delete</a> </td> -->
                                        <td>
                                            <button type="button" name="delete" id="<?php echo $row["bank_type_id"] ?>"
                                                    class="btn btn-gradient-danger delete"
                                                    data-status="<?php echo $row["bank_type_delete"] ?>">Delete
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
                var bank_type_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "bank_type_action.php",
                        method: "POST",
                        data: {bank_type_id: bank_type_id, status: status, btn_action: btn_action},
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