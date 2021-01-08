<?php
include '../db.php';
//ledgerentry_action.php

include('../db.php');

include('../function.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO ledger_master ( transaction_number ,  user_id ,  job_no ,  bill_no ) 
		VALUES (:transaction_number , :user_id , :job_no , :bill_no)
		";
    
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id'				=>	$_SESSION["user_id"],
				':transaction_number'	=>	$_POST['transaction_id'],
				':job_no'				=>	$_POST['job_no'],
				':bill_no'				=>	$_POST['bill_no']
			)
		);
		$result = $statement->fetchAll();
		$statement = $connect->query("SELECT LAST_INSERT_ID()");
		$ledger_master_id = $statement->fetchColumn();
   

    $total_amount = 0;

		if(isset($ledger_master_id))
		{

			$json1 = json_decode($_POST['tabledata']);
            $queries = json_decode($json1);
			foreach ($queries as $query) {
				 				
				$sub_query = "
				INSERT INTO  ledger_details ( ledger_master_id ,  bill_id ,  ledger_date ,  payment_type ,  payment_type_name ,  bill_name ,  amount, remarks ) VALUES (:ledger_master_id, :bill_id, :ledger_date, :payment_type, :payment_type_name, :bill_name, :amount, :remarks)
				";
        

        
				$statement = $connect->prepare($sub_query);
				$statement->execute(
					array(
						':ledger_master_id'		=>	$ledger_master_id,
						':bill_id'				=>	$query->bill_id,
						':ledger_date'			=>	$query->ledger_date,
						':payment_type'			=>	$query->payment_type,
						':payment_type_name'	=>	$query->payment_type_name,
						':bill_name'			=>	$query->bill_name,
						':amount'				=>	$query->bill_amount,
						':remarks'				=>	$query->remarks
					)
				);

				$total_amount += $query->bill_amount;

			}

			$update_query = "
			UPDATE ledger_master 
			SET ledger_master_total = '".$total_amount."' 
			WHERE ledger_master_id = '".$ledger_master_id."'
			";
			$statement = $connect->prepare($update_query);
			$statement->execute();
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Ledger Entry Created...';
				echo '<br />';
				echo $total_amount;
				echo '<br />';
				echo $ledger_master_id;
			}
		}
	}



   
if ($_POST['btn_action'] == 'Edit') {
        $user_id = $_SESSION["user_id"];

        $ledger_master_id = $_POST['ledger_master_id'];
        $job_no = $_POST['job_no'];
        $bill_no = $_POST['bill_no'];

        // echo $bill_master_id."<br>";

        $query = "UPDATE ledger_master SET user_id ='$user_id', job_no='$job_no', bill_no='$bill_no' WHERE ledger_master_id = '$ledger_master_id'";

        $statement = $connect->prepare($query);
        $statement->execute();

        if ($statement->execute()) {
            echo " MASTER UPDATED <br>";
        }
        
                // if($statement->execute())
                // {
                //   echo "<br>MASTER UPDATEDdd";
                // }
                // else
                // {
                //  echo $statement->errorInfo();
                // }
    
    
        $result2 = $statement->fetchAll();


        $json1 = json_decode($_POST['tabledata']);


        $queries = json_decode($json1);

        $details_id_db = "";
        $details_id = array();
        $lol = array();
        $m = 0;
        $total_amount = 0;
        foreach ($queries as $query) {
            $details_id[$m] = $query->details_id;
            $m++;
            $total_amount += $query->bill_amount;
        }

        // echo $total_amount;

        // echo "1- ";
        // print_r($details_id);


        $check_query = "SELECT ledger_details__id, ledger_master_id, amount FROM ledger_details WHERE ledger_master_id = '$ledger_master_id' ";

        $statement = $connect->prepare($check_query);
        $statement->execute();
        $result = $statement->fetchAll();

        $i = 0;
        $pre_amount = 0;
        foreach ($result as $row) {
            $lol[$i] = $row['ledger_details__id'];
            // $details_id_db = array($lol);
            $i++;

            // $pre_amount += $row['amount'];
        }

        // echo "2- ";
        //              print_r($lol);


        // $res1 = array_diff($details_id, $details_id_db);

        /////////// if removed , then delete

        $res2 = array_diff($lol, $details_id);

        // print_r($res2);


        foreach ($res2 as $res) {
            // echo $res;
            $l = $res;
            $del_query = " DELETE FROM ledger_details WHERE ledger_details__id='$l';
                            ";
            $statement = $connect->prepare($del_query);
            $statement->execute();
            // if($statement->execute())
            // {
            //   echo "Deleted".$l;
            // }
            // else
            // {
            //  echo $statement->errorInfo();
            // }
        }

        $details_id_q = "";

// $total_amount = 0;

        foreach ($queries as $query) {
            $details_id_q = $query->details_id;
            if ($details_id_q == "0") {

            $sub_query = "
				INSERT INTO  ledger_details ( ledger_master_id ,  bill_id ,  ledger_date ,  payment_type ,  payment_type_name ,  bill_name ,  amount, remarks ) VALUES (:ledger_master_id, :bill_id, :ledger_date, :payment_type, :payment_type_name, :bill_name, :amount, :remarks)
				";
        

        
				$statement = $connect->prepare($sub_query);
				$statement->execute(
					array(
						':ledger_master_id'		=>	$ledger_master_id,
						':bill_id'				=>	$query->bill_id,
						':ledger_date'			=>	$query->ledger_date,
						':payment_type'			=>	$query->payment_type,
						':payment_type_name'	=>	$query->payment_type_name,
						':bill_name'			=>	$query->bill_name,
						':amount'				=>	$query->bill_amount,
						':remarks'				=>	$query->remarks
					)
				);
				$result23 = $statement->fetchAll();
				
				// if($statement->execute())
    //             {
    //               echo "<br>Added ".$query->bill_id;
    //             }
    //             else
    //             {
    //              echo $statement->errorInfo();
    //             }

				// $total_amount += $query->bill_amount;

            }
        }

        $update_query = "
			UPDATE ledger_master 
			SET ledger_master_total = '".$total_amount."' 
			WHERE ledger_master_id = '".$ledger_master_id."'
			";
			$statement = $connect->prepare($update_query);
			$statement->execute();

        $result = $statement->fetchAll();

			if(isset($result))
			{
				echo 'Ledger Entry Created...';
				echo '<br />';
				echo $total_amount;
				echo '<br />';
				echo $ledger_master_id;
			}
// 			if(isset($result23))
// 			{
// 			    echo "Good";
// 			}
    }


	if($_POST['btn_action'] == 'delete')
	{
		$status = '0';
		if($_POST['status'] == '0')
		{
			$status = '1';
		}
		$query = "
		UPDATE ledger_master 
		SET ledger_master_delete = :ledger_master_status 
		WHERE ledger_master_id = :ledger_master_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':ledger_master_status'	=>	$status,
				':ledger_master_id'		=>	$_POST["ledgerentry_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Ledger Entry Deleted';
		}
	}
}

?>