<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Gate</h4>
        <ol class="breadcrumb">
            <a href="gate.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Gate</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM gate WHERE gate_id = '$id' ");
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
                    <form class="form-sample" id="addgate" action="" method="">
                        <input type="hidden" name="gate_id" id="gate_id" value=" <?php echo $row['gate_id']; ?> "/>
                        <div class="form-group">
                            <label for="gate_name">Gate Name</label>
                            <input type="text" name="gate_name" id="gate_name" class="form-control"
                            value="<?php echo $row['gate_name']; ?> "/>
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
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script>
$(document).ready(function () {
////////////// Edit
$(document).on('submit', '#addgate', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$('#action').attr('disabled', 'disabled');
// alert(form_data);
$.ajax({
url: "gate_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addgate')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
$('#action').attr('disabled', false);
}
})
});
});
</script>