$(function(){
    //izmeni novom super duper funkcijom iz receiver.js
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
    //functionf for selecting future strategy, populating right span
    $('#tr_form_future').on('change', function() {
        var value = $(this).val();
        $('#rightspan').load('process/strategy_name.php?f='+value);        
    });
    //when canceling tr, button submit is hidden, showing cxl, rpl, reset and radio button, 
    //shorter price input and other elements are disabled to change (css pointer event - none)
    $("#tr_form_cancel").on("click",function(){
        $("#tr_form_cancel, #tr_form_submit").hide();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep, #reset").show();        
        $("#tr_form_stop_loss, #tr_form_price_target").removeClass("prices");
        $("#tr_form_stop_loss, #tr_form_price_target").addClass("replace");
        //input number pointer none because radio button is input type
        $("select, input[type=number]").css('pointer-events','none');
    });
    //on reset removing reset, cxl, rpl and radio buttons, showing cancel new buttons
    //adding prices class to normalize input prices, removing cancel and replace color from prices, pointer events back to normal
    $("#reset").on("click",function(){
        $(this).hide();
        $("#tr_form_cancel, #tr_form_submit").show();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep ").hide();
        $("#tr_form_stop_loss, #tr_form_price_target").addClass("prices");        
        $("tbody tr").removeClass("activetr");
        $("input").removeClass("mark_as_red");
        $('.radio_rep').removeClass('radio_require');
        $("select, input[type=number]").css('pointer-events','auto');
    });
    $("input:radio[name='rpl_price']").on("change",function(){
        if ($(this).is(':checked') && $(this).val() == 'stop_loss') {
            $("#tr_form_stop_loss").addClass("mark_as_red").css('pointer-events','auto');
            $("#tr_form_price_target").removeClass("mark_as_red").css('pointer-events','none');
        }else {
            $("#tr_form_price_target").addClass("mark_as_red").css('pointer-events','auto');
            $("#tr_form_stop_loss").removeClass("mark_as_red").css('pointer-events','none');
        }
    });
    $("#tr_form_cxl, #tr_form_rpl, #tr_form_submit").on("click", function (){        
        var empty = false;
        if($(this).attr('id') === "tr_form_rpl"){
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
        if($("#tr_form_future").val()===null || $("#strategy_id").val()==0){
            $(".shade").show();
            $("#notice").show(); 
            $("#notice-title h3").html("Notice");
            $("#notice-span").html("Selected Future Contract is not in a Strategy list");     
            $("#notice-close").show();      
            $("#notice-entry-price").html("");
            $("#notice-stop-loss").html("");
            $("#notice-price-target").html("");  
            $("#notice-confirm").hide(); 
            $("#notice-cancel").hide();   
            empty = true;
        }
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
            if(price_target <= stop_loss){
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Stop Loss price is higher then Price Target! Your entry choice is BUY!");
                $("#notice-close").show();                
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }else {
            if(stop_loss <= price_target) {
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
            e.preventDefault(); 
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
    $("#to_bottom").on("click", function(){   
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    });
});