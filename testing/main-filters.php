<!DOCTYPE html>
<html>
<body>

<h2>Aladin Filters</h2>

<form action="main-filters.php" method="post">
    Main Category<br>
    <input type="text" name="main_cat">
    <br>
    Sub Category<br>
    <input type="text" name="sub_cat">
    <br><br>
    Main Area<br>
    <input type="text" name="main_area">
    <br>
    Sub Area<br>
    <input type="text" name="sub_area">
    <input type="submit" value="Submit">
</form>


</body>
</html>

<?php
session_start();
include_once "../repository/aladinlk-function.php";

//set empty parameters to unset
if(empty($_POST['main_cat'])){
    unset($_POST['main_cat']);
}
if (empty($_POST['sub_cat'])){
    unset($_POST['sub_cat']);

}
if (empty($_POST['main_area'])){
    unset($_POST['main_area']);
}
if (empty($_POST['sub_area'])){
    unset($_POST['sub_area']);
}

if(isset($_POST['main_cat']) || isset($_POST['sub_cat'])){

    if ((!isset($_POST['main_area']) && !isset($_POST['sub_area']))){

        $data=array();

        $total_row="select count(title) as count from all_ads WHERE main_cat_id='".$_POST['main_cat']."' or sub_cat_id='".$_POST['sub_cat']."';";
        $filter="select * from all_ads WHERE main_cat_id='".$_POST['main_cat']."' or sub_cat_id='".$_POST['sub_cat']."' ORDER BY modified DESC;";
        $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

        echo json_encode($data);
    }
    elseif (isset($_POST['main_area']) || isset($_POST['sub_area'])){
        $data=array();

        $total_row="select count(title) as count from all_ads WHERE (main_cat_id='".$_POST['main_cat']."' or sub_cat_id='".$_POST['sub_cat']."') and
        (main_area_id='".$_POST['main_area']."' or sub_area_id='".$_POST['sub_area']."');";
        $filter="select * from all_ads WHERE (main_cat_id='".$_POST['main_cat']."' or sub_cat_id='".$_POST['sub_cat']."') and
        (main_area_id='".$_POST['main_area']."' or sub_area_id='".$_POST['sub_area']."') ORDER BY modified DESC;";
        $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

        echo json_encode($data);
    }
}

elseif(isset($_POST['main_area']) || isset($_POST['sub_area'])){

    if (!isset($_POST['main_cat']) && !isset($_POST['sub_cat'])){
        $data=array();

        $total_row="select count(title) as count from all_ads WHERE main_area_id='".$_POST['main_area']."' or sub_area_id='".$_POST['sub_area']."';";
        $filter="select * from all_ads WHERE main_area_id='".$_POST['main_area']."' or sub_area_id='".$_POST['sub_area']."' ORDER BY modified DESC;";
        $data=array_merge($data,ad_filters($row_per_page,$page_no,$filter,$total_row));

        echo json_encode($data);
    }

}

?>