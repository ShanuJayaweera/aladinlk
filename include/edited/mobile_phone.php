<?php
require_once "../../repository/aladinlk-function.php";


//Set Date
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['mobile_phone'])){

    $errors=array();
    try{
        //text box validation
        $text_box=array('title','description','brand','model','edition');
        $errors=array_merge($errors,check_req_fields($text_box));

        //length validation
        $max_len_fields=array('title'=>100,'description'=>5000,'brand'=>50,'model'=>80,'edition'=>40);
        $errors=array_merge($errors, max_len_fields($max_len_fields));

        //radio button check
        $radio=array('condition','authenticity');
        $errors=array_merge($errors,radio_button($radio));

        //price check
        if(!isset($_POST['negotiable'])){
            $errors=array_merge($errors,price('price'));
            $price=$_POST['price'];
        }
        else{
            $price='Negotiable';
        }


        $feature="";

        //get features
        $features=array('ch1','ch2','ch3','ch4','ch5','ch6','ch7','ch8','ch9','ch10','ch11','ch12','ch13');
        foreach ($features as $val){
            if(isset($_POST[$val])){
                $feature=$feature.$_POST[$val]."|";
            }
        }

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


        if (empty($errors)){

            //mysql parse
            $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
            $brand=mysqli_real_escape_string(DBConnection(),$_POST['brand']);
            $model=mysqli_real_escape_string(DBConnection(),$_POST['model']);
            $edition=mysqli_real_escape_string(DBConnection(),$_POST['edition']);
            $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
            $condition=mysqli_real_escape_string(DBConnection(),$_POST['condition']);
            $price=mysqli_real_escape_string(DBConnection(),$price);
            $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
            $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
            $telephone=mysqli_real_escape_string(DBConnection(),$telephone);

            //customer details query
            $customer_details="insert into customer_details(ad_id,telephone,email,address) VALUES ({$_SESSION['ad_id']}
                                    ,'{$telephone}','{$email}','{$address}');";

            //select main image
            $main_img=select_by_id($_SESSION['ad_id'],'main_img','temp_table');
            $image_path=get_images($_SESSION['ad_id']);

            if (DB_insert($customer_details)==true){

                //insert three wheeler
                $mobile_phone="INSERT INTO mobile_phone (ad_id,item_condition, title, brand, model, edition, authenticity, Features, description, price, image_path) 
                                VALUES (".$_SESSION['ad_id'].", '".$condition."', '".$title."', '".$brand."', '".$model."', 
                                        '".$edition."', '".$_POST['authenticity']."', '".$feature."', '".$description."', '".$price."','".$image_path."');";


                if(DB_insert($mobile_phone)==true){
                    //remove all of temp data used to this ad
                    $delete_temp="DELETE FROM temp_table WHERE ad_id=".$_SESSION['ad_id'].";";
                    mysqli_query(DBConnection(), $delete_temp);
                    mysqli_close(DBConnection());

                    //update advertisement table modified,title,main img,posted
                    $advertisement="update advertisement set modified='{$date}',title='{$title}',main_img='{$main_img}',posted=true where id=".$_SESSION['ad_id'].";";

                    if(mysqli_query(DBConnection(), $advertisement)){
                        unset($_SESSION['sub_cat_id']);
                        unset($_SESSION['sub_area_id']);
                        header("Location:../../dashboard.php");
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


    }
    catch(Exception $e){

    }

}
?>