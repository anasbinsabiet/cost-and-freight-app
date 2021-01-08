<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Access Control</h4>
        <ol class="breadcrumb">
            <a href="access_control.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Access Control</a>
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
                        <div class="form-group ">
                            <label for="user_id">Select User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <?php echo filled_user_name($connect); ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label">Select User Role</label>
                                <select name="user_role_id" id="user_role_id" class="form-control" required>
                                    <?php echo filled_user_role($connect); ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label">Select Branch</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <?php echo filled_branch_name($connect); ?>
                                </select>
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
//alert (form_data);
$.ajax({
url: "access_control_action.php",
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