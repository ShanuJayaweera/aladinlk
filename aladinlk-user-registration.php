<?php
session_start();
?>
<?php
if (isset($_SESSION['Login_Status'])){
    if ($_SESSION['Login_Status']==true){
        header('location:dashboard.php');
        exit();

    }
}

require_once "libraries/Google/config.php";
$LogUrl = $gClient->createAuthUrl();
?>

<?php
require_once "libraries/Facebook/autoload.php";
$fb = new \Facebook\Facebook([
    'app_id' => '522015151596290',
    'app_secret' => 'ca02ecd8758a06eb0cbbf191222b4ffd',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$fbUrl = $helper->getLoginUrl('https://www.aladinlk.com/repository/fb-auth.php', $permissions);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace.">
    <meta name="google-site-verification" content="Fh4DRYDpSAo_POX_MTf-C0znYZyuT8m0eMiBzdkJzS8" />
    <title>Aladinlk user registration</title>
    <meta name="theme-color" content="#e2a01a">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>

    <meta property="og:url" content="https://www.aladinlk.com"/>
    <meta property="og:site_name" content="www.aladinlk.com"/>
    <meta property="og:title" content="Aladinlk user registration"/>
    <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace."/>
    <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700"/>
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"/></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"/></script>

</head>

<body>
<?php include "include/nav-bar.php"?>
<br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12">
                <h3 class="hidden-xs hidden-sm reg-h3">Register on Aladinlk.com</h3>
                <h4 class="hidden-md hidden-lg reg-h3">Register on Aladinlk.com</h4>
                <h5 class="text-left hidden-xs hidden-sm reg-h5">Your Free Classified Web Marketplace </h5>

                <div class="col-sm-6">

                    <h4 class="hidden-xs hidden-sm reg-h4">Register Using Your Social Media Accounts</h4>
                    <hr>
                    <button class="btn btn-primary btn-block btn-lg btn-fb" onclick="window.location='<?php echo $fbUrl; ?>'" type="submit">Continue With Facebook </button>
                    <button class="btn btn-primary btn-block btn-lg btn-google .omb_socialButtons" onclick="window.location='<?php echo $LogUrl; ?>'" type="submit">Continue With Google</button>

                </div>
                <div class="col-sm-6">
                    <h4 class="hidden-xs hidden-sm reg-h4">Register Using Your Email</h4>
                    <h5 class="hidden-md hidden-lg reg-h4">Register Using Your Email</h5>
                    <hr>
                    <?php
                    if (isset($_SESSION['Exist_User'])) {

                        if ($_SESSION['Exist_User']==true) {
                            unset($_SESSION['Exist_User']);
                            $alert="<div class='alert alert-danger' role='alert'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong> User Already Exist !</strong></span>
                                                            </div>";

                        }
                        else{
                            $alert="";
                        }
                        unset($_SESSION['Exist_User']);
                    }
                    else{
                        $alert="";
                        unset($_SESSION['Exist_User']);
                    }
                    echo($alert);?>
                    <form class="form-horizontal" action="repository/email-registration.php" method="post">

                        <div class="form-group has-success">
                            <h5 class="text-left col-sm-3">Name </h5>
                            <div class="col-sm-9">
                                <input class="form-control" name="name" type="text" maxlength="100" required >
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <h5 class="text-left col-sm-3">Email </h5>
                            <div class="col-sm-9">
                                <input class="form-control" name="email" inputmode="email" type="email" maxlength="80" required>
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <h5 class="text-left col-sm-3">Password </h5>
                            <div class="col-sm-9">
                                <input class="form-control" name="password" type="password" id="password" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <h5 class="text-left col-sm-3">Confirm Password</h5>
                            <div class="col-sm-9">
                                <input class="form-control" name="confirm_password" type="password" id="confirm_password" required>
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <h5 class="text-left col-sm-3"> </h5>
                            <div class="col-sm-9">
                                <button class="btn btn-warning Sign in" type="submit" name="register">Sign In</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h5 class="text-center"><a href="login.php">Already I have an Account</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var password = document.getElementById("password")
            , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Password Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    });

</script>
</body>

</html>
