<?php
require_once "config.php";

if(isset($_SESSION['access_token'])){
$gClient ->setAccessToken($_SESSION['access_token']);
}

else if(isset($_GET['code'])){
$token=$gClient->fetchAccessTokenWithAuthCode($_GET['code']);
$_SESSION['access_token']=$token;

}

else{
	header('Location :../../aladinlk-register.php');
	exit();
}


$oAuth=new Google_Service_Oauth2($gClient);
$userData=$oAuth->userinfo_v2_me->get();


//echo "<pre>";
//var_dump($userData);

$_SESSION['email']=$userData['email'];
$_SESSION['Oauth_Id']=$userData['id'];
$_SESSION['user_name']=$userData['name'];
$_SESSION['picture']=$userData['picture'];
$_SESSION['auth_Provider']='Google';

header('Location:../../repository/google-login.php');
exit();
?>