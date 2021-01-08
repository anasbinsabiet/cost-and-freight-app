<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit User</h4>
        <ol class="breadcrumb">
            <a href="user.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to User</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM user WHERE user_id = '$id' ");
        $statement->execute();
        $rowno = $statement->rowCount();
        $result = $statement->fetchAll();
        foreach ($result
        as $row) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="alert alert-primary" role="alert" id="alert_action">
                            <form class="form-sample" id="addlocation" action="" method="">
                                <input type="hidden" name="user_id" id="user_id" value=" <?php echo $row['user_id']; ?> "/>
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control"
                                    value="<?php echo $row['user_name']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email Address</label>
                                    <input type="text" name="user_email" id="user_email"
                                    class="form-control" value="<?php echo $row['user_email']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Password</label>
                                    <input type="password" name="user_password" id="user_password"
                                    class="form-control" value=""/>
                                </div>
                                <div class="form-group">
                                    <label for="user_role">Role</label>
                                    <select name="user_role" id="user_role" class="form-control">
                                        <?php $user_role = $row['user_role']; ?>
                                            <option value="Master User" <?php echo ($user_role == 'Master User')?"selected":"" ?> >Master User</option>
                                            <option value="Admin" <?php echo ($user_role == 'Admin')?"selected":"" ?> >Admin</option>
                                            <option value="User" <?php echo ($user_role == 'User')?"selected":"" ?> >User</option>
                                    </select>
                                </div>
                                <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
        url: "user_action.php",
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