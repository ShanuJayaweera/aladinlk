<?php
/**
 * Created by PhpStorm.
 * User: Chameera
 * Date: 8/9/2018
 * Time: 9:50 PM
 */
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "aladinlk-function.php";



if (isset($_POST['sub_area_id'])){

    if (data_availability('sub_area','Id','Id',$_POST['sub_area_id'])==true){
        $_SESSION['sub_area_id']=$_POST['sub_area_id'];
        unset($_SESSION['area_id']);
    }
    else{
        unset($_SESSION['area_id']);
        unset($_SESSION['sub_area_id']);
    }

}



if (isset($_POST['sub_category_id'])){

    if (data_availability('sub_category','Id','Id',$_POST['sub_category_id'])==true){
        $_SESSION['sub_cat_id']=$_POST['sub_category_id'];
        unset($_SESSION['cat_id']);
    }
    else{
        unset($_SESSION['cat_id']);
        unset($_SESSION['sub_cat_id']);
    }

}

if(isset($_POST['cat_id'])){
    $_SESSION['cat_id']=$_POST['cat_id'];
    unset($_SESSION['sub_cat_id']);


}

if(isset($_POST['area_id'])){
    $_SESSION['area_id']=$_POST['area_id'];
    unset($_SESSION['sub_area_id']);

}

if(isset($_POST['all_cat'])){
    unset($_SESSION['cat_id']);
    unset($_SESSION['sub_cat_id']);
}

if(isset($_POST['all_area'])){
    unset($_SESSION['area_id']);
    unset($_SESSION['sub_area_id']);

}

if(isset($_POST['search'])){
    if (empty(trim($_POST['search']))){
        unset($_SESSION['search']);
    }
    else{
        $_SESSION['search']=$_POST['search'];
    }
}


?>