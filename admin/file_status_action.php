<?php
include '../db.php';

///////////////////////// ADD file_status

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO file_status (file_status_name) VALUES (:file_status_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':file_status_name' => $_POST["file_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Status Added';
        }
    }


/////////////////////// Edit file_status


    if ($_POST['btn_action'] == 'Edit') {

        $file_status_id = $_POST['file_status_id'];
        // $file_status_name=$_POST['file_status_name'];
        $query = " UPDATE `file_status` SET file_status_name = :file_status_name WHERE `file_status_id` = '$file_status_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':file_status_name' => $_POST["file_status_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Status Edited';
        }
    }


////////////////////////// Delete file_status


    if ($_POST['btn_action'] == 'delete') {
        $file_status_id = $_POST["file_status_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE file_status SET file_status_delete = '$status' WHERE file_status_id = '$file_status_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Status status change to ' . $status;
        }
    }


}

?>