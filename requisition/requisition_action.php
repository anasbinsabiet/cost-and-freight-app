<?php 
// $connect = mysqli_connect("localhost", "root", "", "testing");
include '../db.php';

include '../function.php';
if (isset($_POST["action"])) {
if ($_POST["action"] == "Add") {
	
$requisition_date = trim($_POST["requisition_date"]);
$requisition_port = trim($_POST["requisition_port"]);
$requisition_no = date("syHmid");
$user_id = $_SESSION['user_id'];
$query = $connect->prepare("INSERT INTO requisition_master( user_id, requisition_date, requisition_port, requisition_no) VALUES ( '$user_id' ,'$requisition_date', '$requisition_port', '$requisition_no')");
$query->execute();
$requisition_master_id = $connect->lastInsertId();
$number = count($_POST["particulars"]);
 $total_approved = 0;
if($number > 1)
{
	for($i=0; $i<$number; $i++)
	{
	  $particulars = trim($_POST["particulars"][$i]);
	  $bill_no = trim($_POST["bill_no"][$i]);
      $department = trim($_POST["dept"][$i]);
      $proposed_exp = trim($_POST["proposed_exp"][$i]);
	  $approved_exp = trim($_POST["approved_exp"][$i]);
		if($particulars != '' || $bill_no != '' || $department != '' || $proposed_exp != '')
		{
			if($approved_exp == '')
			{
				$approved_exp = 0;
			}
			$sql = "INSERT INTO requisition(particulars, bill_no, department, proposed_exp, approved_exp, requisition_master_id) VALUES ('$particulars', '$bill_no', '$department', '$proposed_exp', '$approved_exp', '$requisition_master_id')";
			$statement = $connect->prepare($sql);
			$statement->execute();
			
// 			if(!$statement->execute())
//             {
//                 print_r($statement->errorInfo());
//             }
			$total_approved += $approved_exp;
		}
	}
	$approved_query = $connect->prepare("UPDATE requisition_master SET total_approved = '$total_approved' WHERE requisition_master_id = '$requisition_master_id' ");
	$approved_query->execute();
	echo "Requisition Creation Complete";
}
else
{
	echo "Please Enter At Least 1 Requisition";
}
} //////// if action = add
//////////////////////////////////////////////// EDIT
if ($_POST["action"] == "Edit") {
$requisition_master_id = trim($_POST["master_id"]);
$requisition_date = trim($_POST["requisition_date"]);
$requisition_port = trim($_POST["requisition_port"]);
$requisition_no = date("syHmid");
$user_id = $_SESSION['user_id'];
$query = $connect->prepare("UPDATE requisition_master SET user_id = '$user_id', requisition_date = '$requisition_date', requisition_port = '$requisition_port' WHERE requisition_master_id = '$requisition_master_id' ");
$query->execute();
// $requisition_master_id = $connect->lastInsertId();
$delete_previous_req = $connect->prepare("DELETE FROM `requisition` WHERE `requisition`.`requisition_master_id` = '$requisition_master_id' ");
$delete_previous_req->execute();
$number = count($_POST["particulars"]);
 $total_approved = 0;
if($number > 1)
{
	for($i=0; $i<$number; $i++)
	{
	  $particulars = trim($_POST["particulars"][$i]);
	  $bill_no = trim($_POST["bill_no"][$i]);
      $department = trim($_POST["dept"][$i]);
      $proposed_exp = trim($_POST["proposed_exp"][$i]);
	  $approved_exp = trim($_POST["approved_exp"][$i]);
		if($particulars != '' || $bill_no != '' || $department != '' || $proposed_exp != '' )
		{
			if($approved_exp == '')
			{
				$approved_exp = 0;
			}
			$sql = "INSERT INTO requisition(particulars, bill_no, department, proposed_exp, approved_exp, requisition_master_id) VALUES ('$particulars', '$bill_no', '$department', '$proposed_exp', '$approved_exp', '$requisition_master_id')";
			$statement = $connect->prepare($sql);
			$statement->execute();
			
// 			if(!$statement->execute())
//             {
//                 print_r($statement->errorInfo());
//             }
			$total_approved += $approved_exp;
		}
	}
	$approved_query = $connect->prepare("UPDATE requisition_master SET total_approved = '$total_approved' WHERE requisition_master_id = '$requisition_master_id' ");
	$approved_query->execute();
	echo "Requisition Creation Complete";
}
else
{
	echo "Please Enter At Least 1 Requisition";
}
} ////// if action = edit
if($_POST['action'] == 'Delete')
{
	$status = '0';
	$master_id = $_POST['master_id'];
	if($_POST['status'] == '0')
	{
		$status = '1';
	}
	$delete_query = $connect->prepare("UPDATE requisition_master SET requisition_master_delete = '$status' WHERE requisition_master_id = '$master_id' ");
	$delete_query->execute();
	$result = $delete_query->fetchAll();
	if($result)
	{
		echo "Requisition No ".$master_id." Deleted";
	}
}
} ///// if isset action