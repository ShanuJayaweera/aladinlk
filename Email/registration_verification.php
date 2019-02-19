<?php
session_start();

use PHPMailer;

if(isset($_SESSION['Register_pending'])){

    if($_SESSION['Register_pending']==true){

        $errors=array();

        include_once "PHPMailer/PHPMailer.php";

        $mail=new PHPMailer\PHPMailer\PHPMailer();

        $mail->setFrom("noreply@aladinlk.com");
        $mail->addAddress($_SESSION['reg_email']);
        $mail->Subject="Please Verify Your Email Account (Do not Reply)!";
        $mail->isHTML(true);
        $mail->Body= $_SESSION['email_body'];

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
    }
    else{
        $errors[]="Sorry ! Registration Failed ";
        header('Location:../errors.php');
        exit();
    }
}
else{
    $errors[]="Sorry ! Registration Failed ";
    header('Location:../errors.php');
    exit();
}

?>