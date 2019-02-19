<?php

//create database connection
function DBConnection(){
    $connection=mysqli_connect('localhost','root','','aladinlkdb');

    if(mysqli_connect_errno()){
        die('Database Connection Failed'.mysqli_connect_error());

    }
    return $connection;
}

function php_slag($string){
    $slag=preg_replace('/[^a-z0-9-]+/','-',strtolower($string));
    return $slag;
}

function get_mileage($ad_id,$sub_cat_id){

    if($sub_cat_id==1){

        $query="select mileage from cars where ad_id=".$ad_id.";";
        $result=mysqli_query(DBConnection(),$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_assoc($result)) {
                return $row['mileage'];
            }
        }
        mysqli_free_result($result);
        mysqli_close(DBConnection());

    }
    elseif ($sub_cat_id==2  || $sub_cat_id==4){

        $query="select mileage from motorbike_van where ad_id=".$ad_id.";";
        $result=mysqli_query(DBConnection(),$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_assoc($result)) {
                return $row['mileage'];
            }
        }
        mysqli_free_result($result);
        mysqli_close(DBConnection());

    }
    elseif ($sub_cat_id==3){

        $query="select mileage from three_wheelers where ad_id=".$ad_id.";";
        $result=mysqli_query(DBConnection(),$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_assoc($result)) {
                return $row['mileage'];
            }
        }
        mysqli_free_result($result);
        mysqli_close(DBConnection());

    }

    if (empty($mileage) || $mileage=="0"){
        $mileage = "No Details";
    }

    return $mileage;
}



function ad_filters($row_per_page,$page_no,$filter_query,$total_row_query){

    date_default_timezone_set('Asia/Colombo');
    $date = date("Y-m-d H:i:s");
    $data=array();

    $result=mysqli_query(DBConnection(),$total_row_query);
    if($row=mysqli_fetch_assoc($result)){
        $total_rows=$row['count'];
    }

    $result=mysqli_query(DBConnection(),$filter_query);
    if(mysqli_num_rows($result)>0){
        while ($row=mysqli_fetch_assoc($result)){

            $difference = timediff($row['modified'],$date);
            $years = abs(floor($difference / 31536000));
            $days = abs(floor(($difference-($years * 31536000))/86400));
            $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
            $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);

            if($years>0){
                $time_diff= $years . " Years ". $days . " Days " . $hours . " Hours " . $mins . " Minutes Ago";
            }
            elseif($days>0){
                $time_diff = $days . " Days " . $hours . " Hours " . $mins . " Minutes Ago";
            }
            elseif ($hours>0){
                $time_diff = $hours . " Hours " . $mins . " Minutes Ago";
            }
            elseif ($mins>0){
                $time_diff = $mins . " Minutes Ago";
            }

            if(empty(trim($row['main_img'])) || $row['main_img']=="" || $row['main_img']==null){
                $main_img="https://www.aladinlk.com/assets/img/tumb.png";
            }
            else{
                $main_img=$row['main_img'];
            }

            $data[]=array(
                'id'=>$row['id'],
                'title'=>$row['title'],
                'title_url'=>php_slag($row['title']),
                'main_img'=>$main_img,
                'sub_cat_name'=>$row['sub_cat_name'],
                'ad_type'=>$row['ad_type'],
                'sub_area_name'=>sub_area_name($row['id']),
                'sub_cat_id'=>$row['sub_cat_id'],
                'price'=>field_by_ad_id('price',$row['tbl_name'],$row['id']),
                'mileage' =>  get_mileage($row['id'],$row['sub_cat_id']),
                'time_diff'=>$time_diff );

        }
        $data['pagination']=array("total_rows"=>$total_rows,"row_per_page"=>$row_per_page,"current_page"=>$page_no);

    }
    mysqli_close(DBConnection());
    return $data;
}



function req_fields($required_fields){

    $errors=array();
    foreach ($required_fields as $name) {

        if (empty(trim($name))) {
            if($name=="0" || $name=="00"){

            }
            else{

                $errors[]=$name." field is not filled !";
            }

        }
    }
    return $errors;
}

