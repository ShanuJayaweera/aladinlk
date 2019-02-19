<?php
include "include/image/image-upload.php";
?>
<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="include/posted/mobile_phone.php">
            <h4>Fill Your Mobile Phone Details</h4>
            <hr class="Line">
            <div class="col-lg-12">
                <div class="form-group">
                    <h5 class="col-sm-2">Condition</h5>
                    <div class="col-sm-10">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="Used" required>Used
                                    </label>
                                </span>
                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="condition" value="New" required>New
                                    </label>
                                </span>

                    </div>
                </div>

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
                            <h5 class="col-sm-2">Edition</h5>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="edition" placeholder="Edition" maxlength="40" required >
                            </div>
                        </div>



                <div class="form-group">
                    <h5 class="col-sm-2">Authenticity</h5>
                    <div class="col-sm-10">
                                <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="authenticity" value="Original" required>Original
                                    </label>
                                </span>
                        <span>
                                    <label class="control-label radio-inline lable">
                                        <input type="radio" name="authenticity" value="Replica" required>Replica
                                    </label>
                                </span>

                    </div>
                </div>





                        <div class="form-group">
                            <h5 class="col-sm-2">Description</h5>
                            <div class="col-sm-10">
                                <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" maxlength="5000" required></textarea>
                            </div>
                        </div>
                <div class="form-group">
                <div class="col-md-2"><h5>Features </h5></div>
                <div class="col-md-10">


                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch1" value="Bluetooth"> Bluetooth</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch2" value="Dual-lens Camera"> Dual-lens Camera</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch3" value="Expandable Memory"> Expandable Memory</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch4" value="GPS"> GPS</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch5" value="Fingerprint Sensor"> Fingerprint Sensor</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch6" value="Motion Sensors"> Motion Sensors</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch7" value="Touch Screen"> Touch Screen</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch8" value="Camera"> Camera</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch9" value="Dual SIM"> Dual SIM</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch10" value="Physical Keyboard"> Physical Keyboard</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch11" value="3G"> 3G</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch12" value="4G"> 4G</label>
                            </div>
                            <div class="checkbox">
                                <label class="control-label features">
                                    <input type="checkbox" name="ch13" value="GSM"> GSM</label>
                            </div>
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
                                <button class="btn btn-default" type="submit" name="mobile_phone">POST YOUR AD</button>
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