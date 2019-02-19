<?php
session_start();
require_once "../../repository/aladinlk-function.php";

//Set Date
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

if(isset($_GET['ad_id'])){
    $ad_id=mysqli_real_escape_string(DBConnection(),$_GET['ad_id']);
    //data availability
    if (data_availability('advertisement','Id','Id',$ad_id)==true){
        //update verified
        $query="update advertisement set verified=true,modified='".$date."' where Id=".$ad_id.";";
        if(mysqli_query(DBConnection(),$query)){
            echo "<div class='alert alert-success fade in'>
                <h6>Advertisement Accepted.</h6>
              </div>";
        }
        else{
            echo "<div class='alert alert-danger fade in'>
                <h6>Sorry ! Something went wrong.</h6>
              </div>";
        }
    }
    else{
        echo "<div class='alert alert-danger fade in'>
                <h6>Data not found.</h6>
              </div>";
    }
}
?>