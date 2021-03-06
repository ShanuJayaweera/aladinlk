<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
try{

    $errors=array();
    if(isset($_POST['default_type_brand'])){

        require_once "../../repository/aladinlk-function.php";

        //Set Date
        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d H:i:s");

        //text box validation
        $text_box=array('title','description','brand','model');
        $errors=array_merge($errors,check_req_fields($text_box));

        //length validation
        $max_len_fields=array('title'=>100,'description'=>5000,'brand'=>50,'model'=>80);
        $errors=array_merge($errors, max_len_fields($max_len_fields));


        //price check
        if(!isset($_POST['negotiable'])){
            $errors=array_merge($errors,price('price'));
            $price=$_POST['price'];
        }
        else{
            $price='Negotiable';
        }


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

        //validation is finished

        //check is advertisement id available in database
        $ad_id=mysqli_real_escape_string(DBConnection(),$_POST['ad_id']);

        if(data_availability('default_type_brand','ad_id','ad_id',$ad_id)==false){
            $errors[]="Wrong Ad ID";
        }

        if(empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $brand=mysqli_real_escape_string(DBConnection(),$_POST['brand']);
            $model=mysqli_real_escape_string(DBConnection(),$_POST['model']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $condition=mysqli_real_escape_string(DBConnection(),$_POST['condition']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);
            $item_type=mysqli_real_escape_string(DBConnection(),$_POST['item_type']);


            //customer details query
            $customer_details="update customer_details set telephone='".$telephone."',email='".$email."',address='".$address."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $customer_details);
            mysqli_close(DBConnection());

            $main_img=main_img($_SESSION['ad_id']);
            $image_path=get_images($_SESSION['ad_id']);

            $default_type_brand="update default_type_brand set item_condition='".$condition."',type_name='".$item_type."',title='".$title."',brand='".$brand."',
            description='".$description."',price='".$price."',image_path='".$image_path."' where ad_id=".$ad_id.";";


            mysqli_query(DBConnection(), $default_type_brand);
            mysqli_close(DBConnection());

            //update advertisement table modified,title,main img,posted

            $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='".$main_img."',posted=true,verified=false where id=".$ad_id.";";

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

        else{

        }
        foreach ($errors as $e){
            echo $e."<br>";
        }

    }
    else{

    }

}
catch(Exception $e){
echo $e;
}
?>