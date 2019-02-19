<?php
session_start();
require_once "repository/aladinlk-function.php";
?>

<hr style="font-size:82px;height:1px;background-color:#e2a01a;"  >
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h4 class="name"> Aladin Top Advertisements </h4>
            </div>

            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right">
                    <a class="icon ion-arrow-left-c btn btn-success" href="#carousel-example" data-slide="prev"></a>
                    <a class="icon ion-arrow-right-c btn btn-success" href="#carousel-example" data-slide="next"> </a>
                </div>
            </div>
        </div>

        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">

                        <?php
                        $q="select * from all_ads ORDER BY modified DESC LIMIT 4;";
                        $result=mysqli_query(DBConnection(),$q);
                        $ads=array();

                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)){
                                $title_url= php_slag($row['title']);
                                if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                                    $main_img="https://www.aladinlk.com/assets/img/s_tumb.png";
                                }
                                else{
                                    $main_img=$row['main_img'];
                                }
                                ?>
                                <a href="/advertisement/<?php echo $row['id']; ?>/<?php echo $title_url; ?>">
                                    <div class="col-sm-3">
                                        <div class="col-item">
                                            <div class="photo">
                                                <img src="<?php echo $main_img;?>" class="img-responsive" alt="aladin - <?php echo $row['title'];?>" />
                                            </div>
                                            <div class="info">
                                                <div class="row">
                                                    <div class="price col-md-12">
                                                        <h5 style="color: #e2a01a;"><?php echo $row['title'];?></h5>
                                                        <h5 style="color: #000000;" class="price-text-color">Rs : <?php echo field_by_ad_id('price',$row['tbl_name'],$row['id']);?></h5>
                                                    </div>

                                                </div>

                                                <div class="clearfix">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }

                        }
                        mysqli_free_result($result);
                        mysqli_close(DBConnection());
                        ?>

                    </div>
                </div>
                <div class="item">
                    <div class="row">

                        <?php
                        $q="select * from all_ads ORDER BY RAND() LIMIT 4;";
                        $result=mysqli_query(DBConnection(),$q);
                        $ads=array();

                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)){
                                $title_url= php_slag($row['title']);
                                if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                                    $main_img="https://www.aladinlk.com/assets/img/s_tumb.png";
                                }
                                else{
                                    $main_img=$row['main_img'];
                                }
                                ?>
                                <a href="/advertisement/<?php echo $row['id']; ?>/<?php echo $title_url; ?>">
                                    <div class="col-sm-3">
                                        <div class="col-item">
                                            <div class="photo">
                                                <img src="<?php echo $main_img;?>" class="img-responsive" alt="aladin - <?php echo $row['title'];?>" />
                                            </div>
                                            <div class="info">
                                                <div class="row">
                                                    <div class="price col-md-12">
                                                        <h5 style="color: #e2a01a;"><?php echo $row['title'];?></h5>
                                                        <h5 style="color: #000000;" class="price-text-color">Rs : <?php echo field_by_ad_id('price',$row['tbl_name'],$row['id']);?></h5>
                                                    </div>

                                                </div>

                                                <div class="clearfix">
                                                </div>
                                            </div>
                                        </div>
                                    </div></a>

                                <?php
                            }

                        }
                        mysqli_free_result($result);
                        mysqli_close(DBConnection());
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>