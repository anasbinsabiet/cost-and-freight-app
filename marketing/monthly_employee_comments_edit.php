<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Monthly Employee Comments</h4>
        <ol class="breadcrumb">
            <a href="monthly_employee_comments.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Monthly Employee Comments</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM monthly_employee_comments WHERE monthly_employee_comments_id = '$id' ");
            $statement->execute();
            $rowno = $statement->rowCount();
            $result = $statement->fetchAll();
            foreach ($result as $row) {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                            <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
                            <form class="form-sample" id="addmonthly_employee_comments" action="" method="">
                                <input type="hidden" name="monthly_employee_comments_id" id="monthly_employee_comments_id" value="<?php echo $row['monthly_employee_comments_id']; ?>"/>
                                
                                <div class="form-group">
                                    <label for="employee_id">Employee Name</label>
                                    <select type="text" name="employee_id" id="employee_id" class="form-control" required>
                                        <?php echo filled_employee_edit($connect, $row['employee_name']); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comments"> Comments </label>
                                    <textarea name="comments" id="comments" class="form-control"  required><?php echo $row['comments']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="comments_date">Comment Date</label>
                                    <input type="date" name="comments_date" id="comments_date" class="form-control" value="<?php echo $row['comments_date']; ?>" required/>
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
                $(document).on('submit', '#addmonthly_employee_comments', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "monthly_employee_comments_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addmonthly_employee_comments')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>