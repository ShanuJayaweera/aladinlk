
<div class="row">
    <div class="col-md-5">
        <h4 style="color:rgb(0,25,33);">Specifications<br></h4>
        <table class="table">

            <tbody style="font-size: 14px; ">
            <tr>

                <td><strong>Vehicle Condition</strong></td>
                <td><?php echo $row['vehicle_condition']?></td>

            </tr>
            <?php
            if($row['mileage']=="0" || empty($row['mileage'])){

            }
            else{
                ?>
                <tr>

                    <td><strong>Mileage</strong></td>
                    <td><?php echo $row['mileage'];?> Km</td>

                </tr>
                <?php
            }
            ?>

            <tr>

                <td><strong>Fuel Type</strong></td>
                <td><?php echo $row['fuel_type']?></td>

            </tr>
            <tr>

                <td><strong>Brand</strong></td>
                <td><?php echo $row['brand']?></td>

            </tr>
            <tr>

                <td><strong>Model</strong></td>
                <td><?php echo $row['model']?></td>

            </tr>
            <tr>

                <td><strong>Edition(Trim)</strong></td>
                <td><?php echo $row['edition']?></td>

            </tr>
            <tr>

                <td><strong>Model Year</strong></td>
                <td><?php
                    if($row['Model_year']=="Model Year"){
                        echo "Not Given Data";
                    }
                    else{
                        echo $row['Model_year'];
                    }
                    ?></td>

            </tr>
            <tr>

                <td><strong>Body Type</strong></td>
                <td><?php
                    if($row['body_type']=="Body Type"){
                        echo "Not Given Data";
                    }
                    else{
                        echo $row['body_type'];
                    }
                        ?></td>

            </tr>
            <tr>

                <td><strong>Engine Capacity</strong></td>
                <td><?php
                    if($row['engine_capacity']=="0"){
                        echo "Not Given Data";
                    }
                    else{
                        echo $row['engine_capacity']." cc";
                    }
                    ?> </td>

            </tr>
            <tr>

                <td><strong>Transmission</strong></td>
                <td><?php echo $row['transmission']?></td>

            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-7">

        <h4 style="color:rgb(0,25,33);">Description<br></h4>
        <hr style="font-size:82px;height:1px;background-color:#e2a01a;">
        <p style="color: #707676; line-height: 1.71; font-family: 'Open Sans', sans-serif">
        <?php

        $text=$row['description'];
        $text=  nl2br($row['description']);
        echo $text;

        ?>
        </p>
    </div>


</div>
