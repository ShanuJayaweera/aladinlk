<?php
require_once "../../repository/aladinlk-function.php";

$errors=array();
//Set Date
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d H:i:s");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['default_type'])){

    //text box validation
    $text_box=array('title','description');
    $errors=array_merge($errors,check_req_fields($text_box));

    //length validation
    $max_len_fields=array('title'=>100,'description'=>5000);
    $errors=array_merge($errors, max_len_fields($max_len_fields));

    //radio button check
    $radio=array('condition');
    $errors=array_merge($errors,radio_button($radio));

    //price check
    if(!isset($_POST['negotiable'])){
        $errors=array_merge($errors,price('price'));
        $price=$_POST['price'];
    }
    else{
        $price='Negotiable';
    }

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

    if(empty($errors)){

        //mysql parse
        $title=mysqli_real_escape_string(DBConnection(),$_POST['title']);
        $description=mysqli_real_escape_string(DBConnection(),$_POST['description']);
        $condition=mysqli_real_escape_string(DBConnection(),$_POST['condition']);
        $price=mysqli_real_escape_string(DBConnection(),$price);
        $email=mysqli_real_escape_string(DBConnection(),$_POST['email']);
        $address=mysqli_real_escape_string(DBConnection(),$_POST['address']);
        $telephone=mysqli_real_escape_string(DBConnection(),$telephone);
        $item_type=mysqli_real_escape_string(DBConnection(),$_POST['item_type']);

        //customer details query
        $customer_details="insert into customer_details(ad_id,telephone,email,address) VALUES ({$_SESSION['ad_id']}
                                    ,'{$telephone}','{$email}','{$address}');";

        //select main image
        $main_img=main_img($_SESSION['ad_id']);
        $image_path=get_images($_SESSION['ad_id']);

        if (DB_insert($customer_details)==true){

            //insert three wheeler
            $default_type="INSERT INTO default_type (ad_id, item_condition,type_name, title, description, price, image_path) 
                      VALUES (".$_SESSION['ad_id'].", '".$condition."','".$item_type."', '".$title."', '".$description."', '".$price."', '".$image_path."');";


            if(DB_insert($default_type)==true){
                //remove all of temp data used to this ad
              //  $delete_temp="DELETE FROM temp_table WHERE ad_id=".$_SESSION['ad_id'].";";
              //  mysqli_query(DBConnection(), $delete_temp);
              //  mysqli_close(DBConnection());
                unset($_SESSION['sub_cat_id']);
                unset($_SESSION['sub_area_id']);

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
unset($_POST['default_type']);

foreach ($errors as $e){
    echo $e."<br>";
}
?>

