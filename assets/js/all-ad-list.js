$(document).ready(function() {

    filters();
});

function get_cat_area() {
    $.ajax({
        url: "include/filters/meta.php",
        method: "POST",
        dataType: "JSON",
        success: function (data) {

            $('.category_btn').html('');
            $('.area_btn').html('');
            $('.search').html('');

            $('.category_btn').append(data.category);
            $('.area_btn').append(data.area);
            $('.search').append(data.search);


        }
    });

}

function main_cat(value) {
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{cat_id:value},
        success:function (data) {
            return true;
        }
    });
}

function sub_cat(value) {
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{sub_category_id:value},
        success:function (data) {
            $("#category").modal('hide');

        }
    });
}

function main_area(value) {
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{area_id:value},
        success:function (data) {
            return true;
        }
    });
}

function sub_area(value) {
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{sub_area_id:value},
        success:function (data) {
            $("#area").modal('hide');
        }
    });
}

function all_area(para) {

    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{all_area:para},
        success:function(data){
            $("#area").modal('hide');
        }
    });
}

function all_cat(para) {
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{all_cat:para},
        success:function(data){
            $("#category").modal('hide');
        }
    });
}

function ad_information(filter_url) {
    $.ajax({
        url:filter_url,
        method:"POST",
        dataType:"JSON",
        success:function(data)
        {
            $(".ad_container").html('');
            if (!$.trim(data)){
                $('.ad_container').html('<h5>There are no results matching...</h5>');
            }
            else{
                $.each(data, function(key, value){

                    if(key!="pagination"){
                        $(".ad_container").append("<a href='advertisement/"+value.id+"/"+value.title_url+"' style='text-decoration: none;'><div id='products "+value.id+"' class='row list-group pointer ad_id'>" +
                            "<div class='item  col-xs-4 col-lg-4 grid-group-item list-group-item'>" +
                            "<img class='group list-group-image product-img' src='"+value.main_img+"' alt='Ad-img-"+value.id+"' />" +
                            "<div class='caption'>" +
                            "<h4 class='group inner list-group-item-heading' style='color: #001921;'>"+value.title+"</h4>" +
                            "<h6 class='group inner list-group-item-text'>"+value.sub_area_name+", "+value.sub_cat_name+"</h6>" +
                            "<h6 class='group inner list-group-item-text'>Rs : "+value.price+"</h6>" +
                            "<h6 class='group inner list-group-item-text' style='float: right; color: #001921;'> "+value.time_diff+" Minutes Ago.</h6>" +
                            "</div>" +
                            "</div></div></a>");
                    }

                });

                //create first page
                $('.first-page').addClass('pointer');


                //last page
                var total_rows = parseInt(data.pagination.total_rows, 10);
                var row_per_page = parseInt(data.pagination.row_per_page, 10);
                var current_page=parseInt(data.pagination.current_page, 10);

                var celi=Math.ceil(total_rows/row_per_page);

                $('.last-page').addClass('pointer');
                var id=$('.last-page').attr('id');


                if(id!=undefined){
                    var str=id.split(" ");
                    for (i = 0; i < str.length; i++) {
                        if(str[i].includes("page_")==true){
                            //remove id
                            $(".last-page").remove(str[i]);
                        }
                    }
                }
                //add  page no to last page
                $('.last-page').attr('id', 'page_'+celi);


                //next page
                if(current_page>=celi){

                    $('.next-page').removeClass('pointer');
                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".next-page").remove(str[i]);
                            }
                        }
                    }
                }
                else{
                    var id=$('.next-page').attr('id');
                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".next-page").remove(str[i]);
                            }
                        }
                    }


                    var next_page=current_page+1;
                    $('.next-page').addClass('pointer');
                    $('.next-page').attr('id', 'page_'+next_page);

                }

                //previous page
                if(current_page<=1){

                    $('.prev-page').removeClass('pointer');
                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".prev-page").remove(str[i]);
                            }
                        }
                    }
                }
                else{
                    var id=$('.prev-page').attr('id');
                    if(id!=undefined){
                        var str=id.split(" ");
                        for (i = 0; i < str.length; i++) {
                            if(str[i].includes("page_")==true){
                                //remove id
                                $(".prev-page").remove(str[i]);
                            }
                        }
                    }

                    var prev_page=current_page-1;
                    $('.prev-page').addClass('pointer');
                    $('.prev-page').attr('id', 'page_'+prev_page);
                }
            }


        }
    })
}

function p_session(page) {
    $.ajax({
        type:"post",
        url:"repository/pagination.php",
        data:{page_no:page},
        success:function(data){
            return true;
        }
    });
}

