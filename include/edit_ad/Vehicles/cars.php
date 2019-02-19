<?php
require_once 'repository/aladinlk-function.php';
//upload image
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title="";
$brand="";
$model="";
$edition="";
$description="";
$mileage="";
$model_year="";
$condition="";
$body_type="";
$transmission="";
$fuel_type="";
$price="";
$cc="";


//get advertisement details from database
$ad=all_data_from_table($ad_id);

if (mysqli_num_rows($ad)>0) {
    while ($row=mysqli_fetch_assoc($ad)) {

        $title=$row['title'];
        $brand=$row['brand'];
        $model=$row['model'];
        $edition=$row['edition'];
        $description=$row['description'];
        $mileage=$row['mileage'];
        $model_year=$row['Model_year'];
        $condition=$row['vehicle_condition'];
        $body_type=$row['body_type'];
        $transmission=$row['transmission'];
        $fuel_type=$row['fuel_type'];
        $price=$row['price'];
        $cc=$row['engine_capacity'];
    }
}

else{

}
?>
<?php
include "include/image/image-upload.php";
?>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="include/edited/cars.php">
            <input type="hidden" value="<?php echo $ad_id?>" name="ad_id">
            <div class="col-lg-12">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Fill Your Car Details</h4>
                            <hr class="Line">
                            <div class="form-group">
                                <h5 class="col-sm-2">Title</h5>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" placeholder="Title" value="<?php echo $title ?>">
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
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="edition" placeholder="Edition" value="<?php echo $edition?>">
                                </div>

                                <h5 class="col-sm-1">Model Year</h5>
                                <div class="col-sm-5">
                                    <select class="form-control col-sm-9" name="model_year">
                                        <optgroup label="Model Year">
                                            <?php
                                            for ($x = 2018; $x >= 1960; $x--) {
                                                if ($model_year==$x){
                                                    echo "<option value='$x' selected>$x</option>";
                                                }
                                                else{
                                                    echo "<option value='$x'>$x</option>";
                                                }
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <h4>Condition</h4>
                            <hr class="Line">
                            <div class="form-group col-md-12">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Used" <?php if($condition=="Used"){ echo "checked";} ?>>Used
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="New" <?php if($condition=="New"){ echo "checked";} ?>>New
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Recondition" <?php if($condition=="Recondition"){ echo "checked";} ?>>Recondition
                                    </label>
                                </span>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Mileage (KM)</h5>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="mileage" pattern="\d*" maxlength="12" min="1" required placeholder="Mileage (KM)" value="<?php echo $mileage?>">
                                </div>
                                <h5 class="col-sm-2">Engine Capacity (CC)</h5>
                                <div class="col-sm-4">
                                    <input class="form-control" name="cc" placeholder="Engine Capacity (CC)" type="text" value="<?php echo $cc ?>" pattern="\d*" maxlength="12" min="1" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Body Type</h5>
                                <div class="col-sm-4">
                                    <select class="form-control col-sm-9" name="body_type" >
                                        <optgroup label="Body Type">
                                        <option value="Saloon" <?php  if($body_type=="Saloon"){echo "selected";} ?>>Saloon</option>
                                        <option value="Hatchback" <?php  if($body_type=="Hatchback"){echo "selected";} ?>>Hatchback</option>
                                        <option value="Station Wagon" <?php  if($body_type=="Station Wagon"){echo "selected";} ?>>Station Wagon</option>
                                        <option value="Convertible" <?php  if($body_type=="Convertible"){echo "selected";} ?>>Convertible</option>
                                        <option value="Couple/Sport" <?php  if($body_type=="Couple/Sport"){echo "selected";} ?>>Couple/Sport</option>
                                        <option value="SUV/4*4" <?php  if($body_type=="SUV/4*4"){echo "selected";} ?>>SUV/4*4</option>
                                        <option value="MPV" <?php  if($body_type=="MPV"){echo "selected";} ?>>MPV</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <h5 class="col-sm-2">Transmission </h5>
                                <div class="col-sm-4">
                                    <select class="form-control col-sm-9" name="transmission">
                                        <optgroup label="Transmission">
                                            <option value="Automatic" <?php  if($transmission=="Automatic"){echo "selected";} ?>>Automatic</option>
                                            <option value="Manual" <?php  if($transmission=="Manual"){echo "selected";} ?>>Manual</option>
                                            <option value="Tiptronic" <?php  if($transmission=="Tiptronic"){echo "selected";} ?>>Tiptronic</option>
                                            <option value="CVT" <?php  if($transmission=="CVT"){echo "selected";} ?>>CVT</option>
                                            <option value="Other Transmission" <?php  if($transmission=="Other Transmission"){echo "selected";} ?>>Other Transmission</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                           <br>
                            <div class="form-group">
                                <h5 class="col-sm-2">Fuel Type</h5>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Diesel" <?php if($fuel_type=="Diesel"){ echo "checked";}?>>Diesel
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Petrol" <?php if($fuel_type=="Petrol"){ echo "checked";}?>>Petrol
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable" >
                                        <input type="radio" name="fuel_type" value="Electric"  <?php if($fuel_type=="Electric"){ echo "checked";}?>>Electric
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Hybrid" <?php if($fuel_type=="Hybrid"){ echo "checked";}?>>Hybrid
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Other Type" <?php if($fuel_type=="Other Type"){ echo "checked";}?>>Other Fuel Type
                                    </label>
                                </span>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Description</h5>
                                <div class="col-sm-10">
                                    <textarea class="form-control txtarea" rows="10" cols="20" name="description" id="desc" placeholder="Description" >
                                          <?php

                                          $description=preg_replace("#\[sp\]#","&nbsp",$description);
                                          $description=preg_replace("#\[nl\]#","<br>\n",$description);
                                          echo $description;
                                          ?>

                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
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
                        </div>


                        <!--Contact Details-->
                        <?php include "include/edit_ad/user_contact.php"?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-default" type="submit" name="car">UPDATE YOUR AD</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function addNewLines() {
        text=document.getElementById('desc').value;
        text=text.replace(/ /g,"[sp][sp]");
        text=text.replace(/\n/g,"[nl]");
        document.getElementById('desc').value=text;
    }
</script>

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



