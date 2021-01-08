<?php
include '../db.php';
include '../function.php';
///////////////////////// ADD file
if (isset($_POST['btn_action'])) {

    if ($_POST['btn_action'] == 'Add') {

$bill_total = 0;
$fixed_miscelleneous_amount = 0;
$agent_commission = 0;
$minimum_commission = 0;
$less_amount = 0;
$expenses_total = 0;
$received_advance = 0;
$incometax_comission = 0;
$net_payable = 0;
            if(isset($_POST["bill_total"]) > 0){
                $bill_total = $_POST["bill_total"];
            }
            if(isset($_POST["fixed_miscelleneous_amount"]) > 0){
                $fixed_miscelleneous_amount = 0;
            }
            if(isset($_POST["commission_rate"]) != NULL){
                $commission_rate = $_POST["commission_rate"];
            }
            if(isset($_POST["agent_commission"]) > 0){
                $agent_commission = $_POST["agent_commission"];
            }
            if(isset($_POST["minimum_commission"]) > 0){
                $minimum_commission = $_POST["minimum_commission"];
            }
            if(isset($_POST["less_amount"]) > 0){
                $less_amount = $_POST["less_amount"];
            }
            if(isset($_POST["expenses_total"]) > 0 && $_POST["expenses_total"] != NULL){
                $expenses_total = $_POST["expenses_total"];
            }
            if(isset($_POST["received_advance"]) > 0){
            $received_advance = $_POST["received_advance"];
            }
            if(isset($_POST["incometax_comission"]) > 0){
            $incometax_comission = $_POST["incometax_comission"];
            }
            if(isset($_POST["net_payable"]) > 0){
            $net_payable = $_POST["net_payable"];
            }

        $query = "INSERT INTO files (client_name , client_address , zone , mobile , attention , weight , unit , amount , goods , status , model , quantity , payment_status , payment_date , remarks , exim_type, bill_no ,bill_no_date, agent_reference , bill_of_entry_date , job_no , job_date , mawb_no , mawb_date , hawb_no , hawb_date , bl_no , bl_date , exp_no , exp_date , container_no , invoice_no , invoice_date , lc_tt_label , lc_tt_no , lc_tt_date , lca_no , lca_date , ip_no , ip_date , ip_job_no , ip_job_date , b_entry_no , b_entry_date , bond_no , bond_date , san_no , san_date , previous_bill_no , previous_bill_date , port , assessable_value , invoice_value , invoice_currency , delivery_date , expense_status , gate, fixed_miscelleneous_amount , bill_total, commission_rate, agent_commission , minimum_commission, expenses_total , received_advance , incometax_comission , less_amount, net_payable) VALUES (:client_name , :client_address , :zone , :mobile , :attention , :weight , :unit , :amount , :goods , :status , :model , :quantity , :payment_status , :payment_date , :remarks , :exim_type, :bill_no, :bill_no_date , :agent_reference , :bill_of_entry_date , :job_no , :job_date , :mawb_no , :mawb_date , :hawb_no , :hawb_date , :bl_no , :bl_date , :exp_no , :exp_date , :container_no , :invoice_no , :invoice_date , :lc_tt_label , :lc_tt_no , :lc_tt_date , :lca_no , :lca_date , :ip_no , :ip_date , :ip_job_no , :ip_job_date , :b_entry_no , :b_entry_date , :bond_no , :bond_date , :san_no , :san_date , :previous_bill_no , :previous_bill_date , :port , :assessable_value , :invoice_value , :invoice_currency , :delivery_date , :expense_status , :gate, :fixed_miscelleneous_amount , :bill_total , :commission_rate, :agent_commission , :minimum_commission, :expenses_total , :received_advance , :incometax_comission , :less_amount, :net_payable)";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':client_name' => $_POST["client_name"],
                ':client_address' => $_POST["client_address"],
                ':zone' => $_POST["zone"],
                ':mobile' => $_POST["mobile"],
                ':attention' => $_POST["attention"],
                ':weight' => $_POST["weight"],
                ':unit' => $_POST["unit"],
                ':amount' => $_POST["amount"],
                ':goods' => $_POST["goods"],
                ':status' => $_POST["status"],
                ':model' => $_POST["model"],
                ':quantity' => $_POST["quantity"],
                ':payment_status' => $_POST["payment_status"],
                ':payment_date' => date('Y-m-d', strtotime($_POST['payment_date'])),
                ':remarks' => $_POST["remarks"],
                ':exim_type' => $_POST["exim_type"],
                ':bill_no' => $_POST["bill_no"],
                ':bill_no_date' => date('Y-m-d', strtotime($_POST['bill_no_date'])),
                ':agent_reference' => $_POST["agent_reference"],
                ':bill_of_entry_date' => date('Y-m-d', strtotime($_POST['bill_of_entry_date'])),
                ':job_no' => $_POST["job_no"],
                ':job_date' => date('Y-m-d', strtotime($_POST['job_date'])),
                ':mawb_no' => $_POST["mawb_no"],
                ':mawb_date' => date('Y-m-d', strtotime($_POST['mawb_date'])),
                ':hawb_no' => $_POST["hawb_no"],
                ':hawb_date' => date('Y-m-d', strtotime($_POST['hawb_date'])),
                ':bl_no' => $_POST["bl_no"],
                ':bl_date' => date('Y-m-d', strtotime($_POST['bl_date'])),
                ':exp_no' => $_POST["exp_no"],
                ':exp_date' => date('Y-m-d', strtotime($_POST['exp_date'])),
                ':container_no' => $_POST["container_no"],
                ':invoice_no' => $_POST["invoice_no"],
                ':invoice_date' => date('Y-m-d', strtotime($_POST['invoice_date'])),
                ':lc_tt_label' => $_POST["lc_tt_label"],
                ':lc_tt_no' => $_POST["lc_tt_no"],
                ':lc_tt_date' => date('Y-m-d', strtotime($_POST['lc_tt_date'])),
                ':lca_no' => $_POST["lca_no"],
                ':lca_date' => date('Y-m-d', strtotime($_POST['lca_date'])),
                ':ip_no' => $_POST["ip_no"],
                ':ip_date' => date('Y-m-d', strtotime($_POST['ip_date'])),
                ':ip_job_no' => $_POST["ip_job_no"],
                ':ip_job_date' => date('Y-m-d', strtotime($_POST['ip_job_date'])),
                ':b_entry_no' => $_POST["b_entry_no"],
                ':b_entry_date' => date('Y-m-d', strtotime($_POST['b_entry_date'])),
                ':bond_no' => $_POST["bond_no"],
                ':bond_date' => date('Y-m-d', strtotime($_POST['bond_date'])),
                ':san_no' => $_POST["san_no"],
                ':san_date' => date('Y-m-d', strtotime($_POST['san_date'])),
                ':previous_bill_no' => $_POST["previous_bill_no"],
                ':previous_bill_date' => date('Y-m-d', strtotime($_POST['previous_bill_date'])),
                ':port' => $_POST["port"],
                ':assessable_value' => $_POST["assessable_value"],
                ':invoice_value' => $_POST["invoice_value"],
                ':invoice_currency' => $_POST["invoice_currency"],
                ':delivery_date' => date('Y-m-d', strtotime($_POST['delivery_date'])),
                ':expense_status' => $_POST["expense_status"],
                ':gate' => $_POST["gate"],
                ':fixed_miscelleneous_amount' => 0,
                ':bill_total' => $bill_total,
                ':commission_rate' => $commission_rate,
                ':agent_commission' => $agent_commission,
                ':minimum_commission' => $minimum_commission,
                ':expenses_total' => $expenses_total,
                ':received_advance' => $received_advance,
                ':incometax_comission' => $incometax_comission,
                ':less_amount' => $less_amount,
                ':net_payable' => $net_payable
            )
        );
        //     if(!$statement->execute())
        // {
        //     print_r($statement->errorInfo());
        // }
        $file_id =  $connect->lastInsertId();
        $bill_no = date("Ym")."-".$file_id;
        echo "File Data Inserted";
        $bill_query = $connect->prepare("UPDATE files SET bill_no = '$bill_no' WHERE file_id = '$file_id' ");
        $bill_query->execute();


        if(isset($_POST["particular_name"]))
        {

        $number = count($_POST["particular_name"]);



        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                // if(trim($_POST["name"][$i] != ''))
                // {
                    $sql = "INSERT INTO file_bill_items(file_id, particular_id, particular_name, particular_amount) VALUES('$file_id','".$_POST["particular_id"][$i]."', '".$_POST["particular_name"][$i]."', '".$_POST["particular_amount"][$i]."')";
                    $statement = $connect->prepare($sql);
                    $statement->execute();
                // }
            }
            echo "Bill Data Inserted";
        }

        }

        $number1 = count($_POST["others_name"]);
        if($number1 > 0)
        {
        for($i=0; $i<$number1; $i++)
        {
        $sql1 = "INSERT INTO file_others_items(file_id, others_name, others_amount) VALUES('$file_id', '".$_POST["others_name"][$i]."', '".$_POST["others_amount"][$i]."')";
        $statement = $connect->prepare($sql1);
        $statement->execute();
        }
        echo "Bill Data Inserted";
        }


        $number = count($_POST["expenses_name"]);
        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                // if(trim($_POST["name"][$i] != ''))
                // {
                    $sql2 = "INSERT INTO file_expenses_items(file_id,expenses_id,expenses_name,expenses_amount) VALUES('$file_id','".$_POST["expenses_id"][$i]."', '".$_POST["expenses_name"][$i]."', '".$_POST["expenses_amount"][$i]."')";
                    $statement = $connect->prepare($sql2);
                    $statement->execute();
                // }
            }
            echo "Expense Data Inserted";
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Added';
        }
    }


