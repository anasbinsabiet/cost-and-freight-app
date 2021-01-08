<?php
include '../db.php';
///////////////////////// ADD supplier
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO supplier (supplier_name,supplier_address,supplier_phone,supplier_mobile,supplier_fax,supplier_email,supplier_contact_person,supplier_short_name) VALUES (:supplier_name,:supplier_address,:supplier_phone,:supplier_mobile,:supplier_fax,:supplier_email,:supplier_contact_person,:supplier_short_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':supplier_name' => $_POST["supplier_name"],
                ':supplier_address' => $_POST["supplier_address"],
                ':supplier_phone' => $_POST["supplier_phone"],
                ':supplier_mobile' => $_POST["supplier_mobile"],
                ':supplier_fax' => $_POST["supplier_fax"],
                ':supplier_email' => $_POST["supplier_email"],
                ':supplier_contact_person' => $_POST["supplier_contact_person"],
                ':supplier_short_name' => $_POST["supplier_short_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'supplier Added';
        }
    }
/////////////////////// Edit supplier
    if ($_POST['btn_action'] == 'Edit') {
        $supplier_id = $_POST['supplier_id'];
        // $location_name=$_POST['location_name'];
        $query = " UPDATE `supplier` SET supplier_name = :supplier_name,supplier_address = :supplier_address,supplier_phone = :supplier_phone,supplier_mobile = :supplier_mobile,supplier_fax = :supplier_fax,supplier_email = :supplier_email,supplier_contact_person = :supplier_contact_person,supplier_short_name = :supplier_short_name WHERE `supplier_id` = '$supplier_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':supplier_name' => $_POST["supplier_name"],
                ':supplier_address' => $_POST["supplier_address"],
                ':supplier_phone' => $_POST["supplier_phone"],
                ':supplier_mobile' => $_POST["supplier_mobile"],
                ':supplier_fax' => $_POST["supplier_fax"],
                ':supplier_email' => $_POST["supplier_email"],
                ':supplier_contact_person' => $_POST["supplier_contact_person"],
                ':supplier_short_name' => $_POST["supplier_short_name"],
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'supplier Edited';
        }
    }
////////////////////////// Delete supplier
    if ($_POST['btn_action'] == 'delete') {
        $supplier_id = $_POST["supplier_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE supplier SET supplier_delete = '$status' WHERE supplier_id = '$supplier_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'supplier status change to ' . $status;
        }
    }
}
?>