<?php
include "class_autoload.php";
use appoindar\SetupClass;

$setup = new SetupClass();
$setup->registration();
?>

    <?php include "head.php"?>
    <body class="signup-page">
        <div class="signup-box">
            <div class="logo" style="margin: 0 auto; text-align: center;">
                <img src="images/logo_hhh_LLC.png" alt="" style="height: 150px">
                <img src="images/name_hhh_llc.jpg" alt="" style="height: 27px">
            </div>
            <div class="card">
                <div class="body">
                    <form id="sign_up" method="POST">
                        <div class="msg" style="background-color: rosybrown; text-align: center;padding: 10px 0px;">
                            <h4>Registration</h4>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="fname" placeholder="Full Name" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="uname" placeholder="User Name" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="pass" minlength="6" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms">I read and agree to the <a href="https://nohassleresults.com/terms-of-service" target="_blank">terms of service</a>.</label>
                        </div>
                        <input type="hidden" name="p_id" value="<?=$_GET['p_id']?>">
                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                        <div class="m-t-25 m-b--5 align-center">
                            <a href="login.php">You already have a membership?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>
        
      </body>

    <script>
        $(function(){
            $('.start').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            $('.end').datepicker({
                //startDate: '<?php //echo date("Y-m-d")?>',
                startView: 2,
                minView: 2,
                maxView: 2,
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });

        (function($, window, document, undefined){
            $('.start').on("change", function(){
                var date = new Date($('.start').val()),
                    days = 83;

                if(!isNaN(date.getTime())){
                    date.setDate(date.getDate() + days);

                    $(".end").val(date.toInputFormat());
                } else {
                    alert("Invalid Date");
                }
            });


            //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
            Date.prototype.toInputFormat = function() {
                var yyyy = this.getFullYear().toString();
                var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
                var dd  = this.getDate().toString();
                return (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0]) + "/" + yyyy; // padding
                //return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            };
        })(jQuery, this, document);

    </script>
</body>
</html>
