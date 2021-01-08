<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Employee</h4>
        <ol class="breadcrumb">
            <a href="employee.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Employee</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                            <form class="form-sample" id="addlocation">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Employee Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_name" id="employee_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_address" id="employee_address"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Phone Number</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_phone" id="employee_phone"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Mobile Number</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_mobile" id="employee_mobile"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Fax</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_fax" id="employee_fax"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Email Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_email" id="employee_email"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Contact Person</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_contact_person"
                                                       id="employee_contact_person" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Short name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_short_name" id="employee_short_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Credit Sale Limit</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="employee_credit_sale_limit"
                                                       id="employee_credit_sale_limit" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
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
                $(document).on('submit', '#addlocation', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "employee_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addlocation')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');

                        }
                    })
                });
            });
        </script>