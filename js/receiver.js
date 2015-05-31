$(function(){
    $("#receiver_list tbody tr").on("click", function () {
        $rec = {type:$(this).find("[data-title='Receiver Type']").html(),
                first_name:$(this).find("[data-title='First Name']").html(),
                last_name:$(this).find("[data-title='Last Name']").html(),
                email:$(this).find("[data-title='Email']").html(),
                date_added:$(this).find("[data-title='Date Added']").html(),
                na_number:$(this).find("[data-title='NA Number']").html(),
                broker_acc:$(this).find("[data-title='Broker Account']").html(),
                id_receiver:$(this).find("[data-title='Receiver Id']").html()
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
    });
});