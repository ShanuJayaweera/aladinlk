<?php
require_once "aladinlk-function.php";
session_start();
?>
<?php
if (isset($_POST['register'])){
    if (isset($_POST['name'])) {
        $errors=array();
        try{
            $required_fields=array('name','email','password');
            $max_len_fields=array('name'=>100,'email'=>80,'password'=>100);
            //check that is all fields filled
            $errors=array_merge($errors,check_req_fields($required_fields));
            //check is all field in correct character length
            $errors=array_merge($errors,max_len_fields($max_len_fields));
            //validate email address
            $errors=array_merge($errors,validate_email('email'));
            //check is values in correct character format
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $name=mysqli_real_escape_string(DBConnection(),$_POST['name']);
            $hashed_password=md5(mysqli_real_escape_string(DBConnection(),$_POST['password']));
            //check already user has registered
            if (empty($errors)){
                if(data_availability('email_users','email','email',$email)==true){
                    $_SESSION['Exist_User']=true;
                    header('location:../aladinlk-register.php');
                    exit();
                }
                else{
                    //Set Token
                    $token="qwertyuiopasdfghjklzxcvbnm0987654321QWERTYUIOPLKJHGFDSAZXCVBNM";
                    $token=str_shuffle($token);
                    $token=substr($token,0,50);
                    //Set Dat
                    date_default_timezone_set('Asia/Colombo');
                    $date=date('Y-m-d h:i:sa');
                    //insert data to user registration table
                    if (DB_insert("insert into user_register(auth_provider,email) VALUES ('Email','{$email}');")==true){
                        $user_id=select_user_id($email,'Email');
                        if(DB_insert("INSERT INTO email_users(user_id,user_name,email,User_Password,Verified,Token,Created) VALUES (".$user_id.",'".$name."','".$email."','".$hashed_password."',0,'".$token."','".$date."');")==true){
                            if (isset($_SESSION['Exist_User'])){
                                unset($_SESSION['Exist_User']);
                            }
                            $_SESSION['reg_name']=$name;
                            $_SESSION['reg_email']=$email;
                            //verify user has been registered
                            $_SESSION['Register_pending']=true;
                            $base_url='aladinlk.com/repository/email-address-verification.php';
                            $_SESSION['email_body'] ="<p>Hi ".$name.",</p>
                        <p>Thanks for Registration. Your Password is '".$_POST['password']."',This Password will Work Only After Your Email Verification. </p>
                        <p>Please Open This Link to Verified Your Email Address- <a href='".$base_url."?activation_code=".$token."&email=".$email."'>Activation Code </a> </p>
                        <p>Best Regards,<br> Aladinlk.com - Your Free Classified Web Marketplace.</p>";
                            header('Location:../aladin-xx/registration_verification.php');
                            exit();
                        }
                        else{
                            $errors[]="Sorry Cant Add User !";
                            //Redirect Errors Page
                            header('Location:../errors.php');
                            exit();
                        }
                    }
                    else{
                        $errors[]="Sorry Cant Add User !";
                        //Redirect Errors Page
                        header('Location:../errors.php');
                        exit();
                    }
                }
            }
            else{
                header('Location:../errors.php');
                exit();
            }
        }
        catch (Exception $e){
        }
    }
    else{
    }
}
else{
}

?>