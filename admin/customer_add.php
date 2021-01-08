<?php include '../navbar.php';

include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Client</h4>
        <ol class="breadcrumb">
            <a href="customer.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Client</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-horizontal" id="addcustomer">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="first_name" class="col-sm-4 control-label">* Customer Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_name" id="customer_name"
                                    class="form-control" placeholder="Enter Customer Name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-4 control-label">* Address</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_address" id="customer_address"
                                    class="form-control" placeholder="Enter Address" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone" class="col-sm-4 control-label">* Phone Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_phone" id="customer_phone"
                                    class="form-control" placeholder="Enter Phone Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_mobile" class="col-sm-4 control-label">* Mobile Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_mobile" id="customer_mobile"
                                    class="form-control" placeholder="Enter Mobile Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_fax" class="col-sm-4 control-label">Fax Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_fax" id="customer_fax"
                                    class="form-control" placeholder="Enter Mobile Number" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_email" class="col-sm-4 control-label">Email Address</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_email" id="customer_email"
                                    class="form-control" placeholder="Enter Email Address" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_contact_person" class="col-sm-4 control-label">Contact Person</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_contact_person" id="customer_contact_person"
                                    class="form-control" placeholder="Contact Person Name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_short_name" class="col-sm-4 control-label">Short name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_short_name" id="customer_short_name"
                                    class="form-control" placeholder="Short name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_credit_sale_limit" class="col-sm-4 control-label">Credit Sale Limit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_credit_sale_limit" id="customer_credit_sale_limit"
                                    class="form-control" placeholder="Enter Amount" required/>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="customer_credit_sale_limit" class="col-sm-4 control-label">Miscelleneous Amount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="fixed_miscelleneous_amount" id="fixed_miscelleneous_amount"
                                    class="form-control" placeholder="Enter Amount" required/>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <?php
                                $statement = $connect->prepare("SELECT * FROM port WHERE port_delete = 0 ");
                                $statement->execute();
                                $rowno = $statement->rowCount();
                                $result = $statement->fetchAll();
                                $c = 1;
                                foreach ($result as $row) {
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Port <?php echo $c++; ?></label>
                                        <div class="col-sm-7">
                                            <input type="hidden" style="border: 0px;" readonly=""
                                                        name="port_id[]" class="form-control"  value="<?php echo $row['port_id']; ?>">
                                            <input type="text" style="border: 0px;" readonly=""
                                                        name="port_name[]" class="form-control"  value="<?php echo $row['port_name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">
                                        Minimum Commission</label>
                                        <div class="col-sm-7">
                                            <input type="float" name="minimum_commission[]" id="minimum_commission"
                                            class="form-control" placeholder="Enter Amount" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Commission Rate (%)</label>
                                        <div class="col-sm-7">
                                            <input type="float" name="commission_rate[]" id="commission_rate"
                                            class="form-control" placeholder="Enter Amount" required/>
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
                            <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                            <input type="submit" name="action" id="action" class="btn btn-success pull-right" value="Save"/>
                        </div>
                        <!-- /.box-footer -->
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
$(document).on('submit', '#addcustomer', function (event) {
event.preventDefault();
var form_data = $(this).serialize();
$.ajax({
url: "customer_action.php",
method: "POST",
data: form_data,
success: function (data) {
$('#addcustomer')[0].reset();
$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
}
})
});
});
</script>