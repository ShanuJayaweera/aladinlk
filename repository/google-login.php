<?php
require_once "aladinlk-function.php";

$errors=array();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try{

    if (!isset($_SESSION['access_token'])) {
        header('location:../login.php');
        exit();
    }
    else{

        //Check that had user already registered?
        if (data_availability('google_users','email','email',$_SESSION['email'])==true) {

            //Set Login_status
            $_SESSION['Login_Status']=true;


            //unset All Unnecessary Sessions
            unset($_SESSION['access_token']);

            //Redirect to Action
            header('location:../dashboard.php');
            exit();

        }
        else{

            //insert data to user registration table
            if (DB_insert("insert into user_register(auth_provider,email) VALUES ('Google','{$_SESSION['email']}');")==true){

                //get user id
                $user_id=select_user_id($_SESSION['email'],'Google');

                //Set Date
                date_default_timezone_set('Asia/Colombo');
                $date=date('Y-m-d h:i:sa');

                if(DB_insert("insert into google_users(user_id,auth_id,user_name,email,pictureURL,created) VALUES 
                    (".$user_id.",'{$_SESSION['Oauth_Id']}','{$_SESSION['user_name']}','{$_SESSION['email']}','{$_SESSION['picture']}','".$date."');")==true){

                    //Set Login_status
                    $_SESSION['Login_Status']=true;

                    //unset All Unnecessary Sessions
                    unset($_SESSION['access_token']);

                    //Redirect to Action
                    header('location:../dashboard.php');
                    exit();

                }
                else{

                    //Update Login_Status
                    $_SESSION['Login_Status']=false;
                    header('location:../errors.php');
                    exit();

                }
            }
            else{

                //Update Login_Status
                $_SESSION['Login_Status']=false;
                header('location:../errors.php');
                exit();

            }

        }
    }
}
catch(Exception $e){
    $errors[]=$e;
}


?>