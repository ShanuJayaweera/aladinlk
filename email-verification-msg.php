<?php
session_start();
$errors=array();

if (isset($_SESSION['Register_pending'])){

    if($_SESSION['Register_pending']==false){
        $errors[]="Sorry ! Registration Failed ";
        header('Location:../aladinlk-all-ad-list-view.php');
        exit();
    }
    else{
        unset($_SESSION['Register_pending']);

    }
}
else{
    $errors[]="Sorry ! Registration Failed ";
    header('Location:../login.php');
    exit();

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aladinlk.com Email Verification Message</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
<?php include "include/nav-bar.php"?>
<br>
<div class="container">
    <div class="jumbotron" style="background-color:rgb(0,25,33);color:rgb(226,160,26);">
        <h3 class="text-center">Grate Job <?php echo $_SESSION['reg_name']; ?>.......</h3>
        <p class="text-center">You Have Been Registered Successfully . But You Have To Verify Your Email Address Before Access Your Account. Thank You ! </p>
        <p class="text-center">
            <a class="btn btn-default" role="button" href="aladinlk-all-ad-list-view.php" style="padding-right:15px;margin-right:8px;margin-left:0px;background-color:rgb(232,230,173);">Back To All Ads</a>
        </p>
    </div>
</div>
<br>
<?php include "include/footer.php"?>
</body>

</html>