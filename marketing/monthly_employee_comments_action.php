<?php
include '../db.php';

///////////////////////// ADD monthly_employee_comments

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO monthly_employee_comments (employee_name, comments, comments_date) VALUES (:employee_name, :comments, :comments_date) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':employee_name' => $_POST["employee_id"],
                ':comments' => $_POST["comments"],
                ':comments_date' => $_POST["comments_date"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Monthly Employee Comment Added';
        }
    }


/////////////////////// Edit monthly_employee_comments


    if ($_POST['btn_action'] == 'Edit') {

        $monthly_employee_comments_id = $_POST['monthly_employee_comments_id'];
        // $monthly_employee_comments_name=$_POST['monthly_employee_comments_name'];
        $query = " UPDATE monthly_employee_comments SET employee_name = :employee_name, comments = :comments, comments_date = :comments_date WHERE monthly_employee_comments_id = '$monthly_employee_comments_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':employee_name' => $_POST["employee_id"],
                ':comments' => $_POST["comments"],
                ':comments_date' => $_POST["comments_date"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Monthly Employee Comment Edited';
        }
    }


////////////////////////// Delete monthly_employee_comments


    if ($_POST['btn_action'] == 'delete') {
        $monthly_employee_comments_id = $_POST["monthly_employee_comments_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE monthly_employee_comments SET monthly_employee_comments_delete = '$status' WHERE monthly_employee_comments_id = '$monthly_employee_comments_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'monthly_employee_comments status change to ' . $status;
        }
    }


}

?>