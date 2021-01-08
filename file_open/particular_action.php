<?php
include '../db.php';

///////////////////////// ADD particular

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO particular (particular_name,particular_description,particular_type) VALUES (:particular_name,:particular_description,:particular_type) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':particular_name' => $_POST["particular_name"],
                ':particular_description' => $_POST["particular_description"],
                ':particular_type' => $_POST["particular_type"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Particular Added';
        }
    }


/////////////////////// Edit particular


    if ($_POST['btn_action'] == 'Edit') {

        $particular_id = $_POST['particular_id'];
        $query = " UPDATE particular SET particular_name = :particular_name,particular_description=:particular_description,particular_type=:particular_type WHERE `particular_id` = '$particular_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':particular_name' => $_POST["particular_name"],
                ':particular_description' => $_POST["particular_description"],
                ':particular_type' => $_POST["particular_type"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Particular Edited';
        }
    }


////////////////////////// Delete particular


    if ($_POST['btn_action'] == 'delete') {
        $particular_id = $_POST["particular_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE particular SET particular_delete = '$status' WHERE particular_id = '$particular_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'particular status change to ' . $status;
        }
    }


}

?>