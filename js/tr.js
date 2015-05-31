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
                    rightspan:$(this).find("[data-title='Program name']").html()
                };
        $.each($tr_form, function(key, value){
            $("#"+key).val(value);
            $("#rightspan").html("Selected program: "+$tr_form.rightspan);
        });
        $("tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);
    });
    $('#tr_form_future').on('change', function() {
        var value = $(this).val();
        $('#rightspan').load('process/program_name.php?f='+value);
    });
});