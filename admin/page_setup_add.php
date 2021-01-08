<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Page Setup</h4>
        <ol class="breadcrumb">
            <a href="page_setup.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Page Setup</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                            <form class="form-sample" id="addpage_setup">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Page Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="page_name" id="page_name"
                                                       class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="page_url" id="page_url"
                                                       class="form-control" required/>
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
                $(document).on('submit', '#addpage_setup', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "page_setup_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addpage_setup')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        }
                    })
                });
            });
        </script>