<?php 
include '../navbar.php';
 
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">

<?php $master_id = $_GET['id']; ?>

  <section class="content-header">
    <h4>Add Requisition</h4>
    <ol class="breadcrumb">
      <a href="requisition_list.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Requisition List</a>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="alert alert-primary" role="alert" id="alert_action">
          </div>

<?php 

$query = $connect->prepare("SELECT * FROM requisition_master WHERE requisition_master_id = '$master_id' ");
$query->execute();
$result = $query->fetchAll();
 ?>

          <div class="form-group">
            <form name="add_name" id="add_name">
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="date" class="form-control" name="requisition_date" id="requisition_date" value="<?php echo $result[0]['requisition_date']; ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <select class="form-control" name="requisition_port" id="requisition_port">
                      <?php echo filled_port_edit($connect,$result[0]['requisition_port']); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dynamic_field">
                    <tr>
                      <td><input type="text" name="particulars[]" placeholder="Enter your Particulars" class="form-control name_list" /></td>
                      <td><input type="text" name="bill_no[]" placeholder="Enter your HAWB/BL/Exp No" class="form-control name_list" /></td>
                      <td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td>
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Expenses in BD" class="form-control proposed_exp_list" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Expenses in BD" class="form-control approved_exp_list" /></td>
                      <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>

<?php 

$query_requisition = $connect->prepare("SELECT * FROM requisition WHERE requisition_master_id = '$master_id' ");

$query_requisition->execute();

$result_requisition = $query_requisition->fetchAll();


foreach ($result_requisition as $row) {
  

 ?>

                    


                    <tr id="row1">
                      <td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" value="<?php echo $row['particulars'] ?>" /></td>
                      <td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" value="<?php echo $row['bill_no'] ?>"/></td>
                      <td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list"  value="<?php echo $row['department'] ?>" /></td>
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Expenses in BD" class="form-control proposed_exp_list"   value="<?php echo $row['proposed_exp'] ?>" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Expenses in BD" class="form-control approved_exp_list"  value="<?php echo $row['approved_exp'] ?>"  /></td>
                      <td><button type="button" name="remove" id="1" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    
<?php 
} 
?>
                    
                  </table>
                  <input type="hidden" name="action" id="action" class="btn btn-info" value="Edit" />

                  <input type="hidden" name="master_id" id="master_id" class="btn btn-info" value="<?php echo $master_id; ?>" />

                  <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script>
$(document).ready(function(){
var i=1;
$('#add').click(function(){
i++;
$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" /><td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" /></td></td><td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td><td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Expenses in BD" class="form-control proposed_exp_list" /></td><td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Expenses in BD" class="form-control approved_exp_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});

$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id");
$('#row'+button_id+'').remove();
});

$('#submit').click(function(){
$.ajax({
url:"requisition_action.php",
method:"POST",
data:$('#add_name').serialize(),
success:function(data)
{
alert(data);
$('#add_name')[0].reset();
}
});
});

});
</script>