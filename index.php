<?php
require_once "repository/aladinlk-function.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta name="google-site-verification" content="Fh4DRYDpSAo_POX_MTf-C0znYZyuT8m0eMiBzdkJzS8" />
    <title>Aladin - Mobile Phones, Cars, Arduino Products, Electronics, and Lands in Sri Lanka</title>
    <meta name="theme-color" content="#e2a01a">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>

    <meta property="og:url" content="https://www.aladinlk.com">
    <meta property="og:site_name" content="www.aladinlk.com">
    <meta property="og:title" content="Aladin - Mobile Phones, Cars, Arduino Products, Electronics, and Lands in Sri Lanka">
    <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-131104955-1');
    </script>
</head>

<body>

<?php include "include/nav-bar.php"?>

<div class="promo">

    <div class="jumbotron header-jumb">
        <h3 class="header-h3">Welcome to Aladin Home</h3>
        <h4 class="header-h4">Buy or Sell Your Amazing Product or Service</h4>
        <br>
        <form class="form-group form-horizontal col-sm-12 header-search">
            <div class="col-md-3">
                <button class="btn btn-default form-control" style="background-color: #FFFFFF;" type="button" data-target="#category" data-toggle="modal" >
                    <?php

                    if(isset($_SESSION['sub_cat_id'])){
                        $sql="select sub_cat_name from sub_category where id=".$_SESSION['sub_cat_id'].";";
                        $result=mysqli_query(DBConnection(),$sql);
                        if ($row=mysqli_fetch_assoc($result)){
                            echo  $row['sub_cat_name'];
                        }
                        mysqli_close(DBConnection());
                    }
                    elseif (isset($_SESSION['cat_id'])){

                        $sql="select category_name from category where id=".$_SESSION['cat_id'].";";
                        $result=mysqli_query(DBConnection(),$sql);
                        if ($row=mysqli_fetch_assoc($result)){
                            echo  $row['category_name'];
                        }
                        mysqli_close(DBConnection());

                    }
                    else{
                        echo "All Categories";
                    }
                    ?>
                </button>
            </div>




            <div class="col-md-3">
                <button class="btn btn-default form-control" style="background-color: #FFFFFF;" type="button" data-target="#area" data-toggle="modal">
                    <?php
                    if(isset($_SESSION['sub_area_id'])){
                        $sql="select sub_area_name from sub_area where id=".$_SESSION['sub_area_id'].";";
                        $result=mysqli_query(DBConnection(),$sql);
                        if ($row=mysqli_fetch_assoc($result)){
                            echo  $row['sub_area_name'];
                        }
                        mysqli_close(DBConnection());
                    }
                    elseif (isset($_SESSION['area_id'])){
                        $sql="select area_name from area where id=".$_SESSION['area_id'].";";
                        $result=mysqli_query(DBConnection(),$sql);
                        if ($row=mysqli_fetch_assoc($result)){
                            echo  $row['area_name'];
                        }
                        mysqli_close(DBConnection());
                    }
                    else{
                        echo "All of Srilanka";
                    }
                    ?>
                </button>
            </div>


            <div class="col-md-5"><input type="text" class="form-control" placeholder="Search" name="search_bar" id="search_bar" value="<?php if (isset($_SESSION['search'])){echo $_SESSION['search'];} ?>"></div>
            <div class="col-md-1"><button class="btn btn-default" style="background-color: #FFFFFF;" type="button" name="search" id="search">Search </button></div>
        </form>
    </div>
</div>

