<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://www.aladinlk.com/assets/css/Navigation-with-Button.css">
<div>
    <nav class="navbar navbar-default navigation-clean-button" style="background-color:#ffffff;">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand" href="/index" style="font-family:Lobster, cursive !important;font-size:30px;color:#e2a01a;"> <img src="https://www.aladinlk.com/assets/img/logo.png" class="logoimg" alt="aladinlk-logo"></a><button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav_hover" role="presentation"><a href="/index" style="font-size:13px;color:#000000;"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a></li>
                    <?php
                    if(isset($_SESSION['Login_Status'])){
                    if($_SESSION['Login_Status']==true){
                        echo "<li class='nav_hover' role='presentation'><a href='/repository/logout.php' style='font-size:13px;color:#000000;'><i class='glyphicon glyphicon-user'></i>&nbsp;Log Out</a></li>";
                        echo "<li class='nav_hover' role='presentation'><a href='/dashboard.php' style='font-size:13px;color:#000000;'><i class='glyphicon glyphicon-folder-open'></i>&nbsp;My Account</a></li>";
                    }
                    else{
                        echo "<li class='nav_hover' role='presentation'><a href='/login.php' style='font-size:13px;color:#000000;'><i class='glyphicon glyphicon-user'></i>&nbsp;Log in</a></li>";
                        echo "<li class='nav_hover' role='presentation'><a href='/aladinlk-user-registration.php' style=\"font-size:13px;color:#000000;\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;New account</a></li>";
                    }
                    }
                    else{
                        echo "<li class='nav_hover' role='presentation'><a href='/login.php' style='font-size:13px;color:#000000;'><i class='glyphicon glyphicon-user'></i>&nbsp;Log in</a></li>";
                        echo "<li class='nav_hover' role='presentation'><a href='/aladinlk-user-registration.php' style=\"font-size:13px;color:#000000;\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;New account</a></li>";
                    }
                    ?>

                </ul>
                <p class="navbar-text navbar-right actions">
                    <a class="btn btn-default action-button" role="button" href="/repository/aladinlk-all-ads.php" style="background-color:#e2a01a;font-size:14px;margin-right:1px;">All Ads</a>
                    <a class="btn btn-default action-button" role="button" href="/dashboard.php" style="background-color:#e2a01a;font-size:14px;">Post Your Ad</a>
                </p>
            </div>
        </div>
    </nav>

    <div class="hidden-md hidden-lg hidden-sm col-sm-12" style="margin-top: 2px; margin-bottom: 2px;">

        <div class="col-xs-6"><a class="btn btn-block" href="/index" style="color: black;">Home</a></div>
        <div class="col-xs-6"><a class="btn btn-block" href="/repository/aladinlk-all-ads.php" style="color: black">All Ads </a></div>
        <br><br>
    </div>
</div>