
$(document).ready(function () {
    $('.content').load('include/verified_user.php');

    //Check Clicked Link
    $('#verified_user').click(function(){
        $('li').removeClass('active');
        $(this).addClass('active');
        $('.message').html('');
        $('.content').load('include/verified_user.php');
    });

    $('#non_verified_ad').click(function(){
        $('li').removeClass('active');
        $(this).addClass('active');
        $('.message').html('');
        $('.content').load('include/non_verified_ad(posted).php');
    });

    $('#post-ad').click(function(){

        $('li').removeClass('active');
        $(this).addClass('active');
        $('.content').load('include/dashboard/post-ad.php');

    });

    $('#view_exp_ads').click(function(){

        $('li').removeClass('active');
        $(this).addClass('active');
        $('.message').html('');
        $('.content').load('include/view_exp_ads.php');

    });

    $('#rm_non_posted').click(function(){

        $.ajax({
            type: "get",
            url: "include/rm_non_posted.php",
            data: {ad_id: 0},
            success: function (data) {

                $('.message').html('');
                $('.content').html('');
                alert("All Non Posted advertisement has been deleted.");
                $('.message').append(data);

            }

        });
    });

});

$( document ).ajaxComplete(function( event,request, settings ) {

    //remove all non verified user accounts
    $( ".remove_all_non_verified" ).click(function () {

            $.ajax({
                type: "POST", // Method type GET/POST
                url: "include/remove_all_non_verified_user.php", //Ajax Action url
                data: {},

                // Before call ajax you can do activity like please wait message
                beforeSend: function(xhr){
                    $('.message').html('Please Wait...');
                },

                //Will call if method not exists or any error inside php file
                error: function(qXHR, textStatus, errorThrow){
                },

                success: function(data, textStatus, jqXHR){
                    $('.message').html('');
                    $('li').removeClass('active');
                    $('#verified_user').addClass('active');
                    $('.content').load('include/verified_user.php');
                    $('.message').append(data);

                }
            });

    });

    //remove one user accounts
    $( ".remove_one_user" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("user_", "");
        clicked=clicked.trim();

        $.ajax({
            type: "GET", // Method type GET/POST
            url: "include/remove_one_user.php", //Ajax Action url
            data: {id:clicked},

            // Before call ajax you can do activity like please wait message
            beforeSend: function(xhr){
                $('.message').html('Please Wait...');
            },

            //Will call if method not exists or any error inside php file
            error: function(qXHR, textStatus, errorThrow){
            },

            success: function(data, textStatus, jqXHR){
                $('.message').html('');
                $('li').removeClass('active');
                $('#verified_user').addClass('active');
                $('.content').load('include/verified_user.php');
                $('.message').append(data);
            }
        });

    });




    //View Advertisement
    $( ".view_ad" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("view_", "");
        clicked=clicked.trim();

        $.ajax({
            type: "get",
            url: "include/view_ad.php",
            data: {ad_id: clicked},
            success: function (data) {

                $('.message').html('');
                $('.content').html('');
                $('li').removeClass('active');
                $('#non_verified_ad').addClass('active');
                $('.content').append(data);

            }

        });

    });


    //accept Advertisement
    $( ".accept_ad" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("accept_", "");
        clicked=clicked.trim();

        $.ajax({
            type: "get",
            url: "include/accept_ad.php",
            data: {ad_id: clicked},
            success: function (data) {
                $('li').removeClass('active');
                $(this).addClass('active');
                $('.message').html('');
                $('.message').append(data);
                $('.content').html('');
                $('.content').load('include/non_verified_ad(posted).php');
            }

        });

    });

    //remove ad
    $( ".remove_ad" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("remove_", "");
        clicked=clicked.trim();

        $.ajax({
            type: "get",
            url: "include/remove_ad.php",
            data: {ad_id: clicked},
            success: function (data) {

                $('li').removeClass('active');
                $(this).addClass('active');
                $('.message').html('');
                $('.message').append(data);
                $('.content').html('');
                $('.content').load('include/non_verified_ad(posted).php');

            }

        });

    });

    //remove ad
    $( ".remove_exp_ad" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("remove_exp", "");
        clicked=clicked.trim();

        $.ajax({
            type: "get",
            url: "include/remove_exp_ad.php",
            data: {ad_id: clicked},
            success: function (data) {

                $('li').removeClass('active');
                $(this).addClass('active');
                $('.message').html('');
                $('.message').append(data);
                $('.content').html('');
                $('.content').load('include/view_exp_ads.php');

            }

        });

    });

    //renew ad
    $( ".renew_exp_ad" ).click(function () {

        var clicked = $(this).attr('id');
        clicked=clicked.replace("renew_exp", "");
        clicked=clicked.trim();

        $.ajax({
            type: "get",
            url: "include/renew_exp_ad.php",
            data: {ad_id: clicked},
            success: function (data) {

                $('li').removeClass('active');
                $(this).addClass('active');
                $('.message').html('');
                $('.message').append(data);
                $('.content').html('');
                $('.content').load('include/view_exp_ads.php');

            }

        });

    });

});

