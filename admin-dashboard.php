<?php
include "class_autoload.php";
use appoindar\SetupClass;
use appoindar\UserClass;
use appoindar\PackageClass;

$setup = new SetupClass();
$setup->checkAdmin();

//$calendars = $setup->getAllCalendarInfo();

$userClass = new UserClass();
$users = $userClass->SelectAllUsers();

$packageClass = new PackageClass();
//$packages = $packageClass->SelectAllPackages();
//var_dump($_SESSION['user']);die;
?>


    <?php include "head.php"?>
    <body class="theme-red">
        <?php include 'topbar.php' ?>
        <?php include 'sidebar.php' ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>

                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">CALENDARS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?//=$calendars?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">PACKAGES</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?//=count($packages)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW COMMENTS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">243</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">USERS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?=count($users)?></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <?php include 'js.lib.php' ?>
    </body>
    <script>
        $(function(){
            $('.start').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            $('.end').datepicker({
                startDate: '<?php echo date("Y-m-d")?>',
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
