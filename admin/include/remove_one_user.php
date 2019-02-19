<?php
session_start();
if(isset($_SESSION['73600161admin'])){
    if($_SESSION['73600161admin']==false){
        header("location:../login.php");
        exit();
    }
}
else{
    header("location:../login.php");
    exit();
}
?>

<?php

include "../../repository/aladinlk-function.php";

//get id from url
if(isset($_GET['id'])){
    $id=mysqli_real_escape_string(DBConnection(),$_GET['id']);

    //check is user available
    if(data_availability('email_users','Id','Id',$id)){

        //check the user account has been verified.
        $query="select user_id,Verified from email_users where id=".$id.";";
        $res=mysqli_query(DBConnection(),$query);
        if($row=mysqli_fetch_assoc($res)){
            if ($row['Verified']==0){

                //delete this recode
                $remove="delete from email_users where id=".$id.";";
                if( mysqli_query(DBConnection(),$remove)){

                    //remove email user recode
                    $remove="delete from user_register where user_id=".$row['user_id'].";";
                    if( mysqli_query(DBConnection(),$remove)){

                        echo "<div class='alert alert-info fade in'>
                                <h6>User Account Delete Successfully.</h6>
                            </div>";
                    }


                }
                else{
                    echo "<div class='alert alert-danger fade in'>
                        <h6>User Account Cant Remove.</h6>
                    </div>";
                }


            }
            elseif($row['Verified']==1){

                echo "<div class='alert alert-danger fade in'>
                        <h6>User account has been verified.</h6>
                    </div>";
            }
        }

    }
    else{
        echo "<div class='alert alert-danger fade in'>
                <h6>Data not found.</h6>
              </div>";
    }
}
else{
    header("location:../../404.php");
    exit();
}
?>
