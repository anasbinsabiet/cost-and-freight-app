<?php include '../navbar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
    Dashboard
    </h1>
    <ol class="breadcrumb"><i class="fa fa-clock-o"></i>
      <?php
      date_default_timezone_set('Asia/Dhaka');
      $date = date('g:i a, j F, Y');
      echo $date;
      ?>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <?php
          $report = "SELECT file_id FROM files WHERE DATE(file_create) = DATE(NOW()) AND file_delete=0";
          $statement = $connect->prepare($report);
          $statement->execute();
          $bill_count = $statement->rowCount();
          ?>
          <div class="inner">
            <h3><?php echo $bill_count; ?></h3>
            <p># of New Bills</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="../file_open/file_add.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <?php
          $today = "SELECT particular_amount FROM file_bill_items WHERE DATE(particular_create) = DATE(NOW())";
          $statement = $connect->prepare($today);
          $statement->execute();
          $rowno = $statement->rowCount();
          $result1 = $statement->fetchAll();
          $total = 0;
          foreach ($result1 as $row1) {
          $total += $row1['particular_amount'];
          }
          ?>
          <div class="inner">
            <h3><?php echo $total; ?> TK</h3>
            <p>Today's Bills Total</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="../file_open/file.php" class="small-box-footer">More info <i
          class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <?php
          $today = "SELECT expenses_amount FROM file_expenses_items WHERE DATE(expenses_create) = DATE(NOW())";
          $statement = $connect->prepare($today);
          $statement->execute();
          $rowno = $statement->rowCount();
          $result1 = $statement->fetchAll();
          $etotal = 0;
          foreach ($result1 as $row1) {
          $etotal += $row1['expenses_amount'];
          }
          ?>
          <div class="inner">
            <h3><?php echo $etotal; ?> TK</h3>
            <p>Today's Expense</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="../file_open/file.php" class="small-box-footer">More info <i
          class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <?php
          $report = "SELECT customer_id FROM customer WHERE DATE(customer_created_at) = DATE(NOW())";
          $statement = $connect->prepare($report);
          $statement->execute();
          $client_count = $statement->rowCount();
          ?>
          <div class="inner">
            <h3><?php echo $client_count; ?></h3>
            <p>New Clients</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="../admin/customer.php" class="small-box-footer">More info <i
          class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-6">
        <!-- Custom tabs (Charts with tabs)-->
        <?php 

                        $report = "SELECT file_create, COUNT(bill_no) AS total_submit FROM files GROUP BY date(file_create)";
                        $statement = $connect->prepare($report);
                        $statement->execute();
                        $rowno = $statement->rowCount();
                        $result1 = $statement->fetchAll();

                        $ts = array();
                        $date = array();
                        $i = 0;
                        foreach ($result1 as $row) {
                        $i++;
                        $ts[$i] = $row['total_submit'];
                        $date[$i] = date("d",strtotime($row['file_create']));
                        }

                        // print_r($result1);

                        $month = date("t");

                        // echo $month;
                        $dataPoints = array();
                        $k = 1;
                        $j = 1;
                        $p = 0;
                        for($p = 1; $p<=$month; $p++)
                        {
                        // echo $p." -> ".$date[$j]."<br>";

                            if(!empty($date[$j]) && $date[$j] == $p )
                            {

                        // echo $p." -> ".$date[$j]." -> ".$ts[$k]."<br>";

                                $points = array("y" => $ts[$k], "label" => "$p" );
                                array_push($dataPoints, $points); 
                                $k++;
                                $j++;
                            }
                            else
                            {
                                $points = array("y" => 0, "label" => "$p" );
                                array_push($dataPoints, $points); 

                            }
                        }

                         ?>
        <div class="nav-tabs-custom">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <!-- /.nav-tabs-custom -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-6 connectedSortable">
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <script>
  var chart_data = {"labels":["1 Nov"],"datasets":[{"label":"Number of Bills","data":["12"],"backgroundColor":"rgba(243, 156, 18, 1)","borderColor":"rgba(243, 156, 18, 0.9)"}]};
  var ctx = document.getElementById("myChart");
  var myCustomerChart = new Chart(ctx, {
  type: 'bar',
  data: chart_data,
  options: {
  responsive: true,
  title: {
  display: true,
  text: 'Daily Bills'
  },
  tooltips: {
  mode: 'index',
  intersect: true,
  },
  hover: {
  mode: 'nearest',
  intersect: true
  },
  scales: {
  xAxes: [{
  display: true,
  scaleLabel: {
  display: true,
  labelString: 'Days'
  }
  }],
  yAxes: [{
  display: true,
  scaleLabel: {
  display: true,
  labelString: 'Bill'
  }
  }]
  }
  }
  });
</script>  
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script src="../assets/js/canvasjs.min.js"></script>
    <script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light1",
        title:{
            text: "Monthly Bill Submission"
        },
        axisY: {
            title: "Bills Submitted in a Day"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.## Bills",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
     
    }
    </script>