//check required fields
function check_req_fields($required_fields){
    $errors=array();
    foreach ($required_fields as $name) {

        if (empty(trim($_POST[$name]))) {
            if($_POST[$name]=="0" || $_POST[$name]=="00"){

            }
            else{

                $errors[]=$name." field is not filled !";
            }

        }
    }
    return $errors;
}

function field_length($max_len_fields){
    $errors=array();
    foreach ($max_len_fields as $field => $max_len){
        if (strlen($field)>$max_len) {
            $errors[]="Character length is out of boundary.";
        }
    }
    return $errors;
}


//check max character length of fields
function max_len_fields($max_len_fields){
    $errors=array();
    foreach ($max_len_fields as $field => $max_len){
        if (strlen($_POST[$field])>$max_len) {
            $errors[]=$field." Character Length is Out of Boundary !";
        }
    }
    return $errors;
}


function domain_exists( $email, $record = 'MX' ) {
    list( $user, $domain ) = explode( '@', $email );
    return checkdnsrr( $domain, $record );
}


//validate email address

function validate_email($email){

    $errors=array();
    if (!filter_var($_POST[$email], FILTER_VALIDATE_EMAIL)) {
        $errors[]="Invalid email address"."<br>";
    }

    if(domain_exists($_POST[$email])) {
    }
    else {
        $errors[]='No MX record exists;  Invalid email.';
    }
    return $errors;
}

function validation_email($email){
    $errors=array();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[]="Invalid email address";
    }

    if(domain_exists($email)) {
    }
    else {
        $errors[]='No MX record exists;  Invalid email.';
    }
    return $errors;
}


//Check Data Availability
function data_availability($table_name,$select_Field,$hold_field,$data){

    $query="select {$select_Field} from {$table_name} where {$hold_field}='{$data}';";
    $result_set=mysqli_query(DBConnection(),$query);

    if (mysqli_num_rows($result_set)>0) {
        return true;
    }
    else{
        return false;
    }
    // Free result set
    mysqli_free_result($result_set);
    mysqli_close(DBConnection());
}

//select user_id using two data
function select_user_id($email,$auth_provider){
    $query="select user_id from user_register where email='{$email}' and auth_provider='{$auth_provider}'";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            return $row['user_id'];
        }
    }
    mysqli_free_result($result);
    mysqli_close(DBConnection());

}

function get_user_name($email){
    $query="select user_name from email_users where email='{$email}'";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            return $row['user_name'];
        }
    }
    mysqli_free_result($result);
    mysqli_close(DBConnection());
}

function get_user_token($email){
    $query="select token from email_users where email='{$email}'";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            return $row['token'];
        }
    }
    mysqli_free_result($result);
    mysqli_close(DBConnection());
}


//insert data into database
function DB_insert($query){
    $result=mysqli_query(DBConnection(),$query);
    if ($result) {
        return true;
    }
    else{
        return false;
    }
    mysqli_close(DBConnection());
}

//create token
function create_token(){
    $token="qwertyuiopasdfghjklzxcvbnm0987654321QWERTYUIOPLKJHGFDSAZXCVBNM";
    $token=str_shuffle($token);
    $token=substr($token,0,50);
    return $token;
}

//check token is already exist
function get_token($my_token){
    $query="select id from advertisement where token='{$my_token}';";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        //token already exist
        return true;
    }
    else{
        return false;
    }
    // Free result set
    mysqli_free_result($result);
    mysqli_close(DBConnection());
}

function create_new_ad($ad_type){
    //Set Date
    date_default_timezone_set('Asia/Colombo');
    $date=date('Y-m-d h:i:sa');
    //create an advertisement(insert to database)
    $token=create_token();


//check token is already exist
    while(get_token($token)==true){
        $token=create_token();
    }

    $user_id=select_user_id($_SESSION['email'],$_SESSION['auth_Provider']);
    $advertisement="insert into advertisement(user_id,created,verified,token,ad_type,posted) VALUES ({$user_id},'{$date}',0,'{$token}',$ad_type,false);";

    if(DB_insert($advertisement)){

        //select advertisement id
        $query="select id from advertisement where token='{$token}'";
        $result=mysqli_query(DBConnection(),$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_assoc($result)) {
                return $row['id'];
            }
        }
        mysqli_free_result($result);
        mysqli_close(DBConnection());
    }
    else{
        return "Cant add Advertisement";
        mysqli_close(DBConnection());
    }
}


