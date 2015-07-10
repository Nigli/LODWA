$(function(){
    $("#user_list tbody tr").on("click", function () {
        var td = $(this).children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#" + key).val(value);
        });
        $("#user_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);
        $("#update").show();
        $("#delete").show();
        $("#reset").show();
        $("#new").hide();
    });
    $("#reset").on("click",function(){
        $(this).hide();
        $("#update").hide();
        $("#delete").hide();
        $("#new").show();
        $("#id_user").val("");
        $("#user_list_form tbody tr").removeClass("activetr");
    });    
    $("#delete, #update, #new").on("click", function (){    
        var empty = false;    
        $("input[type='number'], input[type='password']").each(function(){
            if($(this).val()===""){
                this.focus();
                empty = true;
            }
        });
        if(empty){
           return false;
        };
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Confirm "+rec_action);
        $("#notice-confirm").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
    });
    $("#notice-close, #notice-cancel").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
        $("#notice-span").html("");
    });
    if($("#admin_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("User Info has been successfully changed.");
        $("#notice-close").show();        
        $("#notice-confirm").hide(); 
        $("#notice-cancel").hide();
    } else if ($("#admin_note").val()==="notsent") {
	$(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("User Info has NOT been successfully changed. Please try again later.");
        $("#notice-close").show();        
        $("#notice-confirm").hide(); 
        $("#notice-cancel").hide();
    }
});