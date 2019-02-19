<?php
require_once "../../repository/aladinlk-function.php";
require_once "../../libraries/gregwar_image/vendor/autoload.php";
use Gregwar\Image\Image;

session_start();


$targetDir = "../../advertisement_images/" . $_SESSION['ad_id'] . "/";
$allowTypes = array('jpg', 'png', 'jpeg', 'gif','PNG');
$images_arr = array();
$user_id = select_user_id($_SESSION['email'], $_SESSION['auth_Provider']);
$display_img="https://www.aladinlk.com/advertisement_images/".$_SESSION['ad_id']."/";

if(!empty($_FILES))
{

    //get count of all images
    $img_count = "SELECT COUNT(image_path) AS image_count FROM temp_table where ad_id=" . $_SESSION['ad_id'] . ";";
    $result = mysqli_query(DBConnection(), $img_count);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['image_count'] < 5) {

                //validation
                $location = $targetDir . $_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $errors=array_merge($errors,image_size_validation($size));

                $filetype=pathinfo($location,PATHINFO_EXTENSION);
                $temp_file = $_FILES['file']['tmp_name'];

                if (in_array($filetype, $allowTypes)) {

                    if (move_uploaded_file($temp_file, $location)) {

                        //resize image
                        Image::open($location)
                            ->scaleResize(720, 453, '#eeeeee')
                            ->save($location,'jpg','100');

                        // create tumb
                        Image::open($location)
                            ->scaleResize(150, 100, '#eeeeee')
                            ->save($targetDir.'tumb/'.$_FILES['file']['name'],'jpg','100');

                        $images_arr[]=$display_img.$_FILES['file']['name'];
                        $image_path="";
                        //clear image path
                        foreach ($images_arr as $path){
                            $image_path=$path."|";
                        }

                        if(DB_insert("insert into temp_table(image_path,user_id,ad_id) values ('{$image_path}',{$user_id},{$_SESSION['ad_id']})")){

                            //set main image
                            $image_path="";

                            //get all images path using ad id and user id
                            $result=mysqli_query(DBConnection(),"Select image_path from temp_table where ad_id=".$_SESSION['ad_id']." ORDER BY id ASC;");

                            while ($row=mysqli_fetch_assoc($result)) {
                                $image_path=$image_path.$row['image_path'];
                            }
                            $tok = strtok($image_path, "|");

                            //update main image
                            if($tok !== false){
                                $sql="UPDATE temp_table SET main_img='".$tok."' where ad_id=".$_SESSION['ad_id'].";";
                                mysqli_query(DBConnection(), $sql);
                            }
                            mysqli_free_result($result);
                            mysqli_close(DBConnection());
                        }
                        else{
                            echo "<script>alert('Can\'t Insert Image to Database!')</script>";
                        }
                    }
                    else{
                        echo "<script>alert('Can\'t move Image to Location!')</script>";
                    }
                    mysqli_close(DBConnection());
                }
                else{
                    echo "<script>alert('File Type Err !')</script>";
                }


            }
            else{
                echo "<script>alert('Image Size Problem !')</script>";
            }

        }

}
else{
}



if(isset($_POST["name"]))
{
    $file_hypan="https://www.aladinlk.com/".$_POST["name"]."|";

    if (data_availability('temp_table','image_path','image_path',$file_hypan)==true){

        $main_img=main_img($_SESSION['ad_id']);
        $main_img=str_replace('https://www.aladinlk.com/',"",$main_img);
        $filename = "../../".$_POST["name"];

        $image_name= basename($_POST["name"]);

        if($main_img==$_POST["name"]){

            //update main image

            if (!unlink($filename)){
                echo "<script>alert('Error Remove File !')</script>";
            }
            else{

                unlink($targetDir.'tumb/'.$image_name);

                $delete_temp="DELETE FROM temp_table WHERE image_path='".$file_hypan."';";
                mysqli_query(DBConnection(), $delete_temp);
                mysqli_close(DBConnection());

                $result=mysqli_query(DBConnection(),"select image_path from temp_table where ad_id=".$_SESSION['ad_id']." ORDER BY id ASC;");
                $image_path="";

                if (mysqli_num_rows($result)>0) {

                    if ($row=mysqli_fetch_assoc($result)) {
                        $image_path=$image_path.$row['image_path'];
                    }

                }

                mysqli_free_result($result);
                mysqli_close(DBConnection());

                $tok = strtok($image_path, "|");
                //update main image
                if($tok !== false){

                    $sql="UPDATE temp_table SET main_img='".$tok."' where ad_id=".$_SESSION['ad_id'].";";
                    mysqli_query(DBConnection(), $sql);
                    mysqli_close(DBConnection());

                }


            }
        }
        else{

            if(!unlink($filename)){
                echo "<script>alert('Error Remove File !')</script>";
            }
            else{

                unlink($targetDir.'tumb/'.$image_name);

                $delete_temp="DELETE FROM temp_table WHERE image_path='".$file_hypan."';";
                mysqli_query(DBConnection(), $delete_temp);
                mysqli_close(DBConnection());
            }
        }
    }
    else{

    }
}


//display image
$image_path="";
$result=mysqli_query(DBConnection(),"Select image_path from temp_table where ad_id=".$_SESSION['ad_id']." ORDER BY id ASC;");

while ($row=mysqli_fetch_assoc($result)) {
    $image_path=$image_path.$row['image_path'];
}
$tok = strtok($image_path, "|");

$main_img=main_img($_SESSION['ad_id']);

while ($tok !== false) {

    $dim=image_size($tok,150,100);
    echo "          <div class='col-md-2'>
                    <div class='image vcenter' style='background-color:#eeeeee; text-align: center; width: 150px; height: 100px;'>
                    <img src='".$tok."' width='".$dim['width']."' height='".$dim['height']."' alt='aladin lk ad image'>
                    </div>";
                    if($tok==$main_img){
                      echo "<h6 style='color: red'>Main Image</h6>";
                    }
                    $remove=str_replace("https://www.aladinlk.com/","",$tok);
    echo"           <h6 class='pointer remove_image' id='".$remove."'>Remove Image</h6>
                    </div>";


    $image_name="";
    $tok = strtok("|");
}


?>
