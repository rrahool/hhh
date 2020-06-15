<?php
    include "class_autoload.php";
    use appoindar\SetupClass;

    $setup = new SetupClass();
    $setup->dbSetup();
?>

    <?php include "head.php"?>

        <div class="col-md-12 row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Database Setting
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        HostName: <input class="form-control" type="text" name="hname"><br/>
                        UserName: <input class="form-control" type="text" name="uname"><br/>
                        Password: <input class="form-control" type="password" name="pass"><br/>
                        DatabaseName: <input class="form-control" type="text" name="dbname"><br/>
                        <input class="btn btn-default" type="submit" name="" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
