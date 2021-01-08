<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Marketing Sector</h4>
        <ol class="breadcrumb">
            <a href="marketing_sector.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Marketing Sector</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addmarketing_sector">
                        <div class="form-group">
                            <label for="marketing_sector_name">Marketing Sector Name</label>
                            <input type="text" name="marketing_sector_name" id="marketing_sector_name" class="form-control" required/>
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
$(document).on('submit', '#addmarketing_sector', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "marketing_sector_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addmarketing_sector')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>