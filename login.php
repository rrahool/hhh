<?php
    include "class_autoload.php";
    use appoindar\SetupClass;

    $setup = new SetupClass();
    $setup->login();
?>

<?php include "head.php"?>


<body class="login-page">
    <div class="login-box">
        <div class="logo" style="margin: 0 auto; text-align: center;">
            <img src="images/logo_hhh_LLC.png" alt="" style="height: 150px">
            <img src="images/name_hhh_llc.jpg" alt="" style="height: 27px">
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg text-danger" style="background-color: goldenrod; text-align: center;padding: 10px 0px;">
                        <h4>Login</h4>
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                            echo "Username / Password is wrong!!";
                        } elseif (isset($_GET['error']) && $_GET['error'] == 2) {
                            echo "Please login to enter the edit mode!";
                        } elseif (isset($_SESSION['user_id'])) {
                            session_destroy();
                            echo "You have signed out. Login again.";
                        } else {
                          echo "Log in to start your session";
                        }
                        ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="uname" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="registration.php">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forget-password.php">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
    <?php include 'js.lib.php' ?>
</body>
</html>
