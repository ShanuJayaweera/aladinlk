<?php
session_start();
?>
<?php
if (isset($_POST['404_search'])){
    if(isset($_POST['404_input'])){
        if(empty(trim($_POST['404_input']))){
            unset($_POST['404_input']);
            unset($_SESSION['search']);
            header("location:/aladinlk-all-ad-list-view");
            exit();
        }
        else{
            $_SESSION['search']= $_POST['404_input'];
            header("location:/aladinlk-all-ad-list-view");
            exit();
        }
    }
}
?>