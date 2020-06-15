<?php
include "class_autoload.php";
use appoindar\SetupClass;
use appoindar\UserClass;

$setup = new SetupClass();
$setup->checkUser($_GET['id']);
$us = new UserClass();

$user = $us->getUserInfo($_GET['id']);
?>


    <?php include "head.php"?>
    <body class="theme-red">
        <h1>Welcome <?=$user['fullname']?></h1>
        <h3>Helping Hearts & Hands LLC, USA.</h3>
    </body>
</html>
