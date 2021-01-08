<?php 
include '../navbar.php';
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Requisition List</h4>
    <ol class="breadcrumb">
      <a href="requisition.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Requisition</a>
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
                                    <th>S/L</th>
                                    <th> Requisition No </th>
                                    <th> Date </th>
                                    <th> Port </th>
                                    <th> Total </th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM requisition_master ORDER BY createdate DESC");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno > 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['requisition_master_delete'] == 0) {
                                        $requisition_master_delete = "<button style='border-radius: 35px;'  class='btn btn-warning btn-xs disabled'>Active</button>";
                                    } else {
                                        $requisition_master_delete = "<button style='border-radius: 35px;' class='btn btn-danger btn-xs disabled'>Inactive</button>";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo htmlentities($row['requisition_master_id']) ?></td>
                                        <td class="py-1">
                                               <a href="requisition_view.php?id=<?php echo htmlentities($row['requisition_master_id']); ?> "> <?php echo htmlentities($row['requisition_no']); ?></a>
                                        </td>
                                        <td class="py-1">
                                            <?php echo date("d-F-Y", strtotime($row['requisition_date'])); ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo get_port_name($connect, $row['requisition_port']) ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo htmlentities($row['total_approved']) ?>
                                        </td>

                                         <td><?php echo $requisition_master_delete; ?></td> 
                                        <td>
                                            <a class="btn btn-success btn-xs" 
                                               href="requisition_edit.php?id=<?php echo $row["requisition_master_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["requisition_master_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["requisition_master_delete"] ?>">Delete
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
                    "aaSorting": [[0 , 'desc']]
                });
            });


            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var master_id = $(this).attr('id');
                var status = $(this).data("status");
                var action = 'Delete';
                if (confirm("Are you sure you want to Delete Requisition No "+master_id+"?")) {
                    $.ajax({
                        url: "requisition_action.php",
                        method: "POST",
                        data: {master_id: master_id, status: status, action: action},
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