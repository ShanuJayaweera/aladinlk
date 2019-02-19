<?php
require_once "repository/aladinlk-function.php";
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta name="theme-color" content="#e2a01a">
    <meta property="og:url" content="https://www.aladinlk.com">
    <meta property="og:site_name" content="www.aladinlk.com">
    <meta property="og:title" content="Aladin is your free classified web marketplace.">
    <meta property="og:description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta property="og:image" content="https://www.aladinlk.com/facebook-opengraph.png"/>

    <title>Aladin - Mobile Phones, Cars, Arduino Products, Electronics, and Lands in Sri Lanka.</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link rel="shortcut icon" href="https://www.aladinlk.com/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/product.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131104955-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-131104955-1');
    </script>

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
</head>

<body>

<?php include "include/nav-bar.php"?>
<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

<div class="promo">
    <div class="jumbotron header-jumb">
        <h4 class="text-center head" style="color: #FFFFFF">Buy or sell Your Amazing Product or Service.</h4>
        <br>
        <div class="form-group form-horizontal col-sm-12 header-search">
            <div class="col-md-3">
                <button style="background-color: #FFFFFF; color: #000000;" class="btn category_btn form-control" type="button" data-target="#category" data-toggle="modal" >

                </button>
            </div>

            <div class="col-md-3">
                <button style="background-color: #FFFFFF; color: #000000;" class="btn area_btn form-control" type="button" data-target="#area" data-toggle="modal">

                </button>
            </div>


            <div class="col-md-5"><input type="text" placeholder="Search" value="<?php if (isset($_SESSION['search'])){echo $_SESSION['search'];} ?>" class="form-control search" name="search_bar" id="search_bar"></div>
            <div class="col-md-1"><button style="background-color: #FFFFFF; color: #000000;" class="btn form-control" type="button" name="search" id="search">Search </button></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="ad-placement" id="ablockercheck"></div>
    <div id="ablockermsg" style="display: none"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" >
            <!--Filter set-->
            <div class="hidden-xs col-sm-4">

                <div class="col-sm-12">

                    <hr>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title pointer" style="text-decoration: none;">
                                Sort results by:
                            </h4>
                        </div>
                        <div class="panel-body" style="padding-left: 0px;">
                            <select class="form-control date_filter" id="date_filter">
                                <option value="nop">Newest on top</option>
                                <option value="oop">Oldest on top</option>
                            </select>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title pointer" style="text-decoration: none;">
                                Select Advertisement Type
                            </h4>
                        </div>
                        <div class="panel-body" id="ad_type" style="padding-left: 0px;">

                            <div class="radio"><label><input class="ad_type" type="radio" value="458" name="ad_type" id="458_type" />Sell an Item or Service</label></div>
                            <div class="radio"><label><input class="ad_type" type="radio" value="789" name="ad_type" id="789_type" />Offer a Property for Rent</label></div>
                            <div class="radio"><label><input class="ad_type" type="radio" value="995" name="ad_type" id="995_type" />Look for Something to Buy</label></div>
                            <div class="radio"><label><input class="ad_type" type="radio" value="125" name="ad_type" id="125_type" />Look for Property to Rent</label></div>
                        </div>
                    </div>
                    <!--category-->
                    <hr>
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title pointer" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration: none;">
                                Main Categories
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse in">
                            <div class="panel-body" style="padding-left: 0px;">
                                <ul class="list-group">
                                    <?php
                                    //select all categories
                                    $query="select category_name,id from category;";
                                    $result=mysqli_query(DBConnection(),$query);

                                    while ($row=mysqli_fetch_assoc($result)){
                                        echo "<li class='list-group-item pointer' style='font-size: 12px' id='".$row['id']."_maincat'>".$row['category_name']."</li>";
                                    }
                                    mysqli_close(DBConnection());
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--Area-->
                    <hr>
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title pointer" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="text-decoration: none;">
                                Location
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body" style="padding-left: 0px;">
                                <ul class="list-group">
                                    <?php
                                    //select all categories
                                    $query="select area_name,id from area;";
                                    $result=mysqli_query(DBConnection(),$query);
                                    while ($row=mysqli_fetch_assoc($result)){
                                        echo "<li class='list-group-item pointer' style='font-size: 12px' id='".$row['id']."_mainarea'>".$row['area_name']."</li>";
                                    }
                                    mysqli_close(DBConnection());
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8" style='padding-left: 5px !important; padding-right: 5px !important;'>
                <button type="button" class="btn btn-warning btn-block hidden-lg hidden-md hidden-sm" data-target="#filters" data-toggle="modal" style="margin-top: 5px;">Add Filters</button>
                <br>
                <div id="myDiv" style="text-align: center;">
                    <img id="loading-image" src="https://www.aladinlk.com/assets/img/aladin-loading.gif" style="display:none; "/>
                </div>
                <div class="ad_container">

                </div>
                <!--pagination-->
                <div class="col-md-12 text-center">

                    <ul class="pagination">
                        <li id="pagination">
                            <a class="first-page">First</a><a class="prev-page">Previous</a><a class="next-page">Next</a><a class="last-page" id="pagination">Last</a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>

    </div>
