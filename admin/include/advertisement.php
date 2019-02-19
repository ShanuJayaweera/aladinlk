
    <div class="card">

                <div class="preview col-md-12">

                    <div class="preview-pic tab-content">
                        <?php
                        $tok = strtok($image_path, "|");

                        $main_img=main_img($ad_id);

                        $tab=0;

                        while ($tok !== false) {
                            $tab=$tab+1;
                            if($tok==$main_img){
                                echo "<div class='tab-pane active' id='pic-".$tab."'><img src='".$tok."' /></div>";
                                $tumb[$tab]=$tumb_path. basename($tok);
                            }
                            else{
                                echo "<div class='tab-pane' id='pic-".$tab."'><img src='".$tok."' /></div>";
                                $tumb[$tab]=$tumb_path. basename($tok);
                            }

                            $image_name="";
                            $tok = strtok("|");
                        }
                        ?>
                    </div>

                    <ul class="preview-thumbnail nav nav-tabs">

                        <?php

                        foreach($tumb as $x=>$path)
                        {
                            if($x==1){
                                echo "<li class='active'><a data-target='#pic-".$x."' data-toggle='tab'><img src='https://www.aladinlk.com/".$path."' /></a></li>";
                            }
                            else{
                                echo "<li><a data-target='#pic-".$x."' data-toggle='tab'><img src='https://www.aladinlk.com/".$path."' /></a></li>";
                            }

                        }

                        ?>

                    </ul>

                    <br>

                </div>
                <div class="details col-md-12">
                    <h4 class="product-title"><?php echo $title; ?></h4>
                    <h5 style="color:rgb(0,25,33); margin-bottom: 1em;"> <strong style="color: #e2a01a;">For sale by </strong> <?php echo customer_name($row['user_id']) ?> ,<?php echo sub_area_name($ad_id); ?>,&nbsp; <?php echo main_area_name($row['sub_area_id'])?>.  &nbsp; <?php echo sub_category($ad_id)?></h5>

                    <h5>&nbsp;<i class="glyphicon glyphicon-map-marker"></i>&nbsp;<?php echo $address?></h5>
                    <h5 style="margin-bottom:22px;">&nbsp;<i class="glyphicon glyphicon-calendar"></i>&nbsp; Posted at <?php echo $row['modified']?></h5>
                    <h4 style="margin-bottom:22px; color: #a92222">&nbsp;<i class="fa fa-dollar"></i>&nbsp; Price - Rs: <?php echo $row['price']?></h4>
                </div>

            <?php
            include "../../include/ad_content/content_item/specification/".$tbl_name.".php";
            echo "<button class='accept_ad btn btn-default' id='accept_".$ad_id."'>Accept Ad</button>
                  <button class='reject_ad btn btn-default' id='reject_".$ad_id."'>Reject Ad</button>
                  <button class='remove_ad btn btn-default' id='remove_".$ad_id."'>Remove Ad</button>";
            ?>

    </div>





<style>

    /*****************globals*************/

    .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }
    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px; } }

    .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1; }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px; }
    .preview-thumbnail.nav-tabs li {
        width: 18%;
        margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block; }
    .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0; }

    .tab-content {
        overflow: hidden; }
    .tab-content img {
        width: 100%;
        -webkit-animation-name: opacity;
        animation-name: opacity;
        -webkit-animation-duration: .3s;
        animation-duration: .3s; }

    .card {
        padding-top: 2em;
        padding-bottom: 2em;
        padding-left: 0px;
        padding-right: 0px;
        line-height: 1.5em !important; }

    @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex; } }

    .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }

    .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1; }

    .product-title, .price, .sizes, .colors {
        text-transform: UPPERCASE;
        font-weight: bold; }

    .checked, .price span {
        color: #e2a01a; }

    .product-title, .rating, .product-description, .price, .vote, .sizes {
        margin-bottom: 0px; }

    .product-title {
        margin-top: 0; }

    .size {
        margin-right: 10px; }
    .size:first-of-type {
        margin-left: 40px; }

    .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px; }

    .color:first-of-type {
        margin-left: 20px; }

    .add-to-cart, .like {
        background: #001921;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #e2a01a;
        -webkit-transition: background .3s ease;
        transition: background .3s ease; }
    .add-to-cart:hover, .like:hover {
        background: #e2a01a;
        color: #001921; }

    .not-available {
        text-align: center;
        line-height: 2em; }
    .not-available:before {
        font-family: fontawesome;
        content: "\f00d";
        color: #fff; }

    .orange {
        background: #ff9f1a; }

    .green {
        background: #85ad00; }

    .blue {
        background: #0076ad; }

    .tooltip-inner {
        padding: 1.3em; }

    @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1); } }

    @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1); } }

    /*# sourceMappingURL=style.css.map */
</style>
