<?php
require_once "../../repository/aladinlk-function.php";

//Set Date
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//check that is advertisement has posted

try{
    $errors=array();

    if (isset($_POST['car'])){

        //text box validation
        $text_box=array('title','model','edition','mileage','cc','description','brand');
        $errors=array_merge($errors,check_req_fields($text_box));


        //length validation
        $max_len_fields=array('title'=>100,'edition'=>40,'model_year'=>4,'mileage'=>12,
            'body_type'=>30,'transmission'=>25,'cc'=>12,'description'=>5000,'brand'=>50,'model'=>80);
        $errors=array_merge($errors, max_len_fields($max_len_fields));



        //radio button check
        $radio=array('condition','fuel_type');
        $errors=array_merge($errors,radio_button($radio));

        //price check
        if(!isset($_POST['negotiable'])){
            $errors=array_merge($errors,price('price'));
            $price=$_POST['price'];
        }
        else{
            $price='Negotiable';
        }


        //number only field validation
        $only_number=array('model_year','mileage','cc');
        $errors=array_merge($errors,number($only_number));


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

        //validation is finished

        //check is advertisement id available in database
        $ad_id=mysqli_real_escape_string(DBConnection(),$_POST['ad_id']);

        if(data_availability('cars','ad_id','ad_id',$ad_id)==false){
            $errors[]="Wrong Ad ID";
        }


        if (empty($errors)) {

            //mysql parse
            $title = mysqli_real_escape_string(DBConnection(), $_POST['title']);
            $brand = mysqli_real_escape_string(DBConnection(), $_POST['brand']);
            $model = mysqli_real_escape_string(DBConnection(), $_POST['model']);
            $edition = mysqli_real_escape_string(DBConnection(), $_POST['edition']);
            $description = mysqli_real_escape_string(DBConnection(), $_POST['description']);
            $mileage = mysqli_real_escape_string(DBConnection(), $_POST['mileage']);
            $model_year = mysqli_real_escape_string(DBConnection(), $_POST['model_year']);
            $condition = mysqli_real_escape_string(DBConnection(), $_POST['condition']);
            $body_type = mysqli_real_escape_string(DBConnection(), $_POST['body_type']);
            $transmission = mysqli_real_escape_string(DBConnection(), $_POST['transmission']);
            $fuel_type = mysqli_real_escape_string(DBConnection(), $_POST['fuel_type']);
            $price = mysqli_real_escape_string(DBConnection(), $price);
            $cc = mysqli_real_escape_string(DBConnection(), $_POST['cc']);
            $email = mysqli_real_escape_string(DBConnection(), $_POST['email']);
            $address = mysqli_real_escape_string(DBConnection(), $_POST['address']);
            $telephone = mysqli_real_escape_string(DBConnection(), $telephone);

            //customer details query
            $customer_details="update customer_details set telephone='".$telephone."',email='".$email."',address='".$address."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $customer_details);
            mysqli_close(DBConnection());

            $main_img=main_img($_SESSION['ad_id']);
            $image_path=get_images($_SESSION['ad_id']);

            $cars = "update cars set brand='".$brand."',model='".$model."',edition='".$edition."',Model_year='".$model_year."',
            vehicle_condition='".$condition."',mileage='".$mileage."',body_type='".$body_type."',
                    transmission='".$transmission."',fuel_type='".$fuel_type."',engine_capacity='".$cc."',description='".$description."',
                    price='".$price."',image_path='".$image_path."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $cars);
            mysqli_close(DBConnection());

            //update advertisement table modified,title,main img,posted

            $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='".$main_img."',posted=true, verified=false where id=".$ad_id.";";

            if(mysqli_query(DBConnection(), $advertisement)){
                unset($_SESSION['sub_cat_id']);
                unset($_SESSION['sub_area_id']);
                header("Location:../../service-good-property-posted.php");
                exit();
            }


            else {
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
catch (Exception $e){
    echo $e;
}


?>