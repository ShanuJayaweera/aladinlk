<?php
include_once "PHPMailer/PHPMailer.php";

$mail=new PHPMailer\PHPMailer\PHPMailer();
$htmlContent = file_get_contents("ad_posted_template.php");
$mail->setFrom("noreply@aladinlk.com");
$mail->addAddress("shanaka.chameera@gmail.com");
$mail->Subject="Testing Email for template";
$mail->isHTML(true);
$mail->Body= $htmlContent;

if($mail->send()){
    unset($_SESSION['reg_email']);
    unset($_SESSION['email_body']);
    header('Location:../email-verification-msg.php');
    exit();
}
else{
    $errors[]="Sorry ! Registration Failed ";
    header('Location:../errors.php');
    exit();
}
?>