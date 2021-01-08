<?php
 
include '../db.php';
///////////////////////// ADD gate

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO gate (gate_name) VALUES (:gate_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':gate_name' => $_POST["gate_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Gate Name Added';
        }
    }


/////////////////////// Edit gate


    if ($_POST['btn_action'] == 'Edit') {

        $gate_id = $_POST['gate_id'];
        // $gate_name=$_POST['gate_name'];
        $query = " UPDATE `gate` SET gate_name = :gate_name WHERE `gate_id` = '$gate_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':gate_name' => $_POST["gate_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Gate Name Edited';
        }
    }


////////////////////////// Delete gate


    if ($_POST['btn_action'] == 'delete') {
        $gate_id = $_POST["gate_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE gate SET gate_delete = '$status' WHERE gate_id = '$gate_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Gate status change to ' . $status;
        }
    }


}

?>