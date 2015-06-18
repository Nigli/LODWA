$(function(){
    $("#user_list tbody tr").on("click", function () {
        $rec = {status:$(this).find("[data-title='User Status']").text(),
                status_id:$(this).find("[data-title='Status Id']").text(),
                email:$(this).find("[data-title='Email']").text(),
                id_user:$(this).find("[data-title='User Id']").text()             
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
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
        $("input[type='number']").each(function(){
            if($(this).val()===""){
                event.preventDefault();
            }
        });
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
    });
});