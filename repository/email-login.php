<?php
require_once "aladinlk-function.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try{
    $errors=array();
    //Check that is set Email
    if(isset($_POST['login'])){

        $required_fields=array('email','password');
        $max_len_fields=array('email'=>80,'password'=>100);
        $errors=array_merge($errors,check_req_fields($required_fields));
        $errors=array_merge($errors,max_len_fields($max_len_fields));


        //Validate Email Address
        $errors=array_merge($errors,validate_email('email'));

        //Check Availability
        if (empty($errors)) {

            //Check real_escape_string
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);

            //Encrypted Password
            $hashed_password=md5(mysqli_real_escape_string(DBConnection(),$_POST['password']));

            //Check User Already Exist
            if (data_availability('email_users','user_id','email',$email)==true) {

                //Get User Data from Database
                $query="select * from email_users where Email='{$email}' and verified=1;";
                //run select query
                $result_set=mysqli_query(DBConnection(),$query);

                if (mysqli_num_rows($result_set)>0) {
                    if ($row = mysqli_fetch_assoc($result_set)) {

                    if ($row['email'] == $email && $row['User_Password'] == $hashed_password) {

                        $_SESSION['email'] = $row['email'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['auth_Provider'] = 'Email';

                        unset($_SESSION['Exist_User']);

                        //Set Login Status
                        $_SESSION['Login_Status'] = true;



                        //Redirect Dashboard
                        header('Location:../Dashboard.php');
                        exit();

                    }
                    else {
                        $_SESSION['Exist_User']=false;
                        $_SESSION['Login_Status']=false;
                        header('Location:../login.php');
                        exit();
                    }
                }
                }
                else{
                    $_SESSION['email-verified']=false;
                    $_SESSION['Exist_User']=false;
                    $_SESSION['Login_Status']=false;
                    header('Location:../login.php');
                    exit();
                }

            }
            else{
                //check is he admin
                if (data_availability('admin_auth','id','email',$email)==true) {

                    //check email and password combination is correct
                    $query="select email,user_password from admin_auth where email='{$email}';";
                    $result_set=mysqli_query(DBConnection(),$query);

                    if (mysqli_num_rows($result_set)>0) {
                        if ($row = mysqli_fetch_assoc($result_set)) {
                            if ($row['email'] == $email && $row['user_password'] == $hashed_password) {

                                $_SESSION['73600161admin']=true; //this is admin session
                                header('Location:../admin/dashboard.php');
                                exit();

                            }
                            else{
                                $_SESSION['73600161admin']=false; //admin session in 73600161
                                header('Location:../login.php');
                                exit();

                            }
                        }
                    }
                }
                else{
                    $_SESSION['Login_Status'] = false;
                    $_SESSION['Exist_User']=false;
                    header('Location:../login.php');
                    exit();
                }

            }

        }
        else{
            $_SESSION['Exist_User']=false;
            $_SESSION['Login_Status']=false;
            header('Location:../login.php');
            exit();
        }
    }
    else{
        header('Location:../error.php');
        exit();
    }
}
catch (Exception $e){

}
?>