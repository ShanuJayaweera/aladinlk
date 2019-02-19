<?php
session_start();
?>
<!--My Account Section in Dashboard-->
<div id="My_Account">
    <h4>My Account Details</h4>
    <hr>
    <form class="form-horizontal">
        <div class="col-sm-4">
            <div class="thumbnail"><img src="<?php
                if ($_SESSION['Login_Status']==true && isset($_SESSION['auth_Provider'])) {
                    if ($_SESSION['auth_Provider']=='Google') {
                        //Code for Email Authentication
                        echo $_SESSION['picture'];
                    }
                    else{

                    }
                }
                ?>">

            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <h5 class="col-sm-3">Name</h5>
                <div class="col-sm-9">
                    <h5><?php echo $_SESSION['user_name']?></h5>
                </div>
            </div>
            <div class="form-group">
                <h5 class="col-sm-3">E-Mail</h5>
                <div class="col-sm-9">
                    <h5><?php echo $_SESSION['email']?></h5>
                </div>
            </div>

        </div>
    </form>
</div>

<!--My Account Section in Dashboard has end-->