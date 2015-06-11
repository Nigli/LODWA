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
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h4").html("Confirm "+rec_action);
        $("#notice-confirm").show(); 
        $("#notice-cancel").show();        
        $("#notice-close").hide(); 
    });
    $("#notice-close, #notice-cancel").on("click", function (){
        $(".shade").hide();
        $("#notice").hide();
    });
});