function main_cat_id_from_ad_id($ad_id){
    $q="select main_cat_id from all_ads where id=".$ad_id.";";
    $result=mysqli_query(DBConnection(),$q);
    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['main_cat_id'];

        }
    }
    mysqli_close(DBConnection());
}

function main_category_name($sub_cat_id){
    $q="SELECT category_name
        FROM category
        RIGHT JOIN sub_category ON category.id = sub_category.main_cat_id where sub_category.id=".$sub_cat_id.";";
    $result=mysqli_query(DBConnection(),$q);
    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['category_name'];

        }
    }
    mysqli_close(DBConnection());

}

function main_area_name($sub_area_id){
    $q="SELECT Area_Name FROM area RIGHT JOIN sub_area ON area.id = sub_area.Main_Area_Id where sub_area.Id=".$sub_area_id.";";
    $result=mysqli_query(DBConnection(),$q);
    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['Area_Name'];

        }
    }
    mysqli_close(DBConnection());

}

//select by id only one data
function select_by_id($id,$select_field,$table_name){
    $query="select $select_field from $table_name where id=$id";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            return $row[$select_field];
        }
    }
    mysqli_free_result($result);
    mysqli_close(DBConnection());

}


//Image Validation
function image_size_validation($file_size){

    $errors=array();
    //checking file size only
    if($file_size > 6164480){
        $errors[]='Upload image size less than 5MB';
    }

    return $errors;
}

function main_img($ad_id){
    $query="select main_img from temp_table where ad_id=$ad_id";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc($result)) {
            return $row['main_img'];
        }
    }
    mysqli_free_result($result);
    mysqli_close(DBConnection());

}
//validate radio button
function radio_button($radio_fields){
    $errors=array();
    foreach ($radio_fields as $fields){
        if (isset($_POST[$fields])){
            if (empty($_POST[$fields])){
                $errors[]=$fields.' has not set';
            }
        }
        else{
            $errors[]=$fields.' has not set';
        }
    }
    return $errors;
}

//number format
function number($field){
    $errors=array();
    $pattern = '/^[0-9]+$/';
    foreach ($field as $fields){

        if (preg_match($pattern, $_POST[$fields]) == '0') {
            $errors[]= $fields." is not in format";
        }
    }
    return $errors;
}

function get_images($ad_id){
    $result=mysqli_query(DBConnection(),"Select image_path from temp_table where ad_id={$ad_id};");
    $image_path="";
    while ($row=mysqli_fetch_assoc($result)) {
        $image_path=$image_path.$row['image_path'];
    }
    return $image_path;
    mysqli_free_result($result);
    mysqli_close(DBConnection());

}

//select model from model table
function item_type($sub_cat_id){
    $query="select type_name,id from item_type where sub_cat_id=$sub_cat_id ORDER BY Id ASC";
    $result=mysqli_query(DBConnection(),$query);
    if (mysqli_num_rows($result)>0) {
        return $result;
    }
    mysqli_close(DBConnection());
}

//Validate Price
function price($price){
    $errors=array();
    if (empty($_POST[$price])){
        $errors[]="Price is Required";
    }
    else{
       $pattern = '/^\d+(?:\.\d{0,2})$/';

        if (preg_match($pattern, $_POST[$price]) == '0') {
            $errors[]="Price is not in format";
        }
    }
    return $errors;
}

function row_count_all_ads(){

    $sql="SELECT COUNT(title) as count FROM all_ads;";
    $result=mysqli_query(DBConnection(),$sql);
    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['count'];

        }
    }
    mysqli_close(DBConnection());

}


function sub_area_name($ad_id){

    $query="select sub_area.Sub_Area_Name from sub_area join advertisement 
        on sub_area.id=advertisement.sub_area_id where advertisement.id=".$ad_id.";";

    $result=mysqli_query(DBConnection(),$query);

    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['Sub_Area_Name'];
        }
    }
    mysqli_close(DBConnection());
}

