$(function(){ 
    $("tbody tr").on("click", function () {
        $tr_form = {tr_form_future:$(this).find("[data-title='Id Futures']").html(),
                    tr_form_entry_choice:$(this).find("[data-title='Entry Choice']").html(),
                    tr_form_entry_price:$(this).find("[data-title='Entry Price']").html(),
                    tr_form_price_target:$(this).find("[data-title='Price Target']").html(),
                    tr_form_stop_loss:$(this).find("[data-title='Stop Loss']").html(),
                    tr_form_num_contr:$(this).find("[data-title='Number of Contracts']").html(),
                    tr_form_duration:$(this).find("[data-title='Duration']").html(),
                    tr_form_month:$(this).find("[data-title='Month']").html(),
                    tr_form_year:$(this).find("[data-title='Year']").html(),
                    rightspan:$(this).find("[data-title='Strategy name']").html()
                };
        $.each($tr_form, function(key, value){
            $("#"+key).val(value);
            $("#rightspan").html("Selected strategy: "+$tr_form.rightspan);
        });
        $("tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);
    });
    $('#tr_form_future').on('change', function() {
        var value = $(this).val();
        $('#rightspan').load('process/strategy_name.php?f='+value);
    });
    $("#tr_form button").on("click", function (){
        var future = $("#tr_form_future option:selected" ).text();
        var month = $("#tr_form_month").val();
        var year = $("#tr_form_year").val();
        var entry_choice = $("#tr_form_entry_choice").val();
        var entry_price = $("#tr_form_entry_price").val();
        var price_target = $("#tr_form_price_target").val();
        var stop_loss = $("#tr_form_stop_loss").val();
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h4").html("Confirm "+tr_type);
        $("#notice-span").html(""+entry_choice+" "+future+" "+month+" "+year+"<br> At: "+entry_price+" Price target: "+price_target+" Stop Loss "+stop_loss+"");
        $("#notice-confirm").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
        if(entry_choice === "BUY"){
            if(price_target < stop_loss){
                $("#notice-title h4").html("Notice!");
                $("#notice-span").html("Stop Loss price is higher then Price Target! Your entry choice is BUY!");
                $("#notice-close").show();                
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }else {
            if(stop_loss < price_target) {
                $("#notice-title h4").html("Notice!");
                $("#notice-span").html("Price Target is higher then Stop Loss price! Your entry choice is SELL!");
                $("#notice-close").show();                
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }    
    });
    $("#notice-confirm").on("click", function (){
        $(".shade").show();        
        $("#notice").hide();
        $("#spinner").addClass("spinner");
    });
    $("#notice-close, #notice-cancel").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});