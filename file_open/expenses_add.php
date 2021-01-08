<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Manage Expenses</h4>
        <ol class="breadcrumb">
            <a href="expenses.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Expenses</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Expense Item</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" id="addexpenses">
              <div class="box-body">
                <div class="row">
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                          <label for="expenses_name">Name</label>
                          <input type="text" class="form-control" id="expenses_name" name="expenses_name" placeholder="Name" required="required">
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                          <label for="expenses_type">Type</label>
                          <select name="expenses_type" id="expenses_type" class="form-control" required="">
                                <option value="Bill">Bill</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                          <label for="expenses_mr">Miscellaneous / Receivable</label>
                          <select name="expenses_mr" id="expenses_mr" class="form-control" required="">
                                <option value="Miscellaneous">Miscellaneous</option>
                                <option value="Receivable">Receivable</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                          <label for="expenses_delete">Status</label>
                          <select name="expenses_delete" id="expenses_delete" class="form-control" required="">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- /.box-body -->
                  <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                  <input type="submit" name="action" id="action" class="btn btn-primary"
                               value="Submit"/>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Expense List</h3>
            </div>
          <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;"></p>
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> Expenses Name</th>
                                    <th> Type</th>
                                    <th> MR</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $statement = $connect->prepare("SELECT * FROM expenses");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                if ($rowno != 0)
                                {
                                foreach ($result as $row) {

                                    if ($row['expenses_delete'] == 0) {
                                        $expenses_status = "Active";
                                    } else {
                                        $expenses_status = "Inactive";
                                    }

                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo $row['expenses_name']; ?></td>
                                        <td class="py-1"><?php echo $row['expenses_type']; ?></td>
                                        <td class="py-1"><?php echo $row['expenses_mr']; ?></td>
                                        <td><?php echo $expenses_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                               href="expenses_edit.php?id=<?php echo $row["expenses_id"]; ?>">Edit</a>
                                            <button type="button" name="delete" id="<?php echo $row["expenses_id"] ?>"
                                                    class="btn btn-danger btn-xs delete"
                                                    data-status="<?php echo $row["expenses_delete"] ?>">Delete
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
    </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script>
$(document).ready(function () {
////////////// Insert
$(document).on('submit', '#addexpenses', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "expenses_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addexpenses')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
location.reload();
}
})
});
});
</script>
<script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $('#myTable').dataTable({
                    "aaSorting": [[0, 'desc']]
                });
            });
            //////////////////////////////////////////// DELETE
            $(document).on('click', '.delete', function () {
                var expenses_id = $(this).attr('id');
                var status = $(this).data("status");
                var btn_action = 'delete';
                if (confirm("Are you sure you want to change status?")) {
                    $.ajax({
                        url: "expenses_action.php",
                        method: "POST",
                        data: {expenses_id: expenses_id, status: status, btn_action: btn_action},
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