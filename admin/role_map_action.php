<?php
include '../db.php';
///////////////////////// ADD bank
if (isset($_POST['btn_action'])) {


    if ($_POST['btn_action'] == 'Add') {

        $role_map_khali_kor = $connect->prepare("TRUNCATE `role_map`");
        $role_map_khali_kor->execute();

        $json1 = json_decode($_POST['tabledata']);
        $queries = json_decode($json1);

        $i=0;
        //Example foreach
        foreach ($queries as $data) {
            $i++;
            $query = " INSERT INTO role_map(role_id, role_name, role_postion) VALUES ( :role_id, :role_name, :role_postion)";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':role_id' => $data->role_id,
                    ':role_name' => $data->role_name,
                    ':role_postion' => $i
                )
            );
        }
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'Role Map Created...';
            echo '<br />';
        }


            
    }


// /////////////////////// Edit bank
//     if ($_POST['btn_action'] == 'Edit') {
//         $bank_id = $_POST['bank_id'];
//         // $location_name=$_POST['location_name'];
//         $query = "UPDATE `bank` SET bank_type_id = :bank_type_id,bank_name = :bank_name WHERE `bank_id` = '$bank_id'";
//         $statement = $connect->prepare($query);
//         $statement->execute(
//             array(
//                 ':bank_type_id' => $_POST["bank_type_id"],
//                 ':bank_name' => $_POST["bank_name"],
//             )
//         );
//         $result = $statement->fetchAll();
//         if (isset($result)) {
//             echo 'Bank Edited';
//         }
//     }
// ////////////////////////// Delete bank
//     if ($_POST['btn_action'] == 'delete') {
//         $bank_id = $_POST["bank_id"];
//         $status1 = $_POST["status"];

//         $status = '0';

//         if ($status1 == '0') {
//             $status = '1';
//         }
//         $query = "
//         UPDATE bank SET bank_delete = '$status' WHERE bank_id = '$bank_id'
//         ";
//         $statement = $connect->prepare($query);
//         $statement->execute();
//         $result = $statement->fetchAll();
//         if (isset($result)) {
//             echo 'Bank status change to ' . $status;
//         }
//     }
}
?>