<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Expense Status</h4>
        <ol class="breadcrumb">
            <a href="expense_status.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Expense Status</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM expense_status WHERE expense_status_id = '$id' ");
        $statement->execute();
        $rowno = $statement->rowCount();
        $result = $statement->fetchAll();
        foreach ($result
        as $row) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
                    <form class="form-sample" id="addexpense_status" action="" method="">
                        <input type="hidden" name="expense_status_id" id="expense_status_id"
                        value=" <?php echo $row['expense_status_id']; ?> "/>
                        <div class="form-group">
                            <label for="expense_status_name">Expense Status Name</label>
                            <input type="text" name="expense_status_name" id="expense_status_name"
                            class="form-control"
                            value="<?php echo $row['expense_status_name']; ?> "/>
                        </div>
                        <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                        <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
</div>

<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php include '../footer.php'; ?>
<script>
$(document).ready(function () {
////////////// Edit
$(document).on('submit', '#addexpense_status', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$('#action').attr('disabled', 'disabled');
// alert(form_data);
$.ajax({
url: "expense_status_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addexpense_status')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
$('#action').attr('disabled', false);
}
})
});
});
</script>