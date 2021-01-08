<?php include '../navbar.php';
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Port</h4>
        <ol class="breadcrumb">
            <a href="port.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Port</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addport">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="location_name">Port name</label>
                                <input type="text" name="port_name" id="port_name" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="location_name">Port Short name</label>
                                <input type="text" name="port_short_name" id="port_short_name" class="form-control" required/>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                            <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>
                        </div>
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
$(document).on('submit', '#addport', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "port_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addport')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>