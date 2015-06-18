$(function(){
    $("#futures_list tbody tr").on("click", function () {
        $rec = {futures_name:$(this).find("[data-title='Futures Name']").text(),
                futures_description:$(this).find("[data-title='Futures Description']").text(),
                id_futures:$(this).find("[data-title='Id Futures']").text(),
                futures_dec:$(this).find("[data-title='Futures Decimal Places']").text(),
                futures_prog:$(this).find("[data-title='Futures Strategy Name']").text(),
                fk_strategy:$(this).find("[data-title='Futures Strategy Id']").text()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
            $("#futures_desc").html($rec.futures_description);
        });
        $("#futures_list tbody tr").removeClass("activetr");
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
        $("#futures_desc").html("");                
        $("#futures_list tbody tr").removeClass("activetr");
    });
    $("#strategy_list tbody tr").on("click", function () {
        $rec = {strategy_name:$(this).find("[data-title='Strategy Name']").text(),                
                id_strategy:$(this).find("[data-title='Id Strategy']").text()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
        });
        $("#strategy_list tbody tr").removeClass("activetr");
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
        $("#strategy_list tbody tr").removeClass("activetr");
    });
    
    $("#delete-right, #update-right, #new-right").on("click", function (){
        var empty = false;
        $("#right input[type='text'], #right input[type='number'], textarea").each(function(){
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
        $("#notice-title h3").html("Confirm Futures "+action);
        $("#notice-confirm-futures").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
        $("#notice-confirm-strategy").hide(); 
    });
    $("#delete-left, #update-left, #new-left").on("click", function (){
        var empty = false;
        $("#left input[type='text']").each(function(){
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
        $("#notice-title h3").html("Confirm Strategy "+action);
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