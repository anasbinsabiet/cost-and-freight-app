<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Country</h4>
        <ol class="breadcrumb">
            <a href="country.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Country</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="addcountry">
                        <div class="form-group">
                            <label for="country_name">Country Name</label>
                            <input type="text" name="country_name" id="country_name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <img src="" id="img" width="100" height="100">
                        </div>
                        <div class="form-group">
                          <label for="file">Choose Image</label>
                          <input type="file" class="form-control" id="file" name="file">
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
$(document).on('submit', '#addcountry', function (event) {
    event.preventDefault();
    var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if(extension != '')
        {
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
            {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
    var form_data = $(this).serialize();
    $.ajax({
        url: "country_action.php",
        method: "POST",
        data: form_data,
        success: function (data) {
        $('#addcountry')[0].reset();
        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
        }
    })
});
});
</script>