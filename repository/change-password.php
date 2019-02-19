<?php
session_start();
if(isset($_SESSION['forgot-password']) && isset($_SESSION['forgot-token']) && isset($_SESSION['forgot-email'])){
    if ($_SESSION['forgot-password']==true && isset($_POST['forgot-password'])){

        require_once "aladinlk-function.php";

        $errors=array();

    //validate forgot password

        if(empty(trim($_POST['forgot-password']))){
            $errors[]="Password not Filled";
        }
        if (strlen($_POST['forgot-password'])>100 ){
            $errors[]="character length";
        }
        $hashed_password=md5(mysqli_real_escape_string(DBConnection(),$_POST['forgot-password']));

        if (empty($errors)){
            $update_password="update email_users set User_Password='".$hashed_password."' where email='".$_SESSION['forgot-email']."' and token='".$_SESSION['forgot-token']."';";

            if (mysqli_query(DBConnection(),$update_password)){
                //remove all sessions
                unset($_SESSION['forgot-password']);
                unset($_SESSION['forgot-token']);
                unset($_SESSION['forgot-email']);
                $_SESSION['forgot-password-msg']=true;
                header('location:../login.php');
                exit();
            }
            else{
                echo "data upate error";
            }
        }
        else{
            foreach ($errors as $va){
                echo $va;
            }
        }
    }
    else{
        echo "fuck";
    }
}
else{

}
?>