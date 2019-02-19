<?php
include "include/image/image-upload.php";
?>

<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="include/posted/cars.php">
            <div class="col-lg-12">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Fill Your Car Details</h4>
                            <hr class="Line">
                            <div class="form-group">
                                <h5 class="col-sm-2">Title</h5>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" placeholder="Title" maxlength="100" required  >
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Brand </h5>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="brand" placeholder="Brand" maxlength="50" required >
                                </div>

                                <h5 class="col-sm-1">Model</h5>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="model" placeholder="Model" maxlength="80" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Edition (optional)</h5>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="edition" placeholder="Edition" maxlength="40">
                                </div>

                                <h5 class="col-sm-1">Model Year</h5>
                                <div class="col-sm-5">
                                    <select class="form-control col-sm-9" name="model_year" required>
                                        <optgroup label="Model Year">
                                            <?php
                                            for ($x = 2019; $x >= 1960; $x--) {
                                                echo "<option value='$x'>$x</option>";
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
                                        <input type="radio" name="condition" value="Used" required>Used
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable" >
                                        <input type="radio" name="condition" value="New" required>New
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Recondition" required>Recondition
                                    </label>
                                </span>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Mileage (KM)</h5>
                                <div class="col-sm-4">
                                    <input class="form-control" name="mileage" placeholder="Mileage (KM)" type="text" pattern="\d*" maxlength="12" min="1" required>
                                </div>
                                <h5 class="col-sm-2">Engine Capacity (CC)</h5>
                                <div class="col-sm-4">
                                    <input class="form-control" name="cc" placeholder="Engine Capacity (CC)" type="text" pattern="\d*" maxlength="12" min="1" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Body Type (optional)</h5>
                                <div class="col-sm-4">
                                    <select class="form-control col-sm-9" name="body_type">
                                        <option value="Body Type">Body Type</option>
                                        <option value="Saloon">Saloon</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Station Wagon">Station Wagon</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Couple/Sport">Couple/Sport</option>
                                        <option value="SUV/4*4">SUV/4*4</option>
                                        <option value="MPV">MPV</option>

                                    </select>
                                </div>
                                <h5 class="col-sm-2">Transmission </h5>
                                <div class="col-sm-4">
                                    <select class="form-control col-sm-9" name="transmission" required>
                                        <optgroup label="Transmission">
                                            <option value="Automatic">Automatic</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Tiptronic">Tiptronic</option>
                                            <option value="CVT">CVT</option>
                                            <option value="Other Transmission">Other Transmission</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                           <br>
                            <div class="form-group">
                                <h5 class="col-sm-2">Fuel Type</h5>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Diesel" required>Diesel
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Petrol" required>Petrol
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Electric" required>Electric
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Hybrid" required>Hybrid
                                    </label>
                                </span>
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="fuel_type" value="Other Type" required>Other Fuel Type
                                    </label>
                                </span>
                            </div>

                            <div class="form-group">
                                <h5 class="col-sm-2">Description</h5>
                                <div class="col-sm-10">
                                    <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" maxlength="4000" required></textarea>
                                </div>
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
                                <button class="btn btn-default" type="submit" name="car">POST YOUR AD</button>
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
        //validate price
        $(".price").prop('required',true);

        if ($(".negotiable").is(":checked")) {
            $(".price").attr("disabled", "disabled");
            $(".price").prop('required',false);

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

    //check is image has been uploaded

</script>