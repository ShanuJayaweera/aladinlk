<?php
session_start();
$data=array();

if(isset($_SESSION['cat_id'])){
    $data['cat_id']=$_SESSION['cat_id'];
}
else{
    $data['cat_id']= "false";
}
if(isset($_SESSION['sub_cat_id'])){$data['sub_cat_id']=$_SESSION['sub_cat_id'];} else{ $data['sub_cat_id']= "false";}
if(isset($_SESSION['area_id'])){$data['area_id']=$_SESSION['area_id'];} else{ $data['area_id']= "false";}
if(isset($_SESSION['sub_area_id'])){$data['sub_area_id']=$_SESSION['sub_area_id'];} else{ $data['sub_area_id']= "false";}
if(isset($_SESSION['search'])){$data['search']=$_SESSION['search'];} else{ $data['search']= "false";}
echo json_encode($data);
?>