<?php
session_start();
if(isset($_GET['activation_code']) && isset($_GET['email'])){

    require_once "aladinlk-function.php";

    $errors=array();

    //validate is activation code and email
    $activation_code=mysqli_real_escape_string(DBConnection(),$_GET['activation_code']);
    $email=mysqli_real_escape_string(DBConnection(),$_GET['email']);

    if(empty(trim($activation_code)) || empty(trim($email))){
        $errors[]="Fields are not filled";
    }
    if (strlen($activation_code)>50 || strlen($email)>80){
        $errors[]="character length";
    }

    //data availability
    if(empty($errors)){

        $q="select token,email from email_users WHERE token='".$activation_code."' and email='".$email."';";
        $result=mysqli_query(DBConnection(),$q);

        if(mysqli_num_rows($result)>0){

            //update verified
            $q="update email_users set verified=1 WHERE token='".$activation_code."' and email='".$email."';";
            $result=mysqli_query(DBConnection(),$q);

            $_SESSION['email-verified']=true;
            mysqli_close(DBConnection());
            header('location:../login.php');
            exit();

        }
        else{
            header('location:../email-expired-msg.php');
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