<?php
include '../function.php';
include '../dashboard/navbar.php'; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include '../sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Bank</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="bank.php">Bank</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Bank</li>
                    </ol>
                </nav>
            </div>
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM bank WHERE bank_id = '$id' ");
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
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <span id="alert_action"></span>
                            <form class="form-sample" id="addlocation" action="" method="">
                                <input type="hidden" name="bank_id" id="bank_id"
                                       value=" <?php echo $row['bank_id']; ?> "/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Select Bank Type</label>
                                            <div class="col-sm-9">
                                                <select name="bank_type_id" id="bank_type_id" class="form-control">
                                                    <?php echo filled_bank_type_edit($connect, $row['bank_type_id']); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Bank Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bank_name" id="bank_name" class="form-control"
                                                       value="<?php echo $row['bank_name']; ?> "/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Edit"/>

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
                        url: "bank_action.php",
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