$(function(){
    if($("#filter_entry_choice").val()!=0 || $("#filter_future").val()!=0){
        $("#tr_list_filter .reset").show();
    }
    $("#filter_entry_choice, #filter_future").on("change",function(){
        if($("#filter_entry_choice").val()!=0 || $("#filter_future").val()!=0){
            $("#tr_list_filter .reset").show();
        }
    });
    $(".reset").on("click", function (){
        $(this).hide();
        $("#tr_list_filter select").val("");
    })
});