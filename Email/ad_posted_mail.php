<?php
session_start();

if(isset($_SESSION['user_name']) || isset($_SESSION['post_email'])){

    $errors=array();

    include_once "PHPMailer/PHPMailer.php";

    $mail=new PHPMailer\PHPMailer\PHPMailer();
    $htmlContent = file_get_contents("ad_posted_template.php");
    $mail->setFrom("noreply@aladinlk.com");
    $mail->addAddress($_SESSION['post_email']);
    $mail->Subject="Your advertisement has been posted !";
    $mail->isHTML(true);
    $mail->Body= $htmlContent;

    if($mail->send()){
        unset($_SESSION['post_email']);
        header("Location:../service-good-property-posted.php");
        exit();
    }
    else{
        $errors[]="Sorry ! Registration Failed ";
        header("Location:../ad_posting_err.php");
        exit();

    }

}
else{
    header("Location:../ad_posting_err.php");
    exit();
}
?>