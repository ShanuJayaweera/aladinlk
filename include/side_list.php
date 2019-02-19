<?php
session_start();
require_once "repository/aladinlk-function.php";
$sub_cat_id= select_by_id($ad_id,'sub_cat_id','advertisement');
$ad_count=false;

$query="select count(title) as count from all_ads where sub_cat_id=".$sub_cat_id.";";
$result=mysqli_query(DBConnection(),$query);
if($row=mysqli_fetch_assoc($result)){

    if($row['count']>4){
        $ad_count=true;

    }
    else{

        $ad_count=false;
    }
}
mysqli_free_result($result);
mysqli_close(DBConnection());
?>


<div class="col-md-12" style="padding-left: 2px; padding-right: 2px;">
    <div class="well well-sm">
        <div class="row">
                    <?php
                    if($ad_count==false){
                        $q="select * from all_ads ORDER BY RAND() LIMIT 4;";
                    }
                    else{
                        $q="select * from all_ads where sub_cat_id=".$sub_cat_id." ORDER BY RAND() LIMIT 4;";
                    }
                    $result=mysqli_query(DBConnection(),$q);
                    $ads=array();

                    if(mysqli_num_rows($result)>0){
                        while ($row=mysqli_fetch_assoc($result)){
                            $tumb_img="advertisement_images/".$row['id']."/tumb/";
                            $title_url= php_slag($row['title']);
                            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                                $main_img="https://www.aladinlk.com/assets/img/s_tumb.png";
                            }
                            else{
                                $main_img="https://www.aladinlk.com/".$tumb_img. basename($row['main_img']);
                            }
                            ?>
                            <a href="/advertisement/<?php echo $row['id']; ?>/<?php echo $title_url; ?>">

                                <div class="col-xs-5 col-md-5 text-center">
                                    <img src="<?php echo $main_img;?>" alt="aladin - <?php echo $row['title'];?>"
                                         class="img-rounded img-responsive" />
                                </div>
                                <div class="col-xs-7 col-md-7 section-box">
                                    <h6 style="color: #e2a01a;"><?php echo $row['title'];?> </h6>
                                    <h6 style="color: #000000;" class="price-text-color">Rs : <?php echo field_by_ad_id('price',$row['tbl_name'],$row['id']);?></h6>


                                </div>
<hr>
                                <div class="clearfix">
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
</div>
