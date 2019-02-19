<?php
session_start();
if (!isset($_SESSION['Login_Status'])){
    header('location:login.php');
    exit();

}
else{
if ($_SESSION['Login_Status']==false){
    header('location:login.php');
    exit();
}
}

?>
<!DOCTYPE html>
<html>

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

    <title>Aladin lk control panel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/bounce.min.js"></script>
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
   <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>


</head>

<body>
<?php include "include/nav-bar.php"?>
<br>
<div class="container-fluid">
    <div class="col-lg-12">

            <div class="panel-heading">
                <h3 class="text-center">Hello <?php echo $_SESSION['user_name']; ?></h3>
                <h4 class="text-center">Welcome to Your Aladinlk Dashboard. </h4>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item pointer" data-bs-hover-animate="bounce" id="my-acc"><span>My Account Details</span></li>
                        <li class="list-group-item pointer" data-bs-hover-animate="bounce" id="my-ad"><span>My Advertisement</span></li>
                        <li class="list-group-item pointer active" data-bs-hover-animate="bounce" id="post-ad"><span>Post an Advertisement</span></li>

                        <?php if ($_SESSION['auth_Provider']=="Email"){
                            echo "<li class=\"list-group-item pointer\" data-bs-hover-animate=\"bounce\" role=\"button\" href=\"#myModal\" data-toggle=\"modal\"><span>Change Password</span></li>";
                        } ?>

                    </ul>
                </div>
                <div class="col-md-8 content"></div>
            </div>

    </div>
</div>

    <br>
    <?php include "include/footer.php"?>

<!--Change Password Model-->
<div class="modal fade" role="dialog" tabindex="-1" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#001921;">
                <h4 style="color:rgb(226,160,26);">Change Password</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <form class="form-body">
                    <div class="form-group"><h5>Old Password&nbsp;</h5>
                        <input class="form-control" type="password" id="old_pass">
                    </div>
                    <div class="form-group"><h5>New Password&nbsp;</h5>
                        <input class="form-control" type="password" id="new_pass">
                    </div>
                    <button class="btn btn-primary" type="button" id="chpw" style="background-color:rgb(226,160,26);">Submit</button>
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button></form>
            </div>

        </div>
    </div>
</div>
<!--Change Password Model End-->

<script>
    $(document).ready(function () {
        $('#chpw').click(function () {
            var old_pass=$('#old_pass').val();
            var new_pass=$('#new_pass').val();

            $.ajax({
                type: "post",
                url: "repository/dashboard-change-password.php",
                data: {old_pass:old_pass,new_pass:new_pass},
                success: function (data) {
                    $(".form-body").html('');
                    $(".form-body").append(data);
                }

            });


        });
    });
</script>



</body>

</html>

