<?php
include '../db.php';

///////////////////////// ADD port

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO port (port_name, port_short_name) VALUES (:port_name, :port_short_name) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':port_name' => $_POST["port_name"],
                ':port_short_name' => $_POST["port_short_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Port Name Added';
        }
    }


/////////////////////// Edit port


    if ($_POST['btn_action'] == 'Edit') {

        $port_id = $_POST['port_id'];
        // $port_name=$_POST['port_name'];
        $query = " UPDATE `port` SET port_name = :port_name, port_short_name = :port_short_name WHERE `port_id` = '$port_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':port_name' => $_POST["port_name"],
                ':port_short_name' => $_POST["port_short_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Port Name Edited';
        }
    }


////////////////////////// Delete port


    if ($_POST['btn_action'] == 'delete') {
        $port_id = $_POST["port_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE port SET port_delete = '$status' WHERE port_id = '$port_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Port status change to ' . $status;
        }
    }


}

?>