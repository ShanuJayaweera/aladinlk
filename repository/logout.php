<?php
session_start();
if (isset($_SESSION['Login_Status'])){
    unset($_SESSION['Login_Status']);
    session_destroy();
    header('Location:../index.php');
    exit();
}
else{
    session_destroy();
    header('Location:../all-ads.php');
    exit();
}
?>