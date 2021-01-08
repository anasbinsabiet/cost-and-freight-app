<?php 
include '../navbar.php';
 
 include '../function.php';
 include '../sidebar.php'; ?>
<div class="content-wrapper">


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
          <div class="form-group">
            <form name="add_name" id="add_name">
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="date" class="form-control" name="requisition_date" id="requisition_date" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <select class="form-control" name="requisition_port" id="requisition_port">
                      <?php echo filled_port($connect); ?>
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
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Amount in BD" class="form-control proposed_exp_list" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Amount in BD" class="form-control approved_exp_list" /></td>
                      <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                    <tr id="row1">
                      <td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" /></td>
                      <td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" /></td>
                      <td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td>
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Amount in BD" class="form-control proposed_exp_list" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Amount in BD" class="form-control approved_exp_list" /></td>
                      <td><button type="button" name="remove" id="1" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    <tr id="row2">
                      <td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" /></td>
                      <td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" /></td>
                      <td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td>
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Amount in BD" class="form-control proposed_exp_list" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Amount in BD" class="form-control approved_exp_list" /></td>
                      <td><button type="button" name="remove" id="2" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    <tr id="row3">
                      <td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" /></td>
                      <td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" /></td>
                      <td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td>
                      <td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Amount in BD" class="form-control proposed_exp_list" /></td>
                      <td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Amount in BD" class="form-control approved_exp_list" /></td>
                      <td><button type="button" name="remove" id="3" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    
                  </table>
                  <input type="hidden" name="action" id="action" class="btn btn-info" value="Add" />
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
$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="particulars[]" placeholder="Enter your particulars" class="form-control name_list" /><td><input type="text" name="bill_no[]" placeholder="Enter your bill no" class="form-control name_list" /></td></td><td><input type="text" name="dept[]" placeholder="Enter your Department" class="form-control dept_list" /></td><td><input type="text" name="proposed_exp[]" placeholder="Enter your Proposed Amount in BD" class="form-control proposed_exp_list" /></td><td><input type="text" name="approved_exp[]" placeholder="Enter your Approved Amount in BD" class="form-control approved_exp_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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