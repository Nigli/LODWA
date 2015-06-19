$(function(){
    $("#receiver_list tbody tr").on("click", function () {
        $rec = {type:$(this).find("[data-title='Receiver Type']").text(),
                type_id:$(this).find("[data-title='Receiver Type Id']").text(),
                first_name:$(this).find("[data-title='First Name']").text(),
                last_name:$(this).find("[data-title='Last Name']").text(),
                email:$(this).find("[data-title='Email']").text(),
                date_added:$(this).find("[data-title='Date Added']").text(),
                na_number:$(this).find("[data-title='NA Number']").text(),
                broker_acc:$(this).find("[data-title='Broker Account']").text(),
                id_receiver:$(this).find("[data-title='Receiver Id']").text()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
            if($rec.broker_acc==1){
                $("#broker_acc").prop('checked', true);
            }else{
                $("#broker_acc").prop('checked', false);
            };
        });
        $("#receiver_list tbody tr").removeClass("activetr");
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
        $("#id_receiver").val("");
        $("#receiver_list tbody tr").removeClass("activetr");
    });
    $("#delete, #update, #new").on("click", function (){
        var empty = false;
        $("input[type='email'], input[type='text']").each(function(){
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
        $("#notice-confirm-filter").hide();  
        $("#notice-close").hide(); 
    });
    $("#notice-close, #notice-cancel").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();        
        $("#notice-reset").hide();
        $("#notice-span").html("");
    });    
    $("#filterspan").on("click", function(){        
        $(".shade").show();
        $("#notice").show();        
        $("#receiver_list_filter").show();
        $("#notice-title h3").html("Filter");
        $("#notice-reset").show();
        $("#notice-confirm").hide();
        $("#notice-confirm-filter").show();  
        $("#notice-cancel").show();
    });
    $("#notice-cancel").on("click", function(){        
        $(".shade").hide();
        $("#notice").hide();
        $("#receiver_list_filter").hide();
        $("#notice-confirm").hide(); 
        $("#notice-cancel").hide();
    });
    $("#notice-reset").on("click",function(){
        $(this).hide();
        $("#receiver_list_type").val("0");
    });
    $("#notice-confirm").on("click", function (){
        $(".shade").show();        
        $("#notice").hide();
        $("#spinner").addClass("spinner");
    });
    $("input").on("keypress",function(e){
        if(e.which === 13){
            event.preventDefault();
        }
    });
    if($("#receiver_note").val()==="sent"){
        $(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Sucess!");
        $("#notice-span").html("Subscriber has been sucessfully changed/added.");
        $("#notice-close").show();
        $("#notice-confirm-filter").hide();  
        $("#notice-confirm").hide();
    } else if ($("#receiver_note").val()==="notsent") {
	$(".shade").show();        
        $("#notice").show();
        $("#notice-title h3").html("Unsucess!");
        $("#notice-span").html("Subscriber has NOT been sucessfully changed/added. Please try again later.");
        $("#notice-close").show();
        $("#notice-confirm-filter").hide();  
        $("#notice-confirm").hide();
    }
});