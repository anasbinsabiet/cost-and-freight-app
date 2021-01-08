<?php
include '../db.php';

///////////////////////// ADD lc_type

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO lc_type (lc_type_name) VALUES (:lc_type_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':lc_type_name' => $_POST["lc_type_name"]
            )
        );
        
    // if(!$statement->execute())
    // {
    //     print_r($statement->errorInfo());
    // }
        
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'LC Type Name Added';
        }
    }


/////////////////////// Edit lc_type


    if ($_POST['btn_action'] == 'Edit') {

        $lc_type_id = $_POST['lc_type_id'];
        // $lc_type_name=$_POST['lc_type_name'];
        $query = " UPDATE `lc_type` SET lc_type_name = :lc_type_name WHERE `lc_type_id` = '$lc_type_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':lc_type_name' => $_POST["lc_type_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'LC Type Name Edited';
        }
    }


////////////////////////// Delete lc_type


    if ($_POST['btn_action'] == 'delete') {
        $lc_type_id = $_POST["lc_type_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE lc_type SET lc_type_delete = '$status' WHERE lc_type_id = '$lc_type_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'LC Type status change to ' . $status;
        }
    }


}

?>