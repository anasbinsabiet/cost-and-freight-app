<?php
 
include '../db.php';
///////////////////////// ADD size

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO size (size_name) VALUES (:size_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':size_name' => $_POST["size_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Size Name Added';
        }
    }


/////////////////////// Edit size


    if ($_POST['btn_action'] == 'Edit') {

        $size_id = $_POST['size_id'];
        $query = " UPDATE `size` SET size_name = :size_name WHERE `size_id` = '$size_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':size_name' => $_POST["size_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Size Name Edited';
        }
    }


////////////////////////// Delete size


    if ($_POST['btn_action'] == 'delete') {
        $size_id = $_POST["size_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE size SET size_delete = '$status' WHERE size_id = '$size_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Size status change to ' . $status;
        }
    }


}

?>