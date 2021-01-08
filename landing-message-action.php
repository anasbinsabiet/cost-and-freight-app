<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $ip_info = $_SERVER;

    if (!empty($full_name) && !empty($email) && !empty($message)) {

        $query = " INSERT INTO landing_message (full_name,email,message,ip_info) VALUES (:full_name,:email,:message,:ip_info) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':full_name' => $_POST["full_name"],
                ':email' => $_POST["email"],
                ':message' => $_POST["message"],
                ':ip_info' => implode(', ', $_SERVER)  
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            $msg = "We received your message and you'll hear from us soon. Thank You!";
            header('location:index.php');
        }
    }
}

?>