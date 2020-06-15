<?php
include "class_autoload.php";
use appoindar\UserClass;
use appoindar\PackageClass;

$us = new UserClass();
$last_id = $_SESSION['last_id'];
$user = $us->getUserInfo($last_id);
$p_id = $us->subscribedPackage($last_id);

$pack = new PackageClass();
$package = $pack->getPackageInfo($p_id['p_id']);
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
                        <div class="msg">
                          <img src="images/NHGG_Logo_Horizontal Full Colour_72 dpi.png" alt="No Hassle Goals Genie" style="width:60%">
                        </div>
                        <div class="msg">
                          Username: <?=$user['fullname']?><br>
                          Package: <?=$package['name']?><br>
                          Amount: $ <?=$package['rate']?> / <?=$package['unit']?><br>
                        </div>
                        <!-- Subscription Button -->
                        <?=$package['button']?>

                </div>
            </div>
        </div>

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
