<?php 
include '../navbar.php';
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
<?php 
// $id = $_GET['id']; 
?>

 <script src="../assets/js/kinzi.print.min.js"></script>
<section class="content-header">
  <h1>
    Profit Loss Report
  </h1>
  <ol class="breadcrumb">
    <li><a href="../dashboard/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="../requisition/requisition_list.php"><i class="fa fa-dashboard"></i>Profit Loss</a></li>
    <li class="active"> Profit Loss Report</li>
  </ol>
</section>

<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> ICM Freight 
        <small class="pull-right">Date: <?php echo date("d-F-Y"); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

 <div id="divToPrint" style="font-size: 11px;">
    <button class="print-link avoid-this btn btn-gradient-info btn-fw">
    Print
    </button>
    <style type="text/css">
      .footer {
      position: absolute;
      bottom: 0;
      }
      .myTable { background-color:transparent;border-collapse:collapse; }
      .myTable th { background-color:transparent;width:50%; }
      .myTable td, .myTable th { padding:5px;border:1px solid #ddd; }
    </style>
  <!-- info row -->

  <div class="row invoice-info">
    <div class="col-sm-1 invoice-col"></div>
    <div class="col-sm-10 invoice-col" align="center">
      <img src="../images/header.jpg" width="100%" height="120px">
    </div>
    <div class="col-sm-1 invoice-col"></div>

    <!-- /.col -->
    
</div>
 
<form class="avoid-this" method="POST">
  <div class="row">
    <div class="col-sm-3">
      <select name="client" class="form-control">
    <?php echo filled_customer_name($connect); ?>
  </select>
    </div>


    <div class="col-sm-3">
      <input type="date" name="datefrom"  class="form-control">
    </div>

    <div class="col-sm-3">
      <input type="date" name="dateto" class="form-control">

    </div>
    <div class="col-sm-3">
    <input type="submit" name="submit" value="Submit" class="form-control">
  </div>
  </div>

</form>
<br>
<!-- <div class="row"> -->
<!-- <div class="col-xs-12"> -->

<?php 
if(isset($_POST['submit'])){
if (isset($_POST['client']) && !empty($_POST['client'])) {
  $client = $_POST['client'];

  echo "<table  width='100%'><tr><td></td> <td align='center'><h1>Profit And Loss</h1><br> Client Name: ". get_customer_name($connect,$client)."</td> <td align='right'></td></tr><br><tr></tr>";
}
else
{
  echo "<table  width='100%'><tr><td></td> <td align='center'><h2>Profit And Loss</h2></td> <td align='right'></td></tr><br><tr></tr>";
}

  if (isset($_POST['datefrom']) && !empty($_POST['datefrom']) && isset($_POST['dateto']) && !empty($_POST['dateto'])) {
  $datefrom = $_POST['datefrom'];
  $dateto = $_POST['dateto'];


   echo "<table  width='100%'><tr><td>Date From : ".$datefrom."</td> <td align='center'><h1></h1></td> <td align='right'>Date To : ".$dateto."</td></tr>";
}
 ?>

  <table class="table myTable" width="100%" style="font-size: 11px;">
    <thead class="bg-sky">
      <tr>
        <th style="width:3%;"> S/L </th>
        <th style="width:19%;"> Bill Date </th>
        <th style="width:13%;"> Bill No </th>
        <th style="width:16%;"> Previous Bill No </th>
        <th style="width:14%;"> Total Bill </th>
        <th style="width:13%;"> Total Expense </th>
        <th style="width:13%;"> Less Amount </th>
        <th style="width:14%;"> Profit </th>
      </tr>
    </thead>
    <tbody>
<?php 



  $query1 = "";

  $query1 .= "SELECT * FROM files WHERE ";

  if (isset($_POST['client']) && !empty($_POST['client'])) {
    $client = $_POST['client'];
      $query1 .= " client_name = '$client' AND ";
  }


  if (isset($_POST['datefrom']) && !empty($_POST['datefrom']) && isset($_POST['dateto']) && !empty($_POST['dateto'])) {
  $datefrom = $_POST['datefrom'];
  $dateto = $_POST['dateto'];

  // $query1 .= " bill_no_date BETWEEN '$datefrom' AND '$dateto' AND ";
  $query1 .= " bill_no_date BETWEEN '$datefrom' AND '$dateto' AND ";
}

// if (isset($_POST['dateto']) && !empty($_POST['dateto'])) {
//   $dateto = $_POST['dateto'];
// }

  $query1 .= " file_delete = 0";

  // echo $query1;

  $query = $connect->prepare($query1);
  $query->execute();

  $result1 = $query->fetchAll();

 // print_r($result1);

$count = 0;
$bill_total = 0;
$expenses_total = 0;
$profit = 0;
$total_profit = 0;
$less_aomunt = 0;
  foreach ($result1 as $row) {
    // echo get_employee_name($connect, $row['employee_id']);

    $count++;
    $bill_total += $row['bill_total'];
    $expenses_total += $row['expenses_total'];
    $less_aomunt += $row['less_amount'];
    $profit = $row['bill_total']-$row['expenses_total']-$row['less_amount'];
    
    // echo $less_aomunt;
    $total_profit += $profit;
?>
        <tr>
           <td class="text-center"><?php echo $count; ?></td> 
          <td><?php if(!empty($row['bill_no_date']) && $row['bill_no_date'] != "1970-01-01"){ echo date("d-F-Y", strtotime($row['bill_no_date'])); } ?></td>
          <td><?php echo $row['bill_no']; ?></td>
          <td><?php echo $row['previous_bill_no']; ?></td>
          <td align="right"><?php echo $row['bill_total']; ?></td>
          <td align="right"><?php echo $row['expenses_total']; ?></td>
          <td align="right"><?php echo $row['less_amount']; ?></td>
          
          <td align="right"><?php echo $profit; ?></td>
        
        </tr>
  <?php 
}

   ?>
   <tr>
     <td colspan="4"  align="right">
       TOTAL
     </td>
     <td align="right"><?php echo $bill_total; ?></td>
     <td align="right"><?php echo $expenses_total; ?></td>
     <td align="right"><?php echo $less_aomunt; ?></td>
     <td align="right"><?php echo $total_profit; ?></td>
   </tr>
      
    </tbody>
  </table>
<?php } ?>
<br>
<div class="footer">
    <img src="../images/footer.jpg" width="100%" height="130px">
 <!-- /.col -->
</div>
<!-- /.row -->
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