<?php
require_once "../../repository/aladinlk-function.php";

if(isset($_GET['ad_id'])){
    $ad_id=mysqli_real_escape_string(DBConnection(),$_GET['ad_id']);

    //data availability
    if (data_availability('advertisement','Id','Id',$ad_id)==true){
       $tbl_name=get_table($ad_id);

       //remove contact details if have
        if (data_availability('customer_details','id','ad_id',$ad_id)==true){
            //remove customer details
           $query="DELETE FROM customer_details WHERE ad_id=".$ad_id.";";
           mysqli_query(DBConnection(),$query);
        }

        //remove recode from table
        if (data_availability($tbl_name,'id','ad_id',$ad_id)==true){
            //remove customer details
            $query="DELETE FROM $tbl_name WHERE ad_id=".$ad_id.";";
            mysqli_query(DBConnection(),$query);
        }

        //remove recode from advertisement table
        $query="DELETE FROM advertisement WHERE id=".$ad_id.";";
        mysqli_query(DBConnection(),$query);

        //remove temp folder
        $files = glob("../../advertisement_images/".$ad_id."/tumb/*"); //get all file names
        foreach($files as $file){
            if(is_file($file))
                unlink($file); //delete file
        }
        //delete temp folder
        if(count(glob("../../advertisement_images/".$ad_id."/tumb/*"))==0) {
            if(!rmdir("../../advertisement_images/".$ad_id."/tumb/"))
            {
                echo "<div class='alert alert-danger fade in'>
                <h6>Data Cant remove</h6>
              </div>";
            }
            else{
                //delete full folder
                $files = glob("../../advertisement_images/".$ad_id."/*"); //get all file names
                foreach($files as $file){
                    if(is_file($file))
                        unlink($file); //delete file
                }
                if(count(glob("../../advertisement_images/".$ad_id."/*"))==0) {
                    if(!rmdir("../../advertisement_images/".$ad_id."/"))
                    {
                        echo "<div class='alert alert-danger fade in'>
                <h6>Data Cant remove</h6>
              </div>";
                    }
                }

            }
        } else {
            echo 'not empty';
        }


    }
    else{
        echo "<div class='alert alert-danger fade in'>
                <h6>Data not found.</h6>
              </div>";
    }
}
?>