/////////////////////// Edit file


    if ($_POST['btn_action'] == 'Edit') {

        $file_id = $_POST['file_id'];

        $delete_bill_files = $connect->prepare("DELETE FROM file_bill_items WHERE file_id='$file_id'");
        $delete_expense_files = $connect->prepare("DELETE FROM file_expenses_items WHERE file_id='$file_id'");
        $delete_others_files = $connect->prepare("DELETE FROM file_others_items WHERE file_id='$file_id'");
        $delete_bill_files->execute();
        $delete_expense_files->execute();
        $delete_others_files->execute();

        $bill_total = 0;
        $fixed_miscelleneous_amount = 0;
        $commission_rate = 0;
        $agent_commission = 0;
        $minimum_commission = 0;
        $less_amount = 0;
        $expenses_total = 0;
        $received_advance = 0;
        $incometax_comission = 0;
        $net_payable = 0;

            if(isset($_POST["bill_total"]) > 0){
                $bill_total = $_POST["bill_total"];
            }
            if(isset($_POST["fixed_miscelleneous_amount"]) > 0){
                $fixed_miscelleneous_amount = 0;
            }
            if(isset($_POST["commission_rate"])  != NULL){
                $commission_rate = $_POST["commission_rate"];
            }
            if(isset($_POST["agent_commission"]) > 0){
                $agent_commission = $_POST["agent_commission"];
            }
            if(isset($_POST["minimum_commission"]) > 0){
                $minimum_commission = $_POST["minimum_commission"];
            }
            if(isset($_POST["less_amount"]) > 0){
                $less_amount = $_POST["less_amount"];
            }
            if(isset($_POST["expenses_total"]) > 0){
                $expenses_total = $_POST["expenses_total"];
            }
            if(isset($_POST["received_advance"]) > 0){
            $received_advance = $_POST["received_advance"];
            }
            if(isset($_POST["incometax_comission"]) > 0){
            $incometax_comission = $_POST["incometax_comission"];
            }
            if(isset($_POST["net_payable"]) > 0){
            $net_payable = $_POST["net_payable"];
            }

        $query = "UPDATE files SET client_name = :client_name, client_address=:client_address, zone=:zone, mobile=:mobile, attention=:attention, weight=:weight, unit=:unit, amount=:amount, goods=:goods, status=:status, model=:model, quantity=:quantity, payment_status=:payment_status, payment_date=:payment_date, remarks=:remarks, exim_type=:exim_type, bill_no=:bill_no,bill_no_date=:bill_no_date, agent_reference=:agent_reference, bill_of_entry_date=:bill_of_entry_date, job_no=:job_no, job_date=:job_date, mawb_no=:mawb_no, mawb_date=:mawb_date, hawb_no=:hawb_no, hawb_date=:hawb_date, bl_no=:bl_no, bl_date=:bl_date, exp_no=:exp_no, exp_date=:exp_date, container_no=:container_no, invoice_no=:invoice_no, invoice_date=:invoice_date, lc_tt_label=:lc_tt_label, lc_tt_no=:lc_tt_no, lc_tt_date=:lc_tt_date, lca_no=:lca_no, lca_date=:lca_date, ip_no=:ip_no, ip_date=:ip_date, ip_job_no=:ip_job_no, ip_job_date=:ip_job_date, b_entry_no=:b_entry_no, b_entry_date=:b_entry_date, bond_no=:bond_no, bond_date=:bond_date, san_no=:san_no, san_date=:san_date, previous_bill_no=:previous_bill_no,previous_bill_date=:previous_bill_date, port=:port, assessable_value=:assessable_value, invoice_value=:invoice_value, invoice_currency=:invoice_currency, delivery_date=:delivery_date, expense_status=:expense_status, gate=:gate, bill_total=:bill_total, commission_rate=:commission_rate, agent_commission=:agent_commission, minimum_commission=:minimum_commission, expenses_total=:expenses_total, received_advance=:received_advance, incometax_comission=:incometax_comission, less_amount = :less_amount, net_payable=:net_payable WHERE file_id = '$file_id'";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':client_name' => $_POST["client_name"], 
                ':client_address' => $_POST["client_address"], 
                ':zone' => $_POST["zone"], 
                ':mobile' => $_POST["mobile"],
                ':attention' => $_POST["attention"],
                ':weight' => $_POST["weight"],
                ':unit' => $_POST["unit"],
                ':amount' => $_POST["amount"],
                ':goods' => $_POST["goods"],
                ':status' => $_POST["status"],
                ':model' => $_POST["model"],
                ':quantity' => $_POST["quantity"],
                ':payment_status' => $_POST["payment_status"],
                ':payment_date' => date('Y-m-d', strtotime($_POST['payment_date'])),
                ':remarks' => $_POST['remarks'],
                ':exim_type' => $_POST['exim_type'],
                ':bill_no' => $_POST["bill_no"],
                ':bill_no_date' => date('Y-m-d', strtotime($_POST['bill_no_date'])),
                ':agent_reference' => $_POST["agent_reference"],
                ':bill_of_entry_date' => date('Y-m-d', strtotime($_POST['bill_of_entry_date'])),
                ':job_no' => $_POST["job_no"],
                ':job_date' => date('Y-m-d', strtotime($_POST['job_date'])),
                ':mawb_no' => $_POST["mawb_no"],
                ':mawb_date' => date('Y-m-d', strtotime($_POST['mawb_date'])),
                ':hawb_no' => $_POST["hawb_no"],
                ':hawb_date' => date('Y-m-d', strtotime($_POST['hawb_date'])),
                ':bl_no' => $_POST["bl_no"],
                ':bl_date' => date('Y-m-d', strtotime($_POST['bl_date'])),
                ':exp_no' => $_POST["exp_no"],
                ':exp_date' => date('Y-m-d', strtotime($_POST["exp_date"])),
                ':container_no' => $_POST["container_no"],
                ':invoice_no' => $_POST["invoice_no"],
                ':invoice_date' => date('Y-m-d', strtotime($_POST['invoice_date'])),
                ':lc_tt_label' => $_POST["lc_tt_label"],
                ':lc_tt_no' => $_POST["lc_tt_no"],
                ':lc_tt_date' => date('Y-m-d', strtotime($_POST['lc_tt_date'])),
                ':lca_no' => $_POST["lca_no"],
                ':lca_date' => date('Y-m-d', strtotime($_POST['lca_date'])),
                ':ip_no' => $_POST["ip_no"],
                ':ip_date' => date('Y-m-d', strtotime($_POST['ip_date'])),
                ':ip_job_no' => $_POST["ip_job_no"],
                ':ip_job_date' => date('Y-m-d', strtotime($_POST['ip_job_date'])),
                ':b_entry_no' => $_POST["b_entry_no"],
                ':b_entry_date' => date('Y-m-d', strtotime($_POST['b_entry_date'])),
                ':bond_no' => $_POST["bond_no"],
                ':bond_date' => date('Y-m-d', strtotime($_POST['bond_date'])),
                ':san_no' => $_POST["san_no"],
                ':san_date' => date('Y-m-d', strtotime($_POST['san_date'])),
                ':previous_bill_no' => $_POST["previous_bill_no"],
                ':previous_bill_date' => date('Y-m-d', strtotime($_POST['previous_bill_date'])),
                ':port' => $_POST["port"],
                ':assessable_value' => $_POST["assessable_value"],
                ':invoice_value' => $_POST["invoice_value"],
                ':invoice_currency' => $_POST["invoice_currency"],
                ':delivery_date' => date('Y-m-d', strtotime($_POST['delivery_date'])),
                ':expense_status' => $_POST["expense_status"],
                ':gate' => $_POST["gate"],
                ':bill_total' => $bill_total,
                ':commission_rate' => $commission_rate,
                ':agent_commission' => $agent_commission,
                ':minimum_commission' => $minimum_commission,
                ':expenses_total' => $expenses_total,
                ':received_advance' => $_POST["received_advance"],
                ':incometax_comission' => $_POST["incometax_comission"],
                ':less_amount' => $_POST["less_amount"],
                ':net_payable' => $_POST["net_payable"]
            )
        );
        //     if(!$statement->execute())
        // {
        //     print_r($statement->errorInfo());
        // }


        if(isset($_POST["particular_name"]))
        {

        $number = count($_POST["particular_name"]);



        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                // if(trim($_POST["name"][$i] != ''))
                // {
                    $sql = "INSERT INTO file_bill_items(file_id, particular_id, particular_name, particular_amount) VALUES('$file_id','".$_POST["particular_id"][$i]."', '".$_POST["particular_name"][$i]."', '".$_POST["particular_amount"][$i]."')";
                    $statement = $connect->prepare($sql);
                    $statement->execute();
                // }
            }
            echo "Bill Data Inserted";
        }

        }

        $number1 = count($_POST["others_name"]);
        if($number1 > 0)
        {
        for($i=0; $i<$number1; $i++)
        {
        $sql1 = "INSERT INTO file_others_items(file_id, others_name, others_amount) VALUES('$file_id', '".$_POST["others_name"][$i]."', '".$_POST["others_amount"][$i]."')";
        $statement = $connect->prepare($sql1);
        $statement->execute();
        }
        echo "Bill Data Inserted";
        }


        $number = count($_POST["expenses_name"]);
        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                // if(trim($_POST["name"][$i] != ''))
                // {
                    $sql2 = "INSERT INTO file_expenses_items(file_id,expenses_id,expenses_name,expenses_amount) VALUES('$file_id','".$_POST["expenses_id"][$i]."', '".$_POST["expenses_name"][$i]."', '".$_POST["expenses_amount"][$i]."')";
                    $statement = $connect->prepare($sql2);
                    $statement->execute();
                // }
            }
            echo "Expense Data Inserted";
        }

        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Edited';
        }
    }


