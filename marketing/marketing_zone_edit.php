<?php include '../navbar.php';
 
include '../function.php';
include '../sidebar.php'; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h4>Edit Marketing Zone</h4>
        <ol class="breadcrumb">
            <a href="marketing_zone.php" class="btn btn-block btn-primary"><i class="fa fa-undo"></i> Back to Marketing Zone</a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <?php
            $id = $_GET['id'];
            $statement = $connect->prepare("SELECT * FROM marketing_zone WHERE marketing_zone_id = '$id' ");
            $statement->execute();
            $rowno = $statement->rowCount();
            $result = $statement->fetchAll();
            foreach ($result

            as $row) {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                            <p class="alert alert-primary" role="alert" id="alert_action" style="display:none;"></p>
                            <form class="form-sample" id="addmarketing_zone" action="" method="">
                                
                                <div class="form-group">
                            <label for="marketing_division_name">Marketing Division Name</label>
                            <Select name="marketing_division_name" id="marketing_division_name" onchange="divisionsList();" class="form-control" required>
                                <option value="" disabled >Select a Division</option>
                                <option value="<?php echo $row['marketing_zone_division']; ?>" selected><?php echo $row['marketing_zone_division']; ?></option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Rajshahi">Rajshahi</option>

                                <option value="Khulna">Khulna</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Sylhet">Sylhet</option>
                                
                            </Select>
                        </div>

                        <div class="form-group">
                            
                            <label for="marketing_district_name">Select District</label>
                            <select name="marketing_district_name" id="marketing_district_name" class="form-control" required>
                                <option value="<?php echo $row['marketing_zone_district']; ?>"><?php echo $row['marketing_zone_district']; ?></option>
                            
                            </select>
                        </div>


                                <input type="hidden" name="marketing_zone_id" id="marketing_zone_id" value="<?php echo $row['marketing_zone_id']; ?>"/>

                                <div class="form-group">
                                    <label for="marketing_zone_name">Marketing Zone Name</label>
                                    <input type="text" name="marketing_zone_name" id="marketing_zone_name" class="form-control" value="<?php echo $row['marketing_zone_name']; ?>"/>
                                </div>

                                <input type="hidden" name="btn_action" id="btn_action" value="Edit"/>
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit"/>

                            </form>
                        </div>
                </div>
            </div>
        <?php } ?>
        </section>
</div>
<!-- /.content-wrapper -->
<?php include '../footer.php'; ?>
        <script>


function divisionsList() {
    // get value from division lists
    var diviList = document.getElementById('marketing_division_name').value;

    // set barishal division districts
    if(diviList == 'Barisal'){     
        var disctList = '<option disabled selected>Select District</option><option value="Barguna">Barguna</option><option value="Barisal">Barisal</option><option value="Bhola">Bhola</option><option value="Jhalokati">Jhalokati</option><option value="Patuakhali">Patuakhali</option><option value="Pirojpur">Pirojpur</option>';
    }
    // set Chattogram division districts
    else if(diviList == 'Chittagong') {
        var disctList = '<option disabled selected>Select District</option><option value="Bandarban">Bandarban</option><option value="Chandpur">Chandpur</option><option value="Chittagong">Chittagong</option><option value="Cumilla">Cumilla</option><option value="Cox\'s Bazar">Cox\'s Bazar</option><option value="Feni">Feni</option><option value="Khagrachhari">Khagrachhari</option><option value="Noakhali">Noakhali</option><option value="Rangamati">Rangamati</option>';   
    }
    // set Dhaka division districts
    else if(diviList == 'Dhaka') {
        var disctList = '<option disabled selected>Select District</option><option value="Dhaka">Dhaka</option><option value="Faridpur">Faridpur</option><option value="Gazipur">Gazipur</option><option value="Gopalganj">Gopalganj</option><option value="Kishoreganj">Kishoreganj</option><option value="Madaripur">Madaripur</option><option value="Manikganj">Manikganj</option><option value="Munshiganj">Munshiganj</option><option value="Narayanganj">Narayanganj</option><option value="Narsingdi">Narsingdi</option><option value="Rajbari">Rajbari</option><option value="Shariatpur">Shariatpur</option><option value="Tangail">Tangail</option>';
    }
    // set Rajshahi division districts
    else if(diviList == 'Rajshahi') {
        var disctList = '<option disabled selected>Select District</option><option value="Sirajganj">Sirajganj</option><option value="Pabna">Pabna</option><option value="Bogura">Bogura</option><option value="Rajshahi">Rajshahi</option><option value="Natore">Natore</option><option value="Joypurhat">Joypurhat</option><option value="Chapainawabganj">Chapainawabganj</option><option value="Naogaon">Naogaon</option>';
    }
    // set Khulna division districts
    else if(diviList == 'Khulna') {
        var disctList = '<option disabled selected>Select District</option><option value="Jashore">Jashore</option><option value="Satkhira">Satkhira</option><option value="Meherpur">Meherpur</option><option value="Narail">Narail</option><option value="Chuadanga">Chuadanga</option><option value="Kushtia">Kushtia</option><option value="Magura">Magura</option><option value="Khulna">Khulna</option><option value="Bagerhat">Bagerhat</option><option value="Jhenaidah">Jhenaidah</option>';
    }
    // set Mymensingh division districts
    else if(diviList == 'Mymensingh') {
        var disctList = '<option disabled selected>Select District</option><option value="Netrokona">Netrokona</option><option value="Jamalpur">Jamalpur</option><option value="Mymensingh">Mymensingh</option><option value="Sherpur">Sherpur</option>';
    }
    // set Rangpur division districts
    else if(diviList == 'Rangpur') {
        var disctList = '<option disabled selected>Select District</option><option value="Panchagarh">Panchagarh</option><option value="Dinajpur">Dinajpur</option><option value="Lalmonirhat">Lalmonirhat</option><option value="Nilphamari">Nilphamari</option><option value="Gaibandha">Gaibandha</option><option value="Thakurgaon">Thakurgaon</option><option value="Rangpur">Rangpur</option><option value="Kurigram">Kurigram</option>';
    }
    // set Sylhet division districts
    else if(diviList == 'Sylhet') {
        var disctList = '<option disabled selected>Select District</option><option value="Sylhet">Sylhet</option><option value="Sunamganj">Sunamganj</option><option value="Habiganj">Habiganj</option><option value="Moulvibazar">Moulvibazar</option>';
    }
    //  set/send districts name to District lists from division
    document.getElementById("marketing_district_name").innerHTML= disctList;
}


            $(document).ready(function () {
                ////////////// Edit
                $(document).on('submit', '#addmarketing_zone', function (event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $('#action').attr('disabled', 'disabled');
                    // alert(form_data);
                    $.ajax({
                        url: "marketing_zone_action.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            $('#addmarketing_zone')[0].reset();
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            $('#action').attr('disabled', false);
                        }
                    })
                });
            });
        </script>