$(function() {
    var focus = 'hours';        
    $( "#modbook-arrival-date" ).attr("required","");
    $( "#modbook-departure-date" ).attr("required","");
    $("#modbook-send").click(function() {
        var url = $(this).closest("#book-form").attr("action"),
            valid = true,
            data = "", 
            checkData = "";
        $("#book-form input").each(function(k,v) {           
            if(inputTest($(v)) == false) {
                valid = false;
            }
        });
        if((inputTest($( "#modbook-arrival-date" )) == false) ||
            (inputTest($( "#modbook-departure-date" )) == false)) {
            valid = false;
        }
        $("#book-form input").each(function(k,v) {             
            if(data != "") {
                data += "&";
            }
            if($(v).attr("type") == "checkbox") {                 
                if($(v).attr("checked") == "checked") {
                    if(checkData != "") {
                        checkData += ",";
                    } else {
                        checkData += "type=";
                    }
                    checkData += $(v).next("label").text();
                }                
            } else if($(v).attr("type") == "radio") {
                //if($(v).val() == "on") {
                if(v.checked) {
                    data += "meet="+$(v).next("label").text();
                }                
            } else {
                data += $(v).attr("name")+"="+$(v).val();
            }
        });          
        if(data != "") {
            if(checkData != "") {
                data = data + '&'+checkData;
            }
            if($("#book").length && $("#mychange").length) {
                var varData = "";
                $("#mychange ul li a.it").each(function(key, val) {
                    if(varData != "") {
                        varData += ",";
                    }
                    varData += $(val).text();
                });
                data += "&variant="+varData;
            } else {
                data += "&variant="+$(".item-page.objcreate-item h2:first").text();
            }            
        }
		
		$('#agree-err').remove()
		
		if(!$('#terms-agree').prop('checked')){
			$('#agree-row').append('<div class="err" id="agree-err" style="color:red;font-size:14px">Согласитесь с правилами сайта</div>');
			valid=false;
		}
		
        if(valid) {            
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(msg) {
                    $("#book-msg-in-modal").html(msg); 
                    $("#book-msg-in-modal").show();
                    setTimeout(function (){
                        $("#book-msg-in-modal").hide();
                        $("#book-msg-in-modal").html("");
                    }, 5000);
                }
             });
        }                
        return false;
    });
    $("#book-msg-in-modal").click(function(){
        $(this).hide();
    });
	
	$('#terms-agree').click(function(){
		$('#agree-err').remove();
		if($(this).prop('checked')){
			$('#modbook-send').removeClass('disabled');
		}else{
			$('#modbook-send').addClass('disabled');
		}
	});
	
    $( "#modbook-arrival-date_img" ).parent().find(".icon").click(function () {
        $( "#modbook-arrival-date_img" ).trigger('click');  
        $(this).parent().find("input").css("border-color", "#DBDBDB");
        $(this).parent().find(".err").remove();
    });
    $( "#modbook-arrival-date" ).click(function () {
        $( "#modbook-arrival-date_img" ).trigger('click');    
        $(this).parent().find("input").css("border-color", "#DBDBDB");
        $(this).parent().find(".err").remove();
    });
    $( "#modbook-departure-date" ).parent().find(".icon").click(function () {
        $( "#modbook-departure-date_img" ).trigger('click');   
        $(this).parent().find("input").css("border-color", "#DBDBDB");
        $(this).parent().find(".err").remove();
    });
    $( "#modbook-departure-date" ).click(function () {
        $( "#modbook-departure-date_img" ).trigger('click'); 
        $(this).parent().find("input").css("border-color", "#DBDBDB");
        $(this).parent().find(".err").remove();
    });            
    $("#book-form .inputbox").blur(function() {
        inputTest($(this));
    });  
    function inputTest(obj) {
        var required = obj.attr("required"),
            err = '',
            label = obj.parent().find("label").text();
        if(required) {
            if(obj.val() != "") {
                if(validate(obj) == false) {
                    err = 'Поле "'+label+'" содержит недопустимые символы!';
                }
            } else {                
                err = 'Поле "'+label+'" не заполнено!';
            }
        }   
        if(err != "") {
            obj.css("border-color", "red");
            obj.parent().find(".err").remove();
            $('<span class="err" style="color: red;">'+err+'</span>').appendTo(obj.parent());
            return false;
        }
        return true;        
    }
    $("#book-form .inputbox").keyup(function() {
       $(this).css("border-color", "#DBDBDB");
       $(this).parent().find(".err").remove();
    });
    $("#modbook-time-hours").focus(function(){
        focus = 'hours';
    }).blur(function() {
    });
    $("#modbook-time-minuts").focus(function(){
        focus = 'minuts';
    });
    $("#modbook-time-hours").keyup(function() {
        timeFomat($(this));
    });
    $("#modbook-time-minuts").keyup(function() {
        timeFomat($(this));
    });
    $("#modbook-time-hours").blur(function(){
    });
    function timeFomat(obj) {
        var val = obj.val(),
            regexp = /^[0-9]{1,2}$/;
        if(regexp.test(val) == false) {
            val = val.substr(0, val.length - 1);
        }
        obj.val(val);
    }
    $("#book-form .arrows .plus").click(function() {        
        var v = $("#modbook-time-"+focus).val(),
            val = 0,
            n = 0;
        if(v != "") {
            if((v.length > 1) && (v[0] == '0')) {
                v = v.substr(1,1);
            }            
            val = parseInt(v);
        }        
        if(focus == "hours") {
            n = 23;
        } else if(focus == "minuts") {
            n = 59;
        }         
        if((val + 1) > n) {
            val = 0;
        } else {
            val++;
        }
        if(val < 10) {
            val = '0' + val;
        }
        $("#modbook-time-"+focus).val(val);
    });
    $("#book-form .arrows .minus").click(function() {
        var v = $("#modbook-time-"+focus).val(),
            val = 0;
        if(v != "") {
            if((v.length > 1) && (v[0] == '0')) {
                v = v.substr(1,1);
            }            
            val = parseInt(v);
        }
        if((val - 1) < 0) {
            if(focus == "hours") {
                val = 23;
            } else if(focus == "minuts") {
                val = 59;
            }
        } else {
            val--;
        }
        if(val < 10) {
            val = '0' + val;
        }
        $("#modbook-time-"+focus).val(val);
    });
    function validate(obj) {
        var regexp = {                  
                name: /^[a-zA-Zа-яА-ЯёЁs_ ]+$/,
                email: /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                phone: /^[0-9\-\(\)\+\ ]{1,25}$/,
                amount: /^[0-9]+$/,
                hours: /^(([0,1][0-9])|(2[0-3]))$/,
                minuts: /^[0-5][0-9]$/                
            },
            type = obj.attr("validate"),
            val = obj.val();                                
        if(typeof type == "undefined") return true;              
        if(typeof regexp[type] == "undefined") return true;              
        return regexp[type].test(val);        
    }        
}); 