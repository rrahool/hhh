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
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <?php $user_image = ($user['image'] != '')? "uploads/".$user['image']:'images/no-profile-picture.jpg' ?>
                            <img src="<?=$user_image?>" style="height:128px; width: 128px;"  alt="<?=$user['name']?>" />
                        </div>
                        <div class="content-area">
                            <h3><?=$user['name']?></h3>
                            <!-- <p>Web Software Developer</p> -->
                            <!-- <p>Administrator</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
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
                                            <label for="NameSurname" class="col-sm-2 control-label">Organization Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="NameSurname" name="name" placeholder="Organization Name" value="<?=$user['name']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-2 control-label">Phone Number</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?=$user['phone']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email Address" value="<?=$user['email']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Office Address</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="address" name="address" placeholder="Office Address" required><?=$user['address']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="Image" class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="Image" name="image" placeholder="" value="" >
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
