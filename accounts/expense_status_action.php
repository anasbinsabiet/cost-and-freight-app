<?php
 include '../db.php';
///////////////////////// ADD expense_status

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO expense_status (expense_status_name) VALUES (:expense_status_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':expense_status_name' => $_POST["expense_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Expense Status Name Added';
        }
    }


/////////////////////// Edit expense_status


    if ($_POST['btn_action'] == 'Edit') {

        $expense_status_id = $_POST['expense_status_id'];
        // $expense_status_name=$_POST['expense_status_name'];
        $query = " UPDATE `expense_status` SET expense_status_name = :expense_status_name WHERE `expense_status_id` = '$expense_status_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':expense_status_name' => $_POST["expense_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Expense Status Name Edited';
        }
    }


////////////////////////// Delete expense_status


    if ($_POST['btn_action'] == 'delete') {
        $expense_status_id = $_POST["expense_status_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE expense_status SET expense_status_delete = '$status' WHERE expense_status_id = '$expense_status_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Expense Status status change to ' . $status;
        }
    }


}

?>