</div>
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

                                            echo " <a data-toggle=\"collapse\" data-parent='#accordion_cat' href='#collapse1".$row['id']."' class=\"modlink\" style=\"text-decoration:none; \">
                                  
                                    <div class=\"panel-heading\">
                                    <h5 class=\"panel-title\">
                                        <img src='{$row['Image_Path']}' alt='{$row['Category_Name']}'  class='cat-imge'/>".$row['Category_Name']."</h5>
                                    </div>
                                  
                                </a>  
                                <div id='collapse1".$row['id']."' class=\"panel-collapse collapse\">
                                    <div class=\"panel-body\">
                                        <table class=\"table\">";
                                            while ($sub_cat=mysqli_fetch_assoc($result_set)){
                                                echo "<tr><td class='sub_cat pointer navlink' id='".$sub_cat['id']."_subcat' style=\"text-decoration:none; font-size: 13px; color: #001921;\">&nbsp; ".$sub_cat['Sub_Cat_Name']."</td></tr>";
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
<!--Category Model End-->


<!--Area Model-->
<div class="modal fade" role="dialog" id="area">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color:rgb(226,150,26); background-color:#001921;">
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
                                            echo "<tr><td class='sub_area pointer navlink' id='".$sub_res['id']."_subarea' style=\"text-decoration:none; font-size: 13px; color: #001921;\">&nbsp; ".$sub_res['Sub_Area_Name']."</td></tr>";
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
<!--Area Model End-->

<!--Aladin filters Responsive-->
<div class="modal fade" role="dialog" id="filters">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color:rgb(226,150,26); background-color:#001921;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:rgb(226,150,26);">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="text-center modal-title">Select Filters<br></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <div class="panel-group" id="accordion">

                            <div class="panel panel">
                                <div class="col-sm-12">

                                    <hr>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title pointer" style="text-decoration: none;">
                                                Select Advertisement Type
                                            </h4>
                                        </div>
                                        <div class="panel-body" style="padding-left: 0px;">

                                            <div class="radio"><label><input class="ad_type" type="radio" name="ad_type" id="458_type" />Sell an Item or Service</label></div>
                                            <div class="radio"><label><input class="ad_type" type="radio" name="ad_type" id="789_type" />Offer a Property for Rent</label></div>
                                            <div class="radio"><label><input class="ad_type" type="radio" name="ad_type" id="995_type" />Look for Something to Buy</label></div>
                                            <div class="radio"><label><input class="ad_type" type="radio" name="ad_type" id="125_type" />Look for Property to Rent</label></div>
                                        </div>
                                    </div>
                                    <!--category-->
                                    <hr>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title pointer" style="text-decoration: none;">
                                                Main Categories
                                            </h4>
                                        </div>
                                        <div class="panel-body" style="padding-left: 0px;">
                                            <ul class="list-group">
                                                <?php
                                                //select all categories
                                                $query="select category_name,id from category;";
                                                $result=mysqli_query(DBConnection(),$query);

                                                while ($row=mysqli_fetch_assoc($result)){
                                                    echo "<li class='list-group-item pointer' style='font-size: 12px;' id='".$row['id']."_maincat'>".$row['category_name']."</li>";
                                                }
                                                mysqli_close(DBConnection());
                                                ?>
                                            </ul>
                                        </div>

                                    </div>

                                    <!--Area-->
                                    <hr>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title pointer" style="text-decoration: none;">
                                                Location
                                            </h4>
                                        </div>

                                        <div class="panel-body" style="padding-left: 0px;">
                                            <ul class="list-group">
                                                <?php
                                                //select all categories
                                                $query="select area_name,id from area;";
                                                $result=mysqli_query(DBConnection(),$query);
                                                while ($row=mysqli_fetch_assoc($result)){
                                                    echo "<li class='list-group-item pointer' style='font-size: 12px;' id='".$row['id']."_mainarea'>".$row['area_name']."</li>";
                                                }
                                                mysqli_close(DBConnection());
                                                ?>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
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
<!--Aladin filters Responsive End-->


<!--Product quick View-->
<div class="modal fade product_view" id="quick_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="color:rgb(226,150,26); background-color:#001921;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:rgb(226,150,26);">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="text-center modal-title">Quick View<br></h4>
            </div>
            <div class="modal-body">
                <div class="quick_body">

                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn mod-close" type="button" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>
<!--Product quick View End-->



<script>
    var func="default";
    var ad_type=458;
    $(document).ready(function() {

        filters();
        p_session(1);

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

    });

    function on_top() {
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    }

    function ad_content(id,title_url,main_img,title,sub_area_name,sub_cat_name,price,time_diff,sub_cat_id,mileage){

        if((sub_cat_id=='1' || sub_cat_id=='2' || sub_cat_id=='3' || sub_cat_id=='4') && (mileage != '0' && mileage != 'No Details')){
            $(".ad_container").append("<a href='advertisement/"+id+"/"+title_url+"' style='text-decoration: none; margin-bottom: 0px;'><div id='products "+id+"' style='margin-bottom: 0px !important; padding-bottom: 0px !important;' class='row list-group pointer ad_id'>" +
                "<div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item' style='margin-bottom: 0px !important;'>" +
                "<img class='group list-group-image product-img' src='"+main_img+"' alt='Ad-img-"+id+"' />" +
                "<div class='caption'>" +
                "<h4 class='group ad_title inner list-group-item-heading' style='color: #0070b5; font-family: Arial,Helvetica,sans-serif !important'><strong>"+title+"</strong></h4>" +
                "<h5 class='group inner list-group-item-text' style='padding: 5px; color: #000000;'>"+sub_area_name+", "+sub_cat_name+"</h5>" +
                "<h5 class='group inner list-group-item-text' style='color: #e2a01a; padding-bottom: 3px; padding-right: 3px; padding-left: 3px;'> Mileage : "+mileage+" km </h5>" +
                "<h5 class='group inner list-group-item-text' style='color: black;'><strong>Rs : "+price+"</strong></h5>" +
                "<h6 class='group inner list-group-item-text' style='float: right; color: #001921; font-size: 11px'> "+time_diff+".</h6>" +
                "</div>" +
                "</div></div></a><button id='"+id+"' style='font-size: 13px; margin-top: 1px; margin-bottom: 5px; margin-left: 0px  !important; color: #000 !important; background-color: #e2a01a !important;' class='themeBtn quick'>Quick View</button>");
        }
        else{
            $(".ad_container").append("<a href='advertisement/"+id+"/"+title_url+"' style='text-decoration: none; margin-bottom: 0px;'><div id='products "+id+"' style='margin-bottom: 0px !important; padding-bottom: 0px !important;' class='row list-group pointer ad_id'>" +
                "<div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item' style='margin-bottom: 0px !important;'>" +
                "<img class='group list-group-image product-img' src='"+main_img+"' alt='Ad-img-"+id+"' />" +
                "<div class='caption'>" +
                "<h4 class='group ad_title inner list-group-item-heading' style='color: #0070b5; font-family: Arial,Helvetica,sans-serif !important'><strong>"+title+"</strong></h4>" +
                "<h5 class='group inner list-group-item-text' style='padding: 5px; color: #000000;'>"+sub_area_name+", "+sub_cat_name+"</h5>" +
                "<h5 class='group inner list-group-item-text' style='color: black;'><strong>Rs : "+price+"</strong></h5>" +
                "<h6 class='group inner list-group-item-text' style='float: right; color: #001921; font-size: 11px'> "+time_diff+".</h6>" +
                "</div>" +
                "</div></div></a><button id='"+id+"' style='font-size: 13px; margin-top: 1px; margin-bottom: 5px; margin-left: 0px  !important; color: #000 !important; background-color: #e2a01a !important;' class='themeBtn quick'>Quick View</button>");
        }



    }

    function get_cat_area() {
        $.ajax({
            url: "include/filters/meta.php",
            method: "POST",
            dataType: "JSON",
            success: function (data) {

                $('.category_btn').html('');
                $('.area_btn').html('');
                $('.search').html('');

                $('.category_btn').append(data.category);
                $('.area_btn').append(data.area);
                $('.search').append(data.search);


            }
        });

    }

    function main_cat(value) {
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{cat_id:value},
            success:function (data) {
                $("#filters").modal('hide');
                return true;
            }
        });
    }

    function sub_cat(value) {
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{sub_category_id:value},
            success:function (data) {
                $("#category").modal('hide');

            }
        });
    }

    function main_area(value) {
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{area_id:value},
            success:function (data) {
                $("#filters").modal('hide');
                return true;
            }
        });
    }

    function sub_area(value) {
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{sub_area_id:value},
            success:function (data) {
                $("#area").modal('hide');
            }
        });
    }

    function all_area(para) {

        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{all_area:para},
            success:function(data){
                $("#area").modal('hide');
            }
        });
    }

    function all_cat(para) {
        $.ajax({
            type:"post",
            url:"repository/create_session.php",
            data:{all_cat:para},
            success:function(data){
                $("#category").modal('hide');
            }
        });
    }

    function ad_information(filter_url) {
        $.ajax({
            url:filter_url,
            method:"POST",
            dataType:"JSON",
            beforeSend: function() {
                $("#loading-image").show();
                $(".ad_container").html('');
            },
            success:function(data)
            {
                $("#loading-image").hide();
                $(".ad_container").html('');
                $("#filters").modal('hide');
                func="default";
                if (!$.trim(data)){
                    $('.ad_container').html('<h5>There are no results matching...</h5>');
                }
                else{
                    $.each(data, function(key, value){

                        if(key!="pagination"){
                            ad_content(value.id,value.title_url,value.main_img,value.title,value.sub_area_name,value.sub_cat_name,value.price,value.time_diff,value.sub_cat_id,value.mileage);
                        }

                    });

                    //create first page
                    $('.first-page').addClass('pointer');


                    //last page
                    var total_rows = parseInt(data.pagination.total_rows, 10);
                    var row_per_page = parseInt(data.pagination.row_per_page, 10);
                    var current_page=parseInt(data.pagination.current_page, 10);

                    var celi=Math.ceil(total_rows/row_per_page);

                    $('.last-page').addClass('pointer');
                    var id=$('.last-page').attr('id');


                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".last-page").remove(str[i]);
                            }
                        }
                    }
                    //add  page no to last page
                    $('.last-page').attr('id', 'page_'+celi);


                    //next page
                    if(current_page>=celi){

                        $('.next-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.next-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }


                        var next_page=current_page+1;
                        $('.next-page').addClass('pointer');
                        $('.next-page').attr('id', 'page_'+next_page);

                    }

                    //previous page
                    if(current_page<=1){

                        $('.prev-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.prev-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }

                        var prev_page=current_page-1;
                        $('.prev-page').addClass('pointer');
                        $('.prev-page').attr('id', 'page_'+prev_page);
                    }
                }


            }
        })
    }

    function sort_time_ad(selected,ad_type) {

        $.ajax({
            url:"include/filters/time_filter/time_filter.php",
            method:"POST",
            data:{ad_type:ad_type,sort_type:selected},
            dataType:"JSON",
            beforeSend: function() {
                $("#loading-image").show();
                $(".ad_container").html('');
            },
            success:function(data)
            {
                $("#loading-image").hide();
                $(".ad_container").html('');
                $("#filters").modal('hide');
                func="sort_time";
                if (!$.trim(data)){
                    $('.ad_container').html('<h5>There are no results matching...</h5>');
                }
                else{
                    $.each(data, function(key, value){

                        if(key!="pagination"){
                            ad_content(value.id,value.title_url,value.main_img,value.title,value.sub_area_name,value.sub_cat_name,value.price,value.time_diff,value.sub_cat_id,value.mileage);
                        }

                    });

                    //create first page
                    $('.first-page').addClass('pointer');


                    //last page
                    var total_rows = parseInt(data.pagination.total_rows, 10);
                    var row_per_page = parseInt(data.pagination.row_per_page, 10);
                    var current_page=parseInt(data.pagination.current_page, 10);

                    var celi=Math.ceil(total_rows/row_per_page);

                    $('.last-page').addClass('pointer');
                    var id=$('.last-page').attr('id');


                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".last-page").remove(str[i]);
                            }
                        }
                    }
                    //add  page no to last page
                    $('.last-page').attr('id', 'page_'+celi);


                    //next page
                    if(current_page>=celi){

                        $('.next-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.next-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }


                        var next_page=current_page+1;
                        $('.next-page').addClass('pointer');
                        $('.next-page').attr('id', 'page_'+next_page);

                    }

                    //previous page
                    if(current_page<=1){

                        $('.prev-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.prev-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }

                        var prev_page=current_page-1;
                        $('.prev-page').addClass('pointer');
                        $('.prev-page').attr('id', 'page_'+prev_page);
                    }
                }


            }

        });
    }

    function p_session(page) {
        $.ajax({
            type:"post",
            url:"repository/pagination.php",
            data:{page_no:page},
            success:function(data){
                on_top();
                return true;
            }
        });
    }

    function ad_type_information(filter_url,para) {
        $.ajax({
            url:filter_url,
            method:"POST",
            dataType:"JSON",
            data:{ad_type:para},
            beforeSend: function() {
                $("#loading-image").show();
                $(".ad_container").html('');
            },
            success:function(data)
            {

                $("#loading-image").hide();
                $(".ad_container").html('');
                func="ad_type";
                $("#filters").modal('hide');
                if (!$.trim(data)){
                    $('.ad_container').html('<h5>There are no results matching...</h5>');
                }
                else{
                    $.each(data, function(key, value){

                        if(key!="pagination"){ad_content(value.id,value.title_url,value.main_img,value.title,value.sub_area_name,value.sub_cat_name,value.price,value.time_diff,value.sub_cat_id,value.mileage);
                        }

                    });

                    //create first page
                    $('.first-page').addClass('pointer');


                    //last page
                    var total_rows = parseInt(data.pagination.total_rows, 10);
                    var row_per_page = parseInt(data.pagination.row_per_page, 10);
                    var current_page=parseInt(data.pagination.current_page, 10);

                    var celi=Math.ceil(total_rows/row_per_page);

                    $('.last-page').addClass('pointer');
                    var id=$('.last-page').attr('id');


                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".last-page").remove(str[i]);
                            }
                        }
                    }
                    //add  page no to last page
                    $('.last-page').attr('id', 'page_'+celi);


                    //next page
                    if(current_page>=celi){

                        $('.next-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.next-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".next-page").remove(str[i]);
                                }
                            }
                        }


                        var next_page=current_page+1;
                        $('.next-page').addClass('pointer');
                        $('.next-page').attr('id', 'page_'+next_page);

                    }

                    //previous page
                    if(current_page<=1){

                        $('.prev-page').removeClass('pointer');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }
                    }
                    else{
                        var id=$('.prev-page').attr('id');
                        if(id!=undefined){
                            var str=id.split(" ");
                            for (i = 0; i < str.length; i++) {
                                if(str[i].includes("page_")==true){
                                    //remove id
                                    $(".prev-page").remove(str[i]);
                                }
                            }
                        }

                        var prev_page=current_page-1;
                        $('.prev-page').addClass('pointer');
                        $('.prev-page').attr('id', 'page_'+prev_page);
                    }
                }


            }
        })
    }


    function ad_type_filter(ad_type_id){


        $.ajax({
            url:"include/filters/get-sessions.php",
            method:"POST",
            dataType:"JSON",
            success:function(data)
            {
                var cat_id=data.cat_id;
                var area_id=data.area_id;
                var sub_area_id=data.sub_area_id;
                var sub_cat_id=data.sub_cat_id;


                if(cat_id=="false" && sub_cat_id=="false" && area_id=="false" && sub_area_id=="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/get-all-data.php",ad_type_id);

                }
                else if(cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/main-cat-data.php",ad_type_id);
                }
                else if(sub_cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/sub-cat-only.php",ad_type_id);
                }
                else if(cat_id=="false" && sub_cat_id=="false" && area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/main-area-only.php",ad_type_id);
                }
                else if(cat_id=="false" && sub_cat_id=="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/sub-cat-only.php",ad_type_id);
                }
                else if(cat_id!="false" && area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/main-area-cat.php",ad_type_id);
                }
                else if(sub_cat_id!="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/sub-area-cat.php",ad_type_id);
                }
                else if(sub_cat_id!="false" && area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/main-area-sub-cat.php",ad_type_id);
                }
                else if(cat_id!="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_type_information("include/filters/ad_type/main-cat-sub-area.php",ad_type_id);
                }
            }
        });




    }

    function filters() {
        //get session values
        $.ajax({
            url:"include/filters/get-sessions.php",
            method:"POST",
            dataType:"JSON",
            success:function(data)
            {
                var cat_id=data.cat_id;
                var area_id=data.area_id;
                var sub_area_id=data.sub_area_id;
                var sub_cat_id=data.sub_cat_id;


                if(cat_id=="false" && sub_cat_id=="false" && area_id=="false" && sub_area_id=="false"){
                    get_cat_area();
                    ad_information("include/filters/get-all-data.php");

                }
                else if(cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                    get_cat_area();
                    ad_information("include/filters/main-cat-data.php");
                }
                else if(sub_cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                    get_cat_area();
                    ad_information("include/filters/sub-cat-only.php");
                }
                else if(cat_id=="false" && sub_cat_id=="false" && area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/main-area-only.php");
                }
                else if(cat_id=="false" && sub_cat_id=="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/sub-cat-only.php");
                }
                else if(cat_id!="false" && area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/main-area-cat.php");
                }
                else if(sub_cat_id!="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/sub-area-cat.php");
                }
                else if(sub_cat_id!="false" && area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/main-area-sub-cat.php");
                }
                else if(cat_id!="false" && sub_area_id!="false"){
                    get_cat_area();
                    ad_information("include/filters/main-cat-sub-area.php");
                }
            }
        });





    }

    $('td').click(function(){


        if($(this).hasClass("sub_cat")==true) {
            //get sub cat
            var clicked=$(this).attr('id');
            clicked=clicked.replace("_subcat", "");
            clicked=clicked.trim();
            sub_cat(clicked);
            p_session(1);
            filters();

        }


        if($(this).hasClass("sub_area")==true) {

            var clicked=$(this).attr('id');
            clicked=clicked.replace("_subarea", "");
            clicked=clicked.trim();
            sub_area(clicked);
            p_session(1);
            filters();
        }

    });

    $('li').click(function () {

        var clicked=$(this).attr('id');

        if(clicked.includes("_maincat")){
            clicked=clicked.replace("_maincat", "");
            clicked=clicked.trim();

            main_cat(clicked);
            p_session(1);
            filters();

        }
        else if(clicked.includes("_mainarea")){
            clicked=clicked.replace("_mainarea", "");
            clicked=clicked.trim();

            main_area(clicked);
            p_session(1);
            filters();
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
                p_session(1);
                filters();
            }
        });

    });

    $('input').click(function () {
        if($(this).hasClass("ad_type")==true) {

            var clicked=$(this).attr('id');
            clicked=clicked.replace("_type", "");
            clicked=clicked.trim();
            ad_type=clicked;
            p_session(1);
            ad_type_filter(clicked);
            $("#filters").modal('hide');
        }
    });

    function date_sort(){
        var optionval = $("#date_filter option:selected").val();
        var ad_type=$('input[name=ad_type]:checked', '#ad_type').val();
        p_session(1);
        sort_time_ad(optionval,ad_type);
        get_cat_area();
    }

    $("select").change(function(){
        if($(this).hasClass("date_filter")==true) {

            date_sort();

        }
    });

    $('a').click(function () {
        var clicked=$(this).attr('id');
        var click_class=$(this).attr('class');

        if(clicked=="all-cat"){
            all_cat("para");
            p_session(1);
            filters();
        }
        if(clicked=="all-area"){

            all_area("d");
            p_session(1);
            filters();

        }

        if($(this).hasClass("first-page")==true) {
            p_session(1);
            if (func=="ad_type"){
                ad_type_filter(ad_type);
            }
            else if(func=="sort_time"){
                date_sort();
            }
            else if(func=="default"){
                filters();
            }

        }
        if($(this).hasClass("next-page")==true){

            //get id from element
            if(clicked!=undefined){
                var str=clicked.split(" ");
                for (i = 0; i < str.length; i++) {
                    if(str[i].includes("page_")==true){
                        str[i]=str[i].replace("page_","");
                        str[i]=str[i].trim();
                        p_session(str[i]);
                        if (func=="ad_type"){
                            ad_type_filter(ad_type);
                        }
                        else if(func=="sort_time"){
                            date_sort();
                            alert(str[i])
                        }
                        else if(func=="default"){
                            filters();
                        }
                    }
                }
            }

        }
        if($(this).hasClass("prev-page")==true){

            //get id from element
            if(clicked!=undefined){
                var str=clicked.split(" ");
                for (i = 0; i < str.length; i++) {
                    if(str[i].includes("page_")==true){
                        str[i]=str[i].replace("page_","");
                        str[i]=str[i].trim();
                        p_session(str[i]);
                        if (func=="ad_type"){
                            ad_type_filter(ad_type);
                        }
                        else if(func=="sort_time"){
                            date_sort();
                        }
                        else if(func=="default"){
                            filters();
                        }
                    }
                }
            }

        }
        if($(this).hasClass("last-page")==true){

            //get id from element
            if(clicked!=undefined){
                var str=clicked.split(" ");
                for (i = 0; i < str.length; i++) {
                    if(str[i].includes("page_")==true){
                        str[i]=str[i].replace("page_","");
                        str[i]=str[i].trim();
                        p_session(str[i]);
                        if (func=="ad_type"){
                            ad_type_filter(ad_type);
                        }
                        else if(func=="sort_time"){
                            date_sort();
                        }
                        else if(func=="default"){
                            filters();
                        }
                    }
                }
            }

        }
    });


    $( document ).ajaxComplete(function( event,request, settings ) {

        $('.quick').click(function () {
            var clicked=$(this).attr('id');

            $.ajax({
                url:"include/quick_view.php",
                type:"POST",
                data:{ad_id:clicked},
                success:function(data)
                {
                    $(".quick_body").html('');
                    $(".quick_body").append(data);
                    $("#quick_view").modal('show');
                }
            });


        });

    });

    //check ad blocker
    window.setInterval(function(){
        if(!$("#ablockercheck").is(":visible"))
        {
            swal("Adblocker Detected !", "Please Disable your adblocker and refresh the page !", "warning");
        }
    }, 5000);

</script>

</body>
</html>

