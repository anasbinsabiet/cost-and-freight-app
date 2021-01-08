<?php
include '../db.php';

///////////////////////// ADD Currency

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO currency (currency_name,currency_symbol) VALUES (:currency_name,:currency_symbol) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':currency_name' => $_POST["currency_name"],
                ':currency_symbol' => $_POST["currency_symbol"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Currency Name Added';
        }
    }


/////////////////////// Edit currency


    if ($_POST['btn_action'] == 'Edit') {

        $currency_id = $_POST['currency_id'];
        // $currency_name=$_POST['currency_name'];
        $query = " UPDATE `currency` SET currency_name = :currency_name,currency_symbol = :currency_symbol WHERE `currency_id` = '$currency_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':currency_name' => $_POST["currency_name"],
                ':currency_symbol' => $_POST["currency_symbol"]

            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Currency Edited';
        }
    }


////////////////////////// Delete currency


    if ($_POST['btn_action'] == 'delete') {
        $currency_id = $_POST["currency_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE currency SET currency_delete = '$status' WHERE currency_id = '$currency_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'currency status change to ' . $status;
        }
    }


}

?>