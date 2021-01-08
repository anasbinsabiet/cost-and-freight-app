<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Ledgerentry List</h4>
    <ol class="breadcrumb">
      <a href="ledgerentry_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Ledgerentry</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="alert alert-primary" role="alert" id="alert_action">
                            <?php
                            $id = $_GET['id'];
                            $query=$connect->prepare("SELECT * FROM ledger_master WHERE ledger_master_id = '$id' ");
                            $query->execute();
                            $row_no = $query->rowCount();
                            $result = $query->fetchAll();
                            $ledger_master_id = $result[0]['ledger_master_id'];
                            
                            // print_r($result);
                            ?>
                            <form class="form-sample" id="order_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Transaction No</label>
                                            <div class="col-sm-12">
                                                <input type="hidden" name="ledger_master_id" id="ledger_master_id" value="<?php echo $ledger_master_id; ?>">
                                                <input type="text" readonly="true" name="transaction_id" id="transaction_id" class="form-control" value=" <?php echo $result[0]['transaction_number']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style='visibility:show;'>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Job No</label>
                                            <div class="col-sm-9">
                                                <input type='text' name="job_no" class="form-control" id="job_no" value='<?php echo $result[0]['job_no']; ?>' >
                                                    
                                            </div>
                                            <!-- <small style="font-size: 7px;">Select if it is necessary</small> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Bill No</label>
                                            <div class="col-sm-6">
                                                <input type='text'  name="bill_no" class="form-control" id="bill_no"  value='<?php echo $result[0]['bill_no']; ?>'>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="ledger_date" id="ledger_date" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Payment Type</label>
                                            <div class="col-sm-6">
                                                
                                                <select name="payment_type" class="form-control" id="payment_type" >
                                                    <?php echo filled_payment_type($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Bill Name</label>
                                            <div class="col-sm-9">
                                                <select name="bill_id" id="bill_id" class="form-control">
                                                    <?php echo filled_ledger_head_all($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Amount</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="bill_amount" id="bill_amount"
                                                class="form-control" />
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Remarks</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="remarks" id="remarks" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <div class="form-group row">
                                        <button type="button" name="add_to_table" id="add_to_table"
                                        class="btn btn-success btn-sm">Add to Table
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p id="demo"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel-heading">
                                            <div class="panel-body">
                                                <table id="stockin_data1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Bill ID</th>
                                                            <th>Date</th>
                                                            <th>Payment Name</th>
                                                            <th>Bill Name</th>
                                                            <th>bill_amount</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $details_query = $connect->prepare("SELECT * FROM ledger_details WHERE ledger_master_id = '$ledger_master_id' ");
                                                        $details_query->execute();
                                                        $details = $details_query->fetchAll();
                                                        foreach ($details as $data) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $data['bill_id']; ?></td>
                                                            <td><?php echo $data['ledger_date']; ?></td>
                                                            <td style="display:none;"><?php echo $data['payment_type']; ?></td>
                                                            <td><?php echo $data['payment_type_name']; ?></td>
                                                            <td><?php echo $data['bill_name']; ?></td>
                                                            <td><?php echo $data['amount']; ?></td>
                                                            <td><?php echo $data['remarks']; ?></td>
                                                            <td style="display:none;"><?php echo $data['ledger_details__id']; ?></td>
                                                            <td style="display:none;"><?php echo $data['ledger_master_id']; ?></td>
                                                            <td>  <button class="btn-remove-data">Remove</button></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary"
                                value="Submit"/>
                            </form>
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
        document.getElementById("action").disabled = true;
        //////////////////////////////// MODAL TABLE ADD
        $('#add_to_table').click(function () {
        var bill_id = document.getElementById("bill_id").value;
        var e = document.getElementById("bill_id");
        var bill_name = e.options[e.selectedIndex].text;
        var ledger_date = document.getElementById("ledger_date").value;
        var payment_type = document.getElementById("payment_type").value;
        var f = document.getElementById("payment_type");
        var payment_type_name = f.options[f.selectedIndex].text;
        var bill_amount = document.getElementById("bill_amount").value;
        var remarks = document.getElementById("remarks").value;
        var details_id = "0";
        var master_id = "0";
        if (isNaN(bill_amount) || bill_amount == "") {
        // ////alert("bill_amount & Price should be Number and Not Empty");
        document.getElementById("demo").innerHTML = "<b style='color:red;'> amount field can not be empty and Charecter</b>";
        } else if (bill_amount < 1) {
        // ////alert("bill_amount & Price should be Number and Not Empty");
        document.getElementById("demo").innerHTML = "<b style='color:red;'> amount field can not be less than One</b>";
        } else {
        //alert ()
        $('#stockin_data1').append($('<tr>')
            .append($('<td>').append(bill_id))
                .append($('<td>').append(ledger_date))
                    .append($('<td style="display:none;">').append(payment_type))
                        .append($('<td>').append(payment_type_name))
                            .append($('<td>').append(bill_name))
                                .append($('<td>').append(bill_amount))
                                .append($('<td>').append(remarks))
                                    .append($('<td style="display:none;">').append(details_id))
                                        .append($('<td style="display:none;">').append(master_id))
                                            .append($('<td> <button class="btn-remove-data">Remove</button></td>'))
                                            )
                                            }
                                            var tablerow = document.getElementById("stockin_data1").rows.length;
                                            // document.getElementById("demo").innerHTML = "Found " + tablerow + " tr elements in the table.";
                                            if (tablerow > 1) {
                                            document.getElementById("action").disabled = false;
                                            }
                                            if (tablerow <2) {
                                            document.getElementById("action").disabled = true;
                                            }
                                            var rowCount = $('#stockin_data1 tr').length;
                                            if (rowCount > 1) {
                                            // document.getElementById("action").disabled = false;
                                            $(".action").attr('disabled', false);
                                            }
                                            if (rowCount < 2) {
                                            // document.getElementById("action").disabled = true;
                                            $(".action").attr('disabled', true);
                                            }
                                            });
                                            //////////////////////////////////////// REMOVE BUTTON
                                            $("#stockin_data1").on('click', '.btn-remove-data', function () {
                                            // alert ('start-remove');
                                            $(this).parents("tr").remove();
                                            var tablerow = document.getElementById("stockin_data1").rows.length;
                                            // document.getElementById("demo").innerHTML = "Found " + tablerow + " tr elements in the table.";
                                            if (tablerow > 1) {
                                            document.getElementById("action").disabled = false;
                                            }
                                            if (tablerow <2) {
                                            document.getElementById("action").disabled = true;
                                            }
                                            var rowCount = $('#stockin_data1 tr').length;
                                            if (rowCount > 1) {
                                            // document.getElementById("action").disabled = false;
                                            $(".action").attr('disabled', false);
                                            }
                                            if (rowCount < 2) {
                                            // document.getElementById("action").disabled = true;
                                            $(".action").attr('disabled', true);
                                            }
                                            });
                                            ///////////////////////////////////// INSERT INTO DB
                                            $(document).on('submit', '#order_form', function (event) {
                                            event.preventDefault();
                                            var tabledata = new Array();
                                            $('#stockin_data1 tr').each(function (row, tr) {
                                            tabledata[row] = {
                                            "bill_id": $(tr).find('td:eq(0)').text()
                                            , "ledger_date": $(tr).find('td:eq(1)').text()
                                            , "payment_type": $(tr).find('td:eq(2)').text()
                                            , "payment_type_name": $(tr).find('td:eq(3)').text()
                                            , "bill_name": $(tr).find('td:eq(4)').text()
                                            , "bill_amount": $(tr).find('td:eq(5)').text()
                                            , "remarks": $(tr).find('td:eq(6)').text()
                                            , "details_id": $(tr).find('td:eq(7)').text()
                                            , "master_id": $(tr).find('td:eq(8)').text()
                                            }
                                            });
                                            tabledata.shift();  // first row is the table header - so remove
                                            tabledata = $.toJSON(tabledata);
                                            tabledata = JSON.stringify(tabledata);
                                            // alert(tabledata);
                                            $.ajax({
                                            url: "ledgerentry_action.php",
                                            method: "POST",
                                            data: {
                                            ledger_master_id: $("input[name='ledger_master_id']").val(),
                                            transaction_id: $("input[name='transaction_id']").val(),
                                            job_no: $("input[name='job_no']").val(),
                                            bill_no: $("input[name='bill_no']").val(),
                                            btn_action: "Edit",
                                            tabledata: tabledata
                                            },
                                            success: function (data) {
                                            $('#order_form')[0].reset();
                                            $('#orderModal').modal('hide');
                                            var table = document.getElementById("stockin_data1");
                                            //or use :  var table = document.all.tableid;
                                            for (var i = table.rows.length - 1; i > 0; i--) {
                                            table.deleteRow(i);
                                            }
                                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                                            $('#action').attr('disabled', false);
                                            orderdataTable.ajax.reload();
                                            setTimeout(function () {
                                            location.reload();
                                            }, 1500)
                                            }
                                            });
                                            });
                                            // $("#job_no").change(function(){
                                            // if ($(this).val() != '') {
                                            // var btn_action = $(this).attr("id");
                                            // var query = $(this).val();
                                            // $.ajax({
                                            // url: "../file_open/bill_action.php",
                                            // method: "POST",
                                            // data: {btn_action: btn_action, query: query},
                                            // // dataType: "json",
                                            // success: function (data) {
                                            // $('#bill_no').html(data);
                                            // }
                                            // })
                                            // }
                                            // });
                                            }); /////// END OF $(document).ready(function()
                                            </script>