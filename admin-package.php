<?php
include 'class_autoload.php';
use appoindar\SetupClass;
use appoindar\PackageClass;

$setup = new SetupClass();
$us = new PackageClass();
$us->packageUpdate();

$Package = $us->getPackageInfo($_GET['id']);


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
                                <!-- <img src="images/user-lg.jpg" alt="AdminBSB - Profile Image" /> -->
                                <i class="material-icons" style="font-size: 50px; color: #EEE;">library_books</i>
                            </div>
                            <div class="content-area">
                                <h3><?=$Package['name']?></h3>
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

                                      <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Package Edit</a></li>

                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <label>Package name:</label> <?=$Package['name']?><br>
                                        <label>Duration:</label> <?=$Package['duration']?><br>
                                        <label>Rate:</label> $ <?=$Package['rate']?>/<?=$Package['unit']?><br>
                                        <label>Features:</label> <ul><?=$Package['features']?></ul>
                                        <label>Status:</label> <?=$Package['status']?>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                        <form method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Package Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="NameSurname" name="name" placeholder="Name" value="<?=$Package['name']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Duration</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Duration" name="duration" placeholder="Duration" value="<?=$Package['duration']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Rate" class="col-sm-2 control-label">Rate</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Rate" name="rate" placeholder="Rate" value="<?=$Package['rate']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Unit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Unit" name="unit" placeholder="Unit" value="<?=$Package['unit']?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Frequency" class="col-sm-2 control-label">Frequency</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Frequency" name="frequency" placeholder="Frequency" value="<?=$Package['frequency']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Status</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <select class="form-control" id="status" name="status">
                                                          <option <?php echo ($Package['status'] == 'Active')?'selected':''?>>Active</option>
                                                          <option <?php echo ($Package['status'] == 'Inctive')?'selected':''?>>Inctive</option>
                                                          <option <?php echo ($Package['status'] == 'Pending')?'selected':''?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Features" class="col-sm-2 control-label">Features</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" name="features" id="Features" rows="8" cols="80"><?=$Package['features']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Button" class="col-sm-2 control-label">Button Embed Code</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" id="Button" name="button" rows="8" cols="80"><?=$Package['button']?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" id="InputExperience" name="InputExperience" rows="3" placeholder="Experience"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
                                                    <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                                </div>
                                            </div> -->
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
