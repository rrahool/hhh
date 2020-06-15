<?php
include 'class_autoload.php';
use appoindar\SetupClass;
use appoindar\UserClass;

$setup = new SetupClass();
$setup->checkAdmin();

$us = new UserClass();
$us->settingUpdate();

$user = $us->setting();
//echo "<pre>";
//print_r($user);
//echo "</pre>";die;

include 'head.php';

?>
<body class="theme-red">
<?php include 'topbar.php' ?>
<?php include 'sidebar.php' ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">

            <div class="col-xs-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Settings</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="NameSurname" name="cname" placeholder="
                                                Name" value="<?=$user['cname']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="tel" class="form-control" id="cdesignation" name="cdesignation" placeholder="Phone Number" value="<?=$user['cdesignation']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-2 control-label">Phone Number</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="tel" class="form-control" id="phone" name="cphone" placeholder="Phone Number" value="<?=$user['cphone']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="Email" name="cemail" placeholder="Email Address" value="<?=$user['cemail']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Office Address</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="address" name="caddress" placeholder="Office Address" required><?=$user['caddress']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Image" class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="file" class="form-control" id="Image" name="cimage" placeholder="" value="" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'js.lib.php' ?>
</body>

</html>
