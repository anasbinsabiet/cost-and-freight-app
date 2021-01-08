<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Ledger Head</h4>
        <ol class="breadcrumb">
            <a href="ledger_head.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Ledger Head</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addlocation">
                                <div class="form-group">
                                    <label for="ledger_category_id">Select Ledger Category</label>
                                        <select name="ledger_category_id" id="ledger_category_id" class="form-control" required>
                                            <?php echo filled_ledger_category($connect); ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="ledger_head_code">Ledger Code</label>
                                        <input type="text" name="ledger_head_code" id="ledger_head_code" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="ledger_head_name">Ledger Head Name</label>
                                    <input type="text" name="ledger_head_name" id="ledger_head_name" class="form-control" required/>
                                </div>
                        <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                        <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>
                    </form>
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
$(document).on('submit', '#addlocation', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "ledger_head_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addlocation')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>