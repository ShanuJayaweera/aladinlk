<?php
require_once "../../repository/aladinlk-function.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Set Date
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

try{
    $errors=array();
    if(isset($_POST['three_wheel'])){

        //text box validation
        $text_box=array('title','mileage','description','brand');
        $errors=array_merge($errors,check_req_fields($text_box));


        //length validation
        $max_len_fields=array('title'=>100,'model_year'=>4,'mileage'=>12,'description'=>5000,'price'=>12,'brand'=>50);
        $errors=array_merge($errors, max_len_fields($max_len_fields));

        //price check
        if(!isset($_POST['negotiable'])){
            $errors=array_merge($errors,price('price'));
            $price=$_POST['price'];
        }
        else{
            $price='Negotiable';
        }


        //number only field validation
        $only_number=array('model_year','mileage');
        $errors=array_merge($errors,number($only_number));


        //radio button check
        $radio=array('condition');
        $errors=array_merge($errors,radio_button($radio));


        //user details validation

        //text box validation
        $text_box=array('address','email','telephone');
        $errors=array_merge($errors,check_req_fields($text_box));

        //length validation
        $max_len_fields=array('address'=>200,'email'=>80,'telephone'=>15,'new_tp'=>15);
        $errors=array_merge($errors, max_len_fields($max_len_fields));

        //email format validation
        $errors=array_merge($errors,validate_email('email'));


        //set telephone numbers
        if(!empty(trim($_POST['new_tp']))){
            $telephone=$_POST['telephone']."|".$_POST['new_tp'];
        }
        else{
            $telephone=$_POST['telephone'];
        }

        //check is advertisement id available in database
        $ad_id=mysqli_real_escape_string(DBConnection(),$_POST['ad_id']);

        if(data_availability('three_wheelers','ad_id','ad_id',$ad_id)==false){
           $errors[]="Wrong Ad ID";
        }

        if(empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $brand=mysqli_real_escape_string(DBConnection(),$_POST['brand']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $mileage=mysqli_real_escape_string(DBConnection(),$_POST['mileage']);
            $model_year=mysqli_real_escape_string(DBConnection(),$_POST['model_year']);
            $condition=mysqli_real_escape_string(DBConnection(),$_POST['condition']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);

            //customer details query
            $customer_details="update customer_details set telephone='".$telephone."',email='".$email."',address='".$address."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $customer_details);
            mysqli_close(DBConnection());

            $main_img=main_img($_SESSION['ad_id']);
            $image_path=get_images($_SESSION['ad_id']);


            $three_wheeler="update three_wheelers set title='".$title."',brand='".$brand."',model_year='".$model_year."',vehicle_condition='".$condition."',
            mileage='".$mileage."',description='".$description."',price='".$price."',image_path='".$image_path."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $three_wheeler);
            mysqli_close(DBConnection());

            //update advertisement table modified,title,main img,posted

            $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='".$main_img."',posted=true where id=".$ad_id.";";

            if(mysqli_query(DBConnection(), $advertisement)){
               unset($_SESSION['sub_cat_id']);
               unset($_SESSION['sub_area_id']);

               header("Location:../../service-good-property-posted.php");
               exit();
            }

            else{
                $errors[]=mysqli_error(DBConnection());
                header("Location:../../errors.php");
                exit();
            }
            mysqli_close(DBConnection());


        }

    }

    foreach ($errors as $e){
        echo $e."<br>";

    }

}
catch(Exception $e){
    echo $e."<br>";
}
?>

