<?php
include '../db.php';

///////////////////////// ADD marketing_zone

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO marketing_zone (marketing_zone_division, marketing_zone_district, marketing_zone_name) VALUES (:marketing_division_name, :marketing_district_name, :marketing_zone_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':marketing_division_name' => $_POST["marketing_division_name"],
                ':marketing_district_name' => $_POST["marketing_district_name"],
                ':marketing_zone_name' => $_POST["marketing_zone_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Zone Name Added';
        }
    }


/////////////////////// Edit marketing_zone


    if ($_POST['btn_action'] == 'Edit') {

        $marketing_zone_id = $_POST['marketing_zone_id'];
        // $marketing_zone_name=$_POST['marketing_zone_name'];
        $query = " UPDATE marketing_zone SET marketing_zone_division = :marketing_zone_division,  marketing_zone_district = :marketing_district_name, marketing_zone_name = :marketing_zone_name WHERE marketing_zone_id = '$marketing_zone_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':marketing_zone_division' => $_POST["marketing_division_name"],
                ':marketing_district_name' => $_POST["marketing_district_name"],
                ':marketing_zone_name' => $_POST["marketing_zone_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Zone Name Edited';
        }
    }


////////////////////////// Delete marketing_zone


    if ($_POST['btn_action'] == 'delete') {
        $marketing_zone_id = $_POST["marketing_zone_id"];

        $status = '0';

        if ($_POST["status"] == '0') {
            $status = '1';
        }
        $query = "
		UPDATE marketing_zone SET marketing_zone_status = '$status' WHERE marketing_zone_id = '$marketing_zone_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Zone status changed';
        }
    }


}

?>