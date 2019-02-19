<?php
session_start();

require_once "../../repository/aladinlk-function.php";

if(isset($_GET['ad_id'])){

    $ad_id=mysqli_real_escape_string(DBConnection(),$_GET['ad_id']);
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
            }
        }

        if(mysqli_num_rows($customer)>0){
            if ($cont=mysqli_fetch_assoc($customer)){
                $tel=$cont['telephone'];
                $address=$cont['address'];
                $email=$cont['email'];
            }
        }
    include "advertisement.php";
    }
    else{
        echo "<div class='alert alert-danger fade in'>
                <h6>Data not found.</h6>
              </div>";
    }
}
else{
    echo "<div class='alert alert-danger fade in'>
                <h6>Something went wrong.</h6>
              </div>";
}
?>

