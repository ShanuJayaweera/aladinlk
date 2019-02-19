<?php
try{
    require_once "repository/aladinlk-function.php";

    $ad=all_data_from_table($ad_id);

    if (mysqli_num_rows($ad)>0) {
        while ($row=mysqli_fetch_assoc($ad)) {

            $title=$row['title'];
            $description=$row['description'];
            $price=$row['price'];
            $house_address=$row['house_address'];
            $land_size=$row['land_size'];
            $house_size=$row['house_size'];
            $bed=$row['bedrooms'];
            $bath=$row['bathrooms'];
        }

        if (strpos($land_size, 'Perches') == true) {
            $unit="Perches";
        }
        else{
            $unit="Acres";
        }
        $land_size = intval(preg_replace("/[^0-9]/", "", $land_size));
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
        <form class="form-horizontal" method="post" action="include/edited/houses.php">
            <h4>Fill Your House Details</h4>
            <hr class="Line">
            <div class="col-lg-12">

                <div class="form-group">
                    <h5 class="col-sm-2">Title</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" placeholder="Title" maxlength="100" value="<?php echo $title ?>" required  >
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Land Size</h5>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" pattern="\d*" min="1" name="land_size" value="<?php echo $land_size;?>" placeholder="Land Size" maxlength="15" required>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="unit">
                            <optgroup label="Unit">
                                <?php if($unit=="Perches"){echo "selected";} ?>

                                <option value="Perches" <?php if($unit=="Perches"){echo "selected";} ?>>Perches</option>
                                <option value="Acres" <?php if($unit=="Acres"){echo "selected";} ?>>Acres</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">House Size</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" pattern="\d*" min="1"  name="house_size" value="<?php echo $house_size;?>" placeholder="House Size(sqft)" maxlength="15" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Bedrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" pattern="\d*" min="1" type="text" name="bedrooms" value="<?php echo $bed;?>" placeholder="Bedrooms" maxlength="5" required>
                    </div>

                    <h5 class="col-sm-2">Bathrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" pattern="\d*" min="1" type="text" name="bathrooms" value="<?php echo $bath;?>" placeholder="Bathrooms" maxlength="5" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Location (Address)</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="house_address" value="<?php echo $house_address?>" placeholder="Location (Address)" maxlength="200" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Description</h5>
                    <div class="col-sm-10">
                        <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" maxlength="5000" required><?php echo $description?></textarea>
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


                <input type="hidden" name="ad_id" value="<?php echo $ad_id; ?>">


                <!--Contact Details-->
                <?php include "include/edit_ad/user_contact.php"?>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-default" type="submit" name="houses">UPDATE YOUR AD</button>
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