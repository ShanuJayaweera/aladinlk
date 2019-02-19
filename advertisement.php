<?php
session_start();
require_once "repository/aladinlk-function.php";
$actual_link=(isset($_SERVER['HTTPS'])? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//get uri
$uri = $_SERVER['REQUEST_URI'];
$uri_array = explode( "/", $uri );

$ad_id= $uri_array[2];


$ad_id=mysqli_real_escape_string(DBConnection(),$ad_id);
//data availability
if (data_availability('advertisement','Id','Id',$ad_id)==true){
    //get table
    $tbl_name=get_table($ad_id);
    $all_data=all_data_from_table($ad_id); //result set
    $customer=customer_details($ad_id); //result set
    $tumb=array();
    $tumb_path="advertisement_images/".$ad_id."/tumb/";

    if (mysqli_num_rows($all_data)>0){
        if ($row=mysqli_fetch_assoc($all_data)){
            $title= $row['title'];
            $image_path=$row['image_path'];
            $main_cat_id=$row['main_cat_id'];
        }
    }

    if(mysqli_num_rows($customer)>0){
        if ($cont=mysqli_fetch_assoc($customer)){
            $tel=$cont['telephone'];
            $address=$cont['address'];
            $email=$cont['email'];
        }
    }

}
else{

    header("location:../404");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta name="google-site-verification" content="Fh4DRYDpSAo_POX_MTf-C0znYZyuT8m0eMiBzdkJzS8" />
    <title><?php echo sub_category($ad_id)." - ".$title." | ".sub_area_name($ad_id)." | aladin"; ?></title>
    <meta name="theme-color" content="#e2a01a">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>

    <meta property="og:url" content="<?php echo $actual_link; ?>">
    <meta property="og:site_name" content="www.aladinlk.com">
    <meta property="og:title" content="<?php echo sub_category($ad_id)." - ".$title." | ".sub_area_name($ad_id).""; ?>">
    <meta property="og:description" content="<?php echo $row['description'];?>">
    <meta property="og:image" content="<?php echo main_img($ad_id);?>"/>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131104955-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-131104955-1');
    </script>
    <style>

        /*****************globals*************/

        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column; }
        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px; } }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1; }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px; }
        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%; }
        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block; }
        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0; }
        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0; }

        .tab-content {
            overflow: hidden; }
        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s; }

        .card {
            padding-top: 2em;
            padding-bottom: 2em;
            padding-left: 0px;
            padding-right: 0px;
            line-height: 1.5em !important; }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex; } }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column; }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1; }

        .product-title, .price, .sizes, .colors {
            text-transform: UPPERCASE;
            font-weight: bold; }

        .checked, .price span {
            color: #e2a01a; }

        .product-title, .rating, .product-description, .price, .vote, .sizes {
            margin-bottom: 0px; }

        .product-title {
            margin-top: 0; }


        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3); }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1); } }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3); }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1); } }

    </style>
    <style>
        #return-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgb(0, 0, 0);
            background: #e2a01a;
            width: 50px;
            height: 50px;
            display: block;
            text-decoration: none;
            -webkit-border-radius: 35px;
            -moz-border-radius: 35px;
            border-radius: 35px;
            display: none;
            -webkit-transition: all 0.3s linear;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        #return-to-top i {
            color: #000000;
            margin: 0;
            position: relative;
            left: 16px;
            top: 13px;
            font-size: 19px;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        #return-to-top:hover {
            background: #e2a01a;
        }
        #return-to-top:hover i {
            color: #000000;
            top: 5px;
        }
    </style>
    <script>
        // ===== Scroll to Top ====
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200);    // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200);   // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });
    </script>
</head>

