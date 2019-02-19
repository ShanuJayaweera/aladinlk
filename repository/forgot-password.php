<?php
if(isset($_GET['forgot_password']) && isset($_GET['email'])){
    //validate email and token
session_start();
    require_once "aladinlk-function.php";

    $errors=array();

    $forgot_password=mysqli_real_escape_string(DBConnection(),$_GET['forgot_password']);
    $email=mysqli_real_escape_string(DBConnection(),$_GET['email']);

    if(empty(trim($forgot_password)) || empty(trim($email))){
        $errors[]="Fields are not filled";
    }
    if (strlen($forgot_password)>100 || strlen($email)>80){
        $errors[]="character length";
    }

    //data availability
    if(empty($errors)){

        $q="select token,email from email_users WHERE token='".$forgot_password."' and email='".$email."';";
        $result=mysqli_query(DBConnection(),$q);

        if(mysqli_num_rows($result)>0){

            $_SESSION['forgot-password']=true;
            $_SESSION['forgot-token']=$forgot_password;
            $_SESSION['forgot-email']=$email;
            mysqli_close(DBConnection());
            header('location:../change-forgot-password.php');
            exit();

        }
        else{
            header('location:../404.php');
            exit();
        }
        mysqli_close(DBConnection());
    }
    else{

        header('location:../404.php');
        exit();

    }
}
else{

    header('location:../404.php');
    exit();
}
?>