function filters() {
    //get session values
    $.ajax({
        url:"include/filters/get-sessions.php",
        method:"POST",
        dataType:"JSON",
        success:function(data)
        {
            var cat_id=data.cat_id;
            var area_id=data.area_id;
            var sub_area_id=data.sub_area_id;
            var sub_cat_id=data.sub_cat_id;


            if(cat_id=="false" && sub_cat_id=="false" && area_id=="false" && sub_area_id=="false"){
                get_cat_area();
                ad_information("include/filters/get-all-data.php");

            }
            else if(cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                get_cat_area();
                ad_information("include/filters/main-cat-data.php");
            }
            else if(sub_cat_id!="false" && area_id=="false" && sub_area_id=="false" ){
                get_cat_area();
                ad_information("include/filters/sub-cat-only.php");
            }
            else if(cat_id=="false" && sub_cat_id=="false" && area_id!="false"){
                get_cat_area();
                ad_information("include/filters/main-area-only.php");
            }
            else if(cat_id=="false" && sub_cat_id=="false" && sub_area_id!="false"){
                get_cat_area();
                ad_information("include/filters/sub-cat-only.php");
            }
            else if(cat_id!="false" && area_id!="false"){
                get_cat_area();
                ad_information("include/filters/main-area-cat.php");
            }
            else if(sub_cat_id!="false" && sub_area_id!="false"){
                get_cat_area();
                ad_information("include/filters/sub-area-cat.php");
            }
            else if(sub_cat_id!="false" && area_id!="false"){
                get_cat_area();
                ad_information("include/filters/main-area-sub-cat.php");
            }
            else if(cat_id!="false" && sub_area_id!="false"){
                get_cat_area();
                ad_information("include/filters/main-cat-sub-area.php");
            }
        }
    });





}

$('td').click(function(){


    if($(this).hasClass("sub_cat")==true) {
        //get sub cat
        var clicked=$(this).attr('id');
        clicked=clicked.replace("_subcat", "");
        clicked=clicked.trim();
        sub_cat(clicked);
        p_session(1);
        filters();

    }


    if($(this).hasClass("sub_area")==true) {

        var clicked=$(this).attr('id');
        clicked=clicked.replace("_subarea", "");
        clicked=clicked.trim();
        sub_area(clicked);
        p_session(1);
        filters();
    }

});

$('li').click(function () {

    var clicked=$(this).attr('id');

    if(clicked.includes("_maincat")){
        clicked=clicked.replace("_maincat", "");
        clicked=clicked.trim();

        main_cat(clicked);
        p_session();
        filters();

    }
    else if(clicked.includes("_mainarea")){
        clicked=clicked.replace("_mainarea", "");
        clicked=clicked.trim();

        main_area(clicked);
        p_session(1);
        filters();
    }
});

$('#search').click(function () {
    //get search value

    var search_bar = $('#search_bar').val();
    $.ajax({
        type:"post",
        url:"repository/create_session.php",
        data:{search:search_bar},
        success:function(data){
            p_session(1);
            filters();
        }
    });

});

$('a').click(function () {
    var clicked=$(this).attr('id');
    var click_class=$(this).attr('class');

    if(clicked=="all-cat"){
        all_cat("para");
        p_session(1);
        filters();
    }
    if(clicked=="all-area"){

        all_area("d");
        p_session(1);
        filters();

    }

    if($(this).hasClass("first-page")==true) {
        p_session(1);
        filters();
    }


    if($(this).hasClass("next-page")==true){

        //get id from element
        if(clicked!=undefined){
            var str=clicked.split(" ");
            for (i = 0; i < str.length; i++) {
                if(str[i].includes("page_")==true){
                    str[i]=str[i].replace("page_","");
                    str[i]=str[i].trim();
                    p_session(str[i]);
                    filters();
                }
            }
        }

    }
    if($(this).hasClass("prev-page")==true){

        //get id from element
        if(clicked!=undefined){
            var str=clicked.split(" ");
            for (i = 0; i < str.length; i++) {
                if(str[i].includes("page_")==true){
                    str[i]=str[i].replace("page_","");
                    str[i]=str[i].trim();
                    p_session(str[i]);
                    filters();
                }
            }
        }

    }
    if($(this).hasClass("last-page")==true){

        //get id from element
        if(clicked!=undefined){
            var str=clicked.split(" ");
            for (i = 0; i < str.length; i++) {
                if(str[i].includes("page_")==true){
                    str[i]=str[i].replace("page_","");
                    str[i]=str[i].trim();
                    p_session(str[i]);
                    filters();
                }
            }
        }

    }
});
