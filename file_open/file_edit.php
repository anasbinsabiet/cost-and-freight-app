<?php
include '../navbar.php';
include '../function.php';
include '../sidebar.php'; ?>
<!-- <script src="file_edit_script.js"></script> -->

<script type="text/javascript">
    
//////////////////////////////////////////////// Bill Total
// function findTotal1(){
// var arr = document.getElementsByName('particular_amount[]');
// var tot=0;
// for(var i=0;i<arr.length;i++){

//     if(parseInt(arr[i].value))
//     {
//         tot += parseInt(arr[i].value);
//         // alert(tot);
//     }        
// }

// var arr1 = document.getElementsByName('others_amount[]');
// var tot1=0;
//     for(var j=0;j<arr1.length;j++){
//         if(parseInt(arr1[j].value))
//         {
//             tot1 += parseInt(arr1[j].value);
//         }
//     }

// var agent_commission = document.getElementById('agent_commission').value;
// var minimum_commission = document.getElementById('minimum_commission').value;
// var received_advance = document.getElementById('received_advance').value;
// var incometax_comission = document.getElementById('incometax_comission').value;
// var less_amount = document.getElementById('less_amount').value;
// document.getElementById('total').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
// document.getElementById('net_payable').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission)-parseInt(received_advance)-parseInt(incometax_comission)-parseInt(less_amount);
// // alert("TEST");
// }
</script>

