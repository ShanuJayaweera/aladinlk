<?php
session_start();
?>
<?php

require_once "../../repository/aladinlk-function.php";


$user_id=select_user_id($_SESSION['email'],$_SESSION['auth_Provider']);

date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

//select sub category,ad_id,tbl_name,main_img and advertisement title
$query="SELECT sub_cat_name,tbl_name, main_img,advertisement.id,advertisement.title,advertisement.modified,advertisement.posted,advertisement.verified
                    FROM sub_category JOIN advertisement
                    ON sub_category.Id = advertisement.sub_cat_id  where advertisement.user_id=".$user_id." and advertisement.posted=true;";

$result=mysqli_query(DBConnection(),$query);

if (mysqli_num_rows($result)>0) {

    while ($row=mysqli_fetch_assoc($result)){
        if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
            $img="http://placehold.it/150x100/000/fff";
        }
        else{
            $img=$row['main_img'];
        }
//Usage :
        $difference = timediff($row['modified'],$date);
        $years = abs(floor($difference / 31536000));
        $days = abs(floor(($difference-($years * 31536000))/86400));
        $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
        $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);



        $sub_area_name=sub_area_name($row['id']);

        //get price
        $price=field_by_ad_id('price',$row['tbl_name'],$row['id']);

        echo "<div id='products' class='row list-group'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$img."' alt='product-img' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$row['title']."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name." , ".$row['sub_cat_name']."</h6>
                    <h6 class='group inner list-group-item-text'>Rs : " .$price."</h6>
                    <h6 class='group inner list-group-item-text' style='color: darkred;'>";
                    if ($row['verified']==1){
                        echo "Advertisement has Posted";
                    }
                    else{
                        echo "Pending for Admin Confirm";
                    }
                    echo "</h6>";

                    if($years>0){
                        echo "<h6 class='group inner list-group-item-text'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
                    }
                    elseif($days>0){
                        echo "<h6 class='group inner list-group-item-text'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
                    }
                    elseif ($hours>0){
                        echo "<h6 class='group inner list-group-item-text'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
                    }
                    elseif ($mins>0){
                        echo "<h6 class='group inner list-group-item-text'> ". $mins . " Minutes Ago.</h6>";
                    }
                    echo "<h4 class='group inner list-group-item-text' style='float: right; color: #001921;'>
                    <a href='update_ad.php?ad_id={$row['id']}' style='font-size: medium; color: #e2a01a;'>update</a></h4>
                  </div>
                  
                  </div>
              </div>";
    }

}
else{
    echo "<div role='alert' class='alert alert-info'><span>You don't have Advertisement Yet ! </span></div>";
}
mysqli_close(DBConnection());
?>


