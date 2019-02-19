<?php
require_once "aladinlk-function.php";



function email_auth($email,$password){

    $errors=array();

    //check required fields
    $required_fields=array($email,$password);
    $errors=array_merge($errors,req_fields($required_fields));

    //check field length
    $max_len_fields=array($email=>80,$password=>100);
    $errors=array_merge($errors,field_length($max_len_fields));

    //validate email
    $errors=array_merge($errors,validation_email($email));



    if(empty($errors)){

        //check data availability
        if (data_availability('email_users','user_id','email',$email)==true) {

            //check email and password combination is correct
            $query="select email,User_Password from email_users where email='{$email}' and verified=1;";
            $result_set=mysqli_query(DBConnection(),$query);

            if (mysqli_num_rows($result_set)>0) {
                if ($row = mysqli_fetch_assoc($result_set)) {
                    if ($row['email'] == $email && $row['User_Password'] == $password) {

                        $_SESSION['email'] = $row['email'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['auth_Provider'] = 'Email';

                        unset($_SESSION['Exist_User']);

                        //Set Login Status
                        $_SESSION['Login_Status'] = true;

                        return true;

                    }
                    else{
                        $_SESSION['Login_Status'] = false;
                        $errors[]= "Incorrect email or password.";
                        return $errors;
                    }
                }
            }
            else{
                $_SESSION['Login_Status'] = false;
                $errors[]= "You have not confirmed your email address.";
                return $errors;
            }
            mysqli_close(DBConnection());
        }
        else{

            if (data_availability('admin_auth','id','email',$email)==true) {

                //check email and password combination is correct
                $query="select email,user_password from admin_auth where email='{$email}';";
                $result_set=mysqli_query(DBConnection(),$query);

                if (mysqli_num_rows($result_set)>0) {
                    if ($row = mysqli_fetch_assoc($result_set)) {
                        if ($row['email'] == $email && $row['user_password'] == $password) {

                            $_SESSION['73600161']=true; //this is admin session

                            //Redirect Dashboard
                            return true;
                        }
                        else{
                            $_SESSION['73600161']=false; //admin session in 73600161
                            $_SESSION['Login_Status'] = false;
                            $errors[]= "Incorrect email.";
                            return $errors;
                        }
                    }
                }
            }
            else{
                $_SESSION['73600161']=false; //admin session in 73600161
                $_SESSION['Login_Status'] = false;
                $errors[]= "Incorrect email.";
                return $errors;
            }

        }
    }
    else{
        return $errors;
    }
}
?>