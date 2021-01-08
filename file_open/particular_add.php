<?php include '../navbar.php';
include '../db.php';
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Bill Items</h4>
        <ol class="breadcrumb">
            <a href="particular.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Particular</a>
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
              <h3 class="box-title">Add Bill Item</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" id="addparticular">
              <div class="box-body">
                <div class="row">
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                          <label for="particular_name">Name</label>
                          <input type="text" class="form-control" id="particular_name" name="particular_name" placeholder="Enter Name" required="required">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                          <label for="particular_description">Description</label>
                          <input type="text" class="form-control" id="particular_description" name="particular_description" placeholder="Enter Description" required="required">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                          <label for="particular_mr">Miscellaneous / Receivable</label>
                          <select name="particular_type" id="particular_type" class="form-control" required="">
                                <option value="Miscellaneous">Miscellaneous</option>
                                <option value="Receivable">Receivable</option>
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
              <h3 class="box-title">Bill List</h3>
            </div>
            <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> Particular Name</th>
                                        <th> Description</th>
                                        <th> Type</th>
                                        <th> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $statement = $connect->prepare("SELECT * FROM particular");
                                    $statement->execute();
                                    $rowno = $statement->rowCount();
                                    $result = $statement->fetchAll();
                                    if ($rowno != 0)
                                    {
                                    foreach ($result as $row) {
                                    if ($row['particular_delete'] == 0) {
                                    $particular_status = "Active";
                                    } else {
                                    $particular_status = "Inactive";
                                    }
                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo $row['particular_name']; ?></td>
                                        <td class="py-1"><?php echo $row['particular_description']; ?></td>
                                        <td class="py-1"><?php echo $row['particular_type']; ?></td>
                                        <td><?php echo $particular_status; ?></td>
                                        <td><a class="btn btn-success btn-xs"
                                        href="particular_edit.php?id=<?php echo $row["particular_id"]; ?>">Edit</a>
                                        <button type="button" name="delete" id="<?php echo $row["particular_id"] ?>"
                                        class="btn btn-danger btn-xs delete"
                                        data-status="<?php echo $row["particular_delete"] ?>">Delete
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
$(document).on('submit', '#addparticular', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "particular_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addparticular')[0].reset();
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
var particular_id = $(this).attr('id');
var status = $(this).data("status");
var btn_action = 'delete';
if (confirm("Are you sure you want to change status?")) {
$.ajax({
url: "particular_action.php",
method: "POST",
data: {particular_id: particular_id, status: status, btn_action: btn_action},
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