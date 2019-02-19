<?php
session_start();
require_once "../../repository/aladinlk-function.php";

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

//result without search
if (!isset($_SESSION['search'])){


    $data=array();
    //total row query
    $total_row="select count(title) as count from all_ads where ad_type=".$_POST['ad_type']." and sub_cat_id=".$_SESSION['sub_cat_id'].";";
    $filter="select * from all_ads where ad_type=".$_POST['ad_type']." and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page}";
    $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

    echo json_encode($data);

}
elseif (isset($_SESSION['search'])){

//get all data from database all_ads view
    $data=array();
    //total row query
    $total_row="select count(title) as count from all_ads WHERE ad_type=".$_POST['ad_type']." and title LIKE '%".$_SESSION['search']."%' and sub_cat_id=".$_SESSION['sub_cat_id'].";";
    $filter="select * from all_ads WHERE ad_type=".$_POST['ad_type']." and title LIKE '%".$_SESSION['search']."%' and sub_cat_id=".$_SESSION['sub_cat_id']." ORDER BY modified DESC limit {$start},{$row_per_page};";
    $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

    echo json_encode($data);

}

?>