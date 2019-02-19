<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
try{

    $errors=array();
    if(isset($_POST['land'])){

        require_once "../../repository/aladinlk-function.php";

        //Set Date
        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d H:i:s");

        //text box validation
        $text_box=array('title','description','land_size','land_address');
        $errors=array_merge($errors,check_req_fields($text_box));

        //length validation
        $max_len_fields=array('title'=>100,'description'=>5000,'land_size'=>15,'land_address'=>200);
        $errors=array_merge($errors, max_len_fields($max_len_fields));


        //price check
        if(!isset($_POST['negotiable'])){
            $errors=array_merge($errors,price('price'));
            $price=$_POST['price'];
        }
        else{
            $price='Negotiable';
        }


        $land_size=$_POST['land_size']." ".$_POST['unit'];

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

        //number only field validation
        $only_number=array('land_size');
        $errors=array_merge($errors,number($only_number));


        //validation is finished
        //check is advertisement id available in database
        $ad_id=mysqli_real_escape_string(DBConnection(),$_POST['ad_id']);

        if(data_availability('land','ad_id','ad_id',$ad_id)==false){
            $errors[]="Wrong Ad ID";
        }


        if(empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);
            $land_type=mysqli_real_escape_string(DBConnection(),$_POST['item_type']);
            $land_size=mysqli_real_escape_string(DBConnection(),$land_size);
            $land_address=mysqli_real_escape_string(DBConnection(),$_POST['land_address']);
            //customer details query

            //customer details query
            $customer_details="update customer_details set telephone='".$telephone."',email='".$email."',address='".$address."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $customer_details);
            mysqli_close(DBConnection());

            $main_img=main_img($_SESSION['ad_id']);
            $image_path=get_images($_SESSION['ad_id']);

                $land="update land set land_type='".$land_type."', land_address='".$land_address."', 
                land_size='".$land_size."', description='".$description."', price='".$price."',image_path='".$image_path."' where ad_id=".$ad_id.";";

            mysqli_query(DBConnection(), $land);
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
        else{
            foreach ($errors as $e){
                echo $e."<br>";
            }
        }

    }
    else{

    }
    foreach ($errors as $e){
        echo $e."<br>";
    }

}
catch(Exception $e){
    echo $e;
}
?>