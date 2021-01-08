<?php include '../dashboard/navbar.php'; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include '../sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Create Supplier</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="supplier.php">Supplier</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Supplier</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <span id="alert_action"></span>
                            <form class="form-sample" id="addlocation">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Supplier Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_name" id="supplier_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_address" id="supplier_address"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_phone" id="supplier_phone"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_mobile" id="supplier_mobile"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_fax" id="supplier_fax"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_email" id="supplier_email"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Contact Person</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_contact_person"
                                                       id="supplier_contact_person" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Short name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="supplier_short_name" id="supplier_short_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Add"/>

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
                $(document).on('submit', '#addlocation', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "supplier_action.php",
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