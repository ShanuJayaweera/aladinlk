<?php
session_start();

//Set Date
date_default_timezone_set('Asia/Colombo');
$date=date('Y-m-d h:i:sa');

?>
<?php
require_once "aladinlk-function.php";
$row_per_page=500;

if (isset($_SESSION['p'])){
    $page_no=$_SESSION['p'];
}
else{
    $page_no=1;
}

$start=($page_no-1)*$row_per_page;

if(isset($_SESSION['search'])){
if (empty(trim($_SESSION['search']))){
    unset($_SESSION['search']);
}
}


if (isset($_SESSION['search'])){

       if (!isset($_SESSION['cat_id']) && !isset($_SESSION['sub_cat_id']) && !isset($_SESSION['sub_cat_id']) && !isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
       elseif(isset($_SESSION['cat_id']) && !isset($_SESSION['area_id']) && !isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
       elseif (isset($_SESSION['sub_cat_id']) && !isset($_SESSION['area_id']) && !isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
       elseif (!isset($_SESSION['cat_id']) && !isset($_SESSION['sub_cat_id']) && isset($_SESSION['area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());
       }
       elseif (!isset($_SESSION['sub_cat_id']) && !isset($_SESSION['cat_id']) && isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
       elseif (isset($_SESSION['cat_id']) && isset($_SESSION['area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());
       }
       elseif (isset($_SESSION['cat_id']) && isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." and main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }

       elseif (isset($_SESSION['sub_cat_id']) && isset($_SESSION['area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and main_area_id=".$_SESSION['area_id']." and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
       elseif (isset($_SESSION['sub_cat_id']) && isset($_SESSION['sub_area_id'])){

           $query="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);
           if($row=mysqli_fetch_assoc($result)){
               $total_rows=$row['count'];
           }

           $query="select * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and sub_area_id=".$_SESSION['sub_area_id']." and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
           $result=mysqli_query(DBConnection(),$query);

           while ($row=mysqli_fetch_assoc($result)){

               $difference = timediff($row['modified'],$date);
               $years = abs(floor($difference / 31536000));
               $days = abs(floor(($difference-($years * 31536000))/86400));
               $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
               $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
               $title_url= php_slag($row['title']);

               $title=$row['title'];
               $sub_area_id=$row['sub_area_id'];
               $modified=$row['modified'];
               $main_img=$row['main_img'];
               $sub_cat_name=$row['sub_cat_name'];
               $ad_type=$row['ad_type'];
               $sub_area_name=sub_area_name($row['id']);
               $tbl_name=$row['tbl_name'];
               $price=field_by_ad_id('price',$tbl_name,$row['id']);

               if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                   $main_img="http://placehold.it/150x100/000/fff";
               }
               else{
                   $main_img=$row['main_img'];
               }

               echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

               if($years>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif($days>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($hours>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
               }
               elseif ($mins>0){
                   echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
               }

               echo "</div>

                  </div>
              </div></a>";
           }
           mysqli_close(DBConnection());

       }
}
else{
    if (!isset($_SESSION['cat_id']) && !isset($_SESSION['sub_cat_id']) && !isset($_SESSION['area_id']) && !isset($_SESSION['sub_area_id'])){

        $total_rows=row_count_all_ads();
        $query="select * from all_ads ORDER BY modified DESC limit {$start},{$row_per_page};";
        $result=mysqli_query(DBConnection(),$query);
        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

                 echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());


    }
    elseif(isset($_SESSION['cat_id']) && !isset($_SESSION['area_id']) && !isset($_SESSION['sub_area_id'])){

        $query="select count(title) as count from all_ads where main_cat_id=".$_SESSION['cat_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where main_cat_id=".$_SESSION['cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);

            $title_url= php_slag($row['title']);
            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());


    }
    elseif (isset($_SESSION['sub_cat_id']) && !isset($_SESSION['area_id']) && !isset($_SESSION['sub_area_id'])){

        $query="select count(title) as count from all_ads where sub_cat_id=".$_SESSION['sub_cat_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }
    elseif (!isset($_SESSION['cat_id']) && !isset($_SESSION['sub_cat_id']) && isset($_SESSION['area_id'])){

        $query="select count(title) as count from all_ads where main_area_id=".$_SESSION['area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where main_area_id=".$_SESSION['area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }

    elseif (!isset($_SESSION['sub_cat_id']) && !isset($_SESSION['cat_id']) && isset($_SESSION['sub_area_id'])){


        $query="select count(title) as count from all_ads where sub_area_id=".$_SESSION['sub_area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where sub_area_id=".$_SESSION['sub_area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);
            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }
    elseif (isset($_SESSION['cat_id']) && isset($_SESSION['area_id'])){
        $query="select count(title) as count from all_ads where main_cat_id=".$_SESSION['cat_id']." and main_area_id=".$_SESSION['area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }

        $query="select * from all_ads where main_cat_id=".$_SESSION['cat_id']." and main_area_id=".$_SESSION['area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());
    }
    elseif (isset($_SESSION['cat_id']) && isset($_SESSION['sub_area_id'])){

        $query="select count(title) as count from all_ads where main_cat_id=".$_SESSION['cat_id']." and sub_area_id=".$_SESSION['sub_area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }

        $query="select * from all_ads where main_cat_id=".$_SESSION['cat_id']." and sub_area_id=".$_SESSION['sub_area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }
    elseif (isset($_SESSION['sub_cat_id']) && isset($_SESSION['area_id'])){

        $query="select count(title) as count from all_ads where sub_cat_id=".$_SESSION['sub_cat_id']." and main_area_id=".$_SESSION['area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where sub_cat_id=".$_SESSION['sub_cat_id']." and main_area_id=".$_SESSION['area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);

            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }
    elseif (isset($_SESSION['sub_cat_id']) && isset($_SESSION['sub_area_id'])){

        $query="select count(title) as count from all_ads where sub_cat_id=".$_SESSION['sub_cat_id']." and sub_area_id=".$_SESSION['sub_area_id'].";";
        $result=mysqli_query(DBConnection(),$query);

        if($row=mysqli_fetch_assoc($result)){
            $total_rows=$row['count'];
        }


        $query="select * from all_ads where sub_cat_id=".$_SESSION['sub_cat_id']." and sub_area_id=".$_SESSION['sub_area_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
        $result=mysqli_query(DBConnection(),$query);

        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
            $title_url= php_slag($row['title']);
            $title=$row['title'];
            $sub_area_id=$row['sub_area_id'];
            $modified=$row['modified'];
            $main_img=$row['main_img'];
            $sub_cat_name=$row['sub_cat_name'];
            $ad_type=$row['ad_type'];
            $sub_area_name=sub_area_name($row['id']);
            $tbl_name=$row['tbl_name'];
            $price=field_by_ad_id('price',$tbl_name,$row['id']);

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="http://placehold.it/150x100/000/fff";
            }
            else{
                $main_img=$row['main_img'];
            }

            echo "<a href='advertisement/".$row['id']."/".$title_url."' style='text-decoration: none;'><div id='products ".$row['id']."' class='row list-group pointer ad_id'>
                  <div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>
                  <img class='group list-group-image product-img' src='".$main_img."' alt='Ad-img-".$row['id']."' />
                  
                  <div class='caption'>
                    <h4 class='group inner list-group-item-heading' style='color: #001921;'>".$title."</h4>
                    <h6 class='group inner list-group-item-text'>".$sub_area_name.", ".$sub_cat_name."</h6>
                    <h6 class='group inner list-group-item-text'>Rs :".$price."</h6>";

            if($years>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $years . " Years ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif($days>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $days . " Days " . $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($hours>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $hours . " Hours, " . $mins . " Minutes Ago.</h6>";
            }
            elseif ($mins>0){
                echo "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> ". $mins . " Minutes Ago.</h6>";
            }

            echo "</div>

                  </div>
              </div></a>";
        }
        mysqli_close(DBConnection());

    }
}
mysqli_close(DBConnection());
?>
<div class="col-md-12 text-center">

    <ul class="pagination">
        <?php
        $first="<a href='aladinlk-all-ad-list-view.php?p=1'>First</a>";
        $last_page=ceil($total_rows/$row_per_page);
        $last="<a href='aladinlk-all-ad-list-view.php?p={$last_page}'>Last Page</a>";

        //next page
        if ($page_no>=$last_page){
            $next="<a>Next</a>";
        }
        else{
            $next_page=$page_no+1;
            $next="<a href='aladinlk-all-ad-list-view.php?p={$next_page}'>Next</a>";
        }

        //previous page
        //next page
        if ($page_no<=1){
            $prev="<a>Previous</a>";
        }
        else{
            $prev_page=$page_no-1;
            $prev="<a href='aladinlk-all-ad-list-view.php?p={$prev_page}'>Previous</a>";
        }

        echo "<li>{$first}  {$prev}  {$next}  {$last} </li>";
        ?>
    </ul>

</div>
