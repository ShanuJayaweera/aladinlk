<?php
include "include/image/image-upload.php";
?>
<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="include/posted/houses.php">
            <h4>Fill Your House Details</h4>
            <hr class="Line">
            <div class="col-lg-12">

                <div class="form-group">
                    <h5 class="col-sm-2">Title</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" placeholder="Title" maxlength="100" required  >
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Land Size</h5>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" pattern="\d*" min="1" name="land_size" placeholder="Land Size" maxlength="15" required>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="unit">
                            <optgroup label="Unit">
                                <option value="Perches" selected="">Perches</option>
                                <option value="Acres">Acres</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">House Size</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" pattern="\d*" min="1" name="house_size" placeholder="House Size (sqft)" maxlength="8" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Bedrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" pattern="\d*" min="1" name="bedrooms" maxlength="5" placeholder="Bedrooms" required>
                    </div>

                    <h5 class="col-sm-2">Bathrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" pattern="\d*" min="1" name="bathrooms" maxlength="5" placeholder="Bathrooms" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Location (Address)</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="house_address" placeholder="Location (Address)" maxlength="200" required>
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Description</h5>
                    <div class="col-sm-10">
                        <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" maxlength="5000" required></textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <h5 class="col-sm-2">Price (Rs)</h5>
                        <div class="col-sm-4">
                            <input class="form-control price" type="text" name="price" placeholder="Price (Rs)" id="price" maxlength="12" min="1" title="Price Format = 100.00">
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label class="control-label lable">
                                    <input type="checkbox" name="negotiable" class="negotiable"> Negotiable</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Contact Details-->
                <?php include "include/post_your_ad/user_contact.php"?>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-default" type="submit" name="houses">POST YOUR AD</button>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        //validate price
        $(".price").prop('required',true);

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