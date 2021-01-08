<?php include '../navbar.php';
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Bill Details</h4>
        <ol class="breadcrumb">
            <a href="file.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Bill</a>
        </ol>
    </section>
    <!-- Main content -->
    <?php
    $id = $_GET['id'];
    $statement = $connect->prepare("SELECT * FROM files WHERE file_id = '$id' LIMIT 1");
    $statement->execute();
    $rowno = $statement->rowCount();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
    $port = $row['port'];
    $client_name = $row['client_name'];
    ?>
    <section class="invoice">
        
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                <i class="fa fa-globe"></i> ICM FREIGHT <a class="btn btn-primary" href="file_edit.php?id=<?php echo $row["file_id"]; ?>">EDIT</a>
                <small class="pull-right">Date: <?php echo date('d/m/Y',strtotime($row['file_create'])); ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div id="divToPrint" style='font-size: 11px;'>
            <button class="print-link avoid-this btn btn-success">
            Print
            </button>
            <style type="text/css">
                .main-footer {
                    font-size: 10px;
                }
                .text-right{
                    text-align: right;
                }
                .text-center{
                    text-align: center;
                }
                .footer {
                    position: absolute;
                    text-align: center;
                    bottom: 0;
                    left: 0;
                    margin-top: 10px;
                    padding: 10px 0;
                    width: 100%;
                     visibility: show;
    opacity: 1;
    filter: alpha(opacity=100);

    /*position: fixed;*/
    bottom: 0;
                }
                .myTable { background-color:transparent;border-collapse:collapse; }
                .myTable th { background-color:transparent;width:50%; }
                .myTable td, .myTable th { padding:5px;border:1px solid #ddd; }
            </style>
            <center class="hidden"><img src="../images/header.jpg" alt="logo" style="width: 100%;margin-bottom:40px;height:100px;"></center>
            <div class="row invoice-info">
                <div class="col-xs-12 invoice-col">
                    <table class="table" style="margin-bottom: 10px;" width="100%">
                        <tbody>
                            <tr>
                                <td width="50%" class="table-no-padding" style="vertical-align: top;">
                                    <div style="font-size: 13px;margin-bottom: 5px;width: 50%;"><strong>Customer Information</strong></div>
                                    <address>
                                        <strong><?php echo get_customer_name($connect, $row['client_name']); ?></strong><br>
                                        <span style="width: 70%; display: block;"><?php echo $row['client_address']; ?><br><?php echo get_zone_name($connect, $row['zone']); ?><br><?php echo $row['attention']; ?><br>
                                        
                                        
                                    </address>
                                </td>
                                <td class="table-no-padding" style="padding: 0">
                                    <table class="table table-condensed myTable" style="margin:0;" width="100%">
                                        <tbody>
                                <?php if(!empty($row['bill_no'])){ ?><tr>
                                    <td><strong>Bill No:</strong> <?php echo $row['bill_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['bill_no_date'])); ?></td>
                                </tr>
                                <?php } ?>
                                <?php if(!empty($row['previous_bill_no'])){ ?><tr>
                                    <td><strong>Previous Bill No:</strong> <?php echo $row['previous_bill_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['previous_bill_date'])); ?></td>
                                </tr>
                                <?php } ?>
                                <?php if(!empty($row['job_no'])){ ?><tr>
                                    <td><strong>Job No:</strong> <?php echo $row['job_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['job_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['mawb_no'])){ ?><tr>
                                    <td><strong>MAWB No :</strong> <?php echo $row['mawb_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['mawb_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['hawb_no'])){ ?><tr>
                                    <td><strong>HAWB No :</strong> <?php echo $row['hawb_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['hawb_date'])); ?></td>
                                </tr><?php } ?>
                                
                                <?php if(!empty($row['bl_no'])){ ?><tr>
                                    <td><strong>BL No :</strong> <?php echo $row['bl_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['bl_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['exp_no'])){ ?><tr>
                                    <td><strong>EXP No :</strong> <?php echo $row['exp_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['exp_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['invoice_no'])){ ?><tr>
                                    <td><strong>Invoice No :</strong> <?php echo $row['invoice_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['invoice_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['lc_tt_no'])){ ?><tr>
                                    <td><strong>LC Type & Number :</strong> <?php echo get_lc_type($connect,$row['lc_tt_label'])." ".$row['lc_tt_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['lc_tt_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['lca_no'])){ ?><tr>
                                    <td><strong>LCA No :</strong> <?php echo $row['lca_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['lca_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['container_no'])){ ?><tr>
                                    <td><strong>Container No :</strong> <?php echo $row['container_no']; ?></td>
                                </tr><?php } ?>
                                <?php if(!empty($row['ip_no'])){ ?><tr>
                                    <td><strong>IP No :</strong> <?php echo $row['ip_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['ip_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <tr><?php if(!empty($row['ip_job_no'])){ ?>
                                    <td><strong>IP Job No :</strong> <?php echo $row['ip_job_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['ip_job_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                <?php if(!empty($row['b_entry_no'])){ ?><tr>
                                    <td><strong>B/Entry No :</strong> <?php echo $row['b_entry_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['b_entry_date'])); ?>
                                    </td>
                                </tr><?php } ?>
                                
                                <?php if(!empty($row['bond_no'])){ ?><tr>
                                    <td><strong>Bond No :</strong> <?php echo $row['bond_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['bond_date'])); ?></td>
                                </tr><?php } ?>
                                <?php if(!empty($row['san_no'])){ ?><tr>
                                    <td><strong>SAN No :</strong> <?php echo $row['san_no']; ?></td>
                                    <td class="text-right">Date: <?php echo date('d/m/Y',strtotime($row['san_date'])); ?></td>
                                </tr><?php } ?>
                                <tr><?php if(!empty($row['port'])){ ?>
                                    <td><strong>Port :</strong> <?php echo get_port_short_name($connect, $row['port']); ?></td><?php } ?>
                                    <td class="text-right"><?php if(!empty($row['payment_date'] != "1970-01-01")){ ?>
                                    Payment Date: <?php echo date('d/m/Y',strtotime($row['payment_date'])); ?>
                                    <?php } ?></td>
                                </tr>
                                <tr><?php if(!empty($row['exim_type'])){ ?>
                                    <td><strong>Export/Import:</strong> <?php echo $row['exim_type']; ?></td><?php } ?>
                                    <td class="text-right"><?php if(!empty($row['delivery_date'] != "1970-01-01")){ ?>
                                    Delivery Date: <?php echo date('d/m/Y',strtotime($row['delivery_date'])); ?><?php } ?></td>
                                </tr>

                                <!-- ////////////////// Change Request 19/11/2020 -->

                                <?php if(!empty($row['weight'])){ ?><tr>
                                    <td><strong>Weight:</strong> <?php echo $row['weight']; ?></td>
                                    <td></td>
                                </tr><?php } ?>

                                <?php if(!empty($row['amount'])){ ?><tr>
                                    <td><strong>Quantity:</strong> <?php echo $row['amount']; ?> <?php echo get_unit_name($connect, $row['unit']); ?></td>
                                    <td></td>

                                </tr><?php } ?>

                                <?php if(!empty($row['goods'])){ ?><tr>
                                    <td><strong>Goods Name:</strong> <?php echo $row['goods']; ?></td>
                                    <td></td>

                                </tr><?php } ?>

                                <?php if(!empty($row['status'])){ ?><tr>
                                    <td><strong>File Status:</strong> <?php echo $row['status']; ?></td>
                                    <td></td>

                                </tr><?php } ?>

                                <?php if(!empty($row['model'])){ ?><tr>
                                    <td><strong>Model:</strong> <?php echo $row['model']; ?></td>
                                    <td></td>

                                </tr><?php } ?>

                                <?php if(!empty($row['quantity'])){ ?><tr>
                                    <td><strong>Quantity:</strong> <?php echo $row['quantity']; ?></td>
                                    <td></td>

                                </tr><?php } ?>

                                <?php if(!empty($row['payment_status'])){ ?><tr>
                                    <td><strong>Payment Status:</strong> <?php echo get_payment_status1($connect, $row['payment_status']); ?></td>
                                    <td></td>

                                </tr><?php } ?>   
                                <?php if(!empty($row['gate'])){ ?><tr>
                                    <td><strong>Gate:</strong> <?php echo $row['gate']; ?></td>
                                    <td></td>

                                </tr><?php } ?>
                                <?php if(!empty($row['expense_status'])){ ?><tr>
                                    <td><strong>Expense Status:</strong> <?php echo $row['expense_status']; ?></td>
                                    <td></td>

                                </tr><?php } ?>
                                




                            </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="row py-1">
                <div class="col-xs-12">
                 
                 <table class="table table-condensed myTable" style="margin-bottom: 10px;" width="100%">
                  <tbody>
                   <tr>
                    <td width="50%"><strong>Invoice Value :</strong> <?php echo get_invoice_currency($connect, $row['invoice_currency']); ?>   <?php echo $row['invoice_value']; ?></td>
                    <td style="text-align: right;"><strong>Assessable Value : TK.</strong> <?php echo $row['assessable_value']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs avoid-this" role="tablist">
                    <li role="presentation" class=""><a href="#bill-tab" aria-controls="bill-tab" role="tab" data-toggle="tab" aria-expanded="false"> <i class="fa fa-th"></i> Bill</a></li>
                    <li role="presentation" class="active"><a href="#expense-tab" aria-controls="bill-tab" role="tab" data-toggle="tab" aria-expanded="true"> <i class="fa fa-th"></i> Expenses</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="bill-tab">
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-condensed table-responsive myTable" width="100%">
                                    <thead class="bg-sky">
                                        <tr>
                                            <th class="text-center" style="width:5%;">S/L</th>
                                            <th style="width:73%;" class="text-center">Particulars</th>
                                            <th style="width:22%;" class="text-right">Amount in TK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $statement1 = $connect->prepare("SELECT * FROM file_bill_items WHERE file_id = '$id' ");
                                        $statement1->execute();
                                        $rowno = $statement1->rowCount();
                                        $result1 = $statement1->fetchAll();
                                        $total = 0;
                                        $count = 1;
                                        foreach ($result1 as $row1) {
                                        $total += $row1['particular_amount']; 
                                        
                                        if($row1['particular_amount'] > 0)
                                        {
                                        
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count++; ?></td>
                                            <td style="text-align:left;"><?php echo htmlentities($row1['particular_name']) ?></td>
                                            <td class="text-right col-sm-2" style="text-align: right;"> <?php echo htmlentities($row1['particular_amount']) ?></td>
                                        </tr>
                                        <?php 
                                            
                                        }
                                        }
                                        
                                        if($row['fixed_miscelleneous_amount'] > 0)
                                        {
                                         ?>
                                         
                                        <tr>
                                            <td class="text-center"> <?php echo $count; ?> </td>
                                            <td>Miscelleneous Expense</td>
                                            <td class="text-right col-sm-2" style="text-align: right;"> <?php echo htmlentities($row['fixed_miscelleneous_amount']) ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>

                                        <!-- //////////////others -->


                                        <?php
                                        $statement1 = $connect->prepare("SELECT * FROM file_others_items WHERE file_id = '$id' ");
                                        $statement1->execute();
                                        $rowno = $statement1->rowCount();
                                        $result1 = $statement1->fetchAll();
                                        $total = 0;
                                        foreach ($result1 as $row2) {
                                        
                                        $total += $row2['others_amount']; 
                                        if ($row2['others_amount']>0) {
                                           $count++;
                                        
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count; ?></td>
                                            <td><?php echo htmlentities($row2['others_name']) ?></td>
                                            <td class="text-right col-sm-2" style="text-align: right;"> <?php echo htmlentities($row2['others_amount']) ?></td>
                                        </tr>
                                        <?php }} ?>


                                        <!-- //////////////Commission -->
                                        <?php  
                                       
                                        $rate = 0;
                                        $statement = $connect->prepare("SELECT * FROM client_commission WHERE port_id = '$port' AND customer_id = '$client_name' LIMIT 1");
                                        $statement->execute();
                                        $result = $statement->fetchAll();
                                        // print_r($result)
                                        $rate = $result[0]['commission_rate'];
                                        ?>

                                        <?php
                                        $count++;  ?>
                                        <?php if ($row['agent_commission']>0){


                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count; ?></td>
                                            <td>Agency Commission @ TK <?php echo htmlentities($row['commission_rate']) ?> % </td>
                                            <td class="text-right col-sm-2" style="text-align: right;"> <?php echo htmlentities($row['agent_commission']) ?></td>
                                        </tr>
                                        <?php }  ?>
                                        <?php if ($row['minimum_commission']>0){


                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count; ?></td>
                                            <td>Minimum Commission</td>
                                            <td class="text-right col-sm-2" style="text-align: right;"> <?php echo htmlentities($row['minimum_commission']) ?></td>
                                        </tr>
                                        <?php }  ?>
                                        <!-- <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Miscelleneous Amount(TK)</td>
                                            <td class="text-right" style="text-align: right;"> <?php echo $row['fixed_miscelleneous_amount']; ?></td>
                                        </tr> -->
                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Grand Total(TK)</td>
                                            <td class="text-right" style="text-align: right;"> <?php echo htmlentities($row['bill_total']); ?></td>
                                        </tr>
                                        <?php
                                         if($row['received_advance'] > 0)
                                        {
                                         ?>
                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Received in Advance(TK)</td>
                                            <td class="text-right" style="text-align: right;"><?php echo htmlentities($row['received_advance']); ?></td>
                                        </tr>
                                        <?php
                                        }
                                        if($row['incometax_comission'] > 0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Less Income Tax on C &amp; F Commission(TK)</td>
                                            <td class="text-right" style="text-align: right;"> <?php echo htmlentities($row['incometax_comission']); ?></td>
                                        </tr>
                                        <?php
                                        }

                                        if($row['less_amount'] > 0)
                                        {
                                        ?>
                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Less Amount</td>
                                            <td class="text-right" style="text-align: right;"> <?php echo htmlentities($row['less_amount']); ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Net Payable(TK)</td>
                                            <td class="text-right" style="text-align: right;"> <?php echo htmlentities($row['net_payable']); ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold">TOTAL TK(In Word) :
                                                <?php
                                                // Create a function for converting the amount in words
                                                function AmountInWords(float $amount)
                                                {
                                                $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
                                                // Check if there is any number after decimal
                                                $amt_hundred = null;
                                                $count_length = strlen($num);
                                                $x = 0;
                                                $string = array();
                                                $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
                                                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                                                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                                                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                                                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                                                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                                                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                                                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                                                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
                                                $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
                                                while( $x < $count_length ) {
                                                $get_divider = ($x == 2) ? 10 : 100;
                                                $amount = floor($num % $get_divider);
                                                $num = floor($num / $get_divider);
                                                $x += $get_divider == 10 ? 1 : 2;
                                                if ($amount) {
                                                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                                                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                                                $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.'
                                                '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. '
                                                '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
                                                }
                                                else $string[] = null;
                                                }
                                                $implode_to_Rupees = implode('', array_reverse($string));
                                                $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . "
                                                " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
                                                return ($implode_to_Rupees ? $implode_to_Rupees . 'Taka Only ' : '') . $get_paise;
                                                }
                                                ?>
                                                <!-- call the function here -->
                                                <?php $amt_words=$row['net_payable'];
                                                // nummeric value in variable
                                                
                                                $get_amount= AmountInWords($amt_words);
                                                echo $get_amount;
                                                ?>
                                            </td>
                                        </tr><?php if(!empty($row['remarks'])){ ?>
                                        <tr></tr>
                                        <tr style="margin-top:40px;"><td style="white-space: pre-line">Remarks: <?php echo htmlentities($row['remarks']); ?></td></tr> <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active avoid-this" id="expense-tab">
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-condensed table-responsive myTable" width="100%">
                                    <thead class="bg-sky">
                                        <tr>
                                            <th style="width:5%;">S/L</th>
                                            <th style="width:70%;" class="text-center">Particulars</th>
                                            <th style="width:25%;" class="text-right">Amount in TK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $statement1 = $connect->prepare("SELECT * FROM file_expenses_items WHERE file_id = '$id' ");
                                        $statement1->execute();
                                        $rowno = $statement1->rowCount();
                                        $result1 = $statement1->fetchAll();
                                        $total = 0;
                                        $count = 1;
                                        foreach ($result1 as $row2) {
                                        $total += $row2['expenses_amount'];
                                        if($row2['expenses_amount'] > 0)
                                        {
                                         ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo htmlentities($row2['expenses_name']) ?></td>
                                            <td class="text-right col-sm-2" style="text-align: right;"><?php echo htmlentities($row2['expenses_amount']) ?></td>
                                        </tr>
                                        <?php } } ?>
                                        <tr>

                                        <tr>
                                            <td colspan="2" class="text-right text-bold" style="text-align: right;"> Grand Total(TK)</td>
                                            <td class="text-right"> <?php echo htmlentities($row['expenses_total']) ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold myTable">
                                                <!-- call the function here -->
                                                <?php $amt_words=$row['expenses_total'];
                                                // nummeric value in variable
                                                
                                                $get_amount= AmountInWords($amt_words);
                                                echo $get_amount."<br><br><br>";
                                                ?>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <br>
            <div class="" width="100%">
                <table width="100%">
                    <tr>
                        <td style="text-align: left; padding-left: 18px;">__________</td>
                        <td>___________</td>
                        <td align='right'>______________</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; padding-left: 18px;">Accountant</td>
                        <td>Checked By</td>
                        <td align='right'>For ICM Freight <br></td><br>
                    </tr><br>
                    <tr></tr>

                </table>
            
                    <br>
                <img src="../images/footer.jpg" width="100%">
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
        </div>
    </section>
    <?php } ?>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
<script type="text/javascript" language="javascript">
$(document).ready(function () {
$('#myTable').dataTable({
"aaSorting": [[0, 'desc']]
});
});
//////////////////////////////////////////// DELETE
$(document).on('click', '.delete', function () {
var expenses_id = $(this).attr('id');
var status = $(this).data("status");
var btn_action = 'delete';
if (confirm("Are you sure you want to change status?")) {
$.ajax({
url: "expenses_action.php",
method: "POST",
data: {expenses_id: expenses_id, status: status, btn_action: btn_action},
success: function (data) {
$('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
// myTable.ajax.reload();
location.reload();
}
})
} else {
return false;
}
});
</script>
<script type="text/javascript">
jQuery(function ($) {
$("#divToPrint").find('button').on('click', function () {
$("#divToPrint").print({
//Use Global styles
globalStyles: false,
//Add link with attrbute media=print
mediaPrint: false,
//Custom stylesheet
stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
//Print in a hidden iframe
iframe: false,
//Don't print this
noPrintSelector: ".avoid-this",
//Add this at top
prepend: "",
//Add this on bottom
append: "",
//Log to console when printing is done via a deffered callback
deferred: $.Deferred().done(function () {
console.log('Printing done', arguments);
})
});
});
});
</script>
<script src="../assets/js/num-to-words.js" type="text/javascript"></script>
<script>
//Enter Only Numbers
$(".text-right").keypress(function (e) {
//if the letter is not digit then display error and don't type anything
if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message
return false;
}
});
var words="";
$(function() {
var net_payable = document.getElementById('net_payable').value;
$("#totalval").val(totalamount);
words = toWords(net_payable);
$("#amount-rupees").val(words + "Taka Only");
});
</script>