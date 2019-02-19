<?php
if(!session_id()) {
    session_start();
}

if (isset($_SESSION['Login_Status'])){
    if ($_SESSION['Login_Status']==true){
        header('location:dashboard.php');
        exit();

    }

}

if(isset($_SESSION['73600161admin'])){
    unset($_SESSION['73600161admin']);
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
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta name="google-site-verification" content="Fh4DRYDpSAo_POX_MTf-C0znYZyuT8m0eMiBzdkJzS8" />
    <title>Aladinlk.com member login</title>
    <meta name="theme-color" content="#e2a01a">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>

    <meta property="og:url" content="https://www.aladinlk.com">
    <meta property="og:site_name" content="www.aladinlk.com">
    <meta property="og:title" content="Aladinlk.com member login">
    <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace.">
    <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131104955-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-131104955-1');
    </script>

</head>

<body>

<?php include "include/nav-bar.php"?>
<br>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="login-card">
            <h3 class="text-center login-h3">Login</h3>
            <hr>
            <?php
            $alert="<div></div>";

            //User Already Exist
            if (isset($_SESSION['Exist_User'])) {
                if ($_SESSION['Exist_User']==false) {
                    $alert="<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong>Wrong Email or Password !</strong></span></div>";
                    unset($_SESSION['Exist_User']);
                }
                else{
                    $alert="<div></div>";
                }

            }

            //The Email has been verified
            if (isset($_SESSION['email-verified'])){
                if ($_SESSION['email-verified']==true){
                    $alert="<div class='alert alert-success' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong>You Have Been Registered Successfully !</strong></span></div>";
                    unset($_SESSION['email-verified']);
                }
                elseif ($_SESSION['email-verified']==false){
                    $alert="<div class='alert alert-info' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong>Email Has Not Verified !</strong></span></div>";
                    unset($_SESSION['email-verified']);
                }

                else{
                    $alert="<div></div>";
                }
            }

            //Change Password Massage
            if (isset($_SESSION['forgot-password-msg'])){
                if ($_SESSION['forgot-password-msg']==true){
                    $alert="<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong>Your Password Has Been Changed !</strong></span></div>";
                    unset($_SESSION['forgot-password-msg']);
                }
                else{
                    $alert="<div></div>";
                }
            }

            //Change Password Massage
            if (isset($_SESSION['email_not_found'])){
                if ($_SESSION['email_not_found']==true){
                    $alert="<div class='alert alert-info' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><span><strong>Sorry ! E-mail is'nt Found in Your FB Profile !</strong></span></div>";
                    unset($_SESSION['email_not_found']);
                }
                else{
                    $alert="<div></div>";
                }
            }

            echo($alert);
            ?>
            <button class="btn btn-primary btn-block btn-lg btn-fb" onclick="window.location='<?php echo $fbUrl; ?>'" type="submit">Continue With Facebook </button>
            <button class="btn btn-primary btn-block btn-lg btn-google .omb_socialButtons" onclick="window.location='<?php echo $LogUrl; ?>'" type="submit">Continue With Google</button>

            <form class="form-signin" action="repository/email-login.php" method="post">
                    <hr>
                    <h5 class="text-center login-h5">Login Using Your Email and Password</h5>
                    <hr>
                    <div class="clearfix"></div>
                <input class="form-control" type="Email" maxlength="100" required="" placeholder="E-Mail Address" name="email">
                <br>
                <input class="form-control" type="password" maxlength="100" required="" placeholder="Password"  name="password">
<br>
               <button class="btn btn-warning btn-block btn-lg" type="submit" name="login">Login</button>
            </form>
            <h5><a class="forgot-password" role="button" href="#forgot-pass" data-toggle="modal">Forgot Password ?</a></h5>
            <hr>
            <a href="aladinlk-user-registration.php" class="forgot-password">Sign up for Free</a></div>

        <div class="modal fade" role="dialog" tabindex="-1" id="forgot-pass">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#001921;">
                        <h4 style="color:rgb(226,160,26);">Forgot Password</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <form>
                            <label class="visible" style="font-size:19px;">Please Enter Your Email&nbsp;</label>
                            <input class="form-control" type="email" id="forgot-email" required maxlength="80">
                            <button class="btn btn-primary justify-content-center" type="button" id="for-pass" style="background-color:rgb(226,160,26);padding-right:12px;margin-right:14px;margin-bottom:3px;margin-left:0px;margin-top:10px;">Send Verify Email</button>
                            <button class="btn btn-warning" type="button" data-dismiss="modal" style="background-color:rgb(226,160,26);color:rgb(246,250,254);margin-top:10px;margin-bottom:3px;">Close</button>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<br>
<?php include "include/footer.php"?>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function () {
        $('#for-pass').click(function () {
            var email = $('#forgot-email').val();
                $.ajax({
                    type: "post",
                    url: "aladin-xx/email-forgot-password.php",
                    data: {email:email},
                    success: function (data) {
                        $(".modal-body").html('');
                        $(".modal-body").append(data);
                    }

                });
        });
    });
</script>