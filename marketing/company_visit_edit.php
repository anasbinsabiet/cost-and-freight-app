<?php 
include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; 
?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Company Visit</h4>
        <ol class="breadcrumb">
            <a href="company_visit.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Company Visit</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM company_visit WHERE company_visit_id = '$id' ");
            $statement->execute();
            $rowno = $statement->rowCount();
            $result = $statement->fetchAll();
            foreach ($result as $row) {

            ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
                <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
                    <form class="form-sample" id="addcompany_visit" action="" method="">
                        <input type="hidden" name="company_visit_id" id="company_visit_id" value="<?php echo $row['company_visit_id']; ?>"/>
                        <div class="form-group">
                            <label for="company_next_visit_date">Company Name</label>
                            <select name="mcompany_id" id="mcompany_id" class="form-control" required>
                                <?php echo filled_mcompany_edit($connect, $row['mcompany_id']); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_next_visit_date">Employee Name</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <?php echo filled_employee_edit($connect, $row['employee_id'] ); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_next_visit_date">Company Visit Date</label>
                            <input type="date" name="company_visit_date" id="company_visit_date" value="<?php echo $row['company_visit_date']; ?>" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="company_next_visit_date">Company Visit Time</label>
                            <input type="time" name="company_visit_time" id="company_visit_time" value="<?php echo $row['company_visit_time']; ?>" class="form-control" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <input type="text" name="comments" id="comments" value="<?php echo $row['comments']; ?>" class="form-control"  required/>
                        </div>
                        <div class="form-group">
                            <label for="company_visit_remarks">Company Visit Remarks</label>
                            <textarea name="company_visit_remarks" id="company_visit_remarks" class="form-control" required><?php echo $row['company_visit_remarks']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="company_next_visit_date">Company Next Visit Date</label>
                            <input type="date" name="company_next_visit_date" id="company_next_visit_date" class="form-control" value="<?php echo $row['company_next_visit_date']; ?>" required/>
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
                $(document).on('submit', '#addcompany_visit', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "company_visit_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addcompany_visit')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>