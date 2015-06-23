$(function(){
    $("#change").on("click",function(){
        $("#profile input").removeAttr("readonly").removeClass("readonly");
        $(this).hide();
        $("#update").show();
        $("#cancel").show();
    });        
    $("#cancel").on("click",function(){
        $("#profile input").attr("readonly","readonly").addClass("readonly");
        $(this).hide();
        $("#update").hide();
        $("#change").show();        
    });   
    $("#update").on("click",function(){        
        $("#spinner").addClass("spinner");
    });  
    $("input").on("keypress",function(e){
        if(e.which === 13){
            event.preventDefault();
        }
    });
    if($("#profile_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Sender Info has been successfully changed.");
        $("#notice-close").show();
    } else if ($("#profile_note").val()==="notsent") {
	$(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Sender Info has NOT been successfully changed. Please try again later.");
        $("#notice-close").show();
    }
    $("#notice-close").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});