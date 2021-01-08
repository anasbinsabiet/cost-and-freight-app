<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Marketing Company</h4>
        <ol class="breadcrumb">
            <a href="marketing_company.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Marketing Company</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM mcompany WHERE mcompany_id = '$id' ");
            $statement->execute();
            $rowno = $statement->rowCount();
            $result = $statement->fetchAll();
            foreach ($result

            as $row) {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                            <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
                            <form class="form-sample" id="addlocation" action="" method="">
                                <input type="hidden" name="mcompany_id" id="mcompany_id"
                                       value=" <?php echo $row['mcompany_id']; ?> "/>
                                 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Marketing Company Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="mcompany_name" id="mcompany_name"
                                                       class="form-control"
                                                       value="<?php echo $row['mcompany_name']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Marketing Date</label>
                                            <div class="col-sm-7">
                                                <input type="date" name="mcompany_date" id="mcompany_date" class="form-control" value="<?php echo $row['mcompany_date']; ?>"  required/>
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
                                                       class="form-control"
                                                       value="<?php echo $row['mcompany_address']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Factory Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="factory_address" id="factory_address" class="form-control" value="<?php echo $row['factory_address']; ?>" required/>
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
                                                       class="form-control"
                                                       value="<?php echo $row['mcompany_phone']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Owner Phone</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="owner_phone" id="owner_phone" class="form-control" value="<?php echo $row['owner_phone']; ?>" required/>
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
                                                       class="form-control"
                                                       value="<?php echo $row['mcompany_email']; ?>"/>
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
                                                       id="mcompany_contact_person" class="form-control"
                                                       value="<?php echo $row['mcompany_contact_person']; ?> "/>
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
                                                       <?php echo filled_employee_edit($connect,$row['employee_id']); ?>
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
                                                       <?php echo filled_marketing_sector_edit($connect, $row['marketing_sector_id']); ?>
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
                                                       <?php echo filled_marketing_zone_edit($connect, $row['marketing_zone_id']); ?>
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
                                                <input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $row['remarks']; ?>" required/>
                                            </div>
                                        </div>
                                    </div>
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
                        url: "marketing_company_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addlocation')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                            // unitdataTable.ajax.reload();
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                            
                        }
                    })
                });
            });
        </script>