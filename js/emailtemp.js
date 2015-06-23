$(function(){
    $("#change").on("click",function(){
        $("#emailtemp td textarea").removeAttr("disabled").removeClass("readonly");
        $(this).hide();
        $("#update").show();
        $("#cancel").show();
    });        
    $("#cancel").on("click",function(){
        $("#emailtemp td textarea").attr("disabled", "disabled").addClass("readonly");
        $(this).hide();
        $("#update").hide();
        $("#change").show();        
    });
    $("#update").on("click",function(){        
        $("#spinner").addClass("spinner");
    }); 
    if($("#emailtemp_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Email Template has been successfully changed.");
        $("#notice-close").show();
    } else if ($("#emailtemp_note").val()==="notsent") {
	$(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Email Template has NOT been successfully changed. Please try again later.");
        $("#notice-close").show();
    }
    $("#notice-close").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});