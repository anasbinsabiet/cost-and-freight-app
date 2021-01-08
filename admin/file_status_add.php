<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add File Status</h4>
        <ol class="breadcrumb">
            <a href="file_status.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to File Status</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addfile_status">
                        <div class="form-group">
                            <label for="file_status_name">File Status Name</label>
                            <input type="text" name="file_status_name" id="file_status_name"
                            class="form-control" required/>
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
$(document).on('submit', '#addfile_status', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "file_status_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addfile_status')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>