<?php
session_start();
require_once "repository/aladinlk-function.php";
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
    <title>Aladinlk post your advertisement</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>
</head>

<body>
<?php include "include/nav-bar.php"?>
<br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 col-md-offset-0">
                <h3 class="text-center post-head" style="color:rgb(226,160,26);">Welcome <?php echo $_SESSION['user_name']; ?></h3>
                <h4 class="text-center text-warning headtext" style="margin-top:15px;margin-bottom:15px;">Let's Post Your Advertisement . Please Select Your Category And Area</h4>
            </div>
            <br>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body post-panal pointer"  data-target="#category" data-toggle="modal">
                            <h5 class="text-left" style="text-align: center"><br>Before Post Your Advertisement Select Your Correct Category<br><br></h5>
                            <?php

                            if(isset($_SESSION['sub_cat_id'])){
                                $sql="select sub_cat_name from sub_category where id=".$_SESSION['sub_cat_id'].";";
                                $result=mysqli_query(DBConnection(),$sql);
                                if ($row=mysqli_fetch_assoc($result)){
                                    echo  "<h5 class='text-warning' style='text-align: center'>".$row['sub_cat_name']."</h5>";
                                }
                                mysqli_close(DBConnection());
                            }
                            else{
                                echo  "<h5 class='text-warning' style='text-align: center'>Select Category</h5>";
                            }

                            ?>

                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="panel ">
                        <div class="panel-body post-panal pointer" data-target="#area" data-toggle="modal">
                            <h5 class="text-left" style="text-align: center"><br>Before Post Your Advertisement Select Your Correct Area<br><br></h5>
                            <?php

                            if(isset($_SESSION['sub_area_id'])){
                                $sql="select sub_area_name from sub_area where id=".$_SESSION['sub_area_id'].";";
                                $result=mysqli_query(DBConnection(),$sql);
                                if ($row=mysqli_fetch_assoc($result)){
                                    echo  "<h5 class='text-warning' style='text-align: center'>".$row['sub_area_name']."</h5>";
                                }
                                mysqli_close(DBConnection());
                            }
                            else{
                                echo  "<h5 class='text-warning' style='text-align: center'>Select Area</h5>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="post-ad-content">

        <!--load post ad content-->
        <?php



        if(isset($_SESSION['sub_cat_id']) && isset($_SESSION['sub_area_id'])){
            //update sub category and sub area
            $sql = "UPDATE advertisement SET sub_cat_id={$_SESSION['sub_cat_id']}, sub_area_id={$_SESSION['sub_area_id']} WHERE id={$_SESSION['ad_id']}";

            if(mysqli_query(DBConnection(), $sql)){

                //load view
                $cat=main_category_name($_SESSION['sub_cat_id']);
                $sub_cat= select_by_id($_SESSION['sub_cat_id'],'Tbl_name','sub_category');
                include 'include/post_your_ad/'.$cat.'/'.$sub_cat.'.php';

            }
            else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error(DBConnection());
            }
            mysqli_close(DBConnection());


        }
        else{
            echo("<div class=\"jumbotron post-Jumbo\" style=\"color:rgb(0,25,33);\">
        <h3 class=\"text-center\" style=\"color:rgb(226,160,26);\"><strong>Prepare a Great Deals With aladinlk.com .&nbsp;</strong> </h3>
        <p class=\"text-center\" style=\"color:rgb(226,160,26);\">To Buy or Sell Your Used or Brand New Car, Van, Lorries, Mobile phone , Computer or Your Property in Sri Lanka.</p>
    </div>");
        }

        ?>
    </div>
</div>


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
<!--Category Model End-->

<!--area Model-->
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

<!--area Model End-->


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
                }

            });
        }

    });
</script>

<br>
<?php include "include/footer.php"?>

</body>

</html>