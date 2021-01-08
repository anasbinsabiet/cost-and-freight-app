<?php
include '../db.php';
///////////////////////// ADD branch
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO branch (bank_id,branch_name,branch_address,branch_phone,branch_email,branch_contact_person) VALUES (:bank_id,:branch_name,:branch_address,:branch_phone,:branch_email,:branch_contact_person) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_id' => $_POST["bank_id"],
                ':branch_name' => $_POST["branch_name"],
                ':branch_address' => $_POST["branch_address"],
                ':branch_phone' => $_POST["branch_phone"],
                ':branch_email' => $_POST["branch_email"],
                ':branch_contact_person' => $_POST["branch_contact_person"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Branch Added';
        }
    }
/////////////////////// Edit branch
    if ($_POST['btn_action'] == 'Edit') {
        $branch_id = $_POST['branch_id'];
        // $location_name=$_POST['location_name'];
        $query = "UPDATE `branch` SET bank_id = :bank_id,branch_name = :branch_name,branch_address=:branch_address,branch_phone=:branch_phone,branch_email=:branch_email,branch_contact_person=:branch_contact_person WHERE `branch_id` = '$branch_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':bank_id' => $_POST["bank_id"],
                ':branch_name' => $_POST["branch_name"],
                ':branch_address' => $_POST["branch_address"],
                ':branch_phone' => $_POST["branch_phone"],
                ':branch_email' => $_POST["branch_email"],
                ':branch_contact_person' => $_POST["branch_contact_person"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Branch Edited';
        }
    }
////////////////////////// Delete branch
    if ($_POST['btn_action'] == 'delete') {
        $branch_id = $_POST["branch_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
        UPDATE branch SET branch_delete = '$status' WHERE branch_id = '$branch_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Branch status change to ' . $status;
        }
    }
}
?>