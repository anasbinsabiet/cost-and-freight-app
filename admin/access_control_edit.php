<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Access Control</h4>
        <ol class="breadcrumb">
            <a href="access_control.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Access Control</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM access_control WHERE access_control_id = '$id' ");
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
                            <form class="form-sample" id="addlocation" action="" method="">
                                <input type="hidden" name="access_control_id" id="access_control_id"
                                       value=" <?php echo $row['access_control_id']; ?> "/>
                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <?php echo filled_user_name_edit($connect, $row['user_id']); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_role_id">Select User Role</label>
                                    <select name="user_role_id" id="user_role_id" class="form-control">
                                        <?php echo filled_user_role_edit($connect, $row['user_role_id']); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="location_id">Select Branch</label>
                                    <select name="location_id" id="location_id" class="form-control">
                                        <?php echo filled_branch_edit($connect, $row['location_id']); ?>
                                    </select>
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
                $(document).on('submit', '#addlocation', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "access_control_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addlocation')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                            // unitdataTable.ajax.reload();
                        }
                    })
                });
            });
        </script>