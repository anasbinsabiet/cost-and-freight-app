<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Add Port</h4>
        <ol class="breadcrumb">
            <a href="role_map.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Role Map</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <span id="alert_action"></span>
                            <form class="form-sample" id="order_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label py-2">User Role</label>
                                            <div class="col-sm-9">
                                                <select name="role_id" id="role_id" class="form-control">
                                                    <?php echo filled_user_role($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
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
                                                            <!-- <th>SL</th> -->
                                                            <th>Role ID</th>
                                                            <th>Role Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="btn_action" id="btn_action" value="Add"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary btn-icon-text"
                                value="Submit"/>      
                            </div>
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
    // var i = 0;
    
    $('#add_to_table').click(function () {
    var role_id = document.getElementById("role_id").value;
    var e = document.getElementById("role_id");
    var role_name = e.options[e.selectedIndex].text;
    var details_id = "0";
    var master_id = "0";
    // i = i++;
    
    $('#stockin_data1').append($('<tr>')
        // .append($('<td>').append(sl))
            .append($('<td>').append(role_id))
                .append($('<td>').append(role_name))
                    .append($('<td style="display:none;">').append(details_id))
                        .append($('<td style="display:none;">').append(master_id))
                            .append($('<td> <button class="btn-remove-data">Remove</button></td>'))
                            )
                            
                            
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
                            
                            $(this).parents("tr").remove();
                            
                            var rowCount = $('#stockin_data1 tr').length;
                            if (rowCount > 1) {
                            
                            $(".action").attr('disabled', false);
                            }
                            if (rowCount < 2) {
                            
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
                            "role_id": $(tr).find('td:eq(0)').text()
                            , "role_name": $(tr).find('td:eq(1)').text()
                            }
                            });
                            tabledata.shift();  // first row is the table header - so remove
                            tabledata = $.toJSON(tabledata);
                            tabledata = JSON.stringify(tabledata);
                            alert(tabledata);
                            $.ajax({
                            url: "role_map_action.php",
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