////////////////////////// Delete file


    if ($_POST['btn_action'] == 'delete') {
        $file_id = $_POST["file_id"];
        $status1 = $_POST["status"];

        $status = '0';

        if ($status1 == '0') {
            $status = '1';
        }
        $query = "
        UPDATE files SET file_delete = '$status' WHERE file_id = '$file_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'file status change to ' . $status;
        }
    }


    /////////////Approve

    if ($_POST['btn_action'] == 'approve') {
        $file_id = $_POST["file_id"];
       

        $status = '0';

        if ($_POST["status"] == '0') {
            $status = '1';
        }
        $query = "
        UPDATE files SET file_approve = '$status' WHERE file_id = '$file_id'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'File Approved';
        }
    }


    if ($_POST['btn_action'] == 'client_name') {
        $customer_id = $_POST['query'];
        $query = $connect->prepare("SELECT * FROM customer WHERE customer_id = '$customer_id' ");
        $query->execute();

        $result = $query->fetchAll();

        $output = array();

        foreach ($result as $row) {
            
            $output['customer_address'] = $row['customer_address'];
            $output['customer_phone'] = $row['customer_phone'].", ".$row['customer_mobile'];
            $output['fixed_miscelleneous_amount'] = $row['fixed_miscelleneous_amount'];

        }
        echo json_encode($output);
    }


//////////////////////////////////////////////////// Port and Commission Calculation

    if ($_POST['btn_action'] == 'port') {
        $port = $_POST['query'];
        $client_id = $_POST['client_id'];
        $query = $connect->prepare("SELECT * FROM client_commission WHERE port_id = '$port' AND customer_id = '$client_id' ");
        $query->execute();

        $result = $query->fetchAll();

        $output = array();

        foreach ($result as $row) {
            
            $output['minimum_commission'] = $row['minimum_commission'];
            $output['commission_rate'] = $row['commission_rate'];

        }
        echo json_encode($output);
    }
}

?>