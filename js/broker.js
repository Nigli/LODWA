$(function(){
    $("#change").on("click",function(){
        $("#profile input").removeAttr("readonly").removeClass("readonly");
        $(this).hide();
        $("#update").show();
    });
});


