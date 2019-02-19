<?php
require_once "aladinlk-function.php";

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
    $errors=array();

    $name=mysqli_real_escape_string(DBConnection(),$_POST['name']);
    $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
    $subject=mysqli_real_escape_string(DBConnection(),$_POST['subject']);
    $message=mysqli_real_escape_string(DBConnection(),$_POST['message']);

    //check is all fields are filled
    $text_box=array('name','email','subject','message');
    $errors=array_merge($errors,check_req_fields($text_box));
    //check email validation
    $errors=array_merge($errors,validate_email('email'));
    //check character length
    $max_len_fields=array('name'=>100,'email'=>80,'subject'=>100,'message'=>2000);
    $errors=array_merge($errors, max_len_fields($max_len_fields));

    if(empty($errors)){
        $query="insert into contactus(name,email,subject,message) VALUES ('".$name."','".$email."','".$subject."','".$message."')";
        if(mysqli_query(DBConnection(),$query)){
            echo "<div class='alert alert-info fade in'>
                    <h6>Thanks for contact us</h6>
                  </div>";
        }
        else{
            echo "<div class='alert alert-danger fade in'>
                    <h6>Something went wrong</h6>
                  </div>";
        }
    }
    else{
        echo "<div class='alert alert-danger fade in'>
                    <h6>Something went wrong</h6>
                  </div>";
    }
}
else{
    echo "<div class='alert alert-danger fade in'>
                    <h6>Data not sent</h6>
                  </div>";
}
?>