function field_by_ad_id($field,$tbl_name,$ad_id){
    $query="select ".$field." from ".$tbl_name." where ad_id=".$ad_id.";";
    $result=mysqli_query(DBConnection(),$query);

    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row[$field];
        }
    }
    mysqli_close(DBConnection());
}

function get_table($ad_id){
    //get sub cat id
    $sub_cat_id= select_by_id($ad_id,'sub_cat_id','advertisement');
    $table=select_by_id($sub_cat_id,'tbl_name','sub_category');

    return $table;
}

//get table name using ad_id
function all_data_from_table($ad_id){

    $tbl_name=get_table($ad_id);

    $query="SELECT * FROM advertisement
            RIGHT OUTER JOIN ".$tbl_name."
            ON advertisement.id=".$tbl_name.".ad_id where advertisement.id=".$ad_id.";";

    $result=mysqli_query(DBConnection(),$query);
    mysqli_close(DBConnection());

    return $result;
}

function customer_details($ad_id){
    $query="select * from customer_details where ad_id=".$ad_id.";";
    $result=mysqli_query(DBConnection(),$query);
    return $result;
    mysqli_close(DBConnection());
}

function customer_name($user_id){
//get auth provider
    $q="select auth_provider from user_register where user_id=".$user_id.";";
    $result=mysqli_query(DBConnection(),$q);
    if(mysqli_num_rows($result)>0){
        if ($row=mysqli_fetch_assoc($result)){
           if($row['auth_provider']=="Google"){
            $q="select user_name from google_users where user_id=".$user_id.";";
               $result=mysqli_query(DBConnection(),$q);
               if(mysqli_num_rows($result)>0){
                   if ($row=mysqli_fetch_assoc($result)){
                       return $row['user_name'];
                   }
               }
           }
           elseif ($row['auth_provider']=="Email"){
               $q="select user_name from email_users where user_id=".$user_id.";";
               $result=mysqli_query(DBConnection(),$q);
               if(mysqli_num_rows($result)>0){
                   if ($row=mysqli_fetch_assoc($result)){
                       return $row['user_name'];
                   }
               }
           }
           elseif ($row['auth_provider']=="Facebook"){
               $q="select user_name from fb_users where user_id=".$user_id.";";
               $result=mysqli_query(DBConnection(),$q);
               if(mysqli_num_rows($result)>0){
                   if ($row=mysqli_fetch_assoc($result)){
                       return $row['user_name'];
                   }
               }
           }
        }
    }
    mysqli_close(DBConnection());
}

function sub_category($ad_id){
    $query="select sub_category.Sub_Cat_Name from sub_category join advertisement on sub_category.Id=advertisement.sub_cat_id where advertisement.id=".$ad_id.";";

    $result=mysqli_query(DBConnection(),$query);

    if (mysqli_num_rows($result)>0) {
        if ($row=mysqli_fetch_assoc( $result)) {
            return $row['Sub_Cat_Name'];
        }
    }
    mysqli_close(DBConnection());
}

function image_size($url,$max_width,$max_height){

    $imageDimensions = getimagesize($url);
    $imageWidth = $imageDimensions[0];
    $imageHeight = $imageDimensions[1];
    $imageSize['width'] = $imageWidth;
    $imageSize['height'] = $imageHeight;
    $ratio=0;

    if ($imageWidth>$max_width){
        $ratio=$max_width/$imageWidth;
        $imageHeight=$imageHeight*$ratio;
        $imageWidth=$imageWidth*$ratio;

    }

    if ($imageHeight>$max_height){
        $ratio=$max_height/$imageHeight;
        $imageHeight=$imageHeight*$ratio;
        $imageWidth=$imageWidth*$ratio;
    }

    $imageSize['width'] = $imageWidth;
    $imageSize['height'] = $imageHeight;

    return $imageSize;
}


function timediff($firstTime,$lastTime){
    // convert to unix timestamps
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);

    // perform subtraction to get the difference (in seconds) between times
    $timeDiff=$lastTime-$firstTime;

    // return the difference
    return $timeDiff;
}


?>