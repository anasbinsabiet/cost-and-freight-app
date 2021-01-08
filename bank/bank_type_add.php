<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Bank Type</h4>
        <ol class="breadcrumb">
            <a href="bank_type.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Bank Type</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                            <form class="form-sample" id="addbank_type">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Bank Type</label>
                                            <div class="col-sm-9">
                                                <!-- <input type="text" id="bank_type_name" class="form-control" /> -->
                                                <input type="text" name="bank_type_name" id="bank_type_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                                <input type="submit" name="action" id="action" class="btn btn-gradient-info btn-fw" value="Add"/>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../footer.php'; ?>
        <script>
            $(document).ready(function () {
                ////////////// Insert
                $(document).on('submit', '#addbank_type', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "bank_type_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addbank_type')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        }
                    })
                });
            });
        </script>