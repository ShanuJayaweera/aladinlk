<?php
require_once 'repository/aladinlk-function.php';
//upload image
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<?php
if (!isset($_SESSION['Login_Status'])){
    header('location:login.php');
    exit();

}
else{
    if ($_SESSION['Login_Status']==false){
        header('location:login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aladinlk.com - Update Your Advertisement</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">


</head>

<body>

<?php include "include/nav-bar.php"?>
<br>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 col-md-offset-0">
                <h3 class="text-center head">Welcome <?php echo $_SESSION['user_name']; ?> !</h3>
                <h4 class="text-center headtext">Let's Update Your Advertisement.</h4></div>

        </div>
    </div>



    <div class="col-lg-12">
        <div class="post-ad-content">

            <!--load post ad content-->
            <?php
            $ad_id=mysqli_real_escape_string(DBConnection(),$_GET['ad_id']);
            if (isset($ad_id)){
                if(data_availability('advertisement','id','id',$ad_id)==true){

                    //get user id
                    $user_id=select_user_id($_SESSION['email'],$_SESSION['auth_Provider']);

                    //check that is user id valid
                    $query="select * from advertisement where id=".$ad_id." and user_id=".$user_id.";";
                    $result=mysqli_query(DBConnection(),$query);

                    if (mysqli_num_rows($result)>0) {

                        $_SESSION['ad_id']=$_GET['ad_id'];

                        //get sub cat id
                        $sub_cat_id= select_by_id($ad_id,'sub_cat_id','advertisement');
                        //get main cat id
                        $cat_id= select_by_id($sub_cat_id,'main_cat_id','sub_category');

                        //get main cat name
                        $cat_name=select_by_id($cat_id,'category_name','category');
                        //get details from database
                        $tbl_name=get_table($ad_id);
                        //get images from database


                        include 'include/edit_ad/'.$cat_name.'/'.$tbl_name.'.php';
                        mysqli_close(DBConnection());
                    }

                }
                else{
                    echo("<div class='jumbotron alert-danger'>
        <h4 class='text-center'><strong>Prepare a Great Deals With Aladinlk .&nbsp;</strong> </h4>
        <h5 class='text-center'>Sorry Something Went Wrong..</h5>
        </div>");
                }

            }
            else{
                echo("<div class='jumbotron alert-danger'>
        <h4 class='text-center'><strong>Prepare a Great Deals With Aladinlk .&nbsp;</strong> </h4>
        <h5 class='text-center'>Sorry Something Went Wrong..</h5>
    </div>");
            }
            ?>
        </div>
    </div>
</div>
</body>

</html>