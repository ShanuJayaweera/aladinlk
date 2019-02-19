<div class="row">

    <div class="col-md-5">

        <h4 style="color:rgb(0,25,33);">Specifications<br></h4>
        <table class="table">

            <tbody style="font-size: 14px;">
            <tr>

                <td><strong>House Size</strong></td>
                <td><?php
                    if($row['house_size']=="0"){
                        echo "No Details";
                    }
                    else{
                        echo $row['house_size']." Sqft";
                    }
                    ?> </td>

            </tr>
            <tr>

                <td><strong>Land Size</strong></td>
                <td><?php
                    if($row['land_size']=="0"){
                        echo "No Details";
                    }
                    else{
                        echo $row['land_size'];
                    }
                    ?>
                    </td>

            </tr>
            <tr>

                <td><strong>Bedrooms</strong></td>
                <td><?php
                    if($row['bedrooms']=="0"){
                        echo "No Details";
                    }
                    else{
                        echo $row['bedrooms'];
                    }
                    ?></td>

            </tr>
            <tr>

                <td><strong>Bathrooms</strong></td>
                <td><?php
                    if($row['bathrooms']=="0"){
                        echo "No details";
                    }
                    else{
                        echo $row['bathrooms'];
                    }?></td>

            </tr>
            <tr>

                <td><strong>House Address</strong></td>
                <td><?php echo $row['house_address']?></td>

            </tr>

            </tbody>
        </table>
    </div>
    <div class="col-md-7">
        <h4 style="color:rgb(0,25,33);">Description<br></h4>
        <hr style="font-size:82px;height:1px;background-color:#e2a01a;">
        <p style="color: #707676; line-height: 1.71 font-family: 'Open Sans', sans-serif">
            <?php

            $text=$row['description'];
            $text=  nl2br($row['description']);
            echo $text;

            ?>
        </p>
    </div>
</div>