<?php
try{

}
catch(Exception $e){

}
?>

<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" method="post">
            <h4>Fill Your Apartment Details</h4>
            <hr class="Line">
            <div class="col-lg-12">

                <div class="form-group">
                    <h5 class="col-sm-2">Title</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="title" placeholder="Title">
                    </div>
                </div>


                <div class="form-group">
                    <h5 class="col-sm-2">Size</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="house_size" placeholder="Size(sqft)">
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Bedrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="bedrooms" placeholder="Bedrooms">
                    </div>

                    <h5 class="col-sm-2">Bathrooms</h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="bathrooms" placeholder="Bathrooms">
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Address</h5>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="address" placeholder="Address">
                    </div>
                </div>

                <div class="form-group">
                    <h5 class="col-sm-2">Description</h5>
                    <div class="col-sm-10">
                        <textarea class="form-control txtarea" rows="10" cols="20" name="description" placeholder="Description" ></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <h5 class="col-sm-2">Price (Rs)</h5>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="price" placeholder="Price (Rs)">
                    </div>
                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label class="control-label lable">
                                <input type="checkbox" name="negotiable"> Negotiable</label>
                        </div>
                    </div>
                </div>


                <!--Contact Details-->
                <?php include "include/post_your_ad/user_contact.php"?>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-default" type="submit">POST YOUR AD</button>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>