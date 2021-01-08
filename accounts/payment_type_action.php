<?php
include '../db.php';

///////////////////////// ADD payment_type

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO payment_type (payment_type_name) VALUES (:payment_type_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_type_name' => $_POST["payment_type_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Type Added';
        }
    }


/////////////////////// Edit payment_type


    if ($_POST['btn_action'] == 'Edit') {

        $payment_type_id = $_POST['payment_type_id'];
        // $payment_type_name=$_POST['payment_type_name'];
        $query = " UPDATE `payment_type` SET payment_type_name = :payment_type_name WHERE `payment_type_id` = '$payment_type_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_type_name' => $_POST["payment_type_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Type Edited';
        }
    }


////////////////////////// Delete payment_type


    if ($_POST['btn_action'] == 'delete') {
        $payment_type_id = $_POST["payment_type_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE payment_type SET payment_type_delete = '$status' WHERE payment_type_id = '$payment_type_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Type status change to ' . $status;
        }
    }


}

?>