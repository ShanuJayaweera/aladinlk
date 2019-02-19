<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell brand new or used cars, vans, mobile phones, laptops, houses, lands and any kind of thing. We are ready to find your real customers. Aladin is your free classified web marketplace.">
    <meta name="google-site-verification" content="Fh4DRYDpSAo_POX_MTf-C0znYZyuT8m0eMiBzdkJzS8" />
    <title>Contact aladin</title>
    <meta name="theme-color" content="#e2a01a">
    <link href="https://www.aladinlk.com/favicon.png" rel="shortcut icon" type=image/x-icon>
    <link href="https://www.aladinlk.com/favicon.png" rel=icon type=image/x-icon>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/contact.min.css">
    <link rel="stylesheet" href="https://www.aladinlk.com/assets/css/styles.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            //send data to contact us page in repository
            $('form').on('submit', function(e) { //use on if jQuery 1.7+
              e.preventDefault();  //prevent form from submitting
              var name=$('#name').val();
              var email=$('#email').val();
              var subject=$('#subject').val();
              var message=$('#message').val();
              $.ajax({
                 type:"post",
                 url:"repository/contact-us.php",
                 data:{name:name,email:email,subject:subject,message:message},
                  success: function (data) {
                     $('.contact-msg').append(data);
                  }
              });
            });
        });
    </script>

</head>

<body>
<?php include "include/nav-bar.php"?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron product-month" style="height:247px;">
                <div class="work-month">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-5 col-sm-5 col-sm-offset-7" style="height:234px;font-family:Roboto, sans-serif;">
                            <h1 style="color:rgb(247,243,243);">Contact Us</h1>
                            <h3 class="hidden-sm" style="margin-top:6px;color:rgb(247,232,232);"><br>Buy and Sell Your Amazing Product or Service<br></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="contact" method="post">
                        <div class='contact-msg'>

                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="name">
                                        Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" maxlength="100" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email Address</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" maxlength="80" required="required" /></div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="service">Customer Service</option>
                                        <option value="suggestions">Suggestions</option>
                                        <option value="product">Product Support</option>
                                        <option value="product">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" maxlength="2000" required="required"
                                              placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "include/footer.php"?>
</body>
</html>