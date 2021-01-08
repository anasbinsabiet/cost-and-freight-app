<?php
include '../db.php';

///////////////////////// ADD page

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $query = " INSERT INTO page_setup (page_name,page_url) VALUES (:page_name,:page_url) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':page_name' => $_POST["page_name"],
                ':page_url' => $_POST["page_url"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Page Added';
        }
    }


/////////////////////// Edit page


    if ($_POST['btn_action'] == 'Edit') {

        $page_id = $_POST['page_id'];

        $query = " UPDATE page_setup SET page_name = :page_name, page_url = :page_url WHERE page_id = '$page_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':page_name' => $_POST["page_name"],
                ':page_url' => $_POST["page_url"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Page Edited';
        }
    }


////////////////////////// Delete page


    if ($_POST['btn_action'] == 'delete') {
        $page_id = $_POST["page_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
        UPDATE page_setup SET page_delete = '$status' WHERE page_id = '$page_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Page status change to ' . $status;
        }
    }


}

?>