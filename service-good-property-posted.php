<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aladinlk.com - Service Item Property has Posted</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="assets/js/dashboard.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>

<?php include 'include/nav-bar.php';?>
<br>

<div class="container">
    <div class="jumbotron Jumbo">
        <h3 class="text-center">Thank You ! <?php echo $_SESSION['user_name']; ?></h3>
        <p class="text-center">You Have Been Posted Your Ad In Successfully. It Will Be Displaying After Administrative Conformation. Stay Tuned with Aladinlk.com.</p>
        <p class="text-center"><a class="btn btn-default lable" role="button" href="dashboard.php">Back To Dashboard</a><a class="btn btn-default lable" role="button" href="aladinlk-all-ad-list-view.php">To All Ads</a></p>
    </div>
</div>
<br>
<?php include "include/footer.php"?>
</body>

</html>