<?php  
$message = '';
if (isset($_POST["agent_reference"])) {
    sleep(5);
    $query = "
INSERT INTO file
(bill_no, client_name, client_address, agent_reference, bill_of_entry_date, san_no, assessable_value, zone, attention) VALUES
(:bill_no, :client_name, :client_address, :agent_reference, :bill_of_entry_date, :san_no, :assessable_value, :zone, :attention)
";
    $user_data = array(
        ':bill_no' => $_POST["bill_no"],
        ':client_name' => $_POST["client_name"],
        ':client_address' => $_POST["client_address"],
        ':agent_reference' => $_POST["agent_reference"],
        ':bill_of_entry_date' => $_POST["bill_of_entry_date"],
        ':san_no' => $_POST["san_no"],
        ':assessable_value' => $_POST["assessable_value"],
        ':zone' => $_POST["zone"],
        ':attention' => $_POST["attention"]
    );
    $statement = $connect->prepare($query);
    if ($statement->execute($user_data)) {
        $message = '
<div class="alert alert-success">
  File Created Successfully
</div>
';
    } else {
        $message = '
<div class="alert alert-success">
  There is an error in File Creation
</div>
';
    }
}
include 'navbar.php'; ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php include './sidebar.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Open File List</h3>
                <span id="alert_action"></span>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="file_opening.php">File</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create File</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            </p>
                            <div class="alert alert-success alert-dismissible" id="asset_success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-success alert-dismissible" id="form_response" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-success alert-dismissible" id="alert_action" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <!-- Tab -->
                            <?php echo $message; ?>
                            <form method="post" id="register_form">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active_tab1" style="border:1px solid #ccc"
                                           id="list_login_details">Page 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link inactive_tab1" id="list_personal_details"
                                           style="border:1px solid #ccc">Page 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link inactive_tab1" id="list_contact_details"
                                           style="border:1px solid #ccc">Page 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="margin-top:16px;">
                                    <div class="tab-pane active" id="login_details">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Login Details</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Client Name</label>
                                                    <input type="text" name="client_name" id="client_name"
                                                           class="form-control"/>
                                                    <span id="error_client_name" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="client_address" id="client_address"
                                                           class="form-control"/>
                                                    <span id="error_client_name" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Zone</label>
                                                    <select class="form-control select2-hidden-accessible" name="zone"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="Dhaka" selected="">Dhaka</option>
                                                        <option value="Chittagong">Chittagong</option>
                                                        <option value="Sylhet">Sylhet</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile </label>
                                                    <input type="text" name="client_mobile" class="form-control"
                                                           id="client_mobile" placeholder="Mobile">
                                                </div>
                                                <div class="form-group">
                                                    <label>Attention</label>
                                                    <input type="text" name="attention" id="attention"
                                                           class="form-control"/>
                                                    <span id="error_attention" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight</label>
                                                    <input type="text" name="weight" id="weight" class="form-control"/>
                                                    <span id="error_weight" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <input type="text" name="unit" id="unit" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Goods</label>
                                                    <input type="text" name="goods" id="goods" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input type="text" name="status" id="status" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Model</label>
                                                    <input type="text" name="model" id="model" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="text" name="quantity" id="quantity"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Payment Status</label>
                                                    <input type="text" name="payment_status" id="payment_status"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Payment Date</label>
                                                    <input type="text" name="payment_date" id="payment_date"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bill No</label>
                                                    <input type="text" name="bill_no" id="bill_no"
                                                           class="form-control"/>
                                                    <span id="error_bill_no" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agent Reference</label>
                                                    <input type="text" name="agent_reference" id="agent_reference"
                                                           class="form-control"/>
                                                    <span id="error_agent_reference" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bill of entry date</label>
                                                    <input type="date" name="bill_of_entry_date" id="bill_of_entry_date"
                                                           class="form-control"/>
                                                    <span id="error_bill_of_entry_date" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Job No</label>
                                                    <input type="text" name="job_no" id="job_no" class="form-control"/>
                                                    <span id="error_job_no" class="text-danger"></span>
                                                </div>
                                                <br/>
                                                <div align="center">
                                                    <button type="button" name="btn_login_details"
                                                            id="btn_login_details" class="btn btn-primary btn-lg">Next
                                                    </button>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="personal_details">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Fill Personal Details</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Bill No</label>
                                                    <input type="text" name="bill_no" id="bill_no"
                                                           class="form-control"/>
                                                    <span id="error_bill_no" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Zone</label>
                                                    <input type="text" name="zone" id="zone" class="form-control"/>
                                                    <span id="error_client_name" class="text-danger"></span>
                                                </div>

                                                <br/>
                                                <div align="center">
                                                    <button type="button" name="previous_btn_personal_details"
                                                            id="previous_btn_personal_details"
                                                            class="btn btn-default btn-lg">Previous
                                                    </button>
                                                    <button type="button" name="btn_personal_details"
                                                            id="btn_personal_details" class="btn btn-primary btn-lg">Next
                                                    </button>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact_details">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Fill Contact Details</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>San No</label>
                                                    <textarea name="san_no" id="san_no" class="form-control"></textarea>
                                                    <span id="error_san_no" class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Assasable Value</label>
                                                    <input type="text" name="assessable_value" id="assessable_value"
                                                           class="form-control"/>
                                                    <span id="error_assessable_value" class="text-danger"></span>
                                                </div>
                                                <br/>
                                                <div align="center">
                                                    <button type="button" name="previous_btn_contact_details"
                                                            id="previous_btn_contact_details"
                                                            class="btn btn-default btn-lg">Previous
                                                    </button>
                                                    <button type="button" name="btn_contact_details"
                                                            id="btn_contact_details" class="btn btn-success btn-lg">
                                                        Register
                                                    </button>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../footer.php'; ?>
        <script>
            $(document).ready(function () {

                $('#btn_login_details').click(function () {

                    var error_agent_reference = '';
                    var error_bill_of_entry_date = '';
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if ($.trim($('#agent_reference').val()).length == 0) {
                        error_agent_reference = 'agent_reference is required';
                        $('#error_agent_reference').text(error_agent_reference);
                        $('#agent_reference').addClass('has-error');
                    }

                    if ($.trim($('#bill_of_entry_date').val()).length == 0) {
                        error_bill_of_entry_date = 'bill_of_entry_date is required';
                        $('#error_bill_of_entry_date').text(error_bill_of_entry_date);
                        $('#bill_of_entry_date').addClass('has-error');
                    }
                    if (error_agent_reference != '' || error_bill_of_entry_date != '') {
                        return false;
                    } else {
                        $('#list_login_details').removeClass('active active_tab1');
                        $('#list_login_details').removeAttr('href data-toggle');
                        $('#login_details').removeClass('active');
                        $('#list_login_details').addClass('inactive_tab1');
                        $('#list_personal_details').removeClass('inactive_tab1');
                        $('#list_personal_details').addClass('active_tab1 active');
                        $('#list_personal_details').attr('href', '#personal_details');
                        $('#list_personal_details').attr('data-toggle', 'tab');
                        $('#personal_details').addClass('active in');
                    }
                });

                $('#previous_btn_personal_details').click(function () {
                    $('#list_personal_details').removeClass('active active_tab1');
                    $('#list_personal_details').removeAttr('href data-toggle');
                    $('#personal_details').removeClass('active in');
                    $('#list_personal_details').addClass('inactive_tab1');
                    $('#list_login_details').removeClass('inactive_tab1');
                    $('#list_login_details').addClass('active_tab1 active');
                    $('#list_login_details').attr('href', '#login_details');
                    $('#list_login_details').attr('data-toggle', 'tab');
                    $('#login_details').addClass('active in');
                });

                $('#btn_personal_details').click(function () {
                    var error_bill_no = '';
                    var error_client_name = '';

                    if ($.trim($('#bill_no').val()).length == 0) {
                        error_bill_no = 'First Name is required';
                        $('#error_bill_no').text(error_bill_no);
                        $('#bill_no').addClass('has-error');
                    } else {
                        error_bill_no = '';
                        $('#error_bill_no').text(error_bill_no);
                        $('#bill_no').removeClass('has-error');
                    }

                    if ($.trim($('#client_name').val()).length == 0) {
                        error_client_name = 'Last Name is required';
                        $('#error_client_name').text(error_client_name);
                        $('#client_name').addClass('has-error');
                    } else {
                        error_client_name = '';
                        $('#error_client_name').text(error_client_name);
                        $('#client_name').removeClass('has-error');
                    }
                    if (error_bill_no != '' || error_client_name != '') {
                        return false;
                    } else {
                        $('#list_personal_details').removeClass('active active_tab1');
                        $('#list_personal_details').removeAttr('href data-toggle');
                        $('#personal_details').removeClass('active');
                        $('#list_personal_details').addClass('inactive_tab1');
                        $('#list_contact_details').removeClass('inactive_tab1');
                        $('#list_contact_details').addClass('active_tab1 active');
                        $('#list_contact_details').attr('href', '#contact_details');
                        $('#list_contact_details').attr('data-toggle', 'tab');
                        $('#contact_details').addClass('active in');
                    }
                });

                $('#previous_btn_contact_details').click(function () {
                    $('#list_contact_details').removeClass('active active_tab1');
                    $('#list_contact_details').removeAttr('href data-toggle');
                    $('#contact_details').removeClass('active in');
                    $('#list_contact_details').addClass('inactive_tab1');
                    $('#list_personal_details').removeClass('inactive_tab1');
                    $('#list_personal_details').addClass('active_tab1 active');
                    $('#list_personal_details').attr('href', '#personal_details');
                    $('#list_personal_details').attr('data-toggle', 'tab');
                    $('#personal_details').addClass('active in');
                });

                $('#btn_contact_details').click(function () {
                    var error_san_no = '';
                    var error_assessable_value = '';
                    var mobile_validation = /^\d{10}$/;
                    if ($.trim($('#san_no').val()).length == 0) {
                        error_san_no = 'san_no is required';
                        $('#error_san_no').text(error_san_no);
                        $('#san_no').addClass('has-error');
                    } else {
                        error_san_no = '';
                        $('#error_san_no').text(error_san_no);
                        $('#san_no').removeClass('has-error');
                    }

                    if ($.trim($('#assessable_value').val()).length == 0) {
                        error_assessable_value = 'Mobile Number is required';
                        $('#error_assessable_value').text(error_assessable_value);
                        $('#assessable_value').addClass('has-error');
                    }
                    if (error_san_no != '' || error_assessable_value != '') {
                        return false;
                    } else {
                        $('#btn_contact_details').attr("disabled", "disabled");
                        $(document).css('cursor', 'prgress');
                        $("#register_form").submit();
                    }

                });

            });
        </script>