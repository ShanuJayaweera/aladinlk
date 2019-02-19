<?php
//get user contact from database
$customer_details="SELECT customer_details.telephone,customer_details.address,customer_details.email
FROM advertisement
RIGHT OUTER JOIN customer_details
ON advertisement.id=customer_details.ad_id where advertisement.id=".$ad_id.";";

$result=mysqli_query(DBConnection(),$customer_details);

$address="";
$email="";
$telephone="";

if(mysqli_num_rows($result)){
    if($row=mysqli_fetch_assoc($result)){
        $address=$row['address'];
        $email=$row['email'];
        $telephone=$row['telephone'];
    }
}

//check telephone number

//get images to an array
$tp = explode("|", $telephone);
//removing null values in img_arr
$tp = array_filter($tp);

?>
<hr>
    <h4>Contact Details</h4>
<br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>Name : <?php echo $_SESSION['user_name']; ?></h5></div>
        <div class="panel-body">
            <div class="form-group">
                <h5 class="col-md-3">Address </h5>
                <div class="col-md-9">
                    <input class="form-control" type="text" name="address" placeholder="Address" value="<?php echo $address ?>" maxlength="200" required>
                </div>

            </div>
            <div class="form-group">
                <h5 class="col-md-3">Email </h5>
                <div class="col-md-6">
                    <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email'] ?>"  inputmode="email" placeholder="Email" maxlength="80" required>
                </div>

            </div>
            <div class="form-group">
                <h5 class="col-md-3">Telephone Number </h5>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="telephone" minlength="10" value="<?php echo $tp[0] ?>" placeholder="Telephone Number" pattern="^[0-9]+$" maxlength="15" title="Please Use 0711234567 or 94759546823 Format" required>
                </div>


            </div>
            <input type="hidden" name="new_tp" value="">
        </div>
    </div>

