<?php
if(isset($_POST['ad_id'])){
    include_once "../repository/aladinlk-function.php";

    $ad_id=mysqli_real_escape_string(DBConnection(),$_POST['ad_id']);

    if (data_availability('advertisement','Id','Id',$ad_id)==true){
        $data=array();
        //get table
        $tbl_name=get_table($ad_id);
        $all_data=all_data_from_table($ad_id); //result set
        $main_img=main_img($ad_id);

        if (mysqli_num_rows($all_data)>0){
            if ($row=mysqli_fetch_assoc($all_data)){
                $text=$row['description'];
                $text=  nl2br($row['description']);
                $url_title=php_slag($row['title']);

                echo "<div class=\"row\">
                    
                    <div class=\"col-md-12 product_img\">
                    <h4>".$row['title']."</h4>";
                if (empty($main_img) || $main_img==""){
                    echo "<img src='https://www.aladinlk.com/assets/img/tumb-aladin.png' alt='aladin ".$row['title']."' class=\"img-responsive\">";
                }
                else{
                    echo "<img src='".$main_img."' alt='aladin ".$row['title']."' class=\"img-responsive\">";
                }
                echo"</div>
                    <div class=\"col-md-3 product_content\">
                    <br>
                    <p style='color: red;'>Price : Rs ".field_by_ad_id('price',$tbl_name,$ad_id)."</p>
                    </div>
                    <div class=\"col-md-9 product_content\">
                    <br>
                    <p>".$text."</p>
                    </div>
                    </div>";
                echo "<div class=\"row\"> <a href='advertisement/".$ad_id."/".$url_title."' class=\"btn btn form-control\" >Go to the advertisement</a></div>";


            }
        }

    }
    else{
        header("location:404.php");
        exit();
    }
}
?>