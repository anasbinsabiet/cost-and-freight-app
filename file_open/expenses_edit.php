<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Edit Location</h4>
    <ol class="breadcrumb">
      <a href="expenses.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to expenses</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php
    $id = $_GET['id'];
    $statement = $connect->prepare("SELECT * FROM expenses WHERE expenses_id = '$id' ");
    $statement->execute();
    $rowno = $statement->rowCount();
    $result = $statement->fetchAll();
    foreach ($result
    as $row) {
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
          <form role="form" method="post" id="addexpenses">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="expenses_name">Name</label>
                    <input type="hidden" value="<?php echo $row['expenses_id']; ?>" class="form-control" id="expenses_id" name="expenses_id" required="required">
                    <input type="text" value=" <?php echo $row['expenses_name']; ?> " class="form-control" id="expenses_name" name="expenses_name" placeholder="Name" required="required">
                  </div>
                </div>
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="expenses_type">Type</label>
                    <select name="expenses_type" id="expenses_type" class="form-control" required="">
                      <?php echo filled_expenses_type_edit($connect, $row['expenses_id']); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="expenses_mr">Miscellaneous / Recevable</label>
                    <select name="expenses_mr" id="expenses_mr" class="form-control" required="">
                      <?php $expenses_mr = $row['expenses_mr']; ?>
                      <option value="Miscellaneous" <?php echo ($expenses_mr == 'Miscellaneous')?"selected":"" ?> >Miscellaneous</option>
                      <option value="Receivable" <?php echo ($expenses_mr == 'Receivable')?"selected":"" ?> >Receivable</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="expenses_delete">Status</label>
                    <select name="expenses_delete" id="expenses_delete" class="form-control" required="">
                      <?php echo filled_expenses_delete_edit($connect, $row['expenses_id']); ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
            <input type="submit" name="action" id="action" class="btn btn-primary"
            value="Submit"/>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
  </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script>
$(document).ready(function () {
////////////// Edit
$(document).on('submit', '#addexpenses', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$('#action').attr('disabled', 'disabled');
// alert(form_data);
$.ajax({
url: "expenses_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addexpenses')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
$('#action').attr('disabled', false);
}
})
});
});
</script>