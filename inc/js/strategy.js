$(function () {
    $("#strategy_list tbody tr").on("click", function () {
        $("input").prop('checked', false);
        var td = $(this).children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#" + key).val(value);
            $("#" + key).prop('checked', true);
        });
        
        $("#strategy_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
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
        $("#strategy_list tbody tr").removeClass("activetr");
    });

    $("#delete, #update, #new").on("click", function () {
        var empty = false;
        $("#left input[type='text']").each(function () {
            if ($(this).val() === "") {
                this.focus();
                empty = true;
            }
        });
        if (empty) {
            return false;
        }
        ;
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Confirm Strategy " + action);
        $("#notice-confirm").show();
        $("#notice-cancel").show();
        $("#notice-close").hide();
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
    if ($("#strategy_note").val() === "update") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Strategy name has been successfully changed/added.");
        $("#notice-close").show();
        $("#notice-confirm").hide();
    } else if ($("#strategy_note").val() === "notupdate") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Strategy name has NOT been successfully changed/added. Please try again later.");
        $("#notice-close").show();
        $("#notice-confirm").hide();
    }
    $("#to_bottom").on("click", function () {
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
});