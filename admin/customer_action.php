<?php
include '../db.php';
///////////////////////// ADD Customer
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = " INSERT INTO customer (customer_name,customer_address,customer_phone,customer_mobile,customer_fax,customer_email,customer_contact_person,customer_short_name,customer_credit_sale_limit, fixed_miscelleneous_amount) VALUES (:customer_name,:customer_address,:customer_phone,:customer_mobile,:customer_fax,:customer_email,:customer_contact_person,:customer_short_name,:customer_credit_sale_limit,:fixed_miscelleneous_amount) ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':customer_name' => $_POST["customer_name"],
                ':customer_address' => $_POST["customer_address"],
                ':customer_phone' => $_POST["customer_phone"],
                ':customer_mobile' => $_POST["customer_mobile"],
                ':customer_fax' => $_POST["customer_fax"],
                ':customer_email' => $_POST["customer_email"],
                ':customer_contact_person' => $_POST["customer_contact_person"],
                ':customer_short_name' => $_POST["customer_short_name"],
                ':customer_credit_sale_limit' => $_POST["customer_credit_sale_limit"],
                ':fixed_miscelleneous_amount' => 0,
            )
        );

        $customer_id =  $connect->lastInsertId();

        if(isset($_POST["port_name"]))
        {

        $number = count($_POST["port_name"]);



        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                // if(trim($_POST["name"][$i] != ''))
                // {
                    $sql = "INSERT INTO client_commission(customer_id, port_id, minimum_commission, commission_rate) VALUES('$customer_id','".$_POST["port_id"][$i]."', '".$_POST["minimum_commission"][$i]."', '".$_POST["commission_rate"][$i]."')";
                    $statement1 = $connect->prepare($sql);
                    $statement1->execute();
                        // if(!$statement1->execute())
                        // {
                        //     print_r($statement1->errorInfo());
                        // }
            }
        }
            echo "Commission Inserted";
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Customer Added';
        }
    }
}
/////////////////////// Edit Customer
    if ($_POST['btn_action'] == 'Edit') {

        $customer_id = $_POST['customer_id'];

        $delete_client_commission = $connect->prepare("DELETE FROM client_commission WHERE customer_id='$customer_id'");
        $delete_client_commission->execute();

        $query = " UPDATE `customer` SET customer_name = :customer_name,customer_address = :customer_address,customer_phone = :customer_phone,customer_mobile = :customer_mobile,customer_fax = :customer_fax,customer_email = :customer_email,customer_contact_person = :customer_contact_person,customer_short_name = :customer_short_name,customer_credit_sale_limit = :customer_credit_sale_limit WHERE `customer_id` = '$customer_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':customer_name' => $_POST["customer_name"],
                ':customer_address' => $_POST["customer_address"],
                ':customer_phone' => $_POST["customer_phone"],
                ':customer_mobile' => $_POST["customer_mobile"],
                ':customer_fax' => $_POST["customer_fax"],
                ':customer_email' => $_POST["customer_email"],
                ':customer_contact_person' => $_POST["customer_contact_person"],
                ':customer_short_name' => $_POST["customer_short_name"],
                ':customer_credit_sale_limit' => $_POST["customer_credit_sale_limit"]
            )
        );

        if(isset($_POST["commission_rate"]))
        {

            $number = count($_POST["commission_rate"]);



            if($number > 0)
            {
                for($i=0; $i<$number; $i++)
                {
                    // if(trim($_POST["name"][$i] != ''))
                    // {
                        $sql = "INSERT INTO client_commission(customer_id, port_id, minimum_commission, commission_rate) VALUES('$customer_id','".$_POST["port_id"][$i]."', '".$_POST["minimum_commission"][$i]."', '".$_POST["commission_rate"][$i]."')";
                        $statement = $connect->prepare($sql);
                        $statement->execute();
                    // }
                }
                echo "Commission Edited";
            }

        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Customer Edited';
        }
    }
////////////////////////// Delete Customer
    if ($_POST['btn_action'] == 'delete') {
        $customer_id = $_POST["customer_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
		UPDATE customer SET customer_delete = '$status' WHERE customer_id = '$customer_id'
		";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Customer status change to ' . $status;
        }
    }

?>