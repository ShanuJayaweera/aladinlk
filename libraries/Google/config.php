<?php

 require_once "googleAPI/vendor/autoload.php";
 $gClient = new Google_Client();
 $gClient ->setClientId("802346213161-dn3c78kg0oafqot6u83qm7k9d21as3ha.apps.googleusercontent.com");
 $gClient ->setClientSecret("tYU8aBPeIkxP6Xq_NNvRkARv");
 $gClient ->setApplicationName("Aladinlk.com Google Authentication");
 $gClient ->setRedirectUri("http://localhost:8080/aladinlk-complete/libraries/Google/g-callback.php");
 $gClient ->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

?>