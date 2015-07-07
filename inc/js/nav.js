$(function(){
    $(".respons").on("click", function(){
        $("#header-nav").toggle();
        $(".shade").toggle();
        $(this).toggleClass("icon_active");
    });
});