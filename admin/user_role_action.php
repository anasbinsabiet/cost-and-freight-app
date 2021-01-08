<?php
include '../db.php';
///////////////////////// ADD Role
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO user_role (user_role_name) VALUES (:user_role_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':user_role_name' => $_POST["user_role_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Role Added';
        }
    }
/////////////////////// Edit Location
    if ($_POST['btn_action'] == 'Edit') {

        $user_role_id = $_POST['user_role_id'];
        // $location_name=$_POST['location_name'];
        $query = " UPDATE `user_role` SET user_role_name = :user_role_name WHERE `user_role_id` = '$user_role_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':user_role_name' => $_POST["user_role_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Role Edited';
        }
    }
////////////////////////// Delete Role
    if ($_POST['btn_action'] == 'delete') {
        $user_role_id = $_POST["user_role_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE user_role SET user_role_status = '$status' WHERE user_role_id = '$user_role_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Role status change to ' . $status;
        }
    }


}

?>