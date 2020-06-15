<?php
include "class_autoload.php";
use appoindar\SetupClass;
use appoindar\UserClass;
use appoindar\PackageClass;


$packageClass = new PackageClass();
$packageClass->createPackage();
$packages = $packageClass->SelectActivePackages();

$setup = new SetupClass();
$setup->checkAdmin();
$setup->registration();
$setup->delete();

$userClass = new UserClass();
$users = $userClass->SelectAllUsers();
//var_dump($_SESSION['user']);die;
?>


    <?php include "head.php"?>
    <body class="theme-red">
        <?php include 'topbar.php' ?>
        <?php include 'sidebar.php' ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>User Management</h2>
                </div>

                <div class="row clearfix">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                          <div class="header">
                              <h2>
                                  Users <a href="#" data-toggle="modal" data-target="#mdModal"><i class="material-icons">queue</i></a>
                              </h2>
                              <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          <i class="material-icons">more_vert</i>
                                      </a>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="javascript:void(0);">Action</a></li>
                                          <li><a href="javascript:void(0);">Another action</a></li>
                                          <li><a href="javascript:void(0);">Something else here</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div>
                          <div class="body">
                              <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                  <thead>
                                    <tr>
                                      <th>SL. NO:</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $key = 0; foreach ($users as $value): $key++ ?>
                                      <tr>
                                        <td><?=$key?></td>
                                        <td><?=$value['fullname']?></td>
                                        <td><?=$value['email']?></td>
                                        <td><?=$value['status']?></td>
                                        <td>
                                          <a href="profile.php?id=<?=$value['id']?>" class="btn btn-xs btn-info"><i class="material-icons">visibility</i></a>
                                          <!-- <a href="user-edit.php?id=<?=$value['id']?>" class="btn btn-xs btn-primary"><i class="material-icons">create</i></a> -->
                                          <a href="?action=delete&id=<?=$value['id']?>&from=user" onclick="return confirm('Are you sure to delete this?')" class="btn btn-xs btn-danger"><i class="material-icons">remove</i></a>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>

                                  </tbody>
                                </table>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>


            </div>
        </section>
        <?php include 'js.lib.php' ?>
        <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="" action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Create User</h4>
                        </div>
                        <div class="modal-body">
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
                                  <i class="material-icons">local_mall</i>
                              </span>
                              <div class="form-line">
                                  <select class="form-control" name="p_id" placeholder="Select Package" required>
                                  	<option value="">Select Package</option>
                                  	<?php foreach ($packages as $subs): ?>
                                  		<option value="<?=$subs['id']?>"><?=$subs['name']?></option>
                                  	<?php endforeach; ?>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                      </form>
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