<body>
<?php include "include/nav-bar.php"; ?>
<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <h4 class="product-title"><strong><?php echo $title; ?></strong><br><br></h4>
        </div>
    </div>
    <div class="row" style="font-size:15px;margin:3px;">
        <div class="col-md-2">
            <h5 style="margin:3px;"><i class="glyphicon glyphicon-tags"></i>&nbsp; &nbsp;<?php echo sub_category($ad_id)?><br><br></h5>
        </div>
        <div class="col-md-3">
            <h5 style="margin:3px;"><i class="glyphicon glyphicon-map-marker"></i>&nbsp; &nbsp;<?php echo $address?><br><br></h5>
        </div>
        <div class="col-md-3">
            <h5 style="margin:3px;"><i class="glyphicon glyphicon-calendar"></i>&nbsp; &nbsp;<?php
                $date = strtotime($row['modified']);
                $new_date = date('Y.m.d', $date);
                echo $new_date;?><br><br></h5>
        </div>
        <div class="col-md-3">
            <h5 style="margin:3px;"><i class="glyphicon glyphicon-user"></i>&nbsp;<?php echo customer_name($row['user_id']) ?></h5>
        </div>
        <div class="col-md-1"> <?php


            echo "<iframe src=\"https://www.facebook.com/plugins/share_button.php?href=".$actual_link."&layout=button_count&size=small&mobile_iframe=true&appId=1918277881574888&width=69&height=20\" width=\"69\" height=\"20\" style='border:none;overflow:hidden; margin: 3px;' scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allow=\"encrypted-media\"></iframe>";


            ?>

        </div>
    </div>
    <div class="row">
        <div class="preview col-md-8 ">

            <div class="preview-pic tab-content">
                <?php
                $tok = strtok($image_path, "|");

                $main_img=main_img($ad_id);
                if(empty($main_img) || $main_img==""){
                    echo "<div class='tab-pane active' id='pic-1'><img src='https://www.aladinlk.com/assets/img/tumb-aladin.png' alt='aladin buy and sell ".$title."' /></div>";
                }
                else{
                    $tab=0;

                    while ($tok !== false) {
                        $tab=$tab+1;
                        if($tok==$main_img){
                            echo "<div class='tab-pane active' id='pic-".$tab."'><img src='".$tok."' alt='aladin buy and sell ".$title."' /></div>";
                            $tumb[$tab]="https://www.aladinlk.com/".$tumb_path. basename($tok);
                        }
                        else{
                            echo "<div class='tab-pane' id='pic-".$tab."'><img src='".$tok."' alt='aladin buy and sell ".$title."' /></div>";
                            $tumb[$tab]="https://www.aladinlk.com/".$tumb_path. basename($tok);
                        }

                        $image_name="";
                        $tok = strtok("|");
                    }
                }


                ?>
            </div>

            <ul class="preview-thumbnail nav nav-tabs">

                <?php
                if(empty($main_img) || $main_img==""){
                    echo "<li class='active'><a data-target='#pic-1' data-toggle='tab'><img src='https://www.aladinlk.com/assets/img/tumb.png' alt='aladin buy and sell ".$title."' /></a></li>";
                }
                else{
                    foreach($tumb as $x=>$path)
                    {
                        if($x==1){
                            echo "<li class='active'><a data-target='#pic-".$x."' data-toggle='tab'><img src='".$path."' alt='aladin buy and sell ".$title."' /></a></li>";
                        }
                        else{
                            echo "<li><a data-target='#pic-".$x."' data-toggle='tab'><img src='".$path."'  alt='aladin buy and sell ".$title."' /></a></li>";
                        }
                    }
                }

                ?>
            </ul>

            <br>

        </div><br>
        <div class="col-md-4">
            <div class="row" style="padding:10px;background-color:#eeeeee;">
                <div class="col-md-12">
                    <h4 style="margin:3px;"><i class="glyphicon glyphicon-earphone" style="color:#e2a01a;"></i>&nbsp; <?php echo $tel; ?><br></h4>
                    <h6>Seller's Phone Number</h6>
                </div>
            </div>
            <hr>
            <div class="row" style="padding:10px;background-color:#eeeeee;">
                <div class="col-md-12">
                    <h4 style="margin:3px;"><i class="glyphicon glyphicon-envelope" style="color:#e2a01a;"></i>&nbsp; <?php echo $email; ?></h4>
                </div>
                <div class="col-md-12">
                    <h6>Seller's Email Address</h6>
                </div>
            </div>
            <hr>
            <h5>Share this advertisement</h5>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>" target="_blank" rel="nofollow"  class="btn btn-link btn-circle" type="button" style="border-radius:50px;background-color:#3b5998;margin:6px;"><i class="icon ion-social-facebook" style="color:#ffffff;font-size:30px;"></i></a>
            <a href="http://www.twitter.com/intent/tweet?url=<?php echo $actual_link; ?>&amp;text=<?php echo $title ?>" target="_blank" rel="nofollow" class="btn btn-link btn-circle" type="button" style="border-radius:50px;background-color:#38A1F3;margin:6px;"><i class="icon ion-social-twitter" style="color:#ffffff;font-size:30px;"></i></a>
            <a href="https://plus.google.com/share?url=<?php echo $actual_link; ?>" target="_blank" rel="nofollow" class="btn btn-link btn-circle" type="button" style="border-radius:50px;background-color:#db4a39;margin:6px;"><i class="icon ion-social-googleplus" style="color:#ffffff;font-size:30px;"></i></a>
            <h4 style="background: #e2a01a;border-radius: 20px; color: #000000;box-shadow: none;border: none;text-shadow: none;padding: 10px 22px; transition: background-color 0.25s;"> <?php
                if($row['price']=="Negotiable"){
                    echo "Price is ";
                }
                else{
                    echo "Rs : ";
                }
                ?> <?php echo $row['price']?></h4>
            <hr style="font-size:82px;height:1px;background-color:#e2a01a;"  >



        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
                <?php
                include "include/ad_content/content_item/specification/".$tbl_name.".php";
                ?>
        </div>


        <div class="col-md-4">
            <?php include "include/side_list.php"?>
            <br>
        </div>
    </div>
</div>
<div class="col-md-12">
    <?php include "include/ad_suggestions.php"?>
    <br>
</div>

<?php include "include/footer.php"?>
</body>

</html>