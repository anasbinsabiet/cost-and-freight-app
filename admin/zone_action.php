<?php
include '../db.php';

///////////////////////// ADD zone

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO zone (zone_name) VALUES (:zone_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':zone_name' => $_POST["zone_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Zone Name Added';
        }
    }


/////////////////////// Edit zone


    if ($_POST['btn_action'] == 'Edit') {

        $zone_id = $_POST['zone_id'];
        // $zone_name=$_POST['zone_name'];
        $query = " UPDATE `zone` SET zone_name = :zone_name WHERE `zone_id` = '$zone_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':zone_name' => $_POST["zone_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Zone Name Edited';
        }
    }


////////////////////////// Delete zone


    if ($_POST['btn_action'] == 'delete') {
        $zone_id = $_POST["zone_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE zone SET zone_delete = '$status' WHERE zone_id = '$zone_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Zone status change to ' . $status;
        }
    }


}

?>