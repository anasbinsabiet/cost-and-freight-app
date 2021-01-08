<?php
include '../db.php';
///////////////////////// ADD Role
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO ledger_category (ledger_category_name) VALUES (:ledger_category_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':ledger_category_name' => $_POST["ledger_category_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Category Added';
        }
    }
/////////////////////// Edit Location
    if ($_POST['btn_action'] == 'Edit') {

        $ledger_category_id = $_POST['ledger_category_id'];
        // $location_name=$_POST['location_name'];
        $query = " UPDATE `ledger_category` SET ledger_category_name = :ledger_category_name WHERE `ledger_category_id` = '$ledger_category_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':ledger_category_name' => $_POST["ledger_category_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Category Edited';
        }
    }
////////////////////////// Delete Role
    if ($_POST['btn_action'] == 'delete') {
        $ledger_category_id = $_POST["ledger_category_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
        UPDATE ledger_category SET ledger_category_delete = '$status' WHERE ledger_category_id = '$ledger_category_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'ledger_category status change to ' . $status;
        }
    }

}

?>