<div class="projects-horizontal">
    <div class="container">
        <?php include "include/index_ad.php"; ?>
        <div class="intro">
            <h2 class="text-center">Featured Categories</h2>
            <p class="text-center">Everything in one Roof . Stay - tuned with aladin</p>
        </div>
        <div class="row projects">
            <div class="col-sm-6 item pointer link" id="1">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/car.jpg" alt="car-vehicle"></div>
                    <div class="col-md-7">
                        <h4 class="name">Vehicles</h4>
                        <p class="text-justify description hidden-xs">Buy and sell brand new or used car, van, lorries, and other vehicles. Select with world-famous vehicles brand Nissan, Honda, Suzuki, and Toyota. Post your free online ad.<br></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item pointer link" id="2">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/mobile-phone.jpg" alt="mobile-phone"></div>
                    <div class="col-md-7">
                        <h4 class="name">Mobile phone, Tab and Computer<br></h4>
                        <p class="text-justify description hidden-xs">Buy and sell brand new or used mobile phones, tablets, laptops, and desktop computer with best prices and best brands Samsung, Nokia, Huawei, Apple, Motorola. Post your free ad on aladin.<br></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item pointer link" id="4">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/house.jpg" alt="house-land"></div>
                    <div class="col-md-7">
                        <h4 class="name">Property</h4>
                        <p class="text-justify description hidden-xs">Buy and sell your property. What is your requirement? Land, house, annex, or commercial property. So post your free ad with us.<br></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item pointer link" id="6">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/bag.jpg" alt="bag"></div>
                    <div class="col-md-7">
                        <h4 class="name">Fashion and Beauty</h4>
                        <p class="text-justify description hidden-xs">Buy and sell bags and luggage, branded watches, shoes and any kind of footwear, jewelers, sunglass. Select your glamour fashion item and Post your free ad on aladin.<br></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item pointer link sub_cat" id="36">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/arduino.jpg" alt="arduino"></div>
                    <div class="col-md-7">
                        <h4 class="name">Arduino and Raspberry PI</h4>
                        <p class="description hidden-xs" >Now you can buy and sell your arduino and raspberry pi products in aladin. Post your free ad here.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item pointer link" id="3">
                <div class="row">
                    <div class="col-md-5"><img class="img-responsive" src="https://www.aladinlk.com/assets/img/home-theater-system.jpg" alt="electronics"></div>
                    <div class="col-md-7">
                        <h4 class="name">Electronics</h4>
                        <p class="text-justify description hidden-xs">Buy and sell brand new or used electronic items. Famous brand Panasonic, Sony, Haier, LG, and so many electronic equipment are available in aladin. Post your free ad here.<br></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr style="font-size:82px;height:1px;background-color:#e2a01a;"  >
<br>
<?php include "include/footer.php"?>


