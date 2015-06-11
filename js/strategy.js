$(function(){
    $("#futures_list tbody tr").on("click", function () {
        $rec = {futures_name:$(this).find("[data-title='Futures Name']").html(),
                futures_description:$(this).find("[data-title='Futures Description']").html(),
                id_futures:$(this).find("[data-title='Id Futures']").html(),
                futures_dec:$(this).find("[data-title='Futures Decimal Places']").html(),
                futures_prog:$(this).find("[data-title='Futures Strategy Name']").html(),
                fk_strategy:$(this).find("[data-title='Futures Strategy Id']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
            $("#futures_desc").html($rec.futures_description);
        });
        $("#futures_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);        
        $("#update-left").show();
            $("#delete-left").show();
            $("#reset-left").show();
            $("#new-left").hide();
        });    
    $("#reset-left").on("click",function(){
        $(this).hide();
        $("#update-left").hide();
        $("#delete-left").hide();
        $("#new-left").show();
        $("#id_strategy").val("");
        $("#futures_desc").html("");
    });
    $("#strategy_list tbody tr").on("click", function () {
        $rec = {strategy_name:$(this).find("[data-title='Strategy Name']").html(),                
                id_strategy:$(this).find("[data-title='Id Strategy']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
        });
        $("#strategy_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);        
        $("#update-right").show();
            $("#delete-right").show();
            $("#reset-right").show();
            $("#new-right").hide();
        });    
    $("#reset-right").on("click",function(){
        $(this).hide();
        $("#update-right").hide();
        $("#delete-right").hide();
        $("#new-right").show();
        $("#id_futures").val("");
    });
    
    $("#delete-left, #update-left, #new-left").on("click", function (){
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h4").html("Confirm Futures "+action);
        $("#notice-confirm-futures").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
        $("#notice-confirm-strategy").hide(); 
    });
    $("#delete-right, #update-right, #new-right").on("click", function (){
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h4").html("Confirm Strategy "+action);
        $("#notice-confirm-strategy").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
        $("#notice-confirm-futures").hide(); 
    });
    $("#notice-close, #notice-cancel").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});