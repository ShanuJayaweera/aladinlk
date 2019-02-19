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


$query="select id,user_id from email_users where Verified=0;";
$result=mysqli_query(DBConnection(),$query);

if (mysqli_num_rows($result)>0){
   while($row=mysqli_fetch_assoc($result)){
        //delete this recode
        $remove="delete from email_users where id=".$row['id'].";";
        mysqli_query(DBConnection(),$remove);
        //remove email user recode
        $remove="delete from user_register where user_id=".$row['user_id'].";";
        mysqli_query(DBConnection(),$remove);
    }
}
else{
    echo "<div class='alert alert-danger fade in'>
            <h6>No recode to remove. </h6>
          </div>";
}
//redirect admin dashboard
mysqli_close(DBConnection());

?>