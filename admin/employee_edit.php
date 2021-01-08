<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Employee</h4>
        <ol class="breadcrumb">
            <a href="employee.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Employee</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM employee WHERE employee_id = '$id' ");
        $statement->execute();
        $rowno = $statement->rowCount();
        $result = $statement->fetchAll();
        foreach ($result
        as $row) {
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="alert alert-primary" role="alert" id="alert_action">
                            <form class="form-sample" id="addlocation" action="" method="">
                                <input type="hidden" name="employee_id" id="employee_id"
                                       value=" <?php echo $row['employee_id']; ?> "/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Employee Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_name" id="employee_name"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_name']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_address" id="employee_address"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_address']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_phone" id="employee_phone"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_phone']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_mobile" id="employee_mobile"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_mobile']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_fax" id="employee_fax"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_fax']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_email" id="employee_email"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_email']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Contact Person</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_contact_person"
                                                       id="employee_contact_person" class="form-control"
                                                       value="<?php echo $row['employee_contact_person']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Short Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_short_name" id="employee_short_name"
                                                       class="form-control"
                                                       value="<?php echo $row['employee_short_name']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Credit Sale Limit</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="employee_credit_sale_limit"
                                                       id="employee_credit_sale_limit" class="form-control"
                                                       value="<?php echo $row['employee_credit_sale_limit']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Credit Sale Limit</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                        url: "employee_action.php",
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