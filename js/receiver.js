$(function () {
    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    function getUrlVar(name) {
        return getUrlVars()[name];
    }
    var default_url = "http://localhost/LODWA/receiverlist";
    $("#receiver_list tbody tr").on("click", function () {
        $("input").prop('checked', false);
        $("input").val('');
        var td = $(this).children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#" + key).val(value);
            $("#" + key).prop('checked', true);
        });

        $("#receiver_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({scrollTop: 0}, 600);
        $("#update").show();
        $("#unsubs").show();
        $("#reset").show();
        $("#new").hide();
    });
    $("#reset").on("click", function () {
        $(this).hide();
        $("#update").hide();
        $("#subs").hide();
        $("#unsubs").hide();
        $("#new").show();
        $("#id_receiver").val("");
        $("#receiver_list tbody tr").removeClass("activetr");
    });
    $("#unsubs, #update, #new").on("click", function () {
        var empty = false;
        $("input[type='email'], #left input[type='text']").each(function () {
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
        $("#notice-title h3").html("Confirm " + rec_action);
        $("#notice-confirm").show();
        $("#notice-cancel").show();
        $("#notice-confirm-filter").hide();
        $("#notice-close").hide();
    });
    $("#notice-close, #notice-cancel").on("click", function () {
        $(".shade").hide();
        $("#notice").hide();
        $("#notice-reset").hide();
        $("#notice-span").html("");
    });
    $("input[type='checkbox']").on("change", function () {
        if ($(this).not(':checked')) {
            $(this).nextAll("input[type='number']").val("");
        }
        ;
    });
    $("#filterspan").on("click", function () {
        $(".shade").show();
        $("#notice").show();
        $("#receiver_list_filter").show();
        $("#notice-title h3").html("Filter");
        if (getUrlVars() != default_url && (getUrlVar("type") != "0" || getUrlVar("strategy") != "0" || getUrlVar("ba") != "ALL" || getUrlVar("active") != "1")) {
            $("#notice-reset").show();
        }
         if ($("#receiver_list_active").val() == 0) {
             $("#receiver_list_strat").hide();            
             $("label[for='receiver_list_strat']").hide();
             $("#receiver_list_type").hide();
             $("label[for='receiver_list_type']").hide();
         }
        $("#notice-confirm").hide();
        $("#notice-confirm-filter").show();
        $("#notice-cancel").show();
        $("#notice-close").hide();
    });
    if (getUrlVars() != default_url && (getUrlVar("type") != 0 || getUrlVar("strategy") != "0" || getUrlVar("ba") != "ALL" || getUrlVar("active") != "1")) {
        $("#filter_notice").html("Filter is active");
    }
    $("#receiver_list_type, #receiver_list_active, #receiver_list_strat, #receiver_list_ba").on("change", function () {
        $("#notice-reset").show();
    });
    $("#notice-cancel").on("click", function () {
        $(".shade").hide();
        $("#notice").hide();
        $("#receiver_list_filter").hide();
        $("#notice-confirm").hide();
        $("#notice-cancel").hide();
    });
    $("#notice-reset").on("click", function () {
        $(this).hide();
        $("#receiver_list_type").val("0");
        $("#receiver_list_active").val("1");
        $("#receiver_list_strat").val("0");
        $("#receiver_list_ba").val("ALL");
    });
    $("#notice-confirm").on("click", function () {
        $(".shade").show();
        $("#notice").hide();
        $("#spinner").addClass("spinner");
    });
    $("input").on("keypress", function (e) {
        if (e.which === 13) {
            event.preventDefault();
        }
    });
    if ($("#receiver_note").val() === "sent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Success!");
        $("#notice-span").html("Subscriber has been successfully changed/added.");
        $("#notice-close").show();
        $("#notice-confirm-filter").hide();
        $("#notice-confirm").hide();
    } else if ($("#receiver_note").val() === "notsent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccess!");
        $("#notice-span").html("Subscriber has NOT been successfully changed/added. Please try again later.");
        $("#notice-close").show();
        $("#notice-confirm-filter").hide();
        $("#notice-confirm").hide();
    }
    $("#to_bottom").on("click", function () {
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
});