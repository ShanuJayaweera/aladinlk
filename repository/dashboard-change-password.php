<?php
if (isset($_POST['old_pass']) && isset($_POST['new_pass'])){

    session_start();
    require_once "aladinlk-function.php";
    $errors=array();
    $new_pass=mysqli_real_escape_string(DBConnection(),$_POST['new_pass']);
    $old_pass=mysqli_real_escape_string(DBConnection(),$_POST['old_pass']);
    $new_pass=md5($new_pass);
    $old_pass=md5($old_pass);

    if(empty(trim($new_pass)) || empty(trim($old_pass))){
        $errors[]="Fields are not filled";
    }
    if (strlen($new_pass)>100 || strlen($old_pass)>100){
        $errors[]="character length";
    }

    if (empty($errors)){

        //Get User Data from Database
        $query="select * from email_users where Email='".$_SESSION['email']."' and verified=1;";
        $result_set=mysqli_query(DBConnection(),$query);

        if (mysqli_num_rows($result_set)>0) {
            if ($row = mysqli_fetch_assoc($result_set)) {

                if ($row['email'] == $_SESSION['email'] && $row['User_Password'] == $old_pass ) {
                //change password
                    $update_password="update email_users set User_Password='".$new_pass."' where email='".$_SESSION['email']."';";

                    if (mysqli_query(DBConnection(),$update_password)){
                        echo "<div role=\"alert\" class=\"alert alert-info\"><span>Your Password is Updated Successfully !</span></div>";
                    }
                    else{
                        echo "<div role=\"alert\" class=\"alert alert-info\"><span>Sorry !. Data Update Error.</span></div>";
                    }

                }
                else {
                echo "<div role=\"alert\" class=\"alert alert-info\"><span>Sorry ! Old Password is Incorrect.</span></div>";
                }
            }
        }
    }
    else{
        foreach ($errors as $v){
            echo $v;
        }
    }
}
?>