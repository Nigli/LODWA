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
    $("#tr_form_cancel").on("click",function(){
        $("#tr_form_cancel, #tr_form_submit").hide();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep, #reset").show();        
        $("#tr_form_stop_loss, #tr_form_price_target").removeClass("prices");
        $("#tr_form_stop_loss, #tr_form_price_target").addClass("replace");
        $("select, input[type=number]").css('pointer-events','none');
    });
    $("#reset").on("click",function(){
        $(this).hide();
        $("#tr_form_cancel, #tr_form_submit").show();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep ").hide();
        $("#tr_form_stop_loss, #tr_form_price_target").addClass("prices");        
        $("tbody tr").removeClass("activetr");
        $("input").removeClass("replace_selected");
        $("select, input[type=number]").css('pointer-events','auto');
    });
    $("input:radio[name='rpl_price']").on("change",function(){
        if ($(this).is(':checked') && $(this).val() == 'stop_loss') {
            $("#tr_form_stop_loss").addClass("replace_selected");
            $("#tr_form_price_target").removeClass("replace_selected");
        }else {
            $("#tr_form_price_target").addClass("replace_selected");
            $("#tr_form_stop_loss").removeClass("replace_selected");
        }
    });
    $("#tr_form_cxl, #tr_form_rpl, #tr_form_submit").on("click", function (){        
        var empty = false;
        if($(this).val() === "cxl_rpl"){
            if($('input:checked').length === 0){
                $('.radio_rep').addClass('radio_require');
                empty = true;
            };
        };
        $("input[type='number']").each(function(){
            if($(this).val()===""){
                this.focus();
                empty = true;
            }
        });
        if(empty){
           return false;
        }
        var future = $("#tr_form_future option:selected" ).text();
        var month = $("#tr_form_month").val();
        var year = $("#tr_form_year").val();
        var entry_choice = $("#tr_form_entry_choice").val();
        var entry_price = $("#tr_form_entry_price").val();
        var price_target = $("#tr_form_price_target").val();
        var stop_loss = $("#tr_form_stop_loss").val();
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Confirm "+tr_type);
        $("#notice-span").html("<strong>"+entry_choice+"</strong> "+future+" "+month+" "+year+"<br>");        
        $("#notice-entry-price").html("<strong>"+entry_choice+" (Entry):</strong> "+entry_price+"<br>");
        $("#notice-stop-loss").html("<strong>Stop Loss: </strong>"+stop_loss+"<br>");
        $("#notice-price-target").html("<strong>Price target: </strong>"+price_target);        
        $("#notice-confirm").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
        if(entry_choice === "BUY"){
            if(price_target < stop_loss){
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Stop Loss price is higher then Price Target! Your entry choice is BUY!");
                $("#notice-close").show();                
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }else {
            if(stop_loss < price_target) {
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Price Target is higher then Stop Loss price! Your entry choice is SELL!");
                $("#notice-close").show();                
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }    
    });    
    $('.radio_rep').on("click",function (){
        $('.radio_rep').removeClass('radio_require');
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
    $("input").on("keypress",function(e){
        if(e.which === 13){
            event.preventDefault();
        }
    });
    if($("#tr_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Successfull TR!");
        $("#notice-span").html("TR has been successfully sent.");
        $("#notice-close").show();
    } else if ($("#tr_note").val()==="notsent") {
	$(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Unsuccessfull TR!");
        $("#notice-span").html("TR has NOT been successfully sent. Please try again later.");
        $("#notice-close").show();
    }
});