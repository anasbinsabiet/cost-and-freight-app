<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Size List</h4>
    <ol class="breadcrumb">
      <a href="size_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Size</a>
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
                                    <th> Size Name</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM size");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['size_delete'] == 0) {
                                        $size_status = "Active";
                                    } else {
                                        $size_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['size_name']) ?>
                                        </td>
                                        <td><?php echo $size_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="size_edit.php?id=<?php echo $row["size_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["size_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["size_delete"] ?>">Delete
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
                var size_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "size_action.php",
                        method: "POST",
                        data: {size_id: size_id, status: status, btn_action: btn_action},
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