  <?php
  session_start();
  if(isset($_SESSION['73600161admin'])){
      if($_SESSION['73600161admin']==false){
        header("location:../login.php");
        exit();
      }
  }
  else{
      header("location:../login.php");
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
      <meta property="og:site_name" content="aladinlk.com">
      <meta property="og:title" content="Aladin lk Admin Control Panel">
      <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladinlk is your free classified web marketplace.">
      <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>


      <title>Aladin lk Admin Control Panel</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="include/assets/admin_dashboard.js"></script>
      <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/product.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
      <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
      <link rel="shortcut icon" href="https://www.aladinlk.com/favicon.png" type="image/x-icon">


  </head>

  <body>
  <?php include "../include/nav-bar.php"?>
  <br>
  <div class="container-fluid">
      <div class="col-lg-12">
          <div class="panel-heading">
              <h3 class="text-center">Admin Control Panel</h3>
              <hr>
          </div>
          <div class="panel-body">
              <div class="col-md-4">
                  <br>
                  <ul class="list-group">
                      <li class="list-group-item pointer active" data-bs-hover-animate="bounce" id="verified_user"><span>All Users</span></li>
                      <li class="list-group-item pointer " data-bs-hover-animate="bounce" id="non_verified_ad"><span>Non Verified Ad (Posted)</span></li>
                      <li class="list-group-item pointer" data-bs-hover-animate="bounce" id="rm_non_posted"><span>Remove Non Posted</span></li>
                      <li class="list-group-item pointer" data-bs-hover-animate="bounce" id="view_exp_ads"><span>View Exp Ads</span></li>
                  </ul>
              </div>
              <div class="col-md-8 message"></div>
              <div class="col-md-8 content"></div>
          </div>

      </div>
  </div>

  <br>
  <?php include "../include/footer.php"?>


  </body>

  </html>


