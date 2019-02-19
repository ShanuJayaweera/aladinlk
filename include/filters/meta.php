<?php
session_start();
include_once "../../repository/aladinlk-function.php";
$meta_data=array();

if(isset($_SESSION['sub_cat_id'])){
    $sql="select sub_cat_name from sub_category where id=".$_SESSION['sub_cat_id'].";";
    $result=mysqli_query(DBConnection(),$sql);
    if ($row=mysqli_fetch_assoc($result)){
        $meta_data['category']="<i class='glyphicon	glyphicon glyphicon-tag'></i> ".$row['sub_cat_name'];
    }
    mysqli_close(DBConnection());
}
elseif (isset($_SESSION['cat_id'])){
    $sql="select category_name from category where id=".$_SESSION['cat_id'].";";
    $result=mysqli_query(DBConnection(),$sql);
    if ($row=mysqli_fetch_assoc($result)){
        $meta_data['category']="<i class='glyphicon glyphicon glyphicon-tag'></i> ".$row['category_name'];

    }
    mysqli_close(DBConnection());
}
else{

    $meta_data['category']="<i class='glyphicon glyphicon glyphicon-tag'></i> All Categories";
}

if(isset($_SESSION['sub_area_id'])){
    $sql="select sub_area_name from sub_area where id=".$_SESSION['sub_area_id'].";";
    $result=mysqli_query(DBConnection(),$sql);
    if ($row=mysqli_fetch_assoc($result)){
        $meta_data['area']= "<i class='glyphicon glyphicon-map-marker'></i> ".$row['sub_area_name'];
    }
    mysqli_close(DBConnection());
}
elseif (isset($_SESSION['area_id'])){
    $sql="select area_name from area where id=".$_SESSION['area_id'].";";
    $result=mysqli_query(DBConnection(),$sql);
    if ($row=mysqli_fetch_assoc($result)){
        $meta_data['area']=  "<i class='glyphicon glyphicon-map-marker'></i> ".$row['area_name'];
    }
    mysqli_close(DBConnection());
}
else{
    $meta_data['area']= "<i class='glyphicon glyphicon-map-marker'></i> All of Srilanka";
}


//search check
if(isset($_SESSION['search'])){
    if (empty(trim($_SESSION['search']))){
        $meta_data['search']="";
    }
    else{
        $meta_data['search']=$_SESSION['search'];
    }
}
else{
    $meta_data['search']="";
}

echo json_encode($meta_data);
?>