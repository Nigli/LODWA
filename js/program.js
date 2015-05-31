$(function(){
    $("#futures_list tbody tr").on("click", function () {
        $rec = {futures_name:$(this).find("[data-title='Futures Name']").html(),
                futures_description:$(this).find("[data-title='Futures Description']").html(),
                id_futures:$(this).find("[data-title='Id Futures']").html(),
                futures_dec:$(this).find("[data-title='Futures Decimal Places']").html(),
                futures_prog:$(this).find("[data-title='Futures Program Name']").html()
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
        $("#id_program").val("");
        $("#futures_desc").html("");
    });
    $("#program_list tbody tr").on("click", function () {
        $rec = {program_name:$(this).find("[data-title='Program Name']").html(),                
                id_program:$(this).find("[data-title='Id Program']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
        });
        $("#program_list tbody tr").removeClass("activetr");
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
});