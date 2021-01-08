<?php
 
include '../db.php';
///////////////////////// ADD unit

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO unit (unit_name) VALUES (:unit_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':unit_name' => $_POST["unit_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Unit Added';
        }
    }


/////////////////////// Edit unit


    if ($_POST['btn_action'] == 'Edit') {

        $unit_id = $_POST['unit_id'];
        // $unit_name=$_POST['unit_name'];
        $query = " UPDATE `unit` SET unit_name = :unit_name WHERE `unit_id` = '$unit_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':unit_name' => $_POST["unit_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Unit Edited';
        }
    }


////////////////////////// Delete unit


    if ($_POST['btn_action'] == 'delete') {
        $unit_id = $_POST["unit_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE unit SET unit_delete = '$status' WHERE unit_id = '$unit_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'unit status change to ' . $status;
        }
    }


}

?>