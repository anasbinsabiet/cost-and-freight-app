<?php
 
include '../db.php';
///////////////////////// ADD bank_type

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO bank_type (bank_type_name) VALUES (:bank_type_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_type_name' => $_POST["bank_type_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank Type Added';
        }
    }


/////////////////////// Edit bank_type


    if ($_POST['btn_action'] == 'Edit') {

        $bank_type_id = $_POST['bank_type_id'];
        // $bank_type_name=$_POST['bank_type_name'];
        $query = " UPDATE `bank_type` SET bank_type_name = :bank_type_name WHERE `bank_type_id` = '$bank_type_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_type_name' => $_POST["bank_type_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank Type Edited';
        }
    }


////////////////////////// Delete bank_type


    if ($_POST['btn_action'] == 'delete') {
        $bank_type_id = $_POST["bank_type_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE bank_type SET bank_type_delete = '$status' WHERE bank_type_id = '$bank_type_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Bank Type status change to ' . $status;
        }
    }


}

?>