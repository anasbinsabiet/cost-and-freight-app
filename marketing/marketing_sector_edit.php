<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Marketing Sector</h4>
        <ol class="breadcrumb">
            <a href="marketing_sector.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Marketing Sector</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM marketing_sector WHERE marketing_sector_id = '$id' ");
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
                            <form class="form-sample" id="addmarketing_sector" action="" method="">
                                <input type="hidden" name="marketing_sector_id" id="marketing_sector_id" value="<?php echo $row['marketing_sector_id']; ?>"/>
                                <div class="form-group">
                                    <label for="marketing_sector_name">marketing_sector Name</label>
                                    <input type="text" name="marketing_sector_name" id="marketing_sector_name" class="form-control" value="<?php echo $row['marketing_sector_name']; ?>"/>
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
                $(document).on('submit', '#addmarketing_sector', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "marketing_sector_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addmarketing_sector')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>