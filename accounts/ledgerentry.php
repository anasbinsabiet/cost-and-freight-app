<?php include '../navbar.php';
  
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h4>Ledger Entry</h4>
    <ol class="breadcrumb">
      <a href="ledgerentry_add.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Ledger Entry</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="alert alert-primary" role="alert" id="alert_action">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                  <!-- <th>Transaction ID</th> -->
                                  <th>Transaction Number</th>
                                  <th>Job No</th>
                                  <th>Total Amount</th>
                                  <th>Date</th>
                                  <!-- <th>Report</th> -->
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "
                                  SELECT * FROM ledger_master WHERE ledger_master_delete = 0 ORDER BY ledger_master_id DESC
                                ";

                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                // $data = array();
                                $filtered_rows = $statement->rowCount();

                                  if ($filtered_rows != 0)
                                  {
                                  foreach($result as $row)
                                      {

                                      ?>
                                      <tr>
                                          <!-- <td class="py-1"> <?php //echo $row['ledger_master_id']; ?> </td> -->
                                          <td class="py-1"><?php echo $row['transaction_number']; ?></td>
                                          <td><?php echo $row['job_no']; ?></td>
                                          <td><?php echo $row['ledger_master_total']; ?></td>
                                          <td><?php echo date("d-F-Y",strtotime($row['ledger_master_created_date'])); ?></td>
                                          <!-- <td><a class="btn btn-success btn-xs"
                                                 href="ledgerentry_report.php?id=<?php echo $row["ledger_master_id"]; ?>">Report</a>
                                          </td> -->
                                          <td><a class="btn btn-success btn-xs"
                                                 href="ledgerentry_edit.php?id=<?php echo $row["ledger_master_id"]; ?>">Edit</a>
                                              <button type="button" name="delete"
                                                      id="<?php echo $row["ledger_master_id"] ?>"
                                                      class="btn btn-danger btn-xs delete"
                                                      data-status="<?php echo $row["ledger_master_delete"] ?>">Delete
                                              </button>
                                          </td>
                                      </tr>
                                  <?php
                                      }
                                  ?>
                                  </tbody>
                                  <!-- closing the if mysqli_num_rows if statement -->
                                  <?php } else {
                                      echo "No record found";
                                  } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
  </section> 
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>

   
		
<script type="text/javascript">
  $(document).ready(function(){

 

  $(document).on('click', '.delete', function(){
  var ledgerentry_id = $(this).attr("id");
  var status = $(this).data("status");
  var btn_action = "delete";
  if(confirm("Are you sure you want to Delete?"))
  {
  $.ajax({
  url:"ledgerentry_action.php",
  method:"POST",
  data:{ledgerentry_id:ledgerentry_id, status:status, btn_action:btn_action},
  success:function(data)
  {
  $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						window.reload();
					}
				})
			}
			else
			{
				return false;
			}
		});

    });
</script>