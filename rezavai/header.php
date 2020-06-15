<?php
include '../class_autoload.php';
use appoindar\SetupClass;
use appoindar\UserClass;

$setup = new SetupClass();
// $setup->checkUser();

$us = new UserClass();
$user = $us->setting();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Helping Hearts & Hands</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-reg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-top: 25px;">
            <!--<div class="col-md-2"></div>-->
            <div class="col-md-8">
                <img src="../uploads/<?=$user['image']?>" alt="logo" class="img-fluid" style="height: 75px;">
                <b style="font-size: 30px;"><?=$user['name']?></b>
            </div>
            <div class="col-md-4 text-right">
                <i class="fa fa-home"></i> <?=$user['address']?><br>
                <i class="fa fa-phone"></i> <?=$user['phone']?><br>
                <i class="fa fa-envelope"></i> <?=$user['email']?><br>
            </div>
        </div>
    </div>
    
    <div class="row d-flex justify-content-center">
        <?php include 'menu.php'?>
    </div>