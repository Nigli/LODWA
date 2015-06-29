$(function(){
    function getUrlVars(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    function getUrlVar(name){
        return getUrlVars()[name];
    }
    var default_url = "http://localhost/LODWA/trlist";
    $("#filterspan").on("click", function(){        
        $(".shade").show();
        $("#notice").show();    
        if(getUrlVar("entry_choice")!= "ALL" || getUrlVar("fk_future")!= 0){
            $("#notice-reset").show(); 
        }
        $("#notice-confirm").show(); 
        $("#notice-cancel").show();
    });
    $("#notice-cancel").on("click", function(){        
        $(".shade").hide();
        $("#notice").hide();
        $("#notice-confirm").hide(); 
        $("#notice-cancel").hide();
    });
    if(getUrlVars()!= default_url && (getUrlVar("entry_choice")!= "ALL" || getUrlVar("fk_future")!= 0)){
        $("#filter_notice").html("Filter is active");
    }
    $("#list_form_future, #list_form_entry_choice").on("change",function(){
        if($("#list_form_future").val()!==0 || $("#list_form_entry_choice").val()!==0){
            $("#notice-reset").show();
        }
    });
    $("#notice-reset").on("click",function(){
        $(this).hide();
        $("#list_form_entry_choice").val("ALL");
        $("#list_form_future").val("0");
    });
});