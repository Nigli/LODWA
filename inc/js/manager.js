$(function () {
    $("tbody tr").on("click", function () {
        $("input").prop('checked', false);
        $("#subs_form input").val('');
        var td = $(this).children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#" + key).val(value);
            $("#" + key).prop('checked', true);
            $("#futures_desc").html(rec.futures_description);
        });

        $("tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("#emailtemp tbody tr").removeClass("activetr");
        $("html, body").animate({scrollTop: 0}, 600);
        $("#update").show();
        $("#delete").show();
        $("#reset").show();
        $("#new").hide();
    });
    $("#reset").on("click", function () {
        $(this).hide();
        $("#update").hide();
        $("#delete").hide();
        $("#new").show();
        $("#id_strategy").val("");
        $("#id_futures").val("");
        $("#futures_desc").html("");
        $("#id_receiver").val("");
        $("tbody tr").removeClass("activetr");
    });

    $("#delete, #update, #new").on("click", function () {
        var manage = $("#manage").val();
        var empty = false;
        $("#left input[type='text'], input[type='email'], #futures_dec, textarea").each(function () {
            if ($(this).val() === "") {
                this.focus();
                empty = true;
            }
        });
        $('input:checked').each(function () {
            if ($(this).length >= 1) {
                if ($(this).nextAll("input[type='number']").val() == 0) {
                    $(this).nextAll("input[type='number']").focus();
                    empty = true;
                }
                ;
            }
            ;
        });
        if (empty) {
            return false;
        }
        ;
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Confirm " + action);
        $("#notice-confirm").attr("name", manage + "-submit").attr("form", manage + "_form");
        $("#notice-confirm").show();
        $("#notice-cancel").show();
        $("#notice-close").hide();        
        $("#notice-span").hide();
    });
    $("#notice-close, #notice-cancel").on("click", function () {
        $(".shade").hide();
        $("#notice").hide();
    });
    $("#notice-confirm").on("click", function () {
        $(".shade").show();
        $("#notice").hide();
        $("#spinner").addClass("spinner");
    });
    $("input").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });
    if ($("#note").val() === "sent") {//note treba promeniti html-u
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Changes were successfull.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    } else if ($("#note").val() === "notsent") {//note treba promeniti u html-u
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Changes were not successfull. Please try again later.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    }
    
    //receiver 
    $("#receiver_form input[type='checkbox']").on("change", function () {
        if ($(this).not(':checked')) {
            $(this).nextAll("input[type='number']").val("");
        }
        ;
    });
    
    //receiver filter
    if ($("#receiver_list_type").val() != 0 || $("#receiver_list_active").val() != 1 || $("#receiver_list_ba").val() != "ALL" || $("#receiver_list_strat").val() != 0) {
        $("#receiver_list_filter .reset").show();
    }
    $("#receiver_list_type, #receiver_list_active, #receiver_list_strat, #receiver_list_ba").on("change", function () {
        $("#receiver_list_filter .reset").show();
    });
    if ($("#receiver_list_active").val() != "1") {
        $("#receiver_list_type, #receiver_list_strat").parent().hide();
    }
    $("#receiver_list_filter .reset").on("click", function () {
        $(this).hide();
        $("#receiver_list_type").val("0");
        $("#receiver_list_active").val("1");
        $("#receiver_list_strat").val("0");
        $("#receiver_list_ba").val("ALL");
    });
    //*receiver filter
    //*receiver
    
    //profile, broker and emailtemp
    $("#change").on("click", function () {
        $("#profile input").removeAttr("readonly").removeClass("readonly");
        $("textarea").removeAttr("disabled").removeClass("readonly");
        $(this).hide();
        $(".update").show();
        $("#cancel").show();
    });
    $("#cancel").on("click", function () {
        $("#profile input").attr("readonly", "readonly").addClass("readonly");
        $("textarea").attr("disabled", "disabled").addClass("readonly");
        $(this).hide();
        $(".update").hide();
        $("#change").show();
    });
    $(".profile_button").on("click", function () {
        $(".shade").show();
        $("#spinner").addClass("spinner");
    });
    //*profile, broker and emailtemp

    $("#to_bottom").on("click", function () {
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
});