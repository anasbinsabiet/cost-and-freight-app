<?php
include '../db.php';
///////////////////////// ADD mcompany
if (isset($_POST['btn_action'])) {

    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO mcompany (mcompany_name, mcompany_date, mcompany_address, factory_address, mcompany_phone, owner_phone, mcompany_email, mcompany_contact_person, employee_id, marketing_sector_id, marketing_zone_id, remarks) VALUES(:mcompany_name, :mcompany_date, :mcompany_address, :factory_address, :mcompany_phone, :owner_phone, :mcompany_email, :mcompany_contact_person, :employee_id, :marketing_sector_id, :marketing_zone_id, :remarks) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':mcompany_name' => $_POST["mcompany_name"],
                ':mcompany_date' => $_POST["mcompany_date"],
                ':mcompany_address' => $_POST["mcompany_address"],
                ':mcompany_phone' => $_POST["mcompany_phone"],
                ':mcompany_email' => $_POST["mcompany_email"],
                ':mcompany_contact_person' => $_POST["mcompany_contact_person"],
                ':employee_id' => $_POST["employee_id"],
                ':factory_address' => $_POST["factory_address"],
                ':owner_phone' => $_POST["owner_phone"],
                ':marketing_sector_id' => $_POST["marketing_sector_id"],
                ':marketing_zone_id' => $_POST["marketing_zone_id"],
                ':remarks' => $_POST["remarks"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Company Added';
        }
    }

/////////////////////// Edit mcompany
    if ($_POST['btn_action'] == 'Edit') {
        $mcompany_id = $_POST['mcompany_id'];
        // $location_name=$_POST['location_name'];
        $query = "UPDATE  mcompany  SET mcompany_name = :mcompany_name, mcompany_date = :mcompany_date, mcompany_address=:mcompany_address, factory_address=:factory_address, mcompany_phone=:mcompany_phone, owner_phone = :owner_phone, mcompany_email=:mcompany_email, mcompany_contact_person=:mcompany_contact_person, employee_id = :employee_id,  marketing_sector_id = :marketing_sector_id, marketing_zone_id = :marketing_zone_id, remarks = :remarks  WHERE  mcompany_id  = '$mcompany_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array( 
                ':mcompany_name' => $_POST["mcompany_name"],
                ':mcompany_date' => $_POST["mcompany_date"],

                ':mcompany_address' => $_POST["mcompany_address"],
                ':mcompany_phone' => $_POST["mcompany_phone"],
                ':mcompany_email' => $_POST["mcompany_email"],
                ':mcompany_contact_person' => $_POST["mcompany_contact_person"],
                ':employee_id' => $_POST["employee_id"],
                ':factory_address' => $_POST["factory_address"],
                ':owner_phone' => $_POST["owner_phone"],
                ':marketing_sector_id' => $_POST["marketing_sector_id"],
                ':marketing_zone_id' => $_POST["marketing_zone_id"],
                ':remarks' => $_POST["remarks"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Company Edited';
        }
    }

////////////////////////// Delete mcompany
    if ($_POST['btn_action'] == 'delete') {
        $mcompany_id = $_POST["mcompany_id"];
        $status = '0';

        if ($_POST["status"] == '0') {
            $status = '1';
        }
        $query = "
        UPDATE mcompany SET mcompany_delete = '$status' WHERE mcompany_id = '$mcompany_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Marketing Company status change to ' . $status;
        }
    }

}
?>