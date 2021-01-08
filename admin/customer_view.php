<?php include '../navbar.php';

include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <?php $id = $_GET['id'];
        $statement = $connect->prepare("SELECT * FROM customer WHERE customer_id = '$id' LIMIT 1");
        $statement->execute();
        $rowno = $statement->rowCount();
        $result = $statement->fetchAll();
        foreach ($result
        as $row5) {
        ?>
        <h4>Client Details  <a class="btn btn-success btn-xs" href="customer_edit.php?id=<?php echo $row5["customer_id"]; ?>">Edit</a></h4>
        <?php } ?>
        <ol class="breadcrumb">
            <a href="customer.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Client</a>
        </ol>
    </section> 
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="divToPrint">
                    <button class="print-link avoid-this btn btn-primary" style="margin-bottom: 20px;">
                    Print
                    </button>
                    <style type="text/css">
                .table  td {
                    border: 1px solid #ccc;
                }
                .table {
                    width: 100%;
                }
                .main-footer {
                    font-size: 10px;
                }
                .text-right{
                    text-align: right;
                }
                .text-center{
                    text-align: center;
                }
                .footer {
                    position: absolute;
                    text-align: center;
                    bottom: 0;
                    left: 0;
                    margin-top: 10px;
                    padding: 10px 0;
                    width: 100%;
                }
                body.skin-blue.sidebar-mini .footer {
                    display: none;
                }
            </style>
                    <center class="hidden"><img src="../images/header.jpg" alt="logo" style="width: 100%;margin-bottom:40px;height: 100px;"></center>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered" style="margin-bottom: 30px">
                                        <?php
                                        
                                        $statement = $connect->prepare("SELECT * FROM customer WHERE customer_id = '$id' ");
                                        $statement->execute();
                                        $rowno = $statement->rowCount();
                                        $result = $statement->fetchAll();
                                        foreach ($result
                                        as $row) {
                                        ?>
                                        <tr>
                                            <td><label>Full Name</label></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Address</label></td>
                                            <td><?php echo $row['customer_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Phone Number</label></td>
                                            <td><?php echo $row['customer_mobile']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Fax Number</label></td>
                                            <td><?php echo $row['customer_fax']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Email Address</label></td>
                                            <td><?php echo $row['customer_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Contact Person</label></td>
                                            <td><?php echo $row['customer_contact_person']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Short Name</label></td>
                                            <td><?php echo $row['customer_short_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Credit Sale Limit</label></td>
                                            <td><?php echo $row['customer_credit_sale_limit']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Miscelleneous Amount</label></td>
                                            <td><?php echo $row['fixed_miscelleneous_amount']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <?php
                                        $statement = $connect->prepare("SELECT * FROM client_commission WHERE customer_id = '$id'");
                                        $statement->execute();
                                        $rowno = $statement->rowCount();
                                        $result = $statement->fetchAll();
                                        $p=1;
                                        foreach ($result as $row1) { ?>
                                        <tr>
                                            <td><label>Port</label> <?php echo $p++; ?></td>
                                            <td><?php echo get_port_name($connect, $row1['port_id']); ?></td>
                                            <td><label>Minimum Commission:</label> <?php echo $row1['minimum_commission']; ?></td>
                                            <td><label>Commission Rate: (%) </label> <?php echo $row1['commission_rate']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <img src="../images/footer.jpg" width="100%">
                    </div>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
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
    <script type="text/javascript">
        jQuery(function ($) {
        $("#divToPrint").find('button').on('click', function () {
        $("#divToPrint").print({
        //Use Global styles
        globalStyles: false,
        //Add link with attrbute media=print
        mediaPrint: false,
        //Custom stylesheet
        stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
        //Print in a hidden iframe
        iframe: false,
        //Don't print this
        noPrintSelector: ".avoid-this",
        //Add this at top
        prepend: "",
        //Add this on bottom
        append: "",
        //Log to console when printing is done via a deffered callback
        deferred: $.Deferred().done(function () {
        console.log('Printing done', arguments);
        })
        });
        });
        });
        </script>