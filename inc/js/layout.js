$(function () {
    var autotr, autotrstp, autotrtgt, num_contracts, trstart, trend, cxrstart, cxrend, trnum, trnum, data, strat_id;
    $.getJSON('process/strategy_name.php', function (response) {
        $('#rightspan').html(response.text);
        if (response.data) {
            data = response.data;
            strat_id = $("#fk_strategy :selected").val();
            autotr = data[strat_id].autotr;           
            autotrstp = parseFloat(data[strat_id].autotrstp);
            autotrtgt = parseFloat(data[strat_id].autotrtgt);            
            num_contracts = data[strat_id].num_contracts;
        } else {
            data = null;
            strat_id = null;
            autotr = response.autotr;
            autotrstp = parseFloat(response.autotrstp);
            autotrtgt = parseFloat(response.autotrtgt);
            num_contracts = response.num_contracts;
            trstart = response.trstart;
            trend = response.trend;
            cxrstart = response.cxrstart;
            cxrend = response.cxrend;
            trnum = response.trnum;
        }
        if(autotr != 0) {
            $("#price_target, #stop_loss").addClass("disable");
        } else {
            $("#price_target, #stop_loss").removeClass("disable");
        }
    });
    $("#tr_list_5 tbody tr").on("click", function () {
        var td = $(this).children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#" + key).val(value);
        });
        $.getJSON('process/strategy_name.php?f=' + rec['fk_future'] + '&s=' + rec['fk_strategy'], function (response) {
            $('#rightspan').html(response.text);
            if (response.data) {
                data = response.data;
                strat_id = $("#fk_strategy :selected").val();
                autotr = data[strat_id].autotr;
                autotrstp = parseFloat(data[strat_id].autotrstp);
                autotrtgt = parseFloat(data[strat_id].autotrtgt);
            } else {
                data = null;
                strat_id = null;
                autotr = response.autotr;                
                autotrstp = parseFloat(response.autotrstp);
                autotrtgt = parseFloat(response.autotrtgt);
                num_contracts = response.num_contracts;
                trstart = response.trstart;
                trend = response.trend;
                cxrstart = response.cxrstart;
                cxrend = response.cxrend;
                trnum = response.trnum;
            }
            if(autotr != 0) {   
                $("#price_target, #stop_loss").addClass("disable");
            } else {
                $("#price_target, #stop_loss").removeClass("disable");
            }
        });

        $("#tr_list_5 tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({scrollTop: 0}, 600);

    });
    $("body").on("change", "#fk_strategy", function () {
//    $("#fk_strategy").on("change",  function () {
        strat_id = $(this).val();
        num_contracts = data[strat_id].num_contracts;
        autotr = data[strat_id].autotr;
        autotrstp = parseFloat(data[strat_id].autotrstp);
        autotrtgt = parseFloat(data[strat_id].autotrtgt);
        $("#num_contr").val(num_contracts);
        
        if(autotr != 0) {                    
            var entry_price = parseFloat($("#entry_price").val());
            var entry_choice = $("#entry_choice").val();

            if(entry_choice == "BUY") {            
                $("#price_target").val((entry_price + autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price - autotrstp).toFixed(2));
            } else {
                $("#price_target").val((entry_price - autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price + autotrstp).toFixed(2));
            }
            $("#price_target, #stop_loss").addClass("disable");
        } else {
            $("#price_target, #stop_loss").removeClass("disable");
        }
    });
    //function for selecting future strategy, populating right span
    $('#fk_future').on('change', function () {
        var value = $(this).val();
        $.getJSON('process/strategy_name.php?f=' + value, function (response) {
            $('#rightspan').html(response.text);
            if (response.data) {
                data = response.data;
                strat_id = $("#fk_strategy :selected").val();
                autotr = data[strat_id].autotr;
                autotrstp = parseFloat(data[strat_id].autotrstp);
                autotrtgt = parseFloat(data[strat_id].autotrtgt);
                num_contracts = data[strat_id].num_contracts;
                $("#num_contr").val(num_contracts);  
            } else {
                data = null;
                strat_id = null;
                autotr = response.autotr;
                autotrstp = parseFloat(response.autotrstp);
                autotrtgt = parseFloat(response.autotrtgt);
                num_contracts = response.num_contracts;
                trstart = response.trstart;
                trend = response.trend;
                cxrstart = response.cxrstart;
                cxrend = response.cxrend;
                trnum = response.trnum;                
                $("#num_contr").val(num_contracts);     
            }
            if(autotr != 0) {                    
                var entry_price = parseFloat($("#entry_price").val());
                var entry_choice = $("#entry_choice").val();

                if(entry_choice == "BUY") {            
                    $("#price_target").val((entry_price + autotrtgt).toFixed(2));
                    $("#stop_loss").val((entry_price - autotrstp).toFixed(2));
                } else {
                    $("#price_target").val((entry_price - autotrtgt).toFixed(2));
                    $("#stop_loss").val((entry_price + autotrstp).toFixed(2));
                }
                $("#price_target, #stop_loss").addClass("disable");
            } else {
                $("#price_target, #stop_loss").removeClass("disable");
            }
        });
    });
    
    $("#entry_price").focusout(function(){
        if(autotr != 0) {                    
            var entry_price = parseFloat($("#entry_price").val());
            var entry_choice = $("#entry_choice").val();

            if(entry_choice == "BUY") {            
                $("#price_target").val((entry_price + autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price - autotrstp).toFixed(2));
            } else {
                $("#price_target").val((entry_price - autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price + autotrstp).toFixed(2));
            }
            $("#price_target, #stop_loss").addClass("disable");
        } else {
            $("#price_target, #stop_loss").removeClass("disable");
        }
    });
    
    $("#entry_choice").on("change", function(){
        if(autotr != 0) {                    
            var entry_price = parseFloat($("#entry_price").val());
            var entry_choice = $("#entry_choice").val();

            if(entry_choice == "BUY") {            
                $("#price_target").val((entry_price + autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price - autotrstp).toFixed(2));
            } else {
                $("#price_target").val((entry_price - autotrtgt).toFixed(2));
                $("#stop_loss").val((entry_price + autotrstp).toFixed(2));
            }
            $("#price_target, #stop_loss").addClass("disable");
        } else {
            $("#price_target, #stop_loss").removeClass("disable");
        }
    });
    
    
    //when canceling tr, button submit is hidden, showing cxl, rpl, reset and radio button, 
    //shorter price input and other elements are disabled to change (css pointer event - none)
    $("#tr_form_cancel").on("click", function () {
        $("#tr_form_cancel, #tr_form_submit").hide();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep, #reset").show();
        $("#stop_loss, #price_target").removeClass("prices");
        $("#stop_loss, #price_target").addClass("replace");
        //input number pointer none because radio button is input type
        $("select, input[type=number]").addClass('disable');
    });
    //on reset removing reset, cxl, rpl and radio buttons, showing cancel new buttons
    //adding prices class to normalize input prices, removing cancel and replace color from prices, pointer events back to normal
    $("#reset").on("click", function () {
        $(this).hide();
        $("#tr_form_cancel, #tr_form_submit").show();
        $("#tr_form_cxl, #tr_form_rpl, .radio_rep ").hide();
        $("#stop_loss, #price_target").addClass("prices");
        $("tbody tr").removeClass("activetr");
        $("input").removeClass("mark_red");
        $('.radio_rep').removeClass('radio_require');
        $("select, input[type=number]").removeClass('disable');
    });
    $("input:radio[name='rpl_price']").on("change", function () {
        if ($(this).is(':checked') && $(this).val() == 'stop_loss') {
            $("#stop_loss").addClass("mark_red").removeClass("disable");
            $("#price_target").removeClass("mark_red").addClass("disable");
        } else {
            $("#price_target").addClass("mark_red").removeClass("disable");
            $("#stop_loss").removeClass("mark_red").addClass("disable");
        }
    });
    $("#tr_form_cxl, #tr_form_rpl, #tr_form_submit").on("click", function () {
        var empty = false;
        
        if ($(this).attr('id') === "tr_form_rpl") {
            if ($('input:checked').length === 0) {
                $('.radio_rep').addClass('radio_require');
                empty = true;
            }
        }
        $("input[type='number']").each(function () {
            if ($(this).val() === "") {
                this.focus();
                empty = true;
            }
        });
        if ($("#tr_form_future").val() === null || $("#fk_strategy").val() == 0) {
            $(".shade").show();
            $("#notice").show();
            $("#notice-title h3").html("Notice");
            $("#notice-span").html($("#rightspan").text());
            $("#notice-close").show();
            $("#notice-entry-price").html("");
            $("#notice-stop-loss").html("");
            $("#notice-price-target").html("");
            $("#notice-confirm").hide();
            $("#notice-cancel").hide();
            empty = true;
        }
        if (empty) {
            return false;
        }
        var future = $("#fk_future option:selected").text();
        var month = $("#month").val();
        var year = $("#year").val();
        var entry_choice = $("#entry_choice").val();
        var entry_price = parseFloat($("#entry_price").val());
        var price_target = $("#price_target").val();
        var stop_loss = $("#stop_loss").val();
        $(".shade").show();
        $("#notice, #notice-title h3, #notice-span, #notice-entry-price, #notice-stop-loss, #notice-price-target").show();
        $("#notice-title h3").html("Confirm " + tr_type);//based on what button is clicked, tr_type is set on the bottom of html page
        $("#notice-span").html("<strong>" + entry_choice + "</strong> " + future + " " + month + " " + year + "<br>");
        $("#notice-entry-price").html("<strong>" + entry_choice + " (Entry):</strong> " + entry_price + "<br>");
        $("#notice-stop-loss").html("<strong>Stop Loss: </strong>" + stop_loss + "<br>");
        $("#notice-price-target").html("<strong>Price target: </strong>" + price_target);
        $("#notice-confirm").show();
        $("#notice-cancel").show();
        $("#notice-close").hide();
        /*checks the side of the trade*/
        if (entry_choice === "BUY") {
            if (price_target < stop_loss) {
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Stop Loss price is higher then Price Target! Your entry choice is BUY!");
                $("#notice-close").show();
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            } else if (entry_price == price_target || entry_price == stop_loss || stop_loss == price_target) {
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Some of your prices have equal values!");
                $("#notice-close").show();
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            } 
        } else {
            if (stop_loss < price_target) {
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Price Target is higher then Stop Loss price! Your entry choice is SELL!");
                $("#notice-close").show();
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            } else if (entry_price == price_target || entry_price == stop_loss || stop_loss == price_target) {
                $("#notice-title h3").html("Notice!");
                $("#notice-span").html("Some of your prices have equal values!");
                $("#notice-close").show();
                $("#notice-confirm").hide();
                $("#notice-cancel").hide();
            }
        }
    });

    //limiting trading time and number of trades a day
    $("#tr_form_submit").on("click", function () {
        var curr_date_time = new Date();
        var month = curr_date_time.getMonth() + 1;
        var day = curr_date_time.getDate();
        var date = (month < 10 ? '0' : '') + month + '/' +
                (day < 10 ? '0' : '') + day + '/' +
                curr_date_time.getFullYear();//                                         getting the date in a format 12/28/2011

        var offset = (curr_date_time.getTimezoneOffset() - 300) * 60 * 1000;//        time offset - 300 minutes chicago time zone
        var curr_mili = curr_date_time.getTime() + offset;//                      current time in miliseconds in chicago time 

        if ($('#fk_strategy option').length) { //                                 if it is a select option tag
            var start_time = data[strat_id].trstart;//     time when trade day starts
            if (start_time === "00:00") {
                start_time = "anytime";
            }
            var start_date = new Date(date + " " + start_time);
            var start_mili = start_date.getTime();//                            start date in miliseconds
            var end_time = data[strat_id].trend;//         time when trade day ends
            if (end_time === "00:00") {
                end_time = "anytime";
            }
            var end_date = new Date(date + " " + end_time);
            var end_mili = end_date.getTime();//                                end date in miliseconds
            var tr_num_limit = data[strat_id].trnum;//     check tr limit broken  
        } else {
            var start_time = trstart;//               time when trade day starts
            if (start_time === "00:00") {
                start_time = "anytime";
            }
            var start_date = new Date(date + " " + start_time);
            var start_mili = start_date.getTime();//                            start date in miliseconds
            var end_time = trend;//                   time when trade day ends
            if (end_time === "00:00") {
                end_time = "anytime";
            }
            var end_date = new Date(date + " " + end_time);
            var end_mili = end_date.getTime();//                                end date in miliseconds
            var tr_num_limit = trnum;//               check tr limit broken  
        }
        var dif = start_mili - curr_mili;
        var time_to_hours = Math.floor(dif / 1000 / 60 / 60);//                       hours until trade day starts
        var time_to_minutes = Math.floor((dif / 1000 / 60) % 60);//                   minutes left 

        if (curr_mili < start_mili || curr_mili >= end_mili || tr_num_limit == "1") {
            if (tr_num_limit == "1") {
                $("#notice-span").html("You have reached strategy trade limits for today!<br>Come back tomorrow at " + start_time + " Chicago Time.");
            } else if (curr_mili < start_mili) {
                $("#notice-span").html("Trading time for this strategy is set from " + start_time + " Chicago Time!<br>" + time_to_hours + " hours and " + time_to_minutes + " minutes before start.");
            } else if (curr_mili >= end_mili) {
                $("#notice-span").html("Trading time for this strategy is set until " + end_time + " Chicago Time!<br>Come back tomorrow at " + start_time + ".");
            }
            $(".shade").show();
            $("#notice").show();
            $("#notice-title h3").html("Notice!");
            $("#notice-close").show();
            $("#notice-entry-price, #notice-stop-loss, #notice-price-target").hide();
            $("#notice-confirm").hide();
            $("#notice-cancel").hide();
        }
    });
    //limiting canceling time
    $("#tr_form_rpl").on("click", function () {
        var curr_date_time = new Date();
        var month = curr_date_time.getMonth() + 1;
        var day = curr_date_time.getDate();
        var date = (month < 10 ? '0' : '') + month + '/' +
                (day < 10 ? '0' : '') + day + '/' +
                curr_date_time.getFullYear();//                                         getting the date in a format 12/28/2011

        var offset = (curr_date_time.getTimezoneOffset() - 300) * 60 * 1000;//        time offset - 300 minutes chicago time zone
        var curr_mili = curr_date_time.getTime() + offset;//                      current time in miliseconds in chicago time 

        if ($('#fk_strategy option').length) { //                                 if it is a select option tag
            var cxr_start_time = data[strat_id].cxrstart;//     time when trade day starts
            if (cxr_start_time === "00:00") {
                cxr_start_time = "anytime";
            }
            var cxr_start_date = new Date(date + " " + cxr_start_time);
            var cxr_start_mili = cxr_start_date.getTime();//                            start date in miliseconds
            var cxr_end_time = data[strat_id].cxrend;//         time when trade day ends
            if (cxr_end_time === "00:00") {
                cxr_end_time = "anytime";
            }
            var cxr_end_date = new Date(date + " " + cxr_end_time);
            var cxr_end_mili = cxr_end_date.getTime();//                                end date in miliseconds            
        } else {
            var cxr_start_time = cxrstart;//               time when trade day starts
            if (cxr_start_time === "00:00") {
                cxr_start_time = "anytime";
            }
            var cxr_start_date = new Date(date + " " + cxr_start_time);
            var cxr_start_mili = cxr_start_date.getTime();//                            start date in miliseconds
            var cxr_end_time = cxrend;//                   time when trade day ends
            if (cxr_end_time === "00:00") {
                cxr_end_time = "anytime";
            }
            var cxr_end_date = new Date(date + " " + cxr_end_time);
            var cxr_end_mili = cxr_end_date.getTime();//                                end date in miliseconds
        }
        var dif = cxr_start_mili - curr_mili;
        var time_to_hours = Math.floor(dif / 1000 / 60 / 60);//                       hours until trade day starts
        var time_to_minutes = Math.floor((dif / 1000 / 60) % 60);//                   minutes left 

        if (curr_mili < cxr_start_mili || curr_mili >= cxr_end_mili) {
            if (curr_mili < cxr_start_mili) {
                $("#notice-span").html("Canceling time for this strategy is set from " + cxr_start_time + " Chicago Time!<br>" + time_to_hours + " hours and " + time_to_minutes + " minutes before you can cancel TR.");
            } else if (curr_mili >= cxr_end_mili) {
                $("#notice-span").html("Canceling time for this strategy is set until " + cxr_end_time + " Chicago Time!<br>Come back tomorrow at " + cxr_start_time + ".");
            }
            $(".shade").show();
            $("#notice").show();
            $("#notice-title h3").html("Notice!");
            $("#notice-close").show();
            $("#notice-entry-price, #notice-stop-loss, #notice-price-target").hide();
            $("#notice-confirm").hide();
            $("#notice-cancel").hide();
        }
    });

    $('.radio_rep').on("click", function () {
        $('.radio_rep').removeClass('radio_require');
    });
    $("#tr_form_cxl").on("click", function () {
        $("#price_target, #stop_loss").removeClass("mark_red").addClass("disable");
    });
    $("#notice-confirm").on("click", function () {
        $(".shade").show();
        $("#notice").hide();
        $("#spinner").addClass("spinner");
    });
    $("#notice-close, #notice-cancel").on("click", function () {
        $(".shade").hide();
        $("#notice").hide();
    });
    $("input").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    /*checks if note value is set to alert the notice*/
    if ($("#tr_note").val() === "sent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Successfull TR!");
        $("#notice-span").html("TR has been successfully sent.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    } else if ($("#tr_note").val() === "notsent") {
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Unsuccessfull TR!");
        $("#notice-span").html("TR has NOT been successfully sent. Please try again later.");
        $("#notice-close").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    }
    $("#to_bottom").on("click", function () {
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
    //filter tr list
    if ($("#filter_entry_choice").val() != 0 || $("#filter_future").val() != 0 || $("#filter_result").val() != 0 || $("#filter_strategy").val() != 0) {
        $("#tr_list_filter .reset").show();
    }
    $("#filter_entry_choice, #filter_future, #filter_result, #filter_strategy").on("change", function () {
        if ($("#filter_entry_choice").val() != 0 || $("#filter_future").val() != 0 || $("#filter_result").val() != 0 || $("#filter_strategy").val() != 0) {
            $("#tr_list_filter .reset").show();
        }
    });
    $("#tr_list_filter .reset").on("click", function () {
        $(this).hide();
        $("#filter_entry_choice").val("0");
        $("#filter_future").val("0");
        $("#filter_result").val("0");
        $("#filter_strategy").val("0");
    });
    //filter receivers
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
    //receivers info
    $("#receiver_list .receiver_info").on("click", function () {
        $("#notice-rec-type").html("<strong>Type: </strong><br>");
        $("#notice-rec-first_name").html("<strong>First Name: </strong><br>");
        $("#notice-rec-last_name").html("<strong>Last Name: </strong><br>");
        $("#notice-rec-email").html("<strong>Email: </strong><br>");
        $("#notice-rec-broker_acc").html("<strong>Broker Account: </strong><br>");
        $("#notice-rec-na_number").html("<strong>NA Number: </strong><br>");
        $("#notice-rec-strat_info").html("<strong>Strategy and # of Subs: </strong><br>");
        var td = $(this).parent().children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#notice-rec-" + key).append(value + "<br>");
            if (key.substring(0, 13) == "strategy_name") {
                $("#notice-rec-strat_info").append(value + ": ");
            }
            if (key.substring(0, 13) == "strategy_subs") {
                $("#notice-rec-strat_info").append(value + "<br>");
            }
        });
        $("#notice-rec-broker_acc").html("");
        if (rec['broker_acc'] == 0) {
            $("#notice-rec-broker_acc").html("<strong>Broker Account: </strong><br>No Account<br>");
        } else {
            $("#notice-rec-broker_acc").html("<strong>Broker Account: </strong><br>Has Account<br>");
        }
        ;
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Subscriber Info");
        $("#notice-close, #notice-rec-type, #notice-rec-first_name, #notice-rec-last_name, #notice-rec-email, #notice-rec-broker_acc, #notice-rec-na_number, #notice-rec-strat_info").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    });
    
    //stategy info
    $("#strategy_list .strategy_info").on("click", function () {
        $("#notice-strat-strategy_name").html("<strong>Strategy Name: </strong><br>");
        $("#notice-strat-strategy_symbol").html("<strong>Strategy Symbol: </strong><br>");
        $("#notice-strat-num_tr_day").html("<strong>Num TR/Day: </strong><br>");
        $("#notice-strat-auto_tr").html("<strong>Auto TR: </strong><br>");
        $("#notice-strat-num_contracts").html("<strong>Num Contracts: </strong><br>");
        $("#notice-strat-num_futures").html("<strong>Num Futures: </strong><br>");
        $("#notice-strat-num_receivers").html("<strong>Num Subscribers: </strong><br>");
        $("#notice-strat-start_time").html("<strong>Start Time: </strong><br>");
        $("#notice-strat-end_time").html("<strong>End Time: </strong><br>");
        $("#notice-strat-cxr_start_time").html("<strong>CXL Start Time: </strong><br>");
        $("#notice-strat-cxr_end_time").html("<strong>CXL End Time: </strong><br>");
        var td = $(this).parent().children();
        var rec = {};
        $.each(td, function (count) {
            rec[td.eq(count).data("index")] = td.eq(count).text();
        });
        $.each(rec, function (key, value) {
            $("#notice-strat-" + key).append(value + "<br>");
//            if (key.substring(0, 13) == "strategy_name") {
//                $("#notice-rec-strat_info").append(value + ": ");
//            }
//            if (key.substring(0, 13) == "strategy_subs") {
//                $("#notice-rec-strat_info").append(value + "<br>");
//            }
        });
        ;
        $(".shade").show();
        $("#notice").show();
        $("#notice-title h3").html("Strategy Info");
        $("#notice-close, #notice-strat-strategy_name, #notice-strat-strategy_symbol, #notice-strat-num_tr_day, #notice-strat-auto_tr, #notice-strat-num_contracts, #notice-strat-num_futures, #notice-strat-num_receivers, #notice-strat-start_time, #notice-strat-end_time, #notice-strat-cxr_start_time, #notice-strat-cxr_end_time").show();
        $("#notice-cancel").hide();
        $("#notice-confirm").hide();
    });
});