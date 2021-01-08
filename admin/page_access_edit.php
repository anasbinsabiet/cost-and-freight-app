<?php

include '../function.php';
include '../dashboard/navbar.php';
?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include '../sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Page Access</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="page_access.php">Back to Page Access</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Page Access</li>
                    </ol>
                </nav>
            </div>
            <?php
            $id = $_GET['id'];
            
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <span id="alert_action"></span>
                            <form class="form-sample" id="update_form">
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
                                            <label class="col-sm-3 col-form-label">Page</label>
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
                                                    <tbody>
                                                    <?php
                                                    $statement1 = $connect->prepare("SELECT * FROM page_access WHERE user_id = '$id' ");
                                                    $statement1->execute();
                                                    $rowno = $statement1->rowCount();
                                                    $result = $statement1->fetchAll();
                                                    foreach ($result as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['user_id']; ?></td>
                                                            <td><?php echo $row['page_id']; ?></td>
                                                            
                                                            <td>
                                                                <button class="btn-remove-data btn btn-gradient-danger btn-fw">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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

        </div>
        <?php include '../footer.php'; ?>
        <script type="text/javascript">

            $(document).ready(function () {
                //////////////////////////////// MODAL TABLE ADD
                $('#add_to_table').click(function () {
                    var user_id = document.getElementById("user_id").value;
                    var e = document.getElementById("user_id");
                    var user_name = e.options[e.selectedIndex].text;
                    var page_id = document.getElementById("page_id").value;
                    // var page_access_id = document.getElementById("page_access_id").value;
                    if (isNaN(page_id) || page_id == "") {
                        // ////alert("amount & Price should be Number and Not Empty");
                        document.getElementById("demo").innerHTML = "<b style='color:red;'>Page field can not be empty and Charecter</b>";
                    } else if (page_id < 1) {
                        // ////alert("amount & Price should be Number and Not Empty");
                        document.getElementById("demo").innerHTML = "<b style='color:red;'>Page field can not be less than One</b>";
                    } else {
                        //alert ()
                        $('#stockin_data1').append($('<tr>')
                            .append($('<td>').append(user_id))
                            .append($('<td>').append(page_id))
                            // .append($('<td style="display:none;">').append(page_access_id))
                            .append($('<td> <button class="btn-remove-data btn btn-gradient-danger btn-fw">Remove</button></td>'))
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


                ////////////////////////////////////////////// update data to db

                $(document).on('submit', '#update_form', function (event) {
                    event.preventDefault();

                    var tabledata = new Array();
                    // var tabledata1 = "";

                    $('#stockin_data1 tr').each(function (row, tr) {
                        tabledata[row] = {
                            "user_id": $(tr).find('td:eq(0)').text()
                            , "page_id": $(tr).find('td:eq(1)').text()
                            // , "page_access_id": $(tr).find('td:eq(2)').text()
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
                            // page_access_id: $("input[name='page_access_id']").val(),
                            user_id: $("input[name='user_id']").val(),
                            page_id: $("input[name='page_id']").val(),
                            btn_action: "Add",
                            tabledata: tabledata
                        },
                        success: function (data) {
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#alert_action').attr('disabled', false);
                            setTimeout(function () {
                                //location.reload();
                            }, 1500)
                        }
                    });
                });


                ////////////////////////////////////////////// DELETE

                $(document).on('click', '.delete', function () {
                    var page_access_master_id = $(this).attr("id");
                    // var status = "1";
                    var btn_action = "delete";
                    if (confirm("Are you sure you want DELETE?")) {
                        $.ajax({
                            url: "page_access_action.php",
                            method: "POST",
                            data: {page_access_master_id: page_access_master_id, btn_action: btn_action},
                            success: function (data) {
                                $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                                orderdataTable.ajax.reload();
                                setTimeout(function () {
                                    location.reload();
                                }, 1500)
                            }
                        })
                    } else {
                        return false;
                    }
                });


            }); /////// END OF $(document).ready(function()
        </script>