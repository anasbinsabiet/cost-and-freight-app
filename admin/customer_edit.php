<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Client</h4>
        <ol class="breadcrumb">
            <a href="customer.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Client</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM customer WHERE customer_id = '$id' ");
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
                        <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;">
                        <form class="form-horizontal" id="addlocation" action="" method="">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="first_name" class="col-sm-4 control-label">* Customer Name</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="customer_id" id="customer_id" value=" <?php echo $row['customer_id']; ?> "/>
                                    <input type="text" name="customer_name" id="customer_name"
                                    class="form-control" value="<?php echo $row['customer_name']; ?>" placeholder="Enter Customer Name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-4 control-label">* Address</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_address" id="customer_address"
                                    class="form-control" value="<?php echo $row['customer_address']; ?>" placeholder="Enter Address" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone" class="col-sm-4 control-label">* Phone Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_phone" id="customer_phone"
                                    class="form-control" value="<?php echo $row['customer_phone']; ?>" placeholder="Enter Phone Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_mobile" class="col-sm-4 control-label">* Mobile Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_mobile" id="customer_mobile"
                                    class="form-control" value="<?php echo $row['customer_mobile']; ?>" placeholder="Enter Mobile Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_fax" class="col-sm-4 control-label">Fax Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_fax" id="customer_fax"
                                    class="form-control" value="<?php echo $row['customer_fax']; ?>" placeholder="Enter Fax Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_email" class="col-sm-4 control-label">Email Address</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_email" id="customer_email"
                                    class="form-control" value="<?php echo $row['customer_email']; ?>" placeholder="Enter Email Address" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_contact_person" class="col-sm-4 control-label">Contact Person</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_contact_person" id="customer_contact_person"
                                    class="form-control" value="<?php echo $row['customer_contact_person']; ?>" placeholder="Contact Person Name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_short_name" class="col-sm-4 control-label">Short name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_short_name" id="customer_short_name"
                                    class="form-control" value="<?php echo $row['customer_short_name']; ?>" placeholder="Short name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_credit_sale_limit" class="col-sm-4 control-label">Credit Sale Limit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_credit_sale_limit" id="customer_credit_sale_limit"
                                    class="form-control" value="<?php echo $row['customer_credit_sale_limit']; ?>" placeholder="Enter Amount" required/>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="miscelleneous_amount" class="col-sm-4 control-label">Miscelleneous Amount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="fixed_miscelleneous_amount" id="fixed_miscelleneous_amount"
                                    class="form-control" value="<?php echo $row['fixed_miscelleneous_amount']; ?>" required/>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <?php
                                                $statement = $connect->prepare("SELECT * FROM client_commission WHERE customer_id = '$id'");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                    $result = $statement->fetchAll();
                                                    $p=1;
                                                    foreach ($result as $row6 ) { ?>

                                                    
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Port <?php echo $p++; ?></label>
                                        <div class="col-sm-7">
                                            <input type="hidden" name="port_id[]" id="port_id" value="<?php echo $row6['port_id']; ?>">
                                            <p><?php echo get_port_name($connect, $row6['port_id']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">
                                        Minimum Commission</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="minimum_commission[]" id="minimum_commission"
                                            class="form-control" value="<?php echo $row6['minimum_commission']; ?>" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Commission Rate (%)</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="commission_rate[]" id="commission_rate"
                                            class="form-control" value="<?php echo $row6['commission_rate']; ?>" required/>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="customer.php" class="btn btn-default">Cancel</a>
                            <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                            <input type="submit" name="action" id="action" class="btn btn-success pull-right" value="Save"/>       
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    </div>
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
url: "customer_action.php",
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