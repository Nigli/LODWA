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
    ("#update").on("click",function(){        
        $("#spinner").addClass("spinner");
    }); 
    $("input").on("keypress",function(e){
        if(e.which === 13){
            event.preventDefault();
        }
    });
    if($("#broker_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Sucess!");
        $("#notice-span").html("Broker Info has been sucessfully changed.");
        $("#notice-close").show();
    } else if ($("#broker_note").val()==="notsent") {
	$(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Unsucess!");
        $("#notice-span").html("Broker Info has NOT been sucessfully changed. Please try again later.");
        $("#notice-close").show();
    }
    $("#notice-close").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});