<div class="col-md-8">

    <h4 style="color:rgb(0,25,33);">Description<br></h4>
    <hr style="height:1px;background-color:#e2a01a;">
    <p style="color: #707676; line-height: 1.71 font-family: 'Open Sans', sans-serif">
        <?php

        $text=$row['description'];
        $text=  nl2br($row['description']);
        echo $text;

        ?>
    </p>
</div>