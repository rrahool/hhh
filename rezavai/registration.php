<?php include 'header.php'?>
<?php
use appoindar\DatabaseClass;

$dbcon = new DatabaseClass();

// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     $fields = implode(",",array_keys($_POST));

//     $values = "'".implode("','",array_values($_POST))."'";

//     $qry = "INSERT into user_details($fields) values($values)";
//     echo $qry;die;
//     mysqli_query($dbcon->conn, $qry);
// }

// $selectQry = "SELECT * FROM user_details WHERE user_id = ".$_GET['id'];
// $runQry = mysqli_query($dbcon->conn, $selectQry);
// $userd = mysqli_fetch_assoc($runQry);

$id = $_REQUEST['id'];
$row = $dbcon->edit($id);

if(isset($_POST['update'])){
    if(
        isset($_POST['fname']) && 
        isset($_POST['mname']) && 
        isset($_POST['lname']) && 
        isset($_POST['gender']) && 
        isset($_POST['dob']) && 
        isset($_POST['doj']) && 
        isset($_POST['occupation']) && 
        isset($_POST['degree']) && 
        isset($_POST['designation']) && 
        isset($_POST['srvc_yr']) && 
        isset($_POST['business_type']) && 
        isset($_POST['address']) && 
        isset($_POST['address2']) && 
        isset($_POST['city']) && 
        isset($_POST['state']) && 
        isset($_POST['zip']) && 
        isset($_POST['country']) && 
        isset($_POST['interest']) && 
        isset($_POST['user_code'])){
        if(
            !empty($_POST['fname']) && 
            !empty($_POST['mname']) && 
            !empty($_POST['lname']) && 
            !empty($_POST['gender']) && 
            !empty($_POST['dob']) && 
            !empty($_POST['doj']) && 
            !empty($_POST['occupation']) && 
            !empty($_POST['address']) && 
            !empty($_POST['address2']) && 
            !empty($_POST['city']) && 
            !empty($_POST['state']) && 
            !empty($_POST['zip']) && 
            !empty($_POST['country']) && 
            !empty($_POST['interest']) && 
            !empty($_POST['user_code'])) {
                $data['id'] = $id;
                $data['fname'] = $_POST['fname'];
                $data['mname'] = $_POST['mname'];
                $data['lname'] = $_POST['lname'];
                $data['gender'] = $_POST['gender'];
                $data['dob'] = $_POST['dob'];
                $data['doj'] = $_POST['doj'];
                $data['occupation'] = $_POST['occupation'];
                $data['degree'] = $_POST['degree'];
                $data['designation'] = $_POST['designation'];
                $data['srvc_yr'] = $_POST['srvc_yr'];
                $data['business_type'] = $_POST['business_type'];
                $data['address'] = $_POST['address'];
                $data['address2'] = $_POST['address2'];
                $data['city'] = $_POST['city'];
                $data['state'] = $_POST['state'];
                $data['zip'] = $_POST['zip'];
                $data['country'] = $_POST['country'];
                $data['interest'] = $_POST['interest'];
                $data['user_code'] = $_POST['user_code'];
                
                $update = $dbcon->update($data);

                if($update){
                    echo "<script>alert('registration successfully');</script>";
                    echo "<script>window.location.href = 'registration.php?id=$id'</script>";
                } else {
                    echo "<script>alert('registration failed');</script>";
                    echo "<script>window.location.href = 'registration.php?id=$id'</script>";
                }
            
        } else {
            echo "<script>alert('empty');</script>";
            header("Location: registration.php?id=$id");
        }
    }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<style>
    table, td, th {border:none !important;}
    td, th{padding: 3px !important;}
    .occupation{display:none;}
</style>
        <div class="row">
            <div class="col-md-12">
                <div class="border border-black">
                    <!-- Nav tabs -->
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <span class="nav-link" data-toggle="tab">Step 1</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" data-toggle="tab">Step 2</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" data-toggle="tab">Finish</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active "><br>
                            <form id="regForm" class="form-horizontal " action="" method="post">
                                <div class="form-body-area contact-box">
                                    <div class="row d-flex justify-content-center contact-left">
                                        <div class="col-md-12">
                                            <div class="input-row">
                                                <input type="hidden" name="user_id" value="<?=$_GET['id']?>">
                                                <div class="input-group">
                                                    <label> First Name </label>
                                                    <input class="form-control" type="text" name="fname" placeholder="First Name" value="<?=$row['fname']?>" />
                                                </div>
                                                <div class="input-group">
                                                    <label> Middle Name </label>
                                                    <input class="form-control" type="text" name="mname" placeholder="Middle Name" value="<?=$row['mname']?>"/>
                                                </div>
                                                <div class="input-group">
                                                    <label> Last Name </label>
                                                    <input class="form-control" type="text" name="lname" placeholder="Last Name" value="<?=$row['lname']?>"/>
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label> Gender </label>
                                                    <select class="form-control" name="gender" id="">
                                                        <option>Select</option>
                                                        <option <?php echo ( $row['gender'] == "Male")?"selected":"";?>>Male</option>
                                                        <option <?php echo ( $row['gender'] == "Female")?"selected":"";?>>Female</option>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <label> Date of Birth </label>
                                                    <input class="form-control date" id="" name="dob" type="text" placeholder="mm/dd/yyyy" value="<?=$row['dob']?>" />
                                                </div>
                                                <div class="input-group">
                                                    <label> Date of Joining </label>
                                                    <input class="form-control date" name="doj" type="text" placeholder="mm/dd/yyyy" value="<?=date('m/d/Y')?>"/>
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label> Occupation </label>
                                                    <select class="form-control" name="occupation" id="occupation">
                                                        <option>Select</option>
                                                        <option <?php echo ( $row['occupation'] == "Student")?"selected":"";?>>Student</option>
                                                        <option <?php echo ( $row['occupation'] == "Service")?"selected":"";?>>Service</option>
                                                        <option <?php echo ( $row['occupation'] == "Business")?"selected":"";?>>Business</option>
                                                    </select>
                                                </div>
                                                <div class="input-group occupation Student">
                                                    <label> Degree </label>
                                                    <select name="degree" class="form-control" id="">
                                                        <option>Select</option>
                                                        <option <?php echo ( $row['degree'] == "Master")?"selected":"";?>>Master</option>
                                                        <option <?php echo ( $row['degree'] == "Bachelor")?"selected":"";?>>Bachelor</option>
                                                    </select>
                                                </div>
                                                <div class="input-group occupation Service">
                                                    <label> Designation </label>
                                                    <select name="designation" class="form-control" id="">
                                                        <option>Select</option>
                                                        <option <?php echo ( $row['designation'] == "Executive")?"selected":"";?>>Executive</option>
                                                        <option <?php echo ( $row['designation'] == "Manager")?"selected":"";?>>Manager</option>
                                                    </select>
                                                </div>
                                                <div class="input-group occupation Service">
                                                    <label> Years of service </label>
                                                    <input name="srvc_yr" class="form-control" value="<?=$row['srvc_yr']?>">
                                                </div>
                                                <div class="input-group occupation Business">
                                                    <label> Type of Business </label>
                                                    <select class="form-control" id="business_type" name="business_type">
                                                        <option>Select Business Type</option>
                                                        <option <?php echo ( $row['business_type'] == "Proprietorship")?"selected":"";?>>Proprietorship</option>
                                                        <option <?php echo ( $row['business_type'] == "Partnership")?"selected":"";?>>Partnership</option>
                                                    </select>
                                                </div>
                                                <div class="input-group occupation Partnership">
                                                    <label> Percentage of share </label>
                                                    <input name="share" class="form-control" id="" value="<?=$row['share']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body-area">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label> Holding Address </label>
                                                    <input class="form-control" type="text" name="address" placeholder="Address1" value="<?=$row['address']?>"/>
                                                </div>
                                                <div class="input-group">
                                                    <label> Holding Address 2 </label>
                                                    <input class="form-control" type="text" name="address2" placeholder="Address2" value="<?=$row['address2']?>"/>
                                                </div>
                                                <div class="input-group">
                                                    <label> City </label>
                                                    <input class="form-control" type="text" name="city" placeholder="City" value="<?=$row['city']?>">
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label> State/Province </label>
                                                    <input class="form-control" type="text" name="state" placeholder="State/Province" value="<?=$row['state']?>">
                                                </div>
                                                <div class="input-group">
                                                    <label> Zip/Postal Code </label>
                                                    <input class="form-control" type="text" name="zip" placeholder="Zip/Postal Code" value="<?=$row['zip']?>"/>
                                                </div>
                                                <div class="input-group">
                                                    <label> Country </label>
                                                    <select class="form-control" id="" name="country">
                                                        <option selected="selected">Select Country</option>
                                                        <option <?php echo ( $row['country'] == "Bangladesh")?"selected":"";?>>Bangladesh</option>
                                                        <option <?php echo ( $row['country'] == "USA")?"selected":"";?>>USA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-row">
                                                <div class="input-group">
                                                    <label> Email </label>
                                                    <input class="form-control" type="text" readonly name="email" value="john@doe.com"/>
                                                </div>
                                                <div class="input-group">
                                                    <label> Field of Interests </label>
                                                    <select class="form-control" name="interest" >
                                                        <option selected="selected">Select From the list</option>
                                                        <option <?php echo ( $row['interest'] == "IT Related in USA")?"selected":"";?>>IT Related in USA</option>
                                                        <option <?php echo ( $row['interest'] == "Gas Station in USA")?"selected":"";?>>Gas Station in USA</option>
                                                        <option <?php echo ( $row['interest'] == "Investment in USA")?"selected":"";?>>Investment in USA</option>
                                                        <option <?php echo ( $row['interest'] == "Investment on Real Estate in USA")?"selected":"";?>>Investment on Real Estate in USA</option>
                                                        <option <?php echo ( $row['interest'] == "Garments")?"selected":"";?>>Garments</option>
                                                        <option <?php echo ( $row['interest'] == "Equipment or Spare Parts")?"selected":"";?>>Equipment or Spare Parts</option>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <label> ID Generation </label>
                                                    <input type="text" class="form-control" id="user_code" placeholder="Enter your id" name="user_code" value="<?=$row['user_code']?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>


                                <div class="form-button-area d-flex justify-content-center">

                                    <button type="reset" class="btn btn-primary" tabindex="53">Clear</button>

                                    <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)" tabindex="54">Previous</button>

                                    <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)" tabindex="55">Next</button>

                                    <button type="submit" name="update" id="updateBtn" class="btn btn-primary" tabindex="56">Submit</button>

                                </div>


                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px; display: none;">
                                    <span class="step"></span>
                                    <span class="step"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
        $(".datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true
        }).datepicker('update', new Date());
        });
    </script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function test(){
        console.log('submit button clicked');
    }

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("form-body-area");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            const updateBtn = document.getElementById("updateBtn");
            updateBtn.style.display = "none";
            const nextBtn = document.getElementById("nextBtn");
            nextBtn.style.display = "inline";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            const updateBtn = document.getElementById("updateBtn");
            updateBtn.style.display = "inline";
            const nextBtn = document.getElementById("nextBtn");
            nextBtn.style.display = "none";
        }
        // if (n == (x.length - 1)) {
        //     const nextBtn = document.getElementById("nextBtn");
        //     nextBtn.style.display = "none";
        // } else {
        //     const updateBtn = document.getElementById("updateBtn");
        //     updateBtn.style.display = "none";
        // }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("form-body-area");
        // Exit the function if any field in the current tab is invalid:
        // if (n == 1) return false;
        // if (n == 1 && !validateForm()) return false;
        console.log(n);
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return true;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("form-body-area");
        y = x[currentTab].getElementsByTagName("input");
        // // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step and nav-menu as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
            document.getElementsByClassName("nav-link")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps and nav-menus...
        var i, x = document.getElementsByClassName("step");
        var y = document.getElementsByClassName("nav-link");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
            y[i].className = y[i].className.replace("active", "");
        }
        //... and adds the "active" class on the current step and nav-menu:
        x[n].className += " active";
        y[n].className += " active";
    }

    // const nextBtn = document.getElementById("nextBtn");
    // nextBtn.addEventListener("click", function(){
    //     elementID("plan_name", "r_plan_name");
    //     elementID("pay_mode", "r_pay_mode");
    //     elementID("pay_cycle", "r_pay_cycle");
    //     elementID("institute", "r_institute");
    //     elementID("reg_address", "r_reg_address");
    //     elementID("owner", "r_owner");
    //     elementID("owner_mobile", "r_owner_mobile");
    //     elementID("owner_email", "r_owner_email");
    // });

    function elementID(get_id, set_id) {
        var x = document.getElementById(get_id).value;
        document.getElementById(set_id).innerHTML = x;
    }

    $("#occupation").change(function () {
        let occ = $(this).val();
        $(".occupation").hide();
        $("."+occ).show();
    });

    $("#business_type").change(function () {
        let occ = $(this).val();
        $(".Partnership").hide();
        $("."+occ).show();
    });

    $('.date').mask("99/99/9999");
    $('.date').change(function() {

        if ($(this).val().substring(0, 2) > 12 || $(this).val().substring(0, 2) == "00") {
            alert("Iregular Month Format");
            return false;
        }
        if ($(this).val().substring(3, 5) > 31 || $(this).val().substring(0, 2) == "00") {
            alert("Iregular Date Format");
            return false;
        }
    });
</script>
</body>
</html>
