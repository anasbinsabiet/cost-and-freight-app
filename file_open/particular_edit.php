<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Edit Particular</h4>
    <ol class="breadcrumb">
      <a href="particular.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Particular</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php
    $id = $_GET['id'];
    $statement = $connect->prepare("SELECT * FROM particular WHERE particular_id = '$id' ");
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
          <form role="form" method="post" id="addparticular">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="particular_name">Name</label>
                    <input type="hidden" value="<?php echo $row['particular_id']; ?>" class="form-control" id="particular_id" name="particular_id" required="required">
                    <input type="text" value=" <?php echo $row['particular_name']; ?> " class="form-control" id="particular_name" name="particular_name" placeholder="Name" required="required">
                  </div>
                </div>
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="particular_description">Description</label>
                    <input type="text" value=" <?php echo $row['particular_description']; ?> " class="form-control" id="particular_description" name="particular_description" placeholder="Description" required="required">
                  </div>
                </div>
                <div class="col-md-3 col-sm-3">
                  <div class="form-group">
                    <label for="particular_type">Miscellaneous / Receivable</label>
                    <select name="particular_type" id="particular_type" class="form-control" required="">
                      <?php $particular_type = $row['particular_type']; ?>
                      <option value="Miscellaneous" <?php echo ($particular_type == 'Miscellaneous')?"selected":"" ?> >Miscellaneous</option>
                      <option value="Receivable" <?php echo ($particular_type == 'Receivable')?"selected":"" ?> >Receivable</option>
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
$(document).on('submit', '#addparticular', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$('#action').attr('disabled', 'disabled');
// alert(form_data);
$.ajax({
url: "particular_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addparticular')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
$('#action').attr('disabled', false);
}
})
});
});
</script>