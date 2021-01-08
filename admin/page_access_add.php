<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Page Access</h4>
        <ol class="breadcrumb">
            <a href="page_access.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Page Access</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="alert alert-primary" role="alert" id="alert_action">
                    </div>
                    <form class="form-sample" id="order_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">User Name</label>
                                    <div class="col-sm-9">
                                        <select name="user_id" id="user_id" class="form-control">
                                            <?php echo filled_user_name($connect); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Page ID</label>
                                    <div class="col-sm-6">
                                        <select name="page_id" id="page_id" class="form-control">
                                            <?php echo filled_page_id($connect); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" align="right">
                                        <button type="button" name="add_to_table" id="add_to_table"
                                        class="btn btn-success btn-xs">Add to Table
                                        </button>
                                    </div>
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
                                                    <th>User ID</th>
                                                    <th>Page ID</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                        <input type="submit" name="action" id="action" class="btn btn-primary btn-icon-text"
                        value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script type="text/javascript">
$(document).ready(function () {
//////////////////////////////// MODAL TABLE ADD
$('#add_to_table').click(function () {
var user_id = document.getElementById("user_id").value;
var e = document.getElementById("user_id");
var user_name = e.options[e.selectedIndex].text;
var page_id = document.getElementById("page_id").value;
var page_access_id = "0";
if (isNaN(page_id) || page_id == "") {
// ////alert("page_access_amount & Price should be Number and Not Empty");
document.getElementById("demo").innerHTML = "<b style='color:red;'>page_id field can not be empty and Charecter</b>";
} else if (page_id < 1) {
// ////alert("page_access_amount & Price should be Number and Not Empty");
document.getElementById("demo").innerHTML = "<b style='color:red;'>page_id field can not be less than One</b>";
} else {
$('#stockin_data1').append($('<tr>')
.append($('<td>').append(user_id))
    .append($('<td>').append(page_id))
        .append($('<td style="display:none;">').append(page_access_id))
            .append($('<td> <button class="btn-remove-data">Remove</button></td>'))
            )
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
            // "sl": $(tr).find('td:eq(0)').text()
            "user_id": $(tr).find('td:eq(0)').text()
            , "page_id": $(tr).find('td:eq(1)').text()
            }
            });
            tabledata.shift();  // first row is the table header - so remove
            tabledata = $.toJSON(tabledata);
            tabledata = JSON.stringify(tabledata);
            alert(tabledata);
            $.ajax({
            url: "page_access_action.php",
            method: "POST",
            data: {
            btn_action: "Add",
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
            }); /////// END OF $(document).ready(function()
            </script>