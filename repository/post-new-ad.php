<?php
require_once 'aladinlk-function.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['ad-type'])){
    $ad_type=mysqli_real_escape_string(DBConnection(),$_GET['ad-type']);

    if ($ad_type==458){
        unset($_SESSION['sub_cat_id']);
        unset($_SESSION['sub_area_id']);
        unset($_SESSION['cat_id']);
        $_SESSION['ad_id']= create_new_ad($ad_type);
        $_SESSION['ad_type']="Sell an Item or Service";

        if (!file_exists('../advertisement_images/'.$_SESSION['ad_id'])) {
            mkdir('../advertisement_images/'.$_SESSION['ad_id'], 0777, true);
            mkdir('../advertisement_images/'.$_SESSION['ad_id'].'/tumb', 0777, true);
        }
        header('Location:../post-your-ad.php');
        exit();
    }

    elseif ($ad_type==125){
        unset($_SESSION['sub_cat_id']);
        unset($_SESSION['sub_area_id']);
        unset($_SESSION['cat_id']);
        $_SESSION['ad_id']= create_new_ad($ad_type);
        $_SESSION['ad_type']="Offer a Property for Rent";
        if (!file_exists('../advertisement_images/'.$_SESSION['ad_id'])) {
            mkdir('../advertisement_images/'.$_SESSION['ad_id'], 0777, true);
            mkdir('../advertisement_images/'.$_SESSION['ad_id'].'/tumb', 0777, true);
        }
        header('Location:../look-offer-property-rent.php');
        exit();


    }
    elseif ($ad_type==995){
        unset($_SESSION['sub_cat_id']);
        unset($_SESSION['sub_area_id']);
        unset($_SESSION['cat_id']);
        $_SESSION['ad_id']=  create_new_ad($ad_type);
        $_SESSION['ad_type']="Look for Something to Buy";
        if (!file_exists('../advertisement_images/'.$_SESSION['ad_id'])) {
            mkdir('../advertisement_images/'.$_SESSION['ad_id'], 0777, true);
            mkdir('../advertisement_images/'.$_SESSION['ad_id'].'/tumb', 0777, true);
        }
        header('Location:../post-your-ad.php');
        exit();

    }
    elseif ($ad_type==789){
        unset($_SESSION['sub_cat_id']);
        unset($_SESSION['sub_area_id']);
        unset($_SESSION['cat_id']);
        $_SESSION['ad_id']= create_new_ad($ad_type);
        $_SESSION['ad_type']="Look for Property to Rent";
        if (!file_exists('../advertisement_images/'.$_SESSION['ad_id'])) {
            mkdir('../advertisement_images/'.$_SESSION['ad_id'], 0777, true);
            mkdir('../advertisement_images/'.$_SESSION['ad_id'].'/tumb', 0777, true);
        }
        header('Location:../look-offer-property-rent.php');
        exit();
    }
    else{
        header('Location:../404.php');
        exit();
    }

}
else{
    header('Location:../404.php');
    exit();
}




?>