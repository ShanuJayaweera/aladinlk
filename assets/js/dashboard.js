

$(document).ready(function () {
    $('.content').load('include/dashboard/post-ad.php');

    //Check Clicked Link
    $('#my-acc').click(function(){
        $('li').removeClass('active');
        $(this).addClass('active');
        $('.content').load('include/dashboard/my_account.php');
    });

    $('#my-ad').click(function(){
        $('li').removeClass('active');
        $(this).addClass('active');
        $('.content').load('include/dashboard/my-ads.php');
    });

    $('#post-ad').click(function(){

        $('li').removeClass('active');
        $(this).addClass('active');
        $('.content').load('include/dashboard/post-ad.php');

    });

});