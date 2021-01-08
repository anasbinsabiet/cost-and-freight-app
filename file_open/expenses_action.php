<?php
include '../db.php';

///////////////////////// ADD expenses

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO expenses (expenses_name,expenses_type,expenses_mr,expenses_delete) VALUES (:expenses_name,:expenses_type,:expenses_mr,:expenses_delete) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':expenses_name' => $_POST["expenses_name"],
                ':expenses_type' => $_POST["expenses_type"],
                ':expenses_mr' => $_POST["expenses_mr"],
                ':expenses_delete' => $_POST["expenses_delete"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Expenses Added';
        }
    }


/////////////////////// Edit expenses


    if ($_POST['btn_action'] == 'Edit') {

        $expenses_id = $_POST['expenses_id'];
        $query = " UPDATE expenses SET expenses_name = :expenses_name,expenses_type=:expenses_type,expenses_mr=:expenses_mr,expenses_delete=:expenses_delete WHERE expenses_id = '$expenses_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':expenses_name' => $_POST["expenses_name"],
                ':expenses_type' => $_POST["expenses_type"],
                ':expenses_mr' => $_POST["expenses_mr"],
                ':expenses_delete' => $_POST["expenses_delete"]  
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Expenses Edited';
        }
    }


////////////////////////// Delete expenses


    if ($_POST['btn_action'] == 'delete') {
        $expenses_id = $_POST["expenses_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE expenses SET expenses_delete = '$status' WHERE expenses_id = '$expenses_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'expenses status change to ' . $status;
        }
    }


}

?>