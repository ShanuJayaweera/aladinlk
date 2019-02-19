<?php
session_start();
include_once "../repository/aladinlk-function.php";

$row_per_page=20;

if (isset($_SESSION['p'])){
    $page_no=$_SESSION['p'];
}
else{
    $page_no=1;
}

$start=($page_no-1)*$row_per_page;


//search check
if(isset($_SESSION['search'])){
    if (empty(trim($_SESSION['search']))){
        unset($_SESSION['search']);
    }
}


if((isset($_SESSION['cat_id']) || isset($_SESSION['sub_cat_id']))){

    if((!isset($_SESSION['area_id']) || !isset($_SESSION['sub_area_id']))){

        $data=array();

        $total_row="select count(title) as count from all_ads WHERE main_cat_id='".$_SESSION['cat_id']."' or sub_cat_id='".$_SESSION['sub_cat_id']."';";
        $filter="select * from all_ads WHERE main_cat_id='".$_SESSION['cat_id']."' or sub_cat_id='".$_SESSION['sub_cat_id']."' ORDER BY modified DESC limit {$start},{$row_per_page};";
        $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

        echo json_encode($data);

    }

    elseif ((isset($_SESSION['area_id']) || isset($_SESSION['sub_area_id']))){

        $data=array();

        $total_row="select count(title) as count from all_ads WHERE (main_cat_id='".$_SESSION['cat_id']."' or sub_cat_id='".$_SESSION['sub_cat_id']."') and (main_area_id='".$_SESSION['area_id']."' or sub_area_id='".$_SESSION['sub_area_id']."');";
        $filter="select * from all_ads WHERE main_cat_id='".$_SESSION['cat_id']."' or sub_cat_id='".$_SESSION['sub_cat_id']."' ORDER BY modified DESC limit {$start},{$row_per_page};";
        $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

        echo json_encode($data);
    }
}

?>