<?php
 
include '../db.php';
///////////////////////// ADD company_visit

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO company_visit (mcompany_id, company_visit_date, employee_id, company_visit_time, comments, company_visit_remarks, company_next_visit_date) VALUES ( :mcompany_id, :company_visit_date, :employee_id, :company_visit_time, :comments, :company_visit_remarks, :company_next_visit_date) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':mcompany_id' => $_POST["mcompany_id"], 
                ':company_visit_date' => $_POST["company_visit_date"], 
                ':employee_id' => $_POST["employee_id"], 
                ':company_visit_time' => $_POST["company_visit_time"], 
                ':comments' => $_POST["comments"], 
                ':company_visit_remarks' => $_POST["company_visit_remarks"], 
                ':company_next_visit_date' => $_POST["company_next_visit_date"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Company Visit Added';
        }
    }


/////////////////////// Edit company_visit


    if ($_POST['btn_action'] == 'Edit') {

        $company_visit_id = $_POST['company_visit_id'];
        // $company_visit_name=$_POST['company_visit_name'];
        $query = " UPDATE company_visit SET mcompany_id= :mcompany_id, employee_id= :employee_id, company_visit_date= :company_visit_date, company_visit_time= :company_visit_time, comments= :comments, company_visit_remarks= :company_visit_remarks, company_next_visit_date= :company_next_visit_date WHERE company_visit_id = '$company_visit_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':mcompany_id' => $_POST["mcompany_id"],
                ':employee_id' => $_POST["employee_id"],
                ':company_visit_date' => $_POST["company_visit_date"],
                ':company_visit_time' => $_POST["company_visit_time"],
                ':comments' => $_POST["comments"],
                ':company_visit_remarks' => $_POST["company_visit_remarks"],
                ':company_next_visit_date' => $_POST["company_next_visit_date"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Company Visit Edited';
        }
    }


////////////////////////// Delete company_visit


    if ($_POST['btn_action'] == 'delete') {
        $company_visit_id = $_POST["company_visit_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE company_visit SET company_visit_delete = '$status' WHERE company_visit_id = '$company_visit_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Company Visit status change to ' . $status;
        }
    }


}

?>