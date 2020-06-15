<?php
include "class_autoload.php";
use appoindar\SetupClass;

$setup = new SetupClass();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $setup->send_password_reset_link();
}

?>

    <?php include "head.php"?>
    <body class="signup-page">
        <div class="signup-box">
            <div class="logo">
                <!-- <a href="javascript:void(0);">No Hassle Goal<b> Calendar</b></a> -->
                <!-- <small>Admin BootStrap Based - Material Design</small> -->
                <!-- <img src="images/NHGG_Logo_Horizontal Full Colour_72 dpi.png" alt="No Hassle Goals Genie" style="width:40%"> -->
            </div>
            <div class="card">
                <div class="body">
                    <form id="sign_up" method="POST">
                        <div class="msg">
                          <img src="images/NHGG_Logo_Horizontal Full Colour_72 dpi.png" alt="No Hassle Goals Genie" style="width:70%">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                        </div>

                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RECOVER PASSWORD</button>

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
