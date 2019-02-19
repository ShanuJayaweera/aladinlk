<?php
session_start();
include_once "../../../repository/aladinlk-function.php";

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

    $main_cat='';
    $sub_cat='';
    $main_area='';
    $sub_area='';
    $ad_type='458';
    $selected='nop';

    if(isset($_POST['ad_type'])){
        $ad_type=$_POST['ad_type'];
    }
    if(isset($_POST['sort_type'])){
        $selected=$_POST['sort_type'];
    }


if(isset($_SESSION['cat_id'])){
        $main_cat=$_SESSION['cat_id'];
    }
    if(isset($_SESSION['sub_cat_id'])){
        $sub_cat=$_SESSION['sub_cat_id'];
    }
    if(isset($_SESSION['area_id'])){
        $main_area=$_SESSION['area_id'];
    }
    if(isset($_SESSION['sub_area_id'])){
        $sub_area=$_SESSION['sub_area_id'];
    }



    if($selected=='nop'){
        if($main_area=='' && $sub_area=='' && $main_cat=='' && $sub_cat==''){
            if(!isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads";
                $filter="SELECT * from all_ads ORDER BY modified DESC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
            elseif(isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' ;";
                $filter="SELECT * from all_ads ORDER BY modified DESC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
        }
        else{
            if(!isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."';";
                $filter="SELECT * from all_ads WHERE ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."' ORDER BY modified DESC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
            elseif(isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."';";
                $filter="SELECT * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."' ORDER BY modified DESC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
        }

    }
    else{
        if($main_area=='' && $sub_area=='' && $main_cat=='' && $sub_cat==''){
            if(!isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads";
                $filter="SELECT * from all_ads ORDER BY modified ASC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
            elseif(isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' ;";
                $filter="SELECT * from all_ads ORDER BY modified ASC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
        }
        else{
            if(!isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."';";
                $filter="SELECT * from all_ads WHERE ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."' ORDER BY modified ASC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
            elseif(isset($_SESSION['search'])){
                //get all data from database all_ads view
                $data=array();
                //total row query
                $total_row="select count(title) as count from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."';";
                $filter="SELECT * from all_ads WHERE title LIKE '%".$_SESSION['search']."%' and ((main_cat_id='".$main_cat."' or sub_cat_id='".$sub_cat."') or (main_area_id='".$main_area."' or sub_area_id = '".$sub_area."')) and ad_type='".$ad_type."' ORDER BY modified ASC limit {$start},{$row_per_page}";
                $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

                echo json_encode($data);
            }
        }


    }


?>