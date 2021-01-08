<?php
include '../dashboard/navbar.php';

$page_id = 10;
$user_id = $_SESSION['user_id'];
$statement1 = $connect->prepare("SELECT * FROM page_access WHERE user_id = '$user_id' AND page_id = '$page_id' ");
$statement1->execute();
$rowno = $statement1->rowCount();
if ($rowno > 0) {

include '../function.php'; 

?>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <?php include '../sidebar.php'; ?>
    <!-- partial:partials/_sidebar.html -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Bill Report</h3>
                <span id="alert_action"></span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-sample" method="POST">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Job</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="job_no" id="job_no">
                                                    <?php echo filled_job_no($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Client</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="customer_name" id="customer_name">
                                                    <?php echo filled_customer_name($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Branch</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="branch" name="branch">
                                                    <?php echo filled_zone($connect); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date From</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date_from" id="date_from">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date From</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date_to" id="date_to">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="hidden" name="btn_action" id="btn_action" value="Submit"/>
                                                <input type="submit" value="Submit" class="form-control btn btn-gradient-info btn-fw" name="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
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
                $id = "";
                $date_from = "";
                $date_to = "";
                if(isset($_POST['submit']))
                {
                $job_no = $_POST['job_no'];
                $customer_name = $_POST['customer_name'];
                $branch = $_POST['branch'];
                $date_from = date('Y-m-d',strtotime($_POST['date_from']));
                $date_to = date('Y-m-d',strtotime($_POST['date_to']));
                $query_report = "";
                $query_report .=
                "SELECT * FROM file WHERE "
                ;

                //////////////// File Number Wise

                if(!empty($job_no))
                {
                $query_report .= " job_no = '$job_no' AND ";
                }

                //////////////// Customer Wise

                if(!empty($customer_name))
                {
                $query_report .= " client_name = '$customer_name' AND ";
                }

                //////////////// Branch Wise

                if(!empty($branch))
                {
                $query_report .= " zone = '$branch' AND ";
                }

                //////////////// Date Wise

                $query_report .= " file_delete = 0 ";

                $statement = $connect->prepare($query_report);
                $statement->execute();
                $rowno = $statement->rowCount();
                $result1 = $statement->fetchAll();
                foreach ($result1 as $row) {
                $id = $row['job_no'];
                ?>


                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        <table class="table table-condensed" width="100%">
                            <tbody>
                                <tr>
                                    <td class="text-right"></td>
                                    <td class="text-right" style="text-align: right;">Date: <?php echo date('d/M/Y',strtotime($row['file_create'])); ?></td>
                                </tr>
                                <tr>
                <td><strong>Client Name :</strong>
                    <?php 
                    // if()
                    echo get_customer_name($connect, $row['client_name']) ; 
                    ?>
                </td>
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
                <?php
                }
                }
                ?>
                <br/>
                <div class="row">
                    <div class="col-sm-12 py-5">
                        <table class="table table-condensed table-bordered border" width="100%" style="border: 1px solid #ccc;">
                            <thead class="bg-sky">
                                <tr style="background-color: #ccc;">
                                    <th style="text-align: center; border: 1px solid #5a86ff;">S/L No</th>
                                    <th style="text-align: center; border: 1px solid #5a86ff;">Particulars</th>
                                    <th class="text-right" style="text-align: right; border: 1px solid #5a86ff;">Amount in TK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $bill_report = "SELECT * FROM bill_details LEFT JOIN bill_master ON bill_master.bill_master_id = bill_details.bill_master_id WHERE bill_master.job_no = '$id'  AND bill_details.bill_created_at BETWEEN '$date_from' AND '$date_to' ";



                                $statement1 = $connect->prepare($bill_report);
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
                                <tr style="background-color: #ccc;">
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
    
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include '../footer.php';
}else{
header("location:../dashboard/index.php");
}
?>
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