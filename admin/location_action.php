<?php
include '../db.php';

///////////////////////// ADD Location

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO location (location_name) VALUES (:location_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':location_name' => $_POST["location_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Location Name Added';
        }
    }


/////////////////////// Edit Location


    if ($_POST['btn_action'] == 'Edit') {

        $location_id = $_POST['location_id'];
        // $location_name=$_POST['location_name'];
        $query = " UPDATE `location` SET location_name = :location_name WHERE `location_id` = '$location_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':location_name' => $_POST["location_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Location Name Edited';
        }
    }


////////////////////////// Delete Location


    if ($_POST['btn_action'] == 'delete') {
        $location_id = $_POST["location_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE location SET location_delete = '$status' WHERE location_id = '$location_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Location status change to ' . $status;
        }
    }


}

?>