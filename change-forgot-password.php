<?php
session_start();
if(isset($_SESSION['forgot-password']) && isset($_SESSION['forgot-token']) && isset($_SESSION['forgot-email'])){
    if ($_SESSION['forgot-password']!=true){
        header('location:../404.php');
        exit();
    }

}
else{
    header('location:../404.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace.">
    <meta name="theme-color" content="#e2a01a">
    <meta property="og:url" content="https://www.aladinlk.com">
    <meta property="og:site_name" content="www.aladinlk.com">
    <meta property="og:title" content="Your free classified web marketplace.">
    <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace.">
    <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>
    
    <title>Aladin change forgot password</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
   <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link rel="shortcut icon" href="https://www.aladinlk.com/favicon.png" type="image/x-icon">
</head>

<body>
<?php include "include/nav-bar.php"?>
<br>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading" style="background-color:#001921;">
        <h4 style="color:#e2a01a;">Change Password</h4>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="repository/change-password.php" method="post" >
            <div class="form-group">
                <div class="col-lg-12">
                    <h5 class="col-sm-4">New Password</h5>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="forgot-password" required>
                        <br>
                        <button class="btn btn-default" type="submit" style="background-color:#e2a01a; color: #ffffff;">Change Your Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</body>

</html>
