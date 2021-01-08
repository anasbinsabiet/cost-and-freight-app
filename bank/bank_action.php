<?php
include '../db.php';
///////////////////////// ADD bank
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO bank (bank_type_id,bank_name) VALUES (:bank_type_id,:bank_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_type_id' => $_POST["bank_type_id"],
                ':bank_name' => $_POST["bank_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank Added';
        }
    }
/////////////////////// Edit bank
    if ($_POST['btn_action'] == 'Edit') {
        $bank_id = $_POST['bank_id'];
        // $location_name=$_POST['location_name'];
        $query = "UPDATE `bank` SET bank_type_id = :bank_type_id,bank_name = :bank_name WHERE `bank_id` = '$bank_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_type_id' => $_POST["bank_type_id"],
                ':bank_name' => $_POST["bank_name"],
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank Edited';
        }
    }
////////////////////////// Delete bank
    if ($_POST['btn_action'] == 'delete') {
        $bank_id = $_POST["bank_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
        UPDATE bank SET bank_delete = '$status' WHERE bank_id = '$bank_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank status change to ' . $status;
        }
    }
}
?>