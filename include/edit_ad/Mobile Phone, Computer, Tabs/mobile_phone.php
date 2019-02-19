<?php
require_once "repository/aladinlk-function.php";


try{
$feature=array();
    //get advertisement details from database
    $ad=all_data_from_table($ad_id);

    if (mysqli_num_rows($ad)>0) {
        while ($row=mysqli_fetch_assoc($ad)) {

            $title=$row['title'];
            $description=$row['description'];
            $condition=$row['item_condition'];
            $price=$row['price'];
            $brand=$row['brand'];
            $model=$row['model'];
            $edition=$row['edition'];
            $authenticity=$row['authenticity'];
            $features=$row['Features'];

        }

        $tok = strtok($features, "|");
        while ($tok !== false) {
            $feature[]=$tok;
            $tok = strtok("|");
        }

    }
    else{

    }

}
catch(Exception $e){

}
?>



<?php
include "include/image/image-upload.php";

?>
<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" method="post">
            <h4>Fill Your Mobile Phone Details</h4>
            <hr class="Line">
            <div class="col-lg-12">

                <div class="form-group">
                    <h5 class="col-sm-2">Condition</h5>
                    <div class="col-sm-10">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Used" required <?php if($condition=="Used"){ echo "checked";} ?>>Used
                                    </label>
                                </span>
                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="New" required <?php if($condition=="New"){ echo "checked";} ?>>New
                                    </label>
                                </span>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Title</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" placeholder="Title" maxlength="100" value="<?php echo $title ?>" required  >
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Brand </h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="brand" placeholder="Brand" value="<?php echo $brand?>">
                    </div>

                    <h5 class="col-sm-1">Model</h5>
                    <div class="col-sm-5">
                        <input class="form-control" type="text" name="model" placeholder="Model" value="<?php echo $model?>">
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Edition</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="edition" placeholder="Edition" value="<?php echo $edition?>">
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Authenticity</h5>
                    <div class="col-sm-10">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="authenticity" <?php if($authenticity=='Original'){echo 'checked';} ?> value="Original" required>Original
                                    </label>
                                </span>
                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="authenticity" <?php if($authenticity=='Replica'){echo 'checked';} ?> value="Replica" required>Replica
                                    </label>
                                </span>

                    </div>
                </div>


                    <div class="form-group">
                        <h5 class="col-sm-2">Description</h5>
                        <div class="col-sm-10">
                            <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" ><?php echo $description?></textarea>
                        </div>
                    </div>

                <div class="form-group">
                <div class="col-md-2"><h5>Features </h5></div>
                <div class="col-md-10">


                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch1" value="Bluetooth" <?php
                                    foreach ($feature as $x){
                                        if($x=="Bluetooth"){
                                            echo "checked";
                                        }
                                    }
                                    ?>> Bluetooth</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch2" value="Dual-lens Camera"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Dual-lens Camera"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                    > Dual-lens Camera</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Expandable Memory"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch3" value="Expandable Memory"> Expandable Memory</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="GPS"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch4" value="GPS"> GPS</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch5"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Fingerprint Sensor"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           value="Fingerprint Sensor"> Fingerprint Sensor</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                           <?php
                                           foreach ($feature as $x){
                                               if($x=="Motion Sensors"){
                                                   echo "checked";
                                               }
                                           }
                                           ?>
                                           name="ch6" value="Motion Sensors"> Motion Sensors</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Touch Screen"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch7" value="Touch Screen"> Touch Screen</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Camera"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch8" value="Camera"> Camera</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Dual SIM"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch9" value="Dual SIM"> Dual SIM</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="Physical Keyboard"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch10" value="Physical Keyboard"> Physical Keyboard</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="3G"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch11" value="3G"> 3G</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="4G"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch12" value="4G"> 4G</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox"
                                        <?php
                                        foreach ($feature as $x){
                                            if($x=="GSM"){
                                                echo "checked";
                                            }
                                        }
                                        ?>
                                           name="ch13" value="GSM"> GSM</label>
                            </div>
                        </div>
                    </div>
                </div>


                        <div class="form-group">
                            <h5 class="col-sm-2">Price (Rs)</h5>
                            <div class="col-sm-4">
                                <input class="form-control price" type="text" name="price" placeholder="Price (Rs)" <?php if($price != "Negotiable"){echo "value='".$price."'";} ?> id="price" maxlength="12" min="1" title="Price Format = 100.00">
                            </div>
                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="control-label lable">
                                        <input type="checkbox" class="negotiable" name="negotiable" <?php if($price == "Negotiable"){echo "checked";} ?>> Negotiable</label>
                                </div>
                            </div>
                        </div>



                    <?php include "include/edit_ad/user_contact.php"?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-default" type="submit" name="mobile_phone">UPDATE YOUR AD</button>
                            </div>
                        </div>


            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {

        $(".price").prop('required',true);

        if ($(".negotiable").is(":checked")) {
            $(".price").attr("disabled", "disabled");
            $(".price").prop('required',false);

        } else {
            $(".price").removeAttr("disabled");
            $(".price").prop('required',true);
            $(".price").focus();
        }

        $(".negotiable").click(function () {
            if ($(this).is(":checked")) {
                $(".price").attr("disabled", "disabled");
                $(".price").prop('required',false);

            } else {
                $(".price").removeAttr("disabled");
                $(".price").prop('required',true);
                $(".price").focus();
            }
        });
        var price = document.getElementById("price");

        function validatePrice(){
            var regex  = /^\d+(?:\.\d{0,2})$/;
            var numStr = price.value;
            if (regex.test(numStr)){
                price.setCustomValidity('');
            }
            else{
                price.setCustomValidity("Price Format = 100.00");
            }
        }
        price.onkeyup = validatePrice;
    });
</script>