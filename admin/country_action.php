<?php
 
include '../db.php';
///////////////////////// ADD country

if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $country_name = $_POST['country_name'];
        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_location = "uploads/";
        if (!file_exists($image_location)) {
            mkdir($image_location, 755, true);
        }
        if (move_uploaded_file($image_temp, $image_location.$image_name)) {
            echo "File Uploaded";
        }else{
            echo "error to uploaded file";
        }
        $image_dir = $image_location . $image_name;


        $query = " INSERT INTO country (country_name, image) VALUES ('$country_name','$image_dir') ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Country Name Added';
        }
    }


/////////////////////// Edit country


    if ($_POST['btn_action'] == 'Edit') {

        $country_id = $_POST['country_id'];
        // $country_name=$_POST['country_name'];
        $query = " UPDATE `country` SET country_name = :country_name WHERE `country_id` = '$country_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':country_name' => $_POST["country_name"]
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Country Name Edited';
        }
    }


////////////////////////// Delete country


    if ($_POST['btn_action'] == 'delete') {
        $country_id = $_POST["country_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE country SET country_delete = '$status' WHERE country_id = '$country_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Country status change to ' . $status;
        }
    }


}

?>