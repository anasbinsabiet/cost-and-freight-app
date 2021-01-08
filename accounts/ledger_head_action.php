<?php
include '../db.php';
///////////////////////// ADD ledger_head
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO ledger_head (ledger_category_id,ledger_head_code,ledger_head_name) VALUES (:ledger_category_id,:ledger_head_code,:ledger_head_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':ledger_category_id' => $_POST["ledger_category_id"],
                ':ledger_head_code' => $_POST["ledger_head_code"],
                ':ledger_head_name' => $_POST["ledger_head_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Ledger Head Added';
        }
    }
/////////////////////// Edit ledger_head
    if ($_POST['btn_action'] == 'Edit') {
        $ledger_head_id = $_POST['ledger_head_id'];
        // $location_name=$_POST['location_name'];
        $query = "UPDATE `ledger_head` SET ledger_category_id = :ledger_category_id,ledger_head_code = :ledger_head_code,ledger_head_name = :ledger_head_name WHERE `ledger_head_id` = '$ledger_head_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':ledger_category_id' => $_POST["ledger_category_id"],
                ':ledger_head_code' => $_POST["ledger_head_code"],
                ':ledger_head_name' => $_POST["ledger_head_name"],
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Ledger Head Edited';
        }
    }
////////////////////////// Delete ledger_head
    if ($_POST['btn_action'] == 'delete') {
        $ledger_head_id = $_POST["ledger_head_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE ledger_head SET ledger_head_delete = '$status' WHERE ledger_head_id = '$ledger_head_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'ledger_head status change to ' . $status;
        }
    }


}

?>