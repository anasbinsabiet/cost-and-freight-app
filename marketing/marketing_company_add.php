<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Marketing Company</h4>
        <ol class="breadcrumb">
            <a href="marketing_company.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Marketing Company</a>
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
                                            <label class="col-sm-5 col-form-label">Marketing Company Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_name" id="mcompany_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Marketing Date</label>
                                            <div class="col-sm-7">
                                                <input type="date" name="mcompany_date" id="mcompany_date" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Company Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_address" id="mcompany_address"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Factory Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="factory_address" id="factory_address" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Company Phone</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_phone" id="mcompany_phone"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Owner Phone</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="owner_phone" id="owner_phone" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Company Email</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_email" id="mcompany_email"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Company Contact Person</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_contact_person"
                                                       id="mcompany_contact_person" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label"> Employee</label>
                                            <div class="col-sm-7">
                                                <select type="text" name="employee_id"
                                                       id="employee_id" class="form-control" required>
                                                       <?php echo filled_employee($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Marketing Sector</label>
                                            <div class="col-sm-7">
                                                <select type="text" name="marketing_sector_id"
                                                       id="marketing_sector_id" class="form-control" required>
                                                       <?php echo filled_marketing_sector($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Marketing Zone</label>
                                            <div class="col-sm-7">
                                                <select type="text" name="marketing_zone_id"
                                                       id="marketing_zone_id" class="form-control" required>
                                                       <?php echo filled_marketing_zone($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Remarks</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="remarks" id="remarks" class="form-control" required/>
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
                $(document).on('submit', '#addlocation', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "marketing_company_action.php",
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