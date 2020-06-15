<?php
include 'class_autoload.php';
use appoindar\SetupClass;
use appoindar\UserClass;

$setup = new SetupClass();
$us = new UserClass();
$us->userUpdate();

$user = $us->getUserInfo($_GET['id']);

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
                                <img src="<?=$user_image?>" style="height:128px; width: 128px;"  alt="<?=$user['username']?>" />
                            </div>
                            <div class="content-area">
                                <h3><?=$user['fullname']?></h3>
                                <!-- <p>Web Software Developer</p> -->
                                <!-- <p>Administrator</p> -->
                            </div>
                        </div>
                        <!-- <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Followers</span>
                                    <span>1.234</span>
                                </li>
                                <li>
                                    <span>Following</span>
                                    <span>1.201</span>
                                </li>
                                <li>
                                    <span>Friends</span>
                                    <span>14.252</span>
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>
                        </div> -->
                    </div>

                    <!-- <div class="card card-about-me">
                        <div class="header">
                            <h2>ABOUT ME</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">library_books</i>
                                        Education
                                    </div>
                                    <div class="content">
                                        B.S. in Computer Science from the University of Tennessee at Knoxville
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">location_on</i>
                                        Location
                                    </div>
                                    <div class="content">
                                        Malibu, California
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">edit</i>
                                        Skills
                                    </div>
                                    <div class="content">
                                        <span class="label bg-red">UI Design</span>
                                        <span class="label bg-teal">JavaScript</span>
                                        <span class="label bg-blue">PHP</span>
                                        <span class="label bg-amber">Node.js</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">notes</i>
                                        Description
                                    </div>
                                    <div class="content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                                      <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                      <?php if ($_SESSION['user_id'] == $_GET['id']): ?>
                                      <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                    <?php endif; ?>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <label>User name:</label> <?=$user['username']?><br>
                                        <label>E-mail:</label> <?=$user['email']?><br>
                                        <label>Status:</label> <?=$user['status']?><br>
<!--                                        <label>Package:</label> --><?//=$user['package_name']?><!--<br>-->
<!--                                        <label>Rate:</label> $--><?//=$user['rate']?><!--/--><?//=$user['unit']?><!--<br>-->
<!--                                        <label>Features:</label><ul>-->
<!--                                          --><?//=$user['features']?>
<!--                                        </ul>-->
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="NameSurname" name="fname" placeholder="Full Name" value="<?=$user['fullname']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email" value="<?=$user['email']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($_SESSION['user']['role'] == 'user'): ?>
                                            <div class="form-group">
                                                <label for="Image" class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="Image" name="image" placeholder="" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Status</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <select class="form-control" id="status" name="status">
                                                          <option <?php echo ($user['status'] == 'Active')?'selected':''?>>Active</option>
                                                          <option <?php echo ($user['status'] == 'Inctive')?'selected':''?>>Inctive</option>
                                                          <option <?php echo ($user['status'] == 'Pending')?'selected':''?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <?php if ($_SESSION['user_id'] == $_GET['id']): ?>
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                        <form method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="oldPassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="newPassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="password" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php endif; ?>
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