<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Bill</h4>
        <ol class="breadcrumb">
            <a href="file.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Bill</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#bill-tab" aria-controls="bill-tab" role="tab" data-toggle="tab"> <i class="fa fa-th"></i> Manage Bill</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="bill-tab">
                            <?php
                            $file_id = 0;
                            $file_id = $_GET['id'];
                            $statement = $connect->prepare("SELECT * FROM files WHERE file_id = '$file_id' ");
                            $statement->execute();
                            $rowno = $statement->rowCount();
                            $result = $statement->fetchAll();
                            foreach ($result as $row) 
                                { 
                                    ?>
                            <!--  <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;"></p> -->
                            <form  class="form-horizontal"  id="edit_bill_form"  >
                                <div class="box-body">
                                    <p class="alert alert-primary" role="alert" id="alert_action" style="display: none;"></p>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="client" class="col-sm-4 control-label">Client Name
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="file_id" class="form-control" id="file_id" value="<?php echo $row['file_id']; ?>">
                                            <select name="client_name" class="form-control" id="client_name"><?php echo filled_customer_name_edit($connect, $row['client_name']); ?></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-4 control-label">Address</label>
                                        <div class="col-sm-8">
                                            <textarea name="client_address" class="form-control" id="client_address" placeholder="Address" rows="6Fst"><?php echo $row['client_address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zone" class="col-sm-4 control-label">Zone</label>
                                        <div class="col-sm-8">
                                        <select class="form-control" name="zone" id="zone" tabindex="-1" aria-hidden="true"><?php echo filled_zone_edit($connect, $row['zone']); ?></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mobile" class="col-sm-4 control-label">Mobile </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $row['mobile']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="attention" class="col-sm-4 control-label">Attention </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="attention" class="form-control" id="attention" value="<?php echo $row['attention']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="weight" class="col-sm-4 control-label">Weight </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="weight" class="form-control" id="weight" value="<?php echo $row['weight']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="carton" class="col-sm-4 control-label">Carton / Roll / Pallet / Box</label>
                                    <div class="col-sm-8">
                                        <div class="input-group" style="width: 100%">
                                            <div style="width: 40%;float: left">
                                                <select class="form-control" name="unit" id="unit" tabindex="-1" aria-hidden="true">
                                                    <?php echo filled_unit_edit($connect, $row['unit']); ?>
                                                </select>
                                            </div>
                                            <input type="text" name="amount" class="form-control" id="amount" value="<?php echo $row['amount']; ?>" style="width: 60%">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods" class="col-sm-4 control-label">Goods Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="goods" class="form-control" id="goods" value="<?php echo $row['goods']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods" class="col-sm-4 control-label">File Status</label>
                                    <div class="col-sm-8">
                                        <select name="status" id="status" class="form-control" tabindex="-1" aria-hidden="true">
                                            <?php echo filled_status_edit($connect, $row['status']); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="model" class="col-sm-4 control-label">Model</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model" class="form-control" id="model" value="<?php echo $row['model']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="col-sm-4 control-label">Quantity</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $row['quantity']; ?>" name="quantity" class="form-control" id="quantity" placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="payment_status" class="col-sm-4 control-label">Payment Status</label>
                                    <div class="col-sm-8">
                                        <select name="payment_status" id="payment_status" class="form-control" tabindex="-1" aria-hidden="true">
                                            <?php echo filled_payment_status_edit($connect, $row['payment_status']); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="payment_date" class="col-sm-4 control-label">Payment date</label>
                                    <div class="col-sm-8">
                                        <?php
                                        if(!empty($row['payment_date'] != "1970-01-01")){ ?>
                                        <input type="text" name="payment_date" value="<?php echo date("d-m-Y", strtotime($row['payment_date'])); ?>" class="form-control" id="payment_date" placeholder="IP Date (2020-11-04)">
                                        <?php } else
                                        { ?>
                                        <input type="text" name="payment_date"  class="form-control" id="payment_date" placeholder="Payment Date (2020-11-04)">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="remarks" class="col-sm-4 control-label">Remarks</label>
                                    <div class="col-sm-8">
                                        <textarea name="remarks" class="form-control" id="remarks"><?php echo $row['remarks']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods" class="col-sm-4 control-label">Export/Import</label>
                                    <div class="col-sm-8">
                                        <select name="exim_type" id="exim_type" class="form-control" tabindex="-1" aria-hidden="true">
                                            <?php $exim_type = $row['exim_type']; ?>
                                            <option value="Export" <?php echo ($exim_type == 'Export')?"selected":"" ?> >Export</option>
                                            <option value="Import" <?php echo ($exim_type == 'Import')?"selected":"" ?> >Import</option>
                                            <option value="Others" <?php echo ($exim_type == 'Others')?"selected":"" ?> >Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="agent_reference" class="col-sm-2 control-label">Bill No </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="<?php echo $row['bill_no']; ?>" name="bill_no" class="form-control" id="bill_no" placeholder="Bill No will be set after submission" readonly="" >
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['bill_no_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="bill_no_date" value="<?php echo date("d-m-Y", strtotime($row['bill_no_date'])); ?>" class="form-control" id="bill_no_date" placeholder="Bill no date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="bill_no_date"  class="form-control" id="bill_no_date" placeholder="Bill no date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agent_reference" class="col-sm-2 control-label">Agent Reference </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="<?php echo $row['agent_reference']; ?>" name="agent_reference" class="form-control" id="agent_reference" placeholder="AGENT REFERENCE">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['bill_of_entry_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="bill_of_entry_date" value="<?php echo date("d-m-Y", strtotime($row['bill_of_entry_date'])); ?>" class="form-control" id="bill_of_entry_date" placeholder="Bill of Entry (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="bill_of_entry_date"  class="form-control" id="bill_of_entry_date" placeholder="Bill of Entry (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="job_no" class="col-sm-2 control-label">Job No: </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="job_no" class="form-control" id="job_no" value="<?php echo $row['job_no']; ?>" placeholder="JOB NO" required="required">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['job_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="job_date" value="<?php echo date("d-m-Y", strtotime($row['job_date'])); ?>" class="form-control" id="job_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="job_date"  class="form-control" id="job_date" placeholder="Job Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="san_no" class="col-sm-2 control-label">Previous Bill No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="previous_bill_no" class="form-control" id="previous_bill_no" value="<?php echo $row['previous_bill_no']; ?>" placeholder="SAN No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['previous_bill_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="previous_bill_date" value="<?php echo date("d-m-Y", strtotime($row['previous_bill_date'])); ?>" class="form-control" id="previous_bill_date" placeholder="Prevoious Bill Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="previous_bill_date"  class="form-control" id="previous_bill_date" placeholder="SAN Date(2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mawb_no" class="col-sm-2 control-label">MAWB No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="mawb_no" value="<?php echo $row['mawb_no']; ?>" class="form-control" id="mawb_no" placeholder="MAWB No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['mawb_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="mawb_date" value="<?php echo date("d-m-Y", strtotime($row['mawb_date'])); ?>" class="form-control" id="mawb_date" placeholder="Mawb Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="mawb_date"  class="form-control" id="mawb_date" placeholder="Mawb Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hawb_no" class="col-sm-2 control-label">HAWB No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="hawb_no" class="form-control" id="hawb_no" value="<?php echo $row['hawb_no']; ?>" placeholder="HAWB No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['hawb_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="hawb_date" value="<?php echo date("d-m-Y", strtotime($row['hawb_date'])); ?>" class="form-control" id="hawb_date" placeholder="Mawb Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="hawb_date"  class="form-control" id="hawb_date" placeholder="Hawb Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bl_no" class="col-sm-2 control-label">BL No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="bl_no" class="form-control" id="bl_no" value="<?php echo $row['bl_no']; ?>" placeholder="BL No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['bl_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="bl_date" value="<?php echo date("d-m-Y", strtotime($row['bl_date'])); ?>" class="form-control" id="bl_date" placeholder="BL Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="bl_date"  class="form-control" id="bl_date" placeholder="Hawb Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exp_no" class="col-sm-2 control-label">EXP No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="exp_no" class="form-control" id="exp_no" value="<?php echo $row['exp_no']; ?>" placeholder="EXP No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['exp_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="exp_date" value="<?php echo date("d-m-Y", strtotime($row['exp_date'])); ?>" class="form-control" id="exp_date" placeholder="Exp Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="exp_date" class="form-control" id="exp_date" placeholder="Exp Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="container_no" class="col-sm-2 control-label">Container No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="container_no" class="form-control" id="container_no" value="<?php echo $row['container_no']; ?>" placeholder="Container No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="invoice_no" class="col-sm-2 control-label">Invoice No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="invoice_no" class="form-control" id="invoice_no" value="<?php echo $row['invoice_no']; ?>" placeholder="Invoice No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['invoice_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="invoice_date" value="<?php echo date("d-m-Y", strtotime($row['invoice_date'])); ?>" class="form-control" id="invoice_date" placeholder="Invoice Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="invoice_date" class="form-control" id="invoice_date" placeholder="Exp Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lc_tt_no" class="col-sm-2 control-label">LC Type</label>
                                    <div class="col-sm-6">
                                        <div class="input-group" style="width: 100%">
                                            <div style="width: 30%;float: left">
                                                <select class="form-control" name="lc_tt_label" tabindex="-1" aria-hidden="true">
                                                    <?php echo filled_lc_type_edit($connect, $row['lc_tt_label']); ?>
                                                </select>
                                            </div>
                                            <input type="text" name="lc_tt_no" class="form-control" id="lc_tt_no" value="<?php echo $row['lc_tt_no']; ?>" placeholder="Number" style="width: 70%">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['lc_tt_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="lc_tt_date" value="<?php echo date("d-m-Y", strtotime($row['lc_tt_date'])); ?>" class="form-control" id="lc_tt_date" placeholder="LC/TT Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="lc_tt_date" class="form-control" id="lc_tt_date" placeholder="Exp Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lca_no" class="col-sm-2 control-label">LCA No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lca_no" class="form-control" id="lca_no" value="<?php echo $row['lca_no']; ?>" placeholder="LCA No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['lca_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="lca_date" value="<?php echo date("d-m-Y", strtotime($row['lca_date'])); ?>" class="form-control" id="lca_date" placeholder="LCA Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="lca_date" class="form-control" id="lca_date" placeholder="Exp Date (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ip_no" class="col-sm-2 control-label">IP No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ip_no" class="form-control" id="ip_no" value="<?php echo $row['ip_no']; ?>" placeholder="IP No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['ip_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="ip_date" value="<?php echo date("d-m-Y", strtotime($row['ip_date'])); ?>" class="form-control" id="ip_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="ip_date"  class="form-control" id="ip_date" placeholder="Bill of Entry (2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ip_job_no" class="col-sm-2 control-label">IP Job No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ip_job_no" class="form-control" id="ip_job_no" value="<?php echo $row['ip_job_no']; ?>" placeholder="IP Job No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['ip_job_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="ip_job_date" value="<?php echo date("d-m-Y", strtotime($row['ip_job_date'])); ?>" class="form-control" id="ip_job_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="ip_job_date"  class="form-control" id="ip_job_date" placeholder="IP Job(2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b_entry_no" class="col-sm-2 control-label">B/Entry No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="b_entry_no" class="form-control" id="b_entry_no" value="<?php echo $row['b_entry_no']; ?>" placeholder="B/Entry No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['b_entry_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="b_entry_date" value="<?php echo date("d-m-Y", strtotime($row['b_entry_date'])); ?>" class="form-control" id="b_entry_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="b_entry_date"  class="form-control" id="b_entry_date" placeholder="B Entry Date(2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bond_no" class="col-sm-2 control-label">Bond No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="bond_no" class="form-control" id="bond_no" value="<?php echo $row['bond_no']; ?>" placeholder="Bond No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['bond_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="bond_date" value="<?php echo date("d-m-Y", strtotime($row['bond_date'])); ?>" class="form-control" id="bond_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="bond_date"  class="form-control" id="bond_date" placeholder="Bond Date(2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="san_no" class="col-sm-2 control-label">SAN No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="san_no" class="form-control" id="san_no" value="<?php echo $row['san_no']; ?>" placeholder="SAN No">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <?php
                                            if(!empty($row['san_date'] != "1970-01-01")){ ?>
                                            <input type="text" name="san_date" value="<?php echo date("d-m-Y", strtotime($row['san_date'])); ?>" class="form-control" id="san_date" placeholder="IP Date (2020-11-04)">
                                            <?php } else
                                            { ?>
                                            <input type="text" name="san_date"  class="form-control" id="san_date" placeholder="SAN Date(2020-11-04)">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="assessable_value" class="col-sm-4 control-label">Assessable Value</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?php echo $row['assessable_value']; ?>" name="assessable_value" class="form-control" id="assessable_value" placeholder="Assessable Value"  required="required">



                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="invoice_value" class="col-sm-4 control-label">Invoice Value</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0 col-sm-12">
                                                    <input type="text" value="<?php echo $row['invoice_value']; ?>" name="invoice_value" class="form-control" id="invoice_value" placeholder="Invoice Value" required="required">
                                                    <div class="input-group-addon currency-addon no-padding no-border" style="width: 60px; font-size: 10px">
                                                        <select class="currency-selector" name="invoice_currency" tabindex="-1" aria-hidden="true">
                                                            <?php echo filled_currency_edit($connect, $row['invoice_currency']); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="san_no" class="col-sm-4 control-label">Port</label>
                                            <div class="col-sm-8">
                                                <select name="port" id="port" class="form-control">
                                                    <?php echo filled_port_edit($connect, $row['port']); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="delivery_date" class="col-sm-4 control-label">Delivery Date</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <?php
                                                    if(!empty($row['delivery_date'] != "1970-01-01")){ ?>
                                                    <input type="text" name="delivery_date" value="<?php echo date("d-m-Y", strtotime($row['delivery_date'])); ?>" class="form-control" id="delivery_date" placeholder="Delivery Date (2020-11-04)">
                                                    <?php } else
                                                    { ?>
                                                    <input type="text" name="delivery_date"  class="form-control" id="delivery_date" placeholder="SAN Date(2020-11-04)">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-sm-4 control-label">Expense Status</label>
                                            <div class="col-sm-8">
                                                <select name="expense_status" id="expense_status" class="form-control" tabindex="-1" aria-hidden="true">
                                                    <?php echo filled_expense_status_edit($connect, $row['expense_status']); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gate_no" class="col-sm-4 control-label">GATE</label>
                                            <div class="col-sm-8">
                                                <select name="gate" id="gate" class="form-control" tabindex="-1" aria-hidden="true">
                                                    <?php echo filled_gate_edit($connect, $row['gate']); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="panel-default row">
                                    
                                    <div class="col-sm-6">
                                        <h5 class="heading">Bill Items</h5>
                                        
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background-color: #efefef">
                                                    <th class="text-center" style="width:6%">S/L</th>
                                                    <th class="text-center" style="width:74%">Bills</th>
                                                    <th class="text-right" style="width:20%">Amount in TK</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bill_content">
                                                <tr><th  colspan='3' align="center">Receivable</th></tr>
                                                <?php
                                                $statement = $connect->prepare("SELECT * FROM file_bill_items LEFT JOIN particular ON particular.particular_id = file_bill_items.particular_id  WHERE particular_type = 'Receivable' AND file_id = '$file_id' ");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                $result = $statement->fetchAll();
                                                $c = 1;
                                                foreach ($result as $row3) {
                                                ?>
                                                <tr class="expense_items">
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $row3['particular_name']; ?>
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="particular_id[]" class="form-control"  value="<?php echo $row3['particular_id']; ?>">
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="particular_name[]" class="form-control"  value="<?php echo $row3['particular_name']; ?>">
                                                    </td>
                                                    <?php
                                                    if ($_SESSION['user_role'] != "User") {
                                                    ?>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal1()" width="50%" class="form-control" name="particular_amount[]" id="particular_amount[]" value="<?php echo $row3['particular_amount']; ?>">
                                                    </td>
                                                    <?php }
                                                    else{ ?>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal1()" class="form-control" name="particular_amount[]" id="particular_amount[]" readonly="" value="<?php echo $row3['particular_amount']; ?>">
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
                                                <tr><th colspan='3' align="center">Miscellaneous</th></tr>
                                                <?php
                                                $statement = $connect->prepare("SELECT * FROM file_bill_items LEFT JOIN particular ON particular.particular_id = file_bill_items.particular_id  WHERE particular_type = 'Miscellaneous' AND file_id = '$file_id'");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                $result = $statement->fetchAll();
                                                $c = 1;
                                                foreach ($result as $row4) {
                                                ?>
                                                <tr class="expense_items">
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $row4['particular_name']; ?>
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="particular_id[]" class="form-control"  value="<?php echo $row4['particular_id']; ?>">
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                    name="particular_name[]" class="form-control"  value="<?php echo $row4['particular_name']; ?>"></td>
                                                    <?php
                                                    if ($_SESSION['user_role'] != "User") {
                                                    ?>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal1()" class="form-control" name="particular_amount[]" id="particular_amount[]" value="<?php echo $row4['particular_amount']; ?>">
                                                    </td>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal1()" class="form-control" id="particular_amount[]" name="particular_amount[]" value="<?php echo $row4['particular_amount']; ?>" readonly>
                                                    </td>
                                                    
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
                                                <tr><th colspan='3' align="center">Others</th></tr>
                                                <?php
                                                $statement = $connect->prepare("SELECT * FROM file_others_items WHERE file_id = '$file_id'");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                $result = $statement->fetchAll();
                                                $p=1;
                                                foreach ($result as $row6 ) { ?>
                                                <tr class="expense_items">
                                                    <td><?php echo $p++; ?></td>
                                                    <td><input type="hidden" style="border: 0px;" readonly=""
                                                        name="others_id[]" id="others_id[]" class="form-control"  value="<?php echo $row6['others_id']; ?>">
                                                        <input type="text" name="others_name[]" class="form-control"  value="<?php echo $row6['others_name']; ?>">
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal1()" name="others_amount[]" id="others_amount[]" class="form-control" value="<?php echo $row6['others_amount']; ?>">
                                                    </td>
                                                </tr>
                                                <?php
                                                } ?>
                                                <!--  <tr>
                                                    <td></td>
                                                    <td>Fixed Miscellaneous Amount</td>
                                                    <td class="text-right"><input type="text" style="border: 0px;" readonly=""
                                                        name="fixed_miscelleneous_amount" id="fixed_miscelleneous_amount" value="<?php echo $row['fixed_miscelleneous_amount']; ?>" class="form-control">
                                                    </td>
                                                </tr> -->



                                                <tr ><th colspan='3' align="center">Commission</th></tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Agency Commission <input style="max-width: 35px" readonly type="text" name="commission_rate" id="commission_rate" value="<?php echo $row['commission_rate']; ?>"> %</strong> </td>
                                                    <td class="text-right"> <strong> <input type="text" class="form-control" name="agent_commission" id="agent_commission" value="<?php echo $row['agent_commission']; ?>" /> </strong> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Minimum Commission</strong> </td>
                                                    <td class="text-right"> <strong> <input type="text" class="form-control" name="minimum_commission" id="minimum_commission" value="<?php echo $row['minimum_commission']; ?>" /> </strong> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Total </strong> </td>
                                                    <td class="text-right"> <strong> <input type="text" readonly="" name="bill_total" id="total" class="form-control" value="<?php echo $row['bill_total']; ?>" readonly="" /> </strong> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Received in Advance </strong> </td>
                                                    <td class="text-right"> <input type="text" class="text-right form-control" id="received_advance" name="received_advance" onkeyup="minus()" value="<?php echo $row['received_advance']; ?>"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Less Incometax on C &amp; F Commission </strong> </td>
                                                    <td class="text-right"> <input type="text" onkeyup="minus()" class="text-right form-control" id="incometax_comission" name="incometax_comission" value="<?php echo $row['incometax_comission']; ?>"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Less Amount </strong> </td>
                                                    <td class="text-right"> <input type="text" onkeyup="minus()" class="text-right form-control" id="less_amount" name="less_amount" value="<?php echo $row['less_amount']; ?>"> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="2"> <strong> Net Payable </strong> </td>
                                                    <td class="text-right"> <input  type="text" class="text-right form-control" id="net_payable" name="net_payable" value="<?php echo $row['net_payable']; ?>" readonly=""> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 class="heading">Expense Items</h5>
                                        
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background-color: #efefef">
                                                    <th class="text-center" style="width:6%">S/L</th>
                                                    <th class="text-center" style="width:74%">Expenses</th>
                                                    <th class="text-right" style="width:20%">Amount in TK</th>
                                                </tr>
                                            </thead>
                                            <tbody id="expense_content">
                                                <tr><th  colspan='3' align="center">Receivable</th></tr>
                                                <?php
                                                $statement = $connect->prepare("SELECT * FROM file_expenses_items LEFT JOIN expenses ON file_expenses_items.expenses_id = expenses.expenses_id WHERE expenses_mr = 'Receivable' AND file_id = '$file_id' ");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                $result = $statement->fetchAll();
                                                $c = 1;
                                                foreach ($result as $row7) {
                                                ?>
                                                <tr class="expense_items">
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $row7['expenses_name']; ?>
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="expenses_id[]" class="form-control"  value="<?php echo $row7['expenses_id']; ?>">
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="expenses_name[]" class="form-control"  value="<?php echo $row7['expenses_name']; ?>">
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal()" class="form-control" name="expenses_amount[]" value="<?php echo $row7['expenses_amount']; ?>">
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr ><th colspan='3' align="center">Miscellaneous</th></tr>
                                                <?php
                                                $statement = $connect->prepare("SELECT * FROM file_expenses_items LEFT JOIN expenses ON file_expenses_items.expenses_id = expenses.expenses_id WHERE expenses_mr = 'Miscellaneous' AND file_id = '$file_id' ");
                                                $statement->execute();
                                                $rowno = $statement->rowCount();
                                                $result = $statement->fetchAll();
                                                $c = 1;
                                                foreach ($result as $row8) {
                                                
                                                ?>
                                                <tr class="expense_items">
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $row8['expenses_name']; ?>
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="expenses_id[]" class="form-control"  value="<?php echo $row8['expenses_id']; ?>">
                                                        <input type="hidden" style="border: 0px;" readonly=""
                                                        name="expenses_name[]" class="form-control"  value="<?php echo $row8['expenses_name']; ?>">
                                                    </td>
                                                    
                                                    <td class="text-right">
                                                        <input type="text" onkeyup="findTotal()" class="form-control" name="expenses_amount[]"  value="<?php echo $row8['expenses_amount']; ?>">
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>  </td>
                                                    <td class="text-right"> <strong> Total </strong> </td>
                                                    <td class="text-right"> <input type="text" class="form-control" readonly="" name="expenses_total" id="exp_grand_total" value="<?php echo $row['expenses_total']; ?>"/> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


<?php 
} 
?>


                        <div class="box-footer">
                            <a href="file.php" class="btn btn-default">Cancel</a>
                            <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                            <input type="submit" name="action" id="action" class="btn btn-success pull-right" value="Save"/>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>


<script type="text/javascript">
    

$(document).ready(function () {




    $("#client_name").change(function(){
        if ($(this).val() != '') {
        var btn_action = $(this).attr("id");
        var query = $(this).val();
        $.ajax({
        url: "files_action.php",
        method: "POST",
        data: {btn_action: btn_action, query: query},
        dataType: "json",
        success: function (data) {
        $('#client_address').val(data.customer_address);
        $('#mobile').val(data.customer_phone);
        $('#fixed_miscelleneous_amount').val(data.fixed_miscelleneous_amount);
        }
        })
        }
        });

////////////////////// Port Select -> Commission Calculation

    $("#port").change(function(){
        if ($(this).val() != '') {
        var btn_action = $(this).attr("id");
        var query = $(this).val();
        var client_id = $("#client_name").val();
        $.ajax({
        url: "files_action.php",
        method: "POST",
        data: {btn_action: btn_action, query: query, client_id: client_id},
        dataType: "json",
        success: function (data) {
            
            var com_rate = data.commission_rate;
             // $('#minimum_commission').val(data.minimum_commission)
            var min_com = data.minimum_commission;

            $('#commission_rate').val(com_rate);

            // alert(com_rate+" - "+min_com);

            var assessable_value = $('#assessable_value').val();
            // var minimum_commission = $("#minimum_commission").val();
            // var commission_rate = $("#commission_rate").val();
            var tac = (assessable_value / 100) * com_rate;

            // alert(tac);

            var commission_amount = 0;

                    if (tac>min_com) {
                        $('#agent_commission').val(tac); 
                        commission_amount = tac;
                        $('#minimum_commission').val(0);  
                    }else{
                        $('#agent_commission').val(0);  
                        $('#minimum_commission').val(min_com); 
                        commission_amount = min_com;
                    }

            
                    /////////auto commission        
                    var arr = document.getElementsByName('particular_amount[]');
                    var tot=0;
                    for(var i=0;i<arr.length;i++){
                    if(parseInt(arr[i].value))
                        {tot += parseInt(arr[i].value);}
                    }

                    // alert(tot);

                    var arr1 = document.getElementsByName('others_amount[]');
                    var tot1=0;
                    for(var j=0;j<arr1.length;j++){
                    if(parseInt(arr1[j].value))
                        {tot1 += parseInt(arr1[j].value);}
                    }

                    alert(tot1+tot);

                    // var fixed_miscelleneous_amount = document.getElementById('fixed_miscelleneous_amount').value;
                    var agent_commission = document.getElementById('agent_commission').value;
                    var minimum_commission = document.getElementById('minimum_commission').value;
                    var received_advance = document.getElementById('received_advance').value;
                    var incometax_comission = document.getElementById('incometax_comission').value;
                    var less_amount = document.getElementById('less_amount').value;
                    document.getElementById('total').value = tot+tot1+commission_amount;
                    document.getElementById('net_payable').value = tot+tot1+commission_amount-parseInt(received_advance)-parseInt(incometax_comission)-parseInt(less_amount);

        }
        })
        }
        });////////////////////// Port Select -> Commission Calculation

////////////////////// Assessable Value Change -> Commission Calculation
    $("#assessable_value").change(function(){
        if ($(this).val() > 0) {
       
        // var query = $(this).val();
        var btn_action = "port";
        var query = $("#port").val();
        var client_id = $("#client_name").val();

            $.ajax({
            url: "files_action.php",
            method: "POST",
            data: {btn_action: btn_action, query: query, client_id: client_id},
            dataType: "json",
            success: function (data) {
                    // $('#commission_rate').val(data.commission_rate);
                    var com_rate = data.commission_rate;
                     // $('#minimum_commission').val(data.minimum_commission)
                    var min_com = data.minimum_commission;

                    // alert(com_rate+" - "+min_com);

                    var assessable_value = $('#assessable_value').val();
                    // var minimum_commission = $("#minimum_commission").val();
                    // var commission_rate = $("#commission_rate").val();
                    var tac = (assessable_value / 100) * com_rate;

                    // alert(tac);

                    var commission_amount = 0;

                    if (tac>min_com) {
                        $('#agent_commission').val(tac); 
                        commission_amount = tac;
                        $('#minimum_commission').val(0);  
                    }else{
                        $('#agent_commission').val(0);  
                        $('#minimum_commission').val(min_com); 
                        commission_amount = min_com;
                    }
                    
                    /////////auto commission        
                    var arr = document.getElementsByName('particular_amount[]');
                    var tot=0;
                    for(var i=0;i<arr.length;i++){
                    if(parseInt(arr[i].value))
                        {tot += parseInt(arr[i].value);}
                    }
                    // alert(tot+" beddop");

                    var arr1 = document.getElementsByName('others_amount[]');
                    var tot1=0;
                    for(var j=0;j<arr1.length;j++){
                    if(parseInt(arr1[j].value))
                        {tot1 += parseInt(arr1[j].value);}
                    }
                    alert(tot1+tot);

                    // var fixed_miscelleneous_amount = document.getElementById('fixed_miscelleneous_amount').value;
                    // var agent_commission = document.getElementById('agent_commission').value;
                    // var minimum_commission = document.getElementById('minimum_commission').value;
                    var received_advance = document.getElementById('received_advance').value;
                    var incometax_comission = document.getElementById('incometax_comission').value;
                    var less_amount = document.getElementById('less_amount').value;
                    document.getElementById('total').value = tot+tot1+commission_amount;
                    document.getElementById('net_payable').value = tot+tot1+commission_amount-parseInt(received_advance)-parseInt(incometax_comission)-parseInt(less_amount);
                    /////////auto commission

                }
            })
        }
        });////////////////////// Assessable Value -> Commission Calculation




        ////////////// Insert
        $(document).on('submit', '#edit_bill_form', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        // alert(form_data);
        $.ajax({
        url: "files_action.php",
        method: "POST",
        data: form_data,
        success: function (data) {
        $('#edit_bill_form')[0].reset();
        // location.reload();
        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
        }
        })
        
        }); ////////////// Insert



        $('#payment_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $('#bill_no_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $('#bill_of_entry_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $('#job_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#mawb_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#hawb_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#bl_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#exp_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#invoice_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#lc_tt_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#lca_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#ip_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#ip_job_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#b_entry_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#bond_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#san_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        }); 
        $('#previous_bill_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $('#delivery_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });       


                                                
}); ////////////////////////// Ready Function

////////////////////////////////////////////// Expense Total
    function findTotal(){
    var arr = document.getElementsByName('expenses_amount[]');
    var tots=0;
    for(var i=0;i<arr.length;i++){
    if(parseInt(arr[i].value))
    tots += parseInt(arr[i].value);
    }
    document.getElementById('exp_grand_total').value = tots;
    }

//////////////////////////////////////////////// Bill Total
function findTotal1(){
var arr = document.getElementsByName('particular_amount[]');
var tot=0;
for(var i=0;i<arr.length;i++){

    if(parseInt(arr[i].value))
    {
        tot += parseInt(arr[i].value);
        // alert(tot);
    }        
}

var arr1 = document.getElementsByName('others_amount[]');
var tot1=0;
    for(var j=0;j<arr1.length;j++){
        if(parseInt(arr1[j].value))
        {
            tot1 += parseInt(arr1[j].value);
        }
    }

var agent_commission = document.getElementById('agent_commission').value;
var minimum_commission = document.getElementById('minimum_commission').value;
var received_advance = document.getElementById('received_advance').value;
var incometax_comission = document.getElementById('incometax_comission').value;
var less_amount = document.getElementById('less_amount').value;
document.getElementById('total').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
document.getElementById('net_payable').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission)-parseInt(received_advance)-parseInt(incometax_comission)-parseInt(less_amount);
// alert("TEST");
}


    // // var fixed_miscelleneous_amount = document.getElementById('fixed_miscelleneous_amount').value;
    // var agent_commission = document.getElementById('agent_commission').value;
    // var minimum_commission = document.getElementById('minimum_commission').value;
    // document.getElementById('total').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
    // document.getElementById('net_payable').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
    // }



        function minus(){
    var total = document.getElementById('total').value;
    var received_advance = document.getElementById('received_advance').value;
    var less_amount = document.getElementById('less_amount').value;
    var incometax_comission = document.getElementById('incometax_comission').value;
    
    var temp1 = parseInt(received_advance)+parseInt(less_amount)+parseInt(incometax_comission);
    document.getElementById('net_payable').value = parseInt(total)-parseInt(temp1);
    }

    // function commission(){
    //     var arr = document.getElementsByName('particular_amount[]');
    // var tot=0;
    // for(var i=0;i<arr.length;i++){
    // if(parseInt(arr[i].value))
    // tot += parseInt(arr[i].value);
    // }
    // var arr1 = document.getElementsByName('others_amount[]');
    // var tot1=0;
    // for(var j=0;j<arr1.length;j++){
    // if(parseInt(arr1[j].value))
    // tot1 += parseInt(arr1[j].value);
    // }
    // // var fixed_miscelleneous_amount = document.getElementById('fixed_miscelleneous_amount').value;
    // var agent_commission = document.getElementById('agent_commission').value;
    // var minimum_commission = document.getElementById('minimum_commission').value;
    // document.getElementById('total').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
    // document.getElementById('net_payable').value = tot+tot1+parseInt(agent_commission)+parseInt(minimum_commission);
    // }
</script>