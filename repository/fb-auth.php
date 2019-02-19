<?php
require_once "aladinlk-function.php";
session_start();
$errors=array();
?>
<?php

require_once "../libraries/Facebook/autoload.php";

$fb = new \Facebook\Facebook([
    'app_id' => '522015151596290',
    'app_secret' => 'ca02ecd8758a06eb0cbbf191222b4ffd',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

$response=$fb->get('me?fields=id,name,gender,birthday,age_range,email',$accessToken);
$userData=$response->getGraphUser();

$_SESSION['email']=$userData['email'];
$_SESSION['Oauth_Id']=$userData['id'];
$_SESSION['user_name']=$userData['name'];
$_SESSION['age_range']=$userData['age_range'];
$_SESSION['auth_Provider']='Facebook';

if(empty($_SESSION['email']) || empty(trim($_SESSION['email']))){
    $_SESSION['email_not_found']=true;
    header("Location:../login.php");
    exit();
}
else{

    try{

        //Check that had user already registered?
        if (data_availability('fb_users','email','email',$_SESSION['email'])==true) {

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
            if (DB_insert("insert into user_register(auth_provider,email) VALUES ('Facebook','{$_SESSION['email']}');")==true){

                //get user id
                $user_id=select_user_id($_SESSION['email'],'Facebook');

                //Set Date
                date_default_timezone_set('Asia/Colombo');
                $date=date('Y-m-d h:i:sa');

                if(DB_insert("insert into fb_users(user_id,auth_id,user_name,email,age_range,created) VALUES 
                    (".$user_id.",'{$_SESSION['Oauth_Id']}','{$_SESSION['user_name']}','{$_SESSION['email']}','{$_SESSION['age_range']}','".$date."');")==true){

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
    catch(Exception $e){
        $errors[]=$e;
    }

}
?>