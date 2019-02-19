<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
try{

    $errors=array();
    if(isset($_POST['houses'])){

        require_once "../../repository/aladinlk-function.php";

        //Set Date
        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d H:i:s");
        //text box validation
        $text_box=array('land_size','house_size','bedrooms','bathrooms','title','description','house_address');
        $errors=array_merge($errors,check_req_fields($text_box));

        //length validation
        $max_len_fields=array('title'=>100,'description'=>5000,'land_size'=>15,'house_address'=>200,'bedrooms'=>5,'bathrooms'=>5,'house_size' => 15);
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
        $only_number=array('land_size','house_size','bedrooms','bathrooms');
        $errors=array_merge($errors,number($only_number));


        //validation is finished

        if(empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);
            $land_size=mysqli_real_escape_string(DBConnection(),$land_size);
            $house_address=mysqli_real_escape_string(DBConnection(),$_POST['house_address']);
            $house_size=mysqli_real_escape_string(DBConnection(),$_POST['house_size']);
            $bedrooms=mysqli_real_escape_string(DBConnection(),$_POST['bedrooms']);
            $bathrooms=mysqli_real_escape_string(DBConnection(),$_POST['bathrooms']);

            //customer details query
            $customer_details="insert into customer_details(ad_id,telephone,email,address) VALUES ({$_SESSION['ad_id']}
                                    ,'{$telephone}','{$email}','{$address}');";

            //select main image
            $main_img=main_img($_SESSION['ad_id']);
            $image_path=get_images($_SESSION['ad_id']);

            if (DB_insert($customer_details)==true){

                $houses="INSERT INTO houses (ad_id, title, land_size, house_size, bedrooms, bathrooms, house_address, description, price, image_path)
                        VALUES (".$_SESSION['ad_id'].", '".$title."', '".$land_size."', '".$house_size."', 
                        '".$bedrooms."', '".$bathrooms."', '".$house_address."', '".$description."', '".$price."', '".$image_path."');";

                if(DB_insert($houses)==true){

                    //remove all of temp data used to this ad
                  //  $delete_temp="DELETE FROM temp_table WHERE ad_id=".$_SESSION['ad_id'].";";
                  //  mysqli_query(DBConnection(), $delete_temp);
                  //  mysqli_close(DBConnection());

                    //update advertisement table modified,title,main img,posted
                    $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='{$main_img}',posted=true where id=".$_SESSION['ad_id'].";";

                    if(mysqli_query(DBConnection(), $advertisement)){
                        unset($_SESSION['sub_cat_id']);
                        unset($_SESSION['sub_area_id']);
                        unset($_SESSION['cat_id']);
                        header("Location:../../service-good-property-posted.php");
                        exit();
                    }
                    else{
                        $errors[]=mysqli_error(DBConnection());
                        header("Location:../../errors.php");
                        exit();
                    }
                }
                else{
                    $errors[]=mysqli_error(DBConnection());
                    header("Location:../../errors.php");
                    exit();
                }
            }
            else{
                $errors[]=mysqli_error(DBConnection());
                header("Location:../../errors.php");
                exit();
            }
        }
        else{

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