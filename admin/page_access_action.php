<?php
include('../db.php');
include('../function.php');

if ($_POST['btn_action'] == 'Add') {
    $json1 = json_decode($_POST['tabledata']);
    $queries = json_decode($json1);
    //Example foreach
    foreach ($queries as $query) {

        $user_id = $query->user_id;
        $page_id = $query->page_id;

        $check_query = $connect->prepare("SELECT * FROM page_access WHERE user_id = '$user_id' AND page_id = '$page_id' ");
        $check_query->execute();
        $rowNo = $check_query->rowCount();

        if($rowNo > 0){
            $delete_query = $connect->prepare("DELETE FROM page_access WHERE user_id = '$user_id' ");
            $delete_query->execute();

        }

    $sub_query = "INSERT INTO page_access (user_id, page_id)
    VALUES (:user_id,:page_id)";
    $statement = $connect->prepare($sub_query);
    $statement->execute(
    array(
    ':user_id' => $query->user_id,
    ':page_id' => $query->page_id
    )
    );
    }

    $result = $statement->fetchAll();
    if (isset($result)) {
    echo 'Access Created...';
    echo '<br />';
    }
}

?>