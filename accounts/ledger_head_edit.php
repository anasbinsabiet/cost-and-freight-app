<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit ledger Head</h4>
        <ol class="breadcrumb">
            <a href="ledger_head.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Ledger Head</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM ledger_head WHERE ledger_head_id = '$id' ");
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
                                <input type="hidden" name="ledger_head_id" id="ledger_head_id"
                                       value=" <?php echo $row['ledger_head_id']; ?>"/>
                                        <div class="form-group">
                                            <label for="ledger_category_id">Select Ledger Category</label>
                                                <select name="ledger_category_id" id="ledger_category_id"
                                                        class="form-control">
                                                    <?php echo filled_ledger_category_edit($connect, $row['ledger_category_id']); ?>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ledger_head_code">Ledger Head Code</label>
                                                <input type="text" name="ledger_head_code" id="ledger_head_code"
                                                       class="form-control"
                                                       value="<?php echo $row['ledger_head_code']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="ledger_head_name">Ledger Head Name</label>
                                                <input type="text" name="ledger_head_name" id="ledger_head_name"
                                                       class="form-control"
                                                       value="<?php echo $row['ledger_head_name']; ?>"/>
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
                $(document).on('submit', '#addlocation', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "ledger_head_action.php",
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