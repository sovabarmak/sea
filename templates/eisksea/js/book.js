jQuery(document).ready(function ($) {
$('#submitbtn').prop('disabled', true);
$('.txt2, .txtarea').addClass('not_error');
var tipebron = 'Нет данных';
var tipebron=$('.bronnn').html();
$('.required').removeClass('not_error').mouseup('error');
$('input, textarea, select').bind("mouseleave keypress change blur",function (){
var id = $(this).attr('id');
var val = $(this).val();
var vall = validate($(this));
if(vall)
{
if (id == 'tip' && val == '-- не выбрал --'){
$(this).removeClass('not_error').addClass('error').css( "border-color", "red" );
$(this).next('.error-box').addClass('error-box2').html('Пожалуйста, выберите тип жилья');
} else {
$(this).addClass('not_error').removeClass('error').css( "border-color", "" );
$(this).next('.error-box').removeClass('error-box2').html('');
}
}
else
{
$(this).removeClass('not_error').addClass('error').css( "border-color", "red" );
if (!val.length) {
$(this).next('.error-box').addClass('error-box2').html('Заполните это поле, пожалуйста');
} else {
err = 'Допущена ошибка';



switch(id)
{
case 'name':
err = 'Вы ввели недопустимые символы';
break;
case 'email':
err = 'Оставьте пустым, или введите правильно';
break;
case 'phone':
err = 'Вы ввели недопустимые символы';
break;
case 'amount':
err = 'Введите число, пожалуйста';
break;
}
$(this).next('.error-box').addClass('error-box2').html(err);
}
$('#submitbtn').prop('disabled', true);
}
var count = $('.error').length;
if (!count) $('#submitbtn').prop('disabled', false);
});



$("form#contactform").submit(function(e) {
var url = $(this).closest("#contactform").attr("action"),
data = $(this).serialize();
data = data+'&tipe='+tipebron;
e.preventDefault();

var agree=$('#terms-agree').prop('checked');

if (!$('.error').length && agree){
$.ajax({
url: url,
type: 'post',
data: data,
beforeSend: function(xhr, textStatus){
$('form#contactform :input').attr('disabled','disabled');
},
success: function(response){
if (response == 'Ваша заявка принята!') {
$('form#contactform :input').removeAttr('disabled').removeClass('not_error');
$('form#contactform .txt').val('').css( "border-color", "" ).next('.error-box').removeClass('error-box2').text('');
$('form#contactform .txt2').val('').css( "border-color", "" ).next('.error-box').removeClass('error-box2').text('');
$('form#contactform .txtarea').val('').css( "border-color", "" ).next('.error-box').removeClass('error-box2').text('');
$('#submitbtn').prop('disabled', true);
$('.txt2, .txtarea').addClass('not_error');
$('.required').removeClass('not_error').addClass('error');
$('div#drop').next('ul').text('');
$("#book-msg-in-modal").html(response);
$("#overlay").show();
$("#book-msg-in-modal").show();
setTimeout(function (){
$("#book-msg-in-modal").hide();
$("#overlay").hide();
$("#book-msg-in-modal").html("");
}, 2000);
} else {
$('form#contactform :input').removeAttr('disabled');
$("#book-msg-in-modal").html(response);
$("#overlay").show();
$("#book-msg-in-modal").show();
setTimeout(function (){
$("#book-msg-in-modal").hide();
$("#overlay").hide();
$("#book-msg-in-modal").html("");
}, 2000);
}}});
}
else
{
	if(!agree){
		$("#book-msg-in-modal").html("Согласитесь с правилами!");
		$("#overlay").show();
		$("#book-msg-in-modal").show();
		setTimeout(function (){
		$("#book-msg-in-modal").hide();
		$("#overlay").hide();
		$("#book-msg-in-modal").html("");
		}, 2000);
	}else{
		$("#book-msg-in-modal").html("Заполните все поля!");
		$("#overlay").show();
		$("#book-msg-in-modal").show();
		setTimeout(function (){
		$("#book-msg-in-modal").hide();
		$("#overlay").hide();
		$("#book-msg-in-modal").html("");
		}, 2000);
		return false;
	}
}
});
$("#book-msg-in-modal").click(function(){
$(this).hide();
$("#overlay").hide();
});
$("#overlay").click(function(){
$("#book-msg-in-modal").hide();
$(this).hide();
});
function validate(obj) {
var regexp = {
name: /^[a-zA-Zа-яА-ЯёЁs_ ]+$/,
email: /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
phone: /^[0-9\-\(\)\+\ ]{1,25}$/,
amount: /^[0-9]+$/
},
type = obj.attr("name"),
valid = obj.attr("class"),
val = obj.val();
if(valid) valid = valid.contains("required");
if(!valid && !val) return true;
if(valid && !val) return false;
if(typeof regexp[type] == "undefined") return true;
return regexp[type].test(val);
}
});