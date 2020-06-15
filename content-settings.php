<?php
include 'class_autoload.php';
use appoindar\SetupClass;
use appoindar\UserClass;

$setup = new SetupClass();
$setup->checkAdmin();

$us = new UserClass();
$us->contentSettingUpdate();

$user = $us->setting();
$content = $us->contentSetting();
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
                                            <label for="NameSurname" class="col-sm-2 control-label">Organization</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea type="text" class="form-control tinymce" id="tinymce" name="organization" placeholder="Organization" required><?=$content['organization']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-2 control-label">Behind the machine</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea type="text" class="form-control tinymce" id="tinymce2" name="behind_machine" placeholder="Behind the machine" required><?=$content['behind_machine']?></textarea>
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
