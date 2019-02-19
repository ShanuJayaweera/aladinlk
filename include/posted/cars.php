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
        $text_box=array('title','model','mileage','cc','description','brand');
        $errors=array_merge($errors,check_req_fields($text_box));

        if(empty(trim($_POST['edition'])) ){
            $_POST['edition']="Not Included";
        }

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
        $max_len_fields=array('address'=>200,'email'=>80,'telephone'=>15);
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

        if (empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $brand=mysqli_real_escape_string(DBConnection(),$_POST['brand']);
            $model=mysqli_real_escape_string(DBConnection(),$_POST['model']);
            $edition=mysqli_real_escape_string(DBConnection(),$_POST['edition']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $mileage=mysqli_real_escape_string(DBConnection(),$_POST['mileage']);
            $model_year=mysqli_real_escape_string(DBConnection(),$_POST['model_year']);
            $condition=mysqli_real_escape_string(DBConnection(),$_POST['condition']);
            $body_type=mysqli_real_escape_string(DBConnection(),$_POST['body_type']);
            $transmission=mysqli_real_escape_string(DBConnection(),$_POST['transmission']);
            $fuel_type=mysqli_real_escape_string(DBConnection(),$_POST['fuel_type']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $cc=mysqli_real_escape_string(DBConnection(),$_POST['cc']);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);

            //customer details query
            $customer_details="insert into customer_details(ad_id,telephone,email,address) VALUES ({$_SESSION['ad_id']}
                                    ,'{$telephone}','{$email}','{$address}');";
            //select main image
            $main_img=main_img($_SESSION['ad_id']);
            $_SESSION['post_email']=$email;

            if (DB_insert($customer_details)==true){

                //get image path

                $image_path=get_images($_SESSION['ad_id']);

                $cars="insert into cars(ad_id,brand,model,edition,Model_year,vehicle_condition,mileage,body_type,
                    transmission,fuel_type,engine_capacity,description,price,image_path) VALUES ({$_SESSION['ad_id']},'{$brand}',
            '{$model}','{$edition}','{$model_year}','{$condition}',
            '{$mileage}','{$body_type}','{$transmission}','{$fuel_type}',
            '{$cc}','{$description}','{$price}','".$image_path."');";

                if (DB_insert($cars)==true){

                    $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='".$main_img."',posted=true where id=".$_SESSION['ad_id'].";";
                    if(mysqli_query(DBConnection(), $advertisement)){
                        unset($_SESSION['sub_cat_id']);
                        unset($_SESSION['sub_area_id']);
                        unset($_SESSION['cat_id']);
                        unset($_POST['car']);

                        header("Location:../../aladin-xx/ad_posted_mail.php");
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
            foreach ($errors as $x){
                echo $x;
            }
        }


    }


}
catch (Exception $e){
    echo "<script>alert($e)</script>";
}


?>