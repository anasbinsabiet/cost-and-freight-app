<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Zone</h4>
        <ol class="breadcrumb">
            <a href="zone.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Zone</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addzone">
                        <div class="form-group">
                            <label for="">Zone Name</label>
                            <input type="text" name="zone_name" id="zone_name" class="form-control"
                            required/> 
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
$(document).on('submit', '#addzone', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "zone_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addzone')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>