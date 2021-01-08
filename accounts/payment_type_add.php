<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Payment Type</h4>
        <ol class="breadcrumb">
            <a href="payment_type.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Payment Type</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addpayment_type">
                        <div class="form-group">
                            <label for="payment_type_name">Payment Type</label>
                            <input type="text" name="payment_type_name" id="payment_type_name"
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
$(document).on('submit', '#addpayment_type', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "payment_type_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addpayment_type')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>