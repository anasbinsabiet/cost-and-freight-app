<?php
include '../db.php';

///////////////////////// ADD marketing_sector

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO marketing_sector (marketing_sector_name) VALUES (:marketing_sector_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':marketing_sector_name' => $_POST["marketing_sector_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'marketing_sector Name Added';
        }
    }


/////////////////////// Edit marketing_sector


    if ($_POST['btn_action'] == 'Edit') {

        $marketing_sector_id = $_POST['marketing_sector_id'];
        // $marketing_sector_name=$_POST['marketing_sector_name'];
        $query = " UPDATE `marketing_sector` SET marketing_sector_name = :marketing_sector_name WHERE `marketing_sector_id` = '$marketing_sector_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':marketing_sector_name' => $_POST["marketing_sector_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'marketing_sector Name Edited';
        }
    }


////////////////////////// Delete marketing_sector


    if ($_POST['btn_action'] == 'delete') {
        $marketing_sector_id = $_POST["marketing_sector_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE marketing_sector SET marketing_sector_delete = '$status' WHERE marketing_sector_id = '$marketing_sector_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'marketing_sector status change to ' . $status;
        }
    }


}

?>