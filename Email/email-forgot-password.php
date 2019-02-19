<?php
if (isset($_POST['email'])){
    require_once "../repository/aladinlk-function.php";

   //validate email
    $errors=array();

    if (empty(trim($_POST['email']))){
        $errors[]="Email is empty";
    }
    else{
        //validate email format
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[]="Invalid email address"."<br>";
        }
    }

    if (strlen($_POST['email'])>=80){
        $errors[]="email length";
    }



    if (empty($errors)){

        $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);

        //check email availability
        if (data_availability('email_users','user_id','email',$email)==true) {

            $user_name=get_user_name($email);
            $token=get_user_token($email);

            $base_url="aladinlk.com/repository/forgot-password.php?forgot_password=".$token."&email=".$email."";

            include_once "PHPMailer/PHPMailer.php";

            $mail=new PHPMailer\PHPMailer\PHPMailer();

            $mail->setFrom("noreply@aladinlk.com");
            $mail->addAddress($email);
            $mail->Subject="Forgot Password !";
            $mail->isHTML(true);
            $mail->Body= "<p>Hi ".$user_name.",</p>
                        <p>Thanks for Using Aladinlk.com. Now You Can Change Your Password. </p>
                        <p>Please Open This Link to Change Your Password - <a href='".$base_url."'>Click Here </a> </p>
                        <p>Best Regards,<br> Aladinlk.com - Your Free Classified Web Marketplace.</p>";

            if($mail->send()){

           echo "<div class='alert alert-success' role='alert'>
           <span>
           <strong>Please Check Your Email to Change Your Password !</strong>
           </span>
           </div>";

            }

            else{
                $errors[]="Sorry ! Change password Failed ";
                header('Location:../errors.php');
                exit();
            }
        }
        else{
            echo "Sorry ! Email Does not Exist. Please <a href='../aladinlk-user-registration'> Sign in</a> on aladinlk.com. Thank You !";
        }
    }
    else{
        foreach ($errors as  $v){
            echo $v;
        }
    }
}
?>