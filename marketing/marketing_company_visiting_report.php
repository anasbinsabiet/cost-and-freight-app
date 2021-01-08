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
        <i class="fa fa-globe"></i> ICM Freight 
        <small class="pull-right">Date: <?php echo date("d-F-Y"); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

 <div id="divToPrint">
                <button class="print-link avoid-this btn btn-gradient-info btn-fw">
                Print
                </button>
                <style type="text/css">
                .footer {
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                }
                .myTable { background-color:transparent;border-collapse:collapse; }
                .myTable th { background-color:transparent;width:50%; }
                .myTable td, .myTable th { padding:5px;border:1px solid #ddd; }
            </style>
  <!-- info row -->

  <div class="row invoice-info">
    <div class="col-sm-1 invoice-col"></div>
    <div class="col-sm-10 invoice-col" align="center">
      <img src="../images/header.jpg" width="100%" height="100px">
    </div>
    <div class="col-sm-1 invoice-col"></div>

    <!-- /.col -->
    
</div>
 
<form class="avoid-this" method="POST">
  <div class="row">
    <div class="col-sm-3">
      <select name="client" class="form-control">
    <?php echo filled_mcompany($connect); ?>
  </select>
    </div>
    <div class="col-sm-3">
      <select name="zone" class="form-control">
    <?php echo filled_marketing_zone($connect); ?>
  </select>
    </div>
    <div class="col-sm-3">
      <select name="employee" class="form-control">
    <?php echo filled_employee($connect); ?>
  </select>
    </div>
</div>
<br>
<div class="row">
  <div class="col-sm-3">
      <select name="sector" class="form-control">
    <?php echo filled_marketing_sector($connect); ?>
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
  if (isset($_POST['datefrom']) && !empty($_POST['datefrom']) && isset($_POST['dateto']) && !empty($_POST['dateto'])) {
  $datefrom = $_POST['datefrom'];
  $dateto = $_POST['dateto'];

  echo "<table  width='100%'><tr><td></td> <td align='center'><h1>Marketing Customer List</h1></td> <td align='right'></td></tr>";
   echo "<table  width='100%'><tr><td>Date From : ".$datefrom."</td> <td align='center'><h1></h1></td> <td align='right'>Date To : ".$dateto."</td></tr>";
}
 ?>

  <table class="table myTable" width="100%">
    <thead class="">
      <tr>
        <th>Date</th>
        <th>Client Name</th>
        <th> Address</th>
        <th> Phone</th>
        <th> Email</th>
        <th>Contact Person Name</th>
        <th>Visit Employee</th>
        <th>Comment</th>
        <th>Next Visit</th>
      </tr>
    </thead>
    <tbody>
<?php 



  $query1 = "";

  $query1 .= "SELECT *, company_visit.employee_id AS employee_id  FROM `mcompany` LEFT JOIN company_visit ON mcompany.mcompany_id = company_visit.mcompany_id WHERE ";

  if (isset($_POST['client']) && !empty($_POST['client'])) {
    $client = $_POST['client'];
      $query1 .= " mcompany.mcompany_id = '$client' AND ";
  }

  if (isset($_POST['zone'])  && !empty($_POST['zone'])) {
    $zone = $_POST['zone'];
      $query1 .= " mcompany.marketing_zone_id = '$zone' AND ";
  }

  if (isset($_POST['employee'])  && !empty($_POST['employee'])) {
    $employee = $_POST['employee'];
      $query1 .= " company_visit.employee_id = '$employee' AND ";
  }

  if (isset($_POST['sector'])  && !empty($_POST['sector'])) {
    $sector = $_POST['sector'];
      $query1 .= " mcompany.marketing_sector_id = '$sector' AND ";
  }

  if (isset($_POST['datefrom']) && !empty($_POST['datefrom']) && isset($_POST['dateto']) && !empty($_POST['dateto'])) {
  $datefrom = $_POST['datefrom'];
  $dateto = $_POST['dateto'];

  $query1 .= " mcompany.mcompany_date BETWEEN '$datefrom' AND '$dateto' AND ";
}

// if (isset($_POST['dateto']) && !empty($_POST['dateto'])) {
//   $dateto = $_POST['dateto'];
// }

  $query1 .= " mcompany_delete = 0";

  // echo $query1;

  $query = $connect->prepare($query1);
  $query->execute();

  $result1 = $query->fetchAll();

 // print_r($result1);

  foreach ($result1 as $row) {
    // echo get_employee_name($connect, $row['employee_id']);

?>
        <tr>
          <!-- <td class="text-center"><?php //echo $count; ?></td> -->
          <td><?php if(!empty($row['mcompany_date'])){ echo date("d-F-Y", strtotime($row['mcompany_date'])); } ?></td>
          <td><?php echo $row['mcompany_name']; ?></td>
          <td><?php echo "Company Address : ".$row['mcompany_address']."<br>Factory Address : ".$row['factory_address']; ?></td>
          <td><?php echo "Company Phone : ".$row['mcompany_phone']."<br>Factory Phone : ".$row['owner_phone']; ?></td>
          <td><?php echo $row['mcompany_email']; ?></td>
          <td><?php echo $row['mcompany_contact_person']; ?></td>
          <td><?php echo get_employee_name($connect, $row['employee_id']); ?></td>
          <td><?php echo $row['remarks']; ?></td>
          <td><?php if(!empty($row['company_visit_date'])){ echo date("d-F-Y", strtotime($row['company_visit_date'])); } ?></td>

        </tr>
  <?php 
}
   ?>
      
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
<!-- </div> -->
<!-- /.col -->
<!-- </div> -->
<br>
<div class="footer">
    <img src="../images/footer.jpg" width="100%" height="130px">
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