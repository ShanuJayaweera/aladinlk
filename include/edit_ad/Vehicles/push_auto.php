<?php
require_once 'repository/aladinlk-function.php';

try{
    $title="";
    $description="";
    $condition="";
    $price="";

//get advertisement details from database
    $ad=all_data_from_table($ad_id);

    if (mysqli_num_rows($ad)>0) {
        while ($row=mysqli_fetch_assoc($ad)) {

            $title=$row['title'];
            $description=$row['description'];
            $condition=$row['vehicle_condition'];
            $price=$row['price'];
            $image_path=$row['image_path'];
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
<div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="include/edited/push_auto.php">
                    <div class="col-lg-12">
                        <div class="col-md-12">

                            <div class="row">

                                    <h4>Fill in the Details</h4>
                                    <hr class="Line">


                                <div class="form-group">
                                    <h5 class="col-sm-2">Condition</h5>
                                    <div class="col-sm-10">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Used" <?php if($condition=="Used"){ echo "checked";} ?> required>Used
                                    </label>
                                </span>
                                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="New" <?php if($condition=="New"){ echo "checked";} ?> required>New
                                    </label>
                                </span>
                                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" required value="Recondition" <?php if($condition=="Recondition"){ echo "checked";} ?>>Recondition
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
                                        <button class="btn btn-default" type="submit" name="push">UPDATE YOUR AD</button>
                                    </div>
                                </div>
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
