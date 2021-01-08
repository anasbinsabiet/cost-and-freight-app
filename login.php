<?php
// session_destroy();
// session_start();
include 'db.php';
include 'function.php';


                    
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }

 $visitor_visit_time = $_SERVER['REQUEST_TIME'];

 $visitor_visit_time = date("Y-m-d", $visitor_visit_time);
 
 // $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $actual_link;
 $visitor_location = "";

// print_r($_SERVER);

 $query1 = "
        SELECT * FROM login_log WHERE visitor_ip = '$ip_address' AND visitor_visit_time = '$visitor_visit_time' ORDER BY createdate DESC LIMIT 1
        ";

        $statement1 = $connect->prepare($query1);
        $statement1->execute();

        $result1 = $statement1->fetchAll();

        // print_r($result1);


        $rowcount = $statement1->rowCount();

if($rowcount == 0)
{

$res = file_get_contents('https://www.iplocate.io/api/lookup/'.$ip_address);
$res = json_decode($res);

 $visitor_location = "Zip Code : ".$res->postal_code.", City : ".$res->city.", Division : ".$res->subdivision2.", Country : ".$res->country.", Latitude : ".$res->latitude.", Longitude : ".$res->longitude;

 // echo $visitor_location;

}

if(empty($visitor_location))
{
         $visitor_location = $result1[0]['visitor_location'];
    
}

$message = '';

if (isset($_POST["submit"])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    // echo $mail."<br>".$pass;
    $query = "SELECT * FROM user WHERE user_name = :user_name";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'user_name' => $_POST["user_name"]
        )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if ($row['user_delete'] == '0') {
                if (password_verify($_POST["user_password"], $row["user_password"])) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['user_role'] = $row['user_role'];

    $query = "
            INSERT INTO login_log (user_id, user_name, user_role_id, user_role_name, visitor_ip, visitor_location, visitor_visit_time) VALUES('$user_id', '$user_name', '$role_id', '$role_name','$ip_address','$visitor_location','$visitor_visit_time' )
            ";

        $statement = $connect->prepare($query);
        $statement->execute();

        $login_log_id = $connect->prepare("SELECT LAST_INSERT_ID()");
        $login_log_id->execute();
        
        $login_log_id_result = $login_log_id->fetchAll();
        
        $_SESSION['login_log_id'] = $login_log_id_result[0]['LAST_INSERT_ID()'];

                        header("location:dashboard/index.php");

                    
                } else {

                    $message = "<label>Wrong Password</label>";

                }
            } else {

                $message = "<label>Your account is disabled,<br> Contact with a Higher Authority.</label>";

            }
        }
    } else {
        $message = "<label>Wrong Username</labe>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ICM FREIGHT</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="lib/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="lib/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="lib/css/login/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="lib/images/favicon.ico"/>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-8 mx-auto">
                    <div class="auth-form-light text-left p-3">
                        <div class="logo">
                            <!-- <center><h1>CNF APP</h1></center> -->
                            <!-- <center></center> -->
                        </div>
                        <div class="row">
                            <div class="col-xs-6 p-5">
                                <img src="lib/images/bg.jpg">
                            </div>
                            <div class="col-xs-6 p-3">
                                <p class="text-right"><img src="lib/images/logo.png" width="150px" style="margin-right: 60px;"></p>
                                <form class="pt-4" action="" method="post">
                                    <input type='hidden' name='submitted' id='submitted' value='1'/>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="user_name"
                                               name="user_name" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" id="user_password"
                                               name="user_password" placeholder="Password">
                                    </div>
                                    <div class="mt-3">
                                        <p><b style="color:red;"><?php echo $message; ?></b></p>
                                        <input type="submit" value="Submit" name="submit"
                                               class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p>
                        <center>Powered by <a href="https://zaimahtech.com/" target="_blank">Zaimah Technologies Ltd</a></center>
                        </p>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="./assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="./assets/js/off-canvas.js"></script>
<script src="./assets/js/hoverable-collapse.js"></script>
<script src="./assets/js/misc.js"></script>
<!-- endinject -->
</body>
</html>