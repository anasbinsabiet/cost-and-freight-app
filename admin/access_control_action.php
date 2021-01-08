<?php
include '../db.php';
include '../function.php';
///////////////////////// ADD access_control
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO access_control (user_id,user_role_id,location_id) VALUES (:user_id,:user_role_id,:location_id) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':user_id' => $_POST["user_id"],
                ':user_role_id' => $_POST["user_role_id"],
                ':location_id' => $_POST["location_id"]
            )
        );

        $user_query = " UPDATE user SET user_role_id = :user_role_id, role_position = :role_position WHERE user_id = :user_id ";
        $user_statement = $connect->prepare($user_query);
        $user_statement->execute(
            array(
                ':user_id' => $_POST["user_id"],
                ':user_role_id' => $_POST["user_role_id"],
                ':role_position' => get_role_position($connect, $_POST["user_role_id"])
            )
        );

        $result2 = $user_statement->fetchAll();

        if (isset($result2)) {
            echo 'Role Assigned';
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo ' AND Access Control Added';
        }
        
    }
/////////////////////// Edit access_control
    if ($_POST['btn_action'] == 'Edit') {
        $access_control_id = $_POST['access_control_id'];
        // $location_name=$_POST['location_name'];
        $query = "UPDATE `access_control` SET user_id = :user_id,user_role_id = :user_role_id,location_id = :location_id WHERE `access_control_id` = '$access_control_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':user_id' => $_POST["user_id"],
                ':user_role_id' => $_POST["user_role_id"],
                ':location_id' => $_POST["location_id"],
            )
        );

          $user_query = " UPDATE user SET user_role_id = :user_role_id, role_position = :role_position WHERE user_id = :user_id ";
        $user_statement = $connect->prepare($user_query);
        $user_statement->execute(
            array(
                ':user_id' => $_POST["user_id"],
                ':user_role_id' => $_POST["user_role_id"],
                ':role_position' => get_role_position($connect, $_POST["user_role_id"])
            )
        );

        $result2 = $user_statement->fetchAll();

        if (isset($result2)) {
            echo 'Role Assigned';
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo ' And Access Control Edited';
        }
    }

    
////////////////////////// Delete access_control
    if ($_POST['btn_action'] == 'delete') {
        $access_control_id = $_POST["access_control_id"];
        $status1 = $_POST["status"];
        $status = '0';
        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE access_control SET access_control_delete = '$status' WHERE access_control_id = '$access_control_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'access_control status change to ' . $status;
        }
    }


}

?>