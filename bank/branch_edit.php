<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Branch</h4>
        <ol class="breadcrumb">
            <a href="branch.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Branch</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM branch WHERE branch_id = '$id' ");
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
                                <input type="hidden" name="branch_id" id="branch_id"
                                       value=" <?php echo $row['branch_id']; ?> "/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Select Bank</label>
                                            <div class="col-sm-7">
                                                <select name="bank_id" id="bank_id" class="form-control">
                                                    <?php echo filled_bank_edit($connect, $row['bank_id']); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Branch Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="branch_name" id="branch_name"
                                                       class="form-control"
                                                       value="<?php echo $row['branch_name']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Branch Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="branch_address" id="branch_address"
                                                       class="form-control"
                                                       value="<?php echo $row['branch_address']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Branch Phone</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="branch_phone" id="branch_phone"
                                                       class="form-control"
                                                       value="<?php echo $row['branch_phone']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Branch Email</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="branch_email" id="branch_email"
                                                       class="form-control"
                                                       value="<?php echo $row['branch_email']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Contact Person</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="branch_contact_person"
                                                       id="branch_contact_person" class="form-control"
                                                       value="<?php echo $row['branch_contact_person']; ?> "/>
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
                        url: "branch_action.php",
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