<!--Category Model-->
<div class="col-lg-12">
<div class="modal fade" role="dialog" id="category">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color:rgb(226,150,26);background-color:#001921;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:rgb(226,150,26);">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="text-center modal-title">Select Category<br></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel-group" id="accordion_cat">
                            <div class="panel panel">
                                <?php

                                try{
                                    $Category_Query="SELECT Category_Name,id,Image_Path FROM category";
                                    $result=mysqli_query(DBConnection(),$Category_Query);
                                    echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" id='all-cat' class='modlink pointer' style='text-decoration:none;'>
                                        
                                            <div class=\"panel-heading\">
                                            <h4 class=\"panel-title\"><strong>All Category</strong></h4>
                                            </div></a>";

                                    while ($row=mysqli_fetch_assoc($result)){
                                        $query="SELECT Sub_Cat_Name,id FROM sub_category WHERE Main_Cat_Id=".$row['id'].";";
                                        $result_set=mysqli_query(DBConnection(),$query);

                                        echo " <a data-toggle=\"collapse\" data-parent='#accordion_cat' href='#collapse1".$row['id']."' class=\"modlink\" style=\"text-decoration:none;\">
                                  
                                    <div class=\"panel-heading\">
                                    <h5 class=\"panel-title\">
                                        <img src='{$row['Image_Path']}' alt='{$row['Category_Name']}'  class='cat-imge'/>".$row['Category_Name']."</h5>
                                    </div>
                                </a>  
                                <div id='collapse1".$row['id']."' class=\"panel-collapse collapse\">
                                    <div class=\"panel-body\">
                                        <table class=\"table\">";
                                        while ($sub_cat=mysqli_fetch_assoc($result_set)){
                                            echo "<tr><td class='sub_cat pointer navlink' id='".$sub_cat['id']."_subcat' style=\"text-decoration:none; font-size: 15px; color: #001921;\">&nbsp; ".$sub_cat['Sub_Cat_Name']."</td></tr>";
                                        }

                                       echo " </table>
                                    </div>
                                </div>";
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close(DBConnection());
                                }
                                catch(Exception $e){
                                    echo "<script>alert($e)</script>";
                                }
                                ?>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn mod-close" type="button" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--Area Model-->
<div class="modal fade" role="dialog" id="area">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color:rgb(226,150,26);background-color:#001921;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:rgb(226,150,26);">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="text-center modal-title">Select Area<br></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <div class="panel-group" id="accordion">

                            <div class="panel panel">
                                <?php
                                try{
                                    $query="SELECT Area_Name,id FROM area";
                                    $area=mysqli_query(DBConnection(),$query);

                                    echo "<a data-toggle=\"collapse\" data-parent=\"#accordion\" class='modlink pointer' id='all-area' style=\"text-decoration:none;\">
                                        
                                            <div class=\"panel-heading\">
                                            <h5 class=\"panel-title\"><strong>All of Sri Lanka</strong></h5>
                                            </div></a>";

                                    while ($row=mysqli_fetch_assoc($area)){

                                        $query="SELECT id,Sub_Area_Name FROM sub_area WHERE Main_Area_Id=".$row['id'].";";
                                        $sub_area=mysqli_query(DBConnection(),$query);

                                        echo "  <a data-toggle=\"collapse\" data-parent=\"#accordion\" href='#collapsex".$row['id']."' class=\"modlink\" style=\"text-decoration:none;\">
                                        
                                            <div class=\"panel-heading\">
                                            <h5 class=\"panel-title\">".$row['Area_Name']."</h5>
                                            </div></a>
                                
                                     <div id='collapsex".$row['id']."' class=\"panel-collapse collapse\">
                                        <div class=\"panel-body\">
                                                <table class=\"table\">";

                                        while ($sub_res=mysqli_fetch_assoc($sub_area)){
                                            echo "<tr><td class='sub_area pointer navlink' id='".$sub_res['id']."_subarea' style=\"text-decoration:none; font-size: 15px; color: #001921;\">&nbsp; ".$sub_res['Sub_Area_Name']."</td></tr>";
                                        }

                                    echo "</table>
                             </div>
                          </div>";
                                    }
                                    mysqli_close(DBConnection());
                                }
                                catch(Exception $e){

                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn mod-close" type="button" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $('td').click(function(){


        if($(this).hasClass("sub_cat")==true) {

            var clicked = $(this).attr('id');
            clicked=clicked.replace("_subcat", "");
            clicked=clicked.trim();
            $.ajax({
                type: "post",
                url: "repository/create_session.php",
                data: {sub_category_id: clicked},
                success: function (data) {
                    $("#category").hide();
                    location.reload();
                    location.href="aladinlk-all-ad-list-view.php";
                }

            });
        }
        if($(this).hasClass("sub_area")==true) {
            var clicked=$(this).attr('id');
            clicked=clicked.replace("_subarea", "");
            clicked=clicked.trim();
            $.ajax({
                type:"post",
                url:"repository/create_session.php",
                data:{sub_area_id:clicked},
                success:function(data){
                    $("#area").hide();
                    location.reload();
                    location.href="aladinlk-all-ad-list-view.php";
                }

            });
        }

    });

    $('a').click(function () {
        var clicked=$(this).attr('id');

        if(clicked=="all-cat"){
            $.ajax({
                type:"post",
                url:"repository/create_session.php",
                data:{all_cat:clicked},
                success:function(data){
                    location.reload();
                    location.href="aladinlk-all-ad-list-view.php";
                }


            });
        }
        if(clicked=="all-area"){
            $.ajax({
                type:"post",
                url:"repository/create_session.php",
                data:{all_area:clicked},
            success:function(data){
                location.reload();
                location.href="aladinlk-all-ad-list-view.php";
            }

        });
        }
    });

    $('#search').click(function () {
        //get search value

        var search_bar = $('#search_bar').val();
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{search:search_bar},
            success:function(data){
                location.href="aladinlk-all-ad-list-view.php";

            }
        });

    });

    $(".link").click(function () {
        var clicked=$(this).attr('id');
        if($(this).hasClass("sub_cat")==true) {
            $.ajax({
                type:"post",
                url:"repository/create_session.php",
                data:{sub_category_id:clicked},
                success:function(data){
                    location.href="aladinlk-all-ad-list-view.php";

                }
            });
        }
        else{
            $.ajax({
                type:"post",
                url:"repository/create_session.php",
                data:{cat_id:clicked},
                success:function(data){
                    location.href="aladinlk-all-ad-list-view.php";

                }
            });
        }

    });

</script>

</body>
</html>

