<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit LC type</h4>
        <ol class="breadcrumb">
            <a href="lc_type.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to LC Type</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM lc_type WHERE lc_type_id = '$id' ");
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
                            <form class="form-sample" id="addlc_type" action="" method="">
                                <input type="hidden" name="lc_type_id" id="lc_type_id"
                                       value=" <?php echo $row['lc_type_id']; ?> "/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">LC Type Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="lc_type_name" id="lc_type_name"
                                                       class="form-control"
                                                       value="<?php echo $row['lc_type_name']; ?>"/>
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
        <?php } ?>
        </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
        <script>
            $(document).ready(function () {
                ////////////// Edit
                $(document).on('submit', '#addlc_type', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "lc_type_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addlc_type')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>