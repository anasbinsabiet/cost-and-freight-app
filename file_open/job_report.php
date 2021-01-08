<?php
include '../dashboard/navbar.php';
include '../function.php'; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include '../sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Job Report</h3>
                <span id="alert_action"></span>
            </div>
            <!-- info row -->
            <div id="divToPrint">
                <button class="print-link avoid-this btn btn-gradient-info btn-fw">
                Print
                </button>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-condensed" width="100%">
                            <tbody>
                                <tr>
                                    <td width="30%"><img src="../assets/images/logo.png" style="border-radius:0px!important;width: 120px !important;height: 30px !important;" alt="logo"/></td>
                                    <td align="center" width="40%" class="info">
                                        <p style="line-height: 10px;"><strong>Company Name : </strong>ICM Freight<p/>
                                        <p style="line-height: 10px;"><strong>Address : </strong>Lalbag, Dhaka<p/>
                                        <p style="line-height: 10px;"><strong>Phone : </strong>01714-131050<p/>
                                        <p style="line-height: 10px;"><strong>Email : </strong>info@icmfreight.com<p/>
                                    </td>
                                    <td width="30%"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
                $id = $_GET['id'];
                $statement = $connect->prepare("SELECT * FROM bill_master LEFT JOIN file ON file.job_no = bill_master.job_no WHERE bill_master.bill_master_id = '$id' LIMIT 1");
                $statement->execute();
                $rowno = $statement->rowCount();
                $result = $statement->fetchAll();
                foreach ($result as $row) { ?>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        <table class="table table-condensed" width="100%">
                            <tbody>
                                <tr>
                                    <td class="text-right"></td>
                                    <td class="text-right" style="text-align: right;">Date: <?php echo date('m/d/Y',strtotime($row['bill_created_at'])); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Client Name :</strong><?php echo get_customer_name($connect, $row['client_name']) ; ?></td>
                                    <td style="text-align: right;"><strong>Bill No:</strong> <?php echo $row['bill_no']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Address :</strong> <?php echo $row['client_address']; ?></td>
                                    <td style="text-align: right;"><strong>Agent Reference:</strong> <?php echo $row['agent_reference']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile :</strong> <?php echo $row['mobile']; ?></td>
                                    <td style="text-align: right;"><strong>Job No:</strong> <?php echo $row['job_no']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Zone :</strong> <?php echo get_zone_name($connect, $row['client_name']) ; ?></td>
                                    <td style="text-align: right;"><strong>B/Entry No :</strong> <?php echo $row['b_entry_no']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Invoice Value :</strong>  &#36;<?php echo $row['invoice_value']; ?> USD</td>
                                    <td style="text-align: right;"><strong>Assessable Value :</strong> <?php echo $row['assessable_value']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <br/>
                <div class="row">
                    <div class="col-sm-12 py-5">
                        <table class="table table-condensed table-bordered border" width="100%" style="border: 1px solid #ccc;">
                            <thead class="bg-sky">
                                <tr>
                                    <th style="text-align: center; border: 1px solid #5a86ff;">S/L No</th>
                                    <th style="text-align: center; border: 1px solid #5a86ff;">Particulars</th>
                                    <th class="text-right" style="text-align: right; border: 1px solid #5a86ff;">Amount in TK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $statement1 = $connect->prepare("SELECT * FROM bill_details WHERE bill_master_id = '$id' ");
                                $statement1->execute();
                                $rowno = $statement1->rowCount();
                                $result1 = $statement1->fetchAll();
                                $total = 0;
                                $count = 1;
                                foreach ($result1 as $row1) {
                                $total += $row1['bill_amount']; ?>
                                <tr>
                                    <td style="text-align: center; border: 1px solid #ccc;"><?php echo $count++; ?></td>
                                    <td style="text-align: center; border: 1px solid #ccc;"><?php echo get_ledger_head($connect, $row1['bill_id']) ?></td>
                                    <td class="text-right text-bold" style="text-align: right; border: 1px solid #ccc;"><?php echo htmlentities($row1['bill_amount']) ?> &#2547;</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="text-right text-bold" colspan="2" style="text-align: center; border: 1px solid #ccc;">
                                        TOTAL TK
                                    </td>
                                    <td class="text-right text-bold" style="text-align: right; border: 1px solid #ccc;">
                                        <?php echo $total; ?> &#2547;
                                    </td>
                                </tr>
                            </tbody>
                        </table>                       
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
            </div>
        </div>
        <?php include '../footer.php' ;?>
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