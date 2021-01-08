<?php
include '../db.php';
///////////////////////// ADD employee
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO employee (employee_name,employee_address,employee_phone,employee_mobile,employee_fax,employee_email,employee_contact_person,employee_short_name,employee_credit_sale_limit) VALUES (:employee_name,:employee_address,:employee_phone,:employee_mobile,:employee_fax,:employee_email,:employee_contact_person,:employee_short_name,:employee_credit_sale_limit) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':employee_name' => $_POST["employee_name"],
                ':employee_address' => $_POST["employee_address"],
                ':employee_phone' => $_POST["employee_phone"],
                ':employee_mobile' => $_POST["employee_mobile"],
                ':employee_fax' => $_POST["employee_fax"],
                ':employee_email' => $_POST["employee_email"],
                ':employee_contact_person' => $_POST["employee_contact_person"],
                ':employee_short_name' => $_POST["employee_short_name"],
                ':employee_credit_sale_limit' => $_POST["employee_credit_sale_limit"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Employee Added';
        }
    }
/////////////////////// Edit employee
    if ($_POST['btn_action'] == 'Edit') {
        $employee_id = $_POST['employee_id'];
        // $location_name=$_POST['location_name'];
        $query = " UPDATE `employee` SET employee_name = :employee_name,employee_address = :employee_address,employee_phone = :employee_phone,employee_mobile = :employee_mobile,employee_fax = :employee_fax,employee_email = :employee_email,employee_contact_person = :employee_contact_person,employee_short_name = :employee_short_name,employee_credit_sale_limit = :employee_credit_sale_limit WHERE `employee_id` = '$employee_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':employee_name' => $_POST["employee_name"],
                ':employee_address' => $_POST["employee_address"],
                ':employee_phone' => $_POST["employee_phone"],
                ':employee_mobile' => $_POST["employee_mobile"],
                ':employee_fax' => $_POST["employee_fax"],
                ':employee_email' => $_POST["employee_email"],
                ':employee_contact_person' => $_POST["employee_contact_person"],
                ':employee_short_name' => $_POST["employee_short_name"],
                ':employee_credit_sale_limit' => $_POST["employee_credit_sale_limit"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Employee Edited';
        }
    }
////////////////////////// Delete employee
    if ($_POST['btn_action'] == 'delete') {
        $employee_id = $_POST["employee_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE employee SET employee_delete = '$status' WHERE employee_id = '$employee_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Employee status change to ' . $status;
        }
    }


}

?>