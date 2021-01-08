<?php
include '../db.php';
///////////////////////// ADD user
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO user (user_name,user_email,user_password,user_role) VALUES (:user_name,:user_email,:user_password,:user_role) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':user_name' => $_POST["user_name"],
                ':user_email' => $_POST["user_email"],
                ':user_password' => password_hash($_POST["user_password"], PASSWORD_DEFAULT),
                ':user_role' => $_POST["user_role"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'user Added';
        }
    }
/////////////////////// Edit user
    if ($_POST['btn_action'] == 'Edit') {
        $user_id = $_POST['user_id'];
        $password = $_POST['user_password'];
        if ($password != NULL) {
            $query = " UPDATE `user` SET user_name = :user_name,user_email,user_role = :user_email,user_password = :user_password,:user_role WHERE `user_id` = '$user_id'";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':user_name' => $_POST["user_name"],
                    ':user_email' => $_POST["user_email"],
                    ':user_password' => password_hash($_POST["user_password"], PASSWORD_DEFAULT),
                    ':user_role' => $_POST["user_role"]
                )
            );
            $result = $statement->fetchAll();
            if (isset($result)) {
                echo 'User Edited';
            }
        } else {
            $query = " UPDATE `user` SET user_name = :user_name,user_email = :user_email,user_role=:user_role WHERE `user_id` = '$user_id'";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':user_name' => $_POST["user_name"],
                    ':user_email' => $_POST["user_email"],
                    ':user_role' => $_POST["user_role"]
                )
            );
            $result = $statement->fetchAll();
            if (isset($result)) {
                echo 'User Edited';
            }
        }
        // $location_name=$_POST['location_name'];

    }
////////////////////////// Delete user
    if ($_POST['btn_action'] == 'delete') {
        $user_id = $_POST["user_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE user SET user_delete = '$status' WHERE user_id = '$user_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'user status change to ' . $status;
        }
    }


}

?>