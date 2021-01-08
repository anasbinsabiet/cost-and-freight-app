<?php
function get_bank_name($connect, $bank_id)
{
    $statement = $connect->prepare("SELECT * FROM bank WHERE bank_id = '$bank_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['bank_name'];
    }
}

function get_role_position($connect, $role_id)
{
    $statement = $connect->prepare("SELECT * FROM role_map WHERE role_id = '$role_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['role_postion'];
    }
}



function get_user_name($connect, $user_id)
{
    $statement = $connect->prepare("SELECT * FROM user WHERE user_id = '$user_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['user_name'];
    }
}

function get_customer_name($connect, $client_name)
{
    $statement = $connect->prepare("SELECT * FROM customer WHERE customer_id = '$client_name' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['customer_name'];
    }
}

function get_zone_name($connect, $zone)
{
    $statement = $connect->prepare("SELECT * FROM zone WHERE zone_id = '$zone' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['zone_name'];
    }
}

function get_payment_status1($connect, $payment_status)
{
    $statement = $connect->prepare("SELECT * FROM payment_status WHERE payment_status_id = '$payment_status' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['payment_status_name'];
    }
}

function get_ledger_head($connect, $ledger_head_id)
{
    $statement = $connect->prepare("SELECT * FROM ledger_head WHERE ledger_head_id = '$ledger_head_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['ledger_head_name'];
    }
}

function get_user_role($connect, $user_role_id)
{
    $statement = $connect->prepare("SELECT * FROM user_role WHERE user_role_id = '$user_role_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['user_role_name'];
    }
}

function get_branch_name($connect, $branch_id)
{
    $statement = $connect->prepare("SELECT * FROM zone WHERE zone_id = '$branch_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['zone_name'];
    }
}

function get_bank_type($connect, $bank_type_id)
{
    $statement = $connect->prepare("SELECT * FROM bank_type WHERE bank_type_id = '$bank_type_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['bank_type_name'];
    }
}

function get_ledger_category($connect, $ledger_category_id)
{
    $statement = $connect->prepare("SELECT * FROM ledger_category WHERE ledger_category_id = '$ledger_category_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['ledger_category_name'];
    }
}

function filled_ledger_head($connect)
{
    $statement = $connect->prepare("SELECT * FROM ledger_head LEFT JOIN ledger_category ON ledger_head.ledger_category_id = ledger_category.ledger_category_id WHERE ledger_category.ledger_category_name = 'Expense' AND ledger_head.ledger_head_delete = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT EXPENSE</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['ledger_head_id'] . '" >' . $row['ledger_head_name'] . '</option>';
    }

    return $output;
}

function filled_ledger_head_all($connect)
{
    $statement = $connect->prepare("SELECT * FROM ledger_head WHERE ledger_head_delete = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Ledger Head</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['ledger_head_id'] . '" >' . $row['ledger_head_name'] . '</option>';
    }

    return $output;
}

function filled_user_name($connect)
{
    $statement = $connect->prepare("SELECT * FROM user WHERE user_delete = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT USER</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['user_id'] . '" >' . $row['user_name'] . '</option>';
    }

    return $output;
}

function filled_job_no($connect)
{
    $statement = $connect->prepare("SELECT job_no FROM file");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT JOB NO</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['job_no'] . '" >' . $row['job_no'] . '</option>';
    }

    return $output;
}

function filled_job_no_for_ledger($connect)
{
    $statement = $connect->prepare("SELECT job_no FROM file WHERE file_delete = 0");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT JOB NO IF NECESSARY</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['job_no'] . '" >' . $row['job_no'] . '</option>';
    }

    return $output;
}


function filled_job_no_for_ledger_edit($connect,$job_no)
{
    $statement = $connect->prepare("SELECT job_no FROM file WHERE file_delete = 0");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT JOB NO IF NECESSARY</option> ";
    foreach ($result as $row) {
        if($job_no = $row['job_no'])
        {
            $output .= '<option value="' . $row['job_no'] . '" SELECTED >' . $row['job_no'] . '</option>';
        }
        else
        {
        $output .= '<option value="' . $row['job_no'] . '" >' . $row['job_no'] . '</option>';
            
        }
    }

    return $output;
}



function filled_bill_no($connect)
{
    $statement = $connect->prepare("SELECT bill_no FROM file");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT BILL NO</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['bill_no'] . '" >' . $row['bill_no'] . '</option>';
    }

    return $output;
}

function filled_ledger_category($connect)
{
    $statement = $connect->prepare("SELECT * FROM ledger_category WHERE ledger_category_delete = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT LEDGER CATEGORY</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['ledger_category_id'] . '" >' . $row['ledger_category_name'] . '</option>';
    }

    return $output;
}

function filled_user_role($connect)
{
    $statement = $connect->prepare("SELECT * FROM user_role WHERE user_role_status = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ROLE</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['user_role_id'] . '" >' . $row['user_role_name'] . '</option>';
    }

    return $output;
}

function filled_page_id($connect)
{
    $statement = $connect->prepare("SELECT * FROM page_setup");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT PAGE ID</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['page_id'] . '" >' . $row['page_name'] . '</option>';
    }

    return $output;
}

function filled_branch_name($connect)
{
    $statement = $connect->prepare("SELECT * FROM zone WHERE zone_delete = '0' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT BRANCH</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['zone_id'] . '" >' . $row['zone_name'] . '</option>';
    }

    return $output;
}

function get_payment_status($connect, $payment_status_id)
{
    $statement = $connect->prepare("SELECT * FROM location WHERE payment_status_id = '$payment_status_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['payment_status_name'];
    }
}

function filled_branch($connect)
{
    $statement = $connect->prepare("SELECT * FROM branch ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT branch</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['branch_id'] . '" >' . $row['branch_name'] . '</option>';
    }

    return $output;
}


function filled_zone($connect)
{
    $statement = $connect->prepare("SELECT * FROM zone ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['zone_id'] . '" >' . $row['zone_name'] . '</option>';
    }

    return $output;
}

function filled_unit($connect)
{
    $statement = $connect->prepare("SELECT * FROM unit ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Unit</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['unit_id'] . '" >' . $row['unit_name'] . '</option>';
    }

    return $output;
}

function get_unit_name($connect,$unit_id)
{
    $statement = $connect->prepare("SELECT * FROM unit WHERE unit_id = '$unit_id' ");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result[0]['unit_name'];
}


function filled_status($connect)
{
    $statement = $connect->prepare("SELECT * FROM file_status ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Status</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['file_status_id'] . '" >' . $row['file_status_name'] . '</option>';
    }

    return $output;
}

function filled_payment_status($connect)
{
    $statement = $connect->prepare("SELECT * FROM payment_status WHERE payment_status_delete = 0 ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Status</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['payment_status_id'] . '" >' . $row['payment_status_name'] . '</option>';
    }

    return $output;
}

function filled_payment_type($connect)
{
    $statement = $connect->prepare("SELECT * FROM payment_type WHERE payment_type_delete = 0 ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select type</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['payment_type_id'] . '" >' . $row['payment_type_name'] . '</option>';
    }

    return $output;
}



function filled_bank_name($connect)
{
    $statement = $connect->prepare("SELECT * FROM bank ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Bank</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['bank_id'] . '" >' . $row['bank_name'] . '</option>';
    }

    return $output;
}

function filled_currency_name($connect)
{
    $statement = $connect->prepare("SELECT * FROM currency ");
    $statement->execute();
    $result = $statement->fetchAll();
    //$output = "<option value=''>Select Currency</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['currency_id'] . '" >' . $row['currency_name'] . '</option>';
    }

    return $output;
}

function filled_gate($connect)
{
    $statement = $connect->prepare("SELECT * FROM gate ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Gate</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['gate_id'] . '" >' . $row['gate_name'] . '</option>';
    }

    return $output;
}

function filled_lc_type($connect)
{
    $statement = $connect->prepare("SELECT * FROM lc_type ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>LC Type</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['lc_type_id'] . '" >' . $row['lc_type_name'] . '</option>';
    }

    return $output;
}


function get_lc_type($connect,$lc_type_id)
{
    $statement = $connect->prepare("SELECT * FROM lc_type WHERE lc_type_id = '$lc_type_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
   
    foreach ($result as $row) {
        return $row['lc_type_name'];
    }

}

function filled_bank_type($connect)
{
    $statement = $connect->prepare("SELECT * FROM bank_type ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Type</option> ";
    foreach ($result as $row) {
        $output .= '<option value="' . $row['bank_type_id'] . '" >' . $row['bank_type_name'] . '</option>';
    }

    return $output;
}



function filled_zone_edit($connect, $zone_id)
{
    $statement = $connect->prepare("SELECT * FROM zone");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($zone_id == $row['zone_id']) {

            $output .= '<option value="' . $row['zone_id'] . '" SELECTED  >' . $row['zone_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['zone_id'] . '" >' . $row['zone_name'] . '</option>';
        }
    }

    return $output;
}

function filled_currency_edit($connect, $currency_id)
{
    $statement = $connect->prepare("SELECT * FROM currency");
    $statement->execute();
    $result = $statement->fetchAll();
    // $output = "<option value=''>SELECT currency</option>";
    foreach ($result as $row) {
        if ($currency_id == $row['currency_id']) {

            $output .= '<option value="' . $row['currency_id'] . '" SELECTED  >' . $row['currency_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['currency_id'] . '" >' . $row['currency_name'] . '</option>';
        }
    }

    return $output;
}

function filled_ledger_category_edit($connect, $ledger_category_id)
{
    $statement = $connect->prepare("SELECT * FROM ledger_category");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT CATEGORY</option>";
    foreach ($result as $row) {
        if ($ledger_category_id == $row['ledger_category_id']) {

            $output .= '<option value="' . $row['ledger_category_id'] . '" SELECTED  >' . $row['ledger_category_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['ledger_category_id'] . '" >' . $row['ledger_category_name'] . '</option>';
        }
    }

    return $output;
}

function filled_bank_type_id_edit($connect, $bank_type_id)
{
    $statement = $connect->prepare("SELECT * FROM bank_type_id");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT BANK TYPE</option>";
    foreach ($result as $row) {
        if ($bank_type_id == $row['bank_id']) {

            $output .= '<option value="' . $row['bank_type_id'] . '" SELECTED  >' . $row['bank_type_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['bank_type_id'] . '" >' . $row['bank_type_name'] . '</option>';
        }
    }

    return $output;
}

function filled_bank_type_edit($connect, $bank_type_id)
{
    $statement = $connect->prepare("SELECT * FROM bank_type");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($bank_type_id == $row['bank_type_id']) {

            $output .= '<option value="' . $row['bank_type_id'] . '" SELECTED  >' . $row['bank_type_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['bank_type_id'] . '" >' . $row['bank_type_name'] . '</option>';
        }
    }

    return $output;
}

function filled_bank_edit($connect, $bank_id)
{
    $statement = $connect->prepare("SELECT * FROM bank");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT BANK</option>";
    foreach ($result as $row) {
        if ($bank_id == $row['bank_id']) {

            $output .= '<option value="' . $row['bank_id'] . '" SELECTED  >' . $row['bank_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['bank_id'] . '" >' . $row['bank_name'] . '</option>';
        }
    }

    return $output;
}

function filled_unit_edit($connect, $unit_id)
{
    $statement = $connect->prepare("SELECT * FROM unit");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Unit</option>";
    foreach ($result as $row) {
        if ($unit_id == $row['unit_id']) {

            $output .= '<option value="' . $row['unit_id'] . '" SELECTED  >' . $row['unit_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['unit_id'] . '" >' . $row['unit_name'] . '</option>';
        }
    }

    return $output;
}

function filled_status_edit($connect, $file_status_id)
{
    $statement = $connect->prepare("SELECT * FROM file_status");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Status</option>";
    foreach ($result as $row) {
        if ($file_status_id == $row['file_status_id']) {

            $output .= '<option value="' . $row['file_status_id'] . '" SELECTED  >' . $row['file_status_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['file_status_id'] . '" >' . $row['file_status_name'] . '</option>';
        }
    }

    return $output;
}

function filled_payment_status_edit($connect, $payment_status_id)
{
    $statement = $connect->prepare("SELECT * FROM payment_status");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Status</option>";
    foreach ($result as $row) {
        if ($payment_status_id == $row['payment_status_id']) {

            $output .= '<option value="' . $row['payment_status_id'] . '" SELECTED  >' . $row['payment_status_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['payment_status_id'] . '" >' . $row['payment_status_name'] . '</option>';
        }
    }

    return $output;
}

function filled_lc_type_edit($connect, $lc_type_id)
{
    $statement = $connect->prepare("SELECT * FROM lc_type");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Status</option>";
    foreach ($result as $row) {
        if ($lc_type_id == $row['lc_type_id']) {

            $output .= '<option value="' . $row['lc_type_id'] . '" SELECTED  >' . $row['lc_type_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['lc_type_id'] . '" >' . $row['lc_type_name'] . '</option>';
        }
    }

    return $output;
}

function filled_expense_status_edit($connect, $expense_status_id)
{
    $statement = $connect->prepare("SELECT * FROM expense_status");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Status</option>";
    foreach ($result as $row) {
        if ($expense_status_id == $row['expense_status_id']) {

            $output .= '<option value="' . $row['expense_status_id'] . '" SELECTED  >' . $row['expense_status_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['expense_status_id'] . '" >' . $row['expense_status_name'] . '</option>';
        }
    }

    return $output;
}

function filled_expense_status($connect)
{
    $statement = $connect->prepare("SELECT * FROM expense_status WHERE expense_status_delete = 0 ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT EXPENSE</option>";
    foreach ($result as $row) {
        
            $output .= '<option value="' . $row['expense_status_id'] . '" >' . $row['expense_status_name'] . '</option>';
        
    }

    return $output;
}

function filled_user_name_edit($connect, $user_id)
{
    $statement = $connect->prepare("SELECT * FROM user");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT USER</option>";
    foreach ($result as $row) {
        if ($user_id == $row['user_id']) {

            $output .= '<option value="' . $row['user_id'] . '" SELECTED  >' . $row['user_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['user_id'] . '" >' . $row['user_name'] . '</option>';
        }
    }

    return $output;
}

function filled_user_role_edit($connect, $user_role_id)
{
    $statement = $connect->prepare("SELECT * FROM user_role");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ROLE</option>";
    foreach ($result as $row) {
        if ($user_role_id == $row['user_role_id']) {

            $output .= '<option value="' . $row['user_role_id'] . '" SELECTED  >' . $row['user_role_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['user_role_id'] . '" >' . $row['user_role_name'] . '</option>';
        }
    }

    return $output;
}

function filled_branch_edit($connect, $branch_id)
{
    $statement = $connect->prepare("SELECT * FROM zone");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT BRANCH</option>";
    foreach ($result as $row) {
        if ($branch_id == $row['zone_id']) {

            $output .= '<option value="' . $row['zone_id'] . '" SELECTED  >' . $row['zone_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['zone_id'] . '" >' . $row['zone_name'] . '</option>';
        }
    }

    return $output;
}

function filled_gate_edit($connect, $gate_id)
{
    $statement = $connect->prepare("SELECT * FROM gate");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Status</option>";
    foreach ($result as $row) {
        if ($gate_id == $row['gate_id']) {

            $output .= '<option value="' . $row['gate_id'] . '" SELECTED  >' . $row['gate_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['gate_id'] . '" >' . $row['gate_name'] . '</option>';
        }
    }

    return $output;
}

function filled_customer_name($connect)
{
    $statement = $connect->prepare("SELECT * FROM customer WHERE customer_delete = 0 ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT CLIENT</option> ";
    foreach ($result as $row) {

        $output .= '<option value="' . $row['customer_id'] . '" >' . $row['customer_name'] . '</option>';
    }

    return $output;
}

function filled_customer_name_edit($connect,$customer_id)
{
    $statement = $connect->prepare("SELECT * FROM customer  WHERE customer_delete = 0 ");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT CLIENT</option> ";
    foreach ($result as $row) {
        if ($row['customer_id'] == $customer_id ) {
            $output .= '<option value="' . $row['customer_id'] . '" SELECTED >' . $row['customer_name'] . '</option>';
        }
        else{
        $output .= '<option value="' . $row['customer_id'] . '" >' . $row['customer_name'] . '</option>';

        }
    }

    return $output;
}


 function last_file_id($connect)
{
    $statement = $connect->prepare("SELECT file_id FROM file ORDER BY file_id DESC LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    $row = $statement->rowCount();

    if($row == 1)
    {
        return $output =number_format($result[0]['file_id'])+1;
    }
    else
    {
        return $output = 1;
    }

}

function filled_job_no_edit($connect, $zone_id)
{
    $statement = $connect->prepare("SELECT * FROM zone");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($zone_id == $row['zone_id']) {

            $output .= '<option value="' . $row['zone_id'] . '" SELECTED  >' . $row['zone_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['zone_id'] . '" >' . $row['zone_name'] . '</option>';
        }
    }

    return $output;
}

function filled_expenses_type_edit($connect, $expenses_id)
{
    $statement = $connect->prepare("SELECT * FROM expenses");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($expenses_id == $row['expenses_id']) {

            $output .= '<option value="' . $row['expenses_type'] . '" SELECTED  >' . $row['expenses_type'] . '</option>';
        } else {
            $output .= '<option value="' . $row['expenses_type'] . '" >' . $row['expenses_type'] . '</option>';
        }
    }

    return $output;
}

function filled_expenses_mr_edit($connect, $expenses_id)
{
    $statement = $connect->prepare("SELECT * FROM expenses");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($expenses_id == $row['expenses_id']) {

            $output .= '<option value="' . $row['expenses_mr'] . '" SELECTED  >' . $row['expenses_mr'] . '</option>';
        } else {
            $output .= '<option value="' . $row['expenses_mr'] . '" >' . $row['expenses_mr'] . '</option>';
        }
    }

    return $output;
}

function filled_expenses_delete_edit($connect, $expenses_id)
{
    $statement = $connect->prepare("SELECT * FROM expenses");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT ZONE</option>";
    foreach ($result as $row) {
        if ($expenses_id == $row['expenses_id']) {

            $output .= '<option value="' . $row['expenses_delete'] . '" SELECTED  >' . $row['expenses_delete'] . '</option>';
        } else {
            $output .= '<option value="' . $row['expenses_delete'] . '" >' . $row['expenses_delete'] . '</option>';
        }
    }

    return $output;
}

// function filled_particular_mr_edit($connect, $particular_id)
// {
//     $statement = $connect->prepare("SELECT * FROM particular");
//     $statement->execute();
//     $result = $statement->fetchAll();
//     $output = "<option value=''>Select Type</option>";
//     foreach ($result as $row) {
//         if ($particular_id == $row['particular_id']) {

//             $output .= '<option value="' . $row['particular_type'] . '" SELECTED  >' . $row['particular_type'] . '</option>';
//         } else {
//             $output .= '<option value="' . $row['particular_type'] . '" >' . $row['particular_type'] . '</option>';
//         }
//     }

//     return $output;
// }
///////////////////////////////////////////////////// 

function filled_mcompany($connect)
{
    $statement = $connect->prepare("SELECT * FROM mcompany");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Company</option>";
    foreach ($result as $row) {
    $output .= '<option value="' . $row['mcompany_id'] . '" >' . $row['mcompany_name'] . '</option>';
    }
    return $output;
}

function filled_mcompany_edit($connect, $mcompany_id)
{
    $statement = $connect->prepare("SELECT * FROM mcompany");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Company</option>";
    foreach ($result as $row) {
        if ($mcompany_id == $row['mcompany_id']) {

            $output .= '<option value="' . $row['mcompany_id'] . '" SELECTED  >' . $row['mcompany_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['mcompany_id'] . '" >' . $row['mcompany_name'] . '</option>';
        }
    }

    return $output;
}

function get_mcompany_name($connect, $mcompany_id)
{
    $statement = $connect->prepare("SELECT * FROM mcompany WHERE mcompany_id = '$mcompany_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['mcompany_name'];
    }
}



function filled_marketing_sector($connect)
{
    $statement = $connect->prepare("SELECT * FROM marketing_sector");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Sector</option>";
    foreach ($result as $row) {
    
    $output .= '<option value="' . $row['marketing_sector_id'] . '" >' . $row['marketing_sector_name'] . '</option>';
        
    }

    return $output;
}

function filled_marketing_sector_edit($connect, $marketing_sector_id)
{
    $statement = $connect->prepare("SELECT * FROM marketing_sector");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Sector</option>";
    foreach ($result as $row) {
        if ($marketing_sector_id == $row['marketing_sector_id']) {

            $output .= '<option value="' . $row['marketing_sector_id'] . '" SELECTED  >' . $row['marketing_sector_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['marketing_sector_id'] . '" >' . $row['marketing_sector_name'] . '</option>';
        }
    }

    return $output;
}

function get_marketing_sector_name($connect, $marketing_sector_id)
{
    $statement = $connect->prepare("SELECT * FROM marketing_sector WHERE marketing_sector_id = '$marketing_sector_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['marketing_sector_name'];
    }
}


function filled_employee($connect)
{
    $statement = $connect->prepare("SELECT * FROM employee");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Employee</option>";
    foreach ($result as $row) {
    
    $output .= '<option value="' . $row['employee_id'] . '" >' . $row['employee_name'] . '</option>';
        
    }

    return $output;
}

function filled_employee_edit($connect, $employee_id)
{
    $statement = $connect->prepare("SELECT * FROM employee");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Employee</option>";
    foreach ($result as $row) {
        if ($employee_id == $row['employee_id']) {

            $output .= '<option value="' . $row['employee_id'] . '" SELECTED  >' . $row['employee_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['employee_id'] . '" >' . $row['employee_name'] . '</option>';
        }
    }

    return $output;
}

function get_employee_name($connect, $employee_id)
{
    $statement = $connect->prepare("SELECT * FROM employee WHERE employee_id = '$employee_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['employee_name'];
    }
}


function filled_port($connect)
{
    $statement = $connect->prepare("SELECT * FROM port");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Port</option>";
    foreach ($result as $row) {
    
    $output .= '<option value="' . $row['port_id'] . '" >' . $row['port_name'] . '</option>';
        
    }

    return $output;
}

function filled_port_edit($connect, $port_id)
{
    $statement = $connect->prepare("SELECT * FROM port");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT PORT</option>";
    foreach ($result as $row) {
        if ($port_id == $row['port_id']) {

            $output .= '<option value="' . $row['port_id'] . '" SELECTED  >' . $row['port_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['port_id'] . '" >' . $row['port_name'] . '</option>';
        }
    }

    return $output;
}

function get_port_name($connect, $port_id)
{
    $statement = $connect->prepare("SELECT * FROM port WHERE port_id = '$port_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['port_name'];
    }
}

function get_port_short_name($connect, $port_id)
{
    $statement = $connect->prepare("SELECT * FROM port WHERE port_id = '$port_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['port_short_name'];
    }
}
/////////////14 nov
function filled_marketing_zone($connect)
{
    $statement = $connect->prepare("SELECT * FROM marketing_zone");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>Select Marketing zone</option>";
    foreach ($result as $row) {
    
    $output .= '<option value="' . $row['marketing_zone_id'] . '" >' . $row['marketing_zone_name'] . '</option>';
        
    }

    return $output;
}

function filled_marketing_zone_edit($connect, $marketing_zone_id)
{
    $statement = $connect->prepare("SELECT * FROM marketing_zone");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "<option value=''>SELECT Marketing zone</option>";
    foreach ($result as $row) {
        if ($marketing_zone_id == $row['marketing_zone_id']) {

            $output .= '<option value="' . $row['marketing_zone_id'] . '" SELECTED  >' . $row['marketing_zone_name'] . '</option>';
        } else {
            $output .= '<option value="' . $row['marketing_zone_id'] . '" >' . $row['marketing_zone_name'] . '</option>';
        }
    }

    return $output;
}

function get_marketing_zone_name($connect, $marketing_zone_id)
{
    $statement = $connect->prepare("SELECT * FROM marketing_zone WHERE marketing_zone_id = '$marketing_zone_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        return $row['marketing_zone_name'];
    }
}

function get_invoice_currency($connect, $currency_id)
{
    $statement = $connect->prepare("SELECT * FROM currency WHERE currency_id = '$currency_id' ");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
         $currency_symbol = $row['currency_symbol'];
    }
    if($currency_symbol!=NULL){
        $currency_symbol = $currency_symbol;
    }else{
        $currency_symbol = "$";
    }
    return $currency_symbol;
}

?>