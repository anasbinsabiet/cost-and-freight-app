<?php
include '../navbar.php';
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
  <?php $id = $_GET['id']; ?>
  <section class="content-header">
    <h1>
    Requisition Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="../requisition/requisition_list.php"><i class="fa fa-dashboard"></i>Requisition</a></li>
      <li class="active"> Requisition details</li>
    </ol>
  </section>
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
        <i class="fa fa-globe"></i> ICM Freight <a class="btn btn-primary" href="../requisition/requisition.php">Create New</a>
        <small class="pull-right">Date: <?php echo date("d-M-Y"); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div id="divToPrint" style='font-size: 11px;'>
            <button class="print-link avoid-this btn btn-success">
            Print
            </button>
            <style type="text/css">
                .footer {
                    position: absolute;
                    text-align: center;
                    bottom: 0;
                    left: 0;
                    margin-top: 10px;
                    padding: 10px 0;
                    width: 100%;
                }
                .text-right{
                  text-align: right;
                }
                .myTable { background-color:transparent;border-collapse:collapse; }
                .myTable th { background-color:transparent;width:50%; }
                .myTable td, .myTable th { padding:5px;border:1px solid #ddd; }
            </style>
    <center class="hidden"><img src="../images/header.jpg" alt="logo" style="width: 100%;margin-bottom:40px;height:100px;"></center>
    <?php
    $query = $connect->prepare("SELECT * FROM requisition_master WHERE requisition_master_id = '$id' ");
    $query->execute();
    $result = $query->fetchAll();
    // print_r($result);
    ?>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
        <p><strong>To</strong><br>Proprietor</p>
        <address>
          <strong>ICM Freight</strong><br>
          <!-- <span style="width: 70%; display: block;">Dom-Inno (Sueno) A4 & B4</span> -->
          House#Nahar Plaza, Road# Bangla Motor,<br>
          Bangla Motor, Dhaka-1000<br>
          Phonh No. +88-018-356345<br>
          E-mail: info@icmfreight.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <table class="table table-condensed table-bordered">
          <tbody>
            <tr>
              <td><strong>Requisition No:</strong> <?php echo $result[0]['requisition_no']; ?> </td>
              <td class="text-right">Date:  <?php echo date("d-M-Y", strtotime($result[0]['requisition_date'])); ?> </td>
            </tr>
            <tr>
              <td><strong>Port:</strong> <?php echo get_port_name($connect, $result[0]['requisition_port']); ?></td>
              <td class="text-right"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-condensed table-responsive myTable">
          <thead class="bg-sky">
            <tr>
              <th class="text-center" style="width:5%;">S/L</th>
              <th width="35%">Particulars</th>
              <th width="18%">HAWB/BL/EXP No.</th>
              <th width="17%">Department</th>
              <th class="text-right">Proposed Expenses(BDT)</th>
              <th class="text-right">Approved Expenses(BDT)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query1 = $connect->prepare("SELECT * FROM requisition WHERE requisition_master_id = '$id' ");
            $query1->execute();
            $result1 = $query1->fetchAll();
            // print_r($result);
            $count = 0;
            $t_pro = 0;
            $t_app = 0;
            foreach ($result1 as $row) {
            $t_pro += $row['proposed_exp'];
            $t_app += $row['approved_exp'];
            $count++;
            ?>
            <tr>
              <td class="text-center"><?php echo $count; ?></td>
              <td><?php echo $row['particulars']; ?></td>
              <td><?php echo $row['bill_no']; ?></td>
              <td><?php echo $row['department']; ?></td>
              <td class="text-right"><?php echo $row['proposed_exp']; ?></td>
              <td class="text-right"><?php echo $row['approved_exp']; ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td colspan="4" class="text-right text-bold"> Grand Total(TK)</td>
              <td class="text-right"> <?php echo $t_pro; ?></td>
              <td class="text-right"> <?php echo $t_app; ?></td>
            </tr>
          </tbody>
        </table>
        <!--   <table>
          <tbody>
            <tr>
              <td class="text-bold">TOTAL TK(In Word) : <?php //
                //$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
              //echo $f->format($t_app); ?> Taka Only</td>
            </tr>
          </tbody>
        </table> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="text-muted" style="margin-top: 10px;">
          <!-- IT IS A COMPUTER GENERATED BILL. SIGNATURE & SEAL IS NOT MANDATORY. -->
        </p>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- this row will not appear when printing -->
    <!-- <div class="row no-print">
      <div class="col-xs-12">
        <a href="https://www.nextgen-soft.com/cnfapp/requisitions/print_a4/1" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Print With Pad</a>
      </div>
    </div> -->
    <div class="footer">
      <img src="../images/footer.jpg" width="100%" height="130px">
 <!-- /.col -->
    </div>
  </div>
  </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
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