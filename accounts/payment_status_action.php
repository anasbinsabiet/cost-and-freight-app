<?php
include '../db.php';

///////////////////////// ADD payment_status

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO payment_status (payment_status_name) VALUES (:payment_status_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_status_name' => $_POST["payment_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Status Added';
        }
    }


/////////////////////// Edit payment_status


    if ($_POST['btn_action'] == 'Edit') {

        $payment_status_id = $_POST['payment_status_id'];
        // $payment_status_name=$_POST['payment_status_name'];
        $query = " UPDATE `payment_status` SET payment_status_name = :payment_status_name WHERE `payment_status_id` = '$payment_status_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':payment_status_name' => $_POST["payment_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Status Edited';
        }
    }


////////////////////////// Delete payment_status


    if ($_POST['btn_action'] == 'delete') {
        $payment_status_id = $_POST["payment_status_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE payment_status SET payment_status_delete = '$status' WHERE payment_status_id = '$payment_status_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Payment Status status change to ' . $status;
        }
    }


}

?>