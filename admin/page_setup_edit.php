<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Page Setup</h4>
        <ol class="breadcrumb">
            <a href="page_setup.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Page Setup</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM page_setup WHERE page_id = '$id' ");
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
                            <form class="form-sample" id="addpage_setup" action="" method="">
                                <input type="hidden" name="page_id" id="page_id"
                                       value=" <?php echo $row['page_id']; ?> "/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Page Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="page_name" id="page_name"
                                                       class="form-control"
                                                       value="<?php echo $row['page_name']; ?> "/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="page_url" id="page_url"
                                                       class="form-control"
                                                       value="<?php echo $row['page_url']; ?> "/>
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
        <?php } ?>
        </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
        <script>
            $(document).ready(function () {
                ////////////// Edit
                $(document).on('submit', '#addpage_setup', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "page_setup_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addpage_setup')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>