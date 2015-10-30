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
        if ($("#num_tr_day").val() === "-1") {
            $("#num_tr_day").addClass("disable_time").css("color", "#eee");
            $("#num_tr_day_check").prop('checked', true);
        } else {
            $("#num_tr_day").removeClass("disable_time").css("color", "inherit");
        }

        if ($("#start_time").val() === "00:00") {
            $("#start_time").addClass("disable_time").css("color", "eee");
            $("#start_time_check").prop('checked', true);
        } else {
            $("#start_time").removeClass("disable_time");
        }
        if ($("#end_time").val() === "00:00") {
            $("#end_time").addClass("disable_time").css("color", "eee");
            $("#end_time_check").prop('checked', true);
        } else {
            $("#end_time").removeClass("disable_time");
        }
        if ($("#cxr_start_time").val() === "00:00") {
            $("#cxr_start_time").addClass("disable_time").css("color", "eee");
            $("#cxr_start_time_check").prop('checked', true);
        } else {
            $("#cxr_start_time").removeClass("disable_time");
        }
        if ($("#cxr_end_time").val() === "00:00") {
            $("#cxr_end_time").addClass("disable_time").css("color", "eee");
            $("#cxr_end_time_check").prop('checked', true);
        } else {
            $("#cxr_end_time").removeClass("disable_time");
        }

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
            }
        });
        if (empty) {
            return false;
        }
        ;
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Confirm " + action);//based on what button is clicked, action is set on the bottom of html page
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
    /*checks if note value is set to alert the notice*/
    if ($("#note").val() === "sent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Changes were successfull.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    } else if ($("#note").val() === "notsent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Changes were not successfull. Please try again later.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    }

    //strategy
    $("#num_tr_day_check").on("click", function () {
        if ($("#num_tr_day_check").is(':checked')) {
            $("#num_tr_day").addClass("disable_time").val("-1").css("color", "#eee");
        } else {
            $("#num_tr_day").removeClass("disable_time").val("1").css("color", "#000");
        }
    });
    $("#start_time_check").on("click", function () {
        if ($("#start_time_check").is(':checked')) {
            $("#start_time").addClass("disable_time").val("00:00");
        } else {
            $("#start_time").removeClass("disable_time").val("08:00");
        }
    });
    $("#end_time_check").on("click", function () {
        if ($("#end_time_check").is(':checked')) {
            $("#end_time").addClass("disable_time").val("00:00");
        } else {
            $("#end_time").removeClass("disable_time").val("18:00");
        }
    });
    $("#cxr_start_time_check").on("click", function () {
        if ($("#cxr_start_time_check").is(':checked')) {
            $("#cxr_start_time").addClass("disable_time").val("00:00");
        } else {
            $("#cxr_start_time").removeClass("disable_time").val("13:00");
        }
        ;
    });
    $("#cxr_end_time_check").on("click", function () {
        if ($("#cxr_end_time_check").is(':checked')) {
            $("#cxr_end_time").addClass("disable_time").val("00:00");
        } else {
            $("#cxr_end_time").removeClass("disable_time").val("15:00");
        }
    });
    //filter tr list
    if ($("#filter_entry_choice").val() != 0 || $("#filter_future").val() != 0 || $("#filter_result").val() != 0) {
        $("#tr_list_filter .reset").show();
    }
    $("#filter_entry_choice, #filter_future, #filter_result").on("change", function () {
        if ($("#filter_entry_choice").val() != 0 || $("#filter_future").val() != 0 || $("#filter_result").val() != 0) {
            $("#tr_list_filter .reset").show();
        }
    });
    $("#tr_list_filter .reset").on("click", function () {
        $(this).hide();
        $("#filter_entry_choice").val("0");
        $("#filter_future").val("0");
        $("#filter_result").val("0");
    });
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
    $("#profile_change, #email_change").on("click", function () {
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
        $("#profile_change, #email_change").show();
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