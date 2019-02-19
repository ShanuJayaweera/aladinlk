<div class="promo">
    <div class="jumbotron header-jumb">
        <?php
        if($current_page=="index.php"){
        ?>
            <h3 class="header-h3">Welcome to Aladin Home</h3>
        <?php
        }
        ?>
        <h4 class="text-center head" style="color: #FFFFFF">Buy or sell Your Amazing Product or Service.</h4>
        <br>
        <div class="form-group form-horizontal col-sm-12 header-search">
            <div class="col-md-3">
                <button style="background-color: #FFFFFF; color: #e2a01a;" class="btn category_btn form-control" type="button" data-target="#category" data-toggle="modal" >
                    <?php
                    if ($current_page!="post-your-ad.php"){

                    }
                    ?>
                </button>
            </div>

            <div class="col-md-3">
                <button style="background-color: #FFFFFF; color: #e2a01a;" class="btn area_btn form-control" type="button" data-target="#area" data-toggle="modal">

                </button>
            </div>


            <div class="col-md-5"><input type="text" placeholder="Search" value="<?php if (isset($_SESSION['search'])){echo $_SESSION['search'];} ?>" class="form-control search" name="search_bar" id="search_bar"></div>
            <div class="col-md-1"><button style="background-color: #FFFFFF; color: #e2a01a;" class="btn form-control" type="button" name="search" id="search">Search </button></div>
        </div>
    </div>
</div>