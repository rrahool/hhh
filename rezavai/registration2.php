<?php include 'header.php'?>
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
                            <form id="regForm" class="form-horizontal " action="success.html">
                                <div class="form-body-area">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <b><i>Member Information</i></b>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>Name: </th>
                                                    <td colspan="3">
                                                        <div class="row">
                                                        <div class="col-4"><input class="form-control" type="text" name="fname" placeholder="First Name"/></div>
                                                        <div class="col-4"><input class="form-control" type="text" name="mname" placeholder="Middle Name"/></div>
                                                        <div class="col-4"><input class="form-control" type="text" name="lname" placeholder="Last Name"/></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Gender: </th>
                                                    <td  width="30%">
                                                        <select class="form-control" name="gender" id="">
                                                            <option selected="selected">Select</option>
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </td>
                                                    <th width="15%">Date of Birth: </th>
                                                    <td idth="30%">
                                                        <div class="input-group date datepicker-off" data-date-format="mm-dd-yyyy">
<!--                                                            <span class="input-group-addon d-flex align-items-center" style="padding: 0 10px;"><i class="fa fa-calendar"></i></span>-->
                                                            <input class="form-control" name="dob" type="text"/>
                                                        </div>
                                                    </td>
                                                </tr>
<!--                                                </tbody>-->
<!--                                            </table>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="row d-flex justify-content-center">-->
<!--                                        <div class="col-md-12">-->
<!--                                            <b><i>Membership Information</i></b>-->
<!--                                            <table class="table table-bordered">-->
<!--                                                <tbody>-->
                                                <tr>
                                                    <th width="15%">Joining Date: </th>
                                                    <td>
                                                        <div class="input-group date datepicker-off" data-date-format="mm-dd-yyyy">
<!--                                                            <span class="input-group-addon d-flex align-items-center" style="padding: 0 10px;"><i class="fa fa-calendar"></i></span>-->
                                                            <input class="form-control" name="doj" type="text"/>
                                                        </div>
                                                    </td>
                                                    <th>Occupation</th>
                                                    <td>
<!--                                                        <input type="text" class="form-control" id="cus_id" placeholder="Enter your Occupation" name="amount" tabindex="10">-->
                                                        <select class="form-control" name="occupation" id="occupation">
                                                            <option selected="selected">Select</option>
                                                            <option>Student</option>
                                                            <option>Service</option>
                                                            <option>Business</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="occupation" id="Student">
                                                    <th>Degree: </th>
                                                    <td colspan="3">
                                                        <select name="degree" class="form-control" id="">
                                                            <option selected="selected">Select</option>
                                                            <option>Post Graduate</option>
                                                            <option>Graduate</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="occupation" id="Service">
                                                    <th>Designation: </th>
                                                    <td colspan="">
                                                        <input name="designation" class="form-control" id="">
                                                    </td>
                                                    <th>Years of service: </th>
                                                    <td colspan="">
                                                        <input name="service_yr" class="form-control" id="">
                                                    </td>
                                                </tr>
                                                <tr id="Business" class="occupation">
                                                    <th>Type of Business: </th>
                                                    <td colspan="">
                                                        <select class="form-control" name="business_type">
                                                            <option selected="selected">Select Country</option>
                                                            <option>Proprietorship</option>
                                                            <option>Partnership</option>
                                                        </select>
                                                    </td>
                                                    <th>Percentage of share: </th>
                                                    <td colspan="">
                                                        <input name="share" class="form-control" id="">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body-area">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <b><i>Correspondence Address</i></b>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>Holding Address</th>
                                                    <td>
                                                        <input type="text" class="form-control" id="" placeholder="Address1, Address2" name="amount" tabindex="10">
                                                    </td>
                                                    <th>City</th>
                                                    <td>
                                                        <select class="form-control" id="">
                                                            <option selected="selected">Select City</option>
                                                            <option>New York City</option>
                                                            <option>Holywood</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>State/Province</th>
                                                    <td>
                                                        <select class="form-control" id="">
                                                            <option selected="selected">Select Your State</option>
                                                            <option>New York</option>
                                                            <option>Los Angeles</option>
                                                        </select>
                                                    </td>
                                                    <th>Zip/Postal Code</th>
                                                    <td>
                                                        <input type="text" class="form-control" id="" placeholder="Type your zip code" name="amount" tabindex="10">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">Country: </th>
                                                    <td colspan="3">
                                                        <select class="form-control" id="">
                                                            <option selected="selected">Select Country</option>
                                                            <option>Bangladesh</option>
                                                            <option>USA</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <b><i>Contact Information</i></b>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th width="15%">Email: </th>
                                                    <td colspan="3" >john.doe@gmail.com</td>

                                                </tr>
                                                <tr>
                                                    <th>Field of Interests</th>
                                                    <td colspan="3">
                                                        <select class="form-control" id="">
                                                            <option selected="selected">Select From the list</option>
                                                            <option>IT Related in USA</option>
                                                            <option>Gas Station in USA</option>
                                                            <option>Investment in USA</option>
                                                            <option>Investment on Real Estate in USA</option>
                                                            <option>Garments</option>
                                                            <option>Equipment or Spare Parts</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>ID Generation</th>
                                                    <td colspan="3">
                                                        <input type="text" class="form-control" id="id_generation" placeholder="Enter your id" name="id_generation">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-button-area d-flex justify-content-center">

                                    <button type="reset" class="btn btn-primary" tabindex="53">Clear</button>

                                    <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)" tabindex="54">Previous</button>

                                    <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)" tabindex="55">Submit</button>

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

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("form-body-area");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
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
        $("#"+occ).show();
    })
</script>
</body>
</html>
