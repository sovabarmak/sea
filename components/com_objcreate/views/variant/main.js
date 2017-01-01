jQuery(document).ready(function($) {
jQuery(".num-desc-price li").css("display", "none");
jQuery(".numbers-list li a").click(function(){
// ID селекторов номеров titleid_X

var text = jQuery(this).text();
var id = jQuery(this).attr("id");
var numId = parseInt(id.replace("titleid_", ""));

// Карусель
var ul = jQuery(this).closest(".item-page").find(".img_carousel").find("ul");
// Первая картинка нужного нам раздела
var photoId = ul.find("li[rel='num_id_"+numId+"'] img").first().attr("rel");
photoId = photoId.replace("photo_id_", "");
showPhoto(photoId);
//jQuery(this).closest(".item-page").find(".big_img").find('img').attr('src', src);

// параметры картинок в карусели
var liW = ul.find("li").first().width();
var n = ul.find("li").length;
// Сколько картинок необходимо "промотать"
var m = ul.find("li[rel=num_id_"+numId+']').first().prevAll("li").length;
var ulW = 0;
var mgRight = 7;

ulW = (liW + mgRight) * n;
ulL = (liW + mgRight) * m;
//if(ulL == -153){ulL = 0;}
ul.width(ulW);
ul.stop().animate({left: (-ulL)}, 500);

jQuery(".num_title").text(text);
jQuery(".num-desc-price li").fadeOut(50);
jQuery(".num-desc-price li#num_"+(numId)).fadeIn(50);
return false;
});
});

function showPhoto(id)
{
id = id.toString();
jQuery('#main_img img').attr('src', jQuery('#num_photo_'+id+' a').attr('rel2'));
jQuery('#main_img a').attr('href', 'javascript:showLytebox('+id+')');
return false;
}

function showLytebox(photoid)
{
clik=document.getElementById('hidden_lytebox_'+photoid.toString());
clik.click();
jQuery('#hidden_lytebox_'+photoid.toString()).trigger('click');
}

jQuery(document).ready(function($){
$(".calculate").click(function() {
var start=jQuery("#date_startt").val();
var end=jQuery("#date_endd").val();
var cost=jQuery("#pri").val();
var conums=jQuery("#conums").val();
var year = parseInt(jQuery("#date_endd").val()); 
costarr=cost.split(" ");
costarr2 = new Array();
for (var i = 0; i < costarr.length-1; i=i+5) {
costarr2.push((new Date(year,costarr[i+1]-1,costarr[i],0,0,0)).getTime()/1000 , (new Date(year,costarr[i+3]-1,costarr[i+2],0,0,0)).getTime()/1000 , costarr[i+4]);
}
startarr=start.split("/");
endarr=end.split("/");
var bron=jQuery("#bro").val();
bron2=bron.split(" ");

if (!start && !end){alert("Введите дату заезда и выезда");} else if (!start) {alert("Введите дату заезда");} else if (!end) {alert("Введите дату выезда");} else if (startarr[1] < 5 || startarr[1] > 9 || endarr[1] < 5 || endarr[1] > 9) {alert("Дата должна лежать в периоде с мая по сентябрь");} else {
var time = (new Date(startarr[0],startarr[1]-1,startarr[2],0,0,0)).getTime()/1000;
var time2 = (new Date(endarr[0],endarr[1]-1,endarr[2],0,0,0)).getTime()/1000;
var time3 = (new Date(startarr[0],startarr[1]-1,startarr[2],7,0,0)).getTime()/1000;
var time4 = (new Date(endarr[0],endarr[1]-1,endarr[2],7,0,0)).getTime()/1000;
var k=0;
var kk=0;

for (var ii = 0; ii <= bron2.length-1; ii++) {
bron3=bron2[ii].split("/");
var yyy= new Date(bron3[0]*1000);
if ((time3<=bron3[0] && time4>=bron3[0]) || (time3<=bron3[1] && time4>=bron3[1])) {kk=1; break;}
}
if (conums>1) kk=0;
if (kk==0){
for (var i = time; i <= time2; i+=86400) {
for (var l = 0; l < costarr2.length-1; l=l+3) {
	m=+costarr2[l+2];
	if (i >= costarr2[l] && i <= costarr2[l+1]) { k = k + m; }
}}
document.getElementById('cena2').innerHTML = 'Примерная стоимость проживания:';
document.getElementById('cena').innerHTML = k + ' руб.';
document.getElementById('cena').style.display = 'block';
document.getElementById('cena2').style.display = 'block';
document.getElementById('cena3').style.display = 'block';
document.getElementById('cena4').style.display = 'block';
}
else {
document.getElementById('cena2').innerHTML = 'Упс... К сожалению, выбранный вами диапазон забронирован... Выберите другую дату или другой вариант.';
document.getElementById('cena').innerHTML = '';
for (var ii = 0; ii <= bron2.length-1; ii++) {
bron3=bron2[ii].split("/");
var yyy= new Date(bron3[0]*1000); var uuu= new Date(bron3[1]*1000);
var month=new Array();
month[0]="января";
month[1]="февраля";
month[2]="марта";
month[3]="апреля";
month[4]="мая";
month[5]="июня";
month[6]="июля";
month[7]="августа";
month[8]="сентября";
month[9]="октября";
month[10]="ноября";
month[11]="декабря";
document.getElementById('cena').innerHTML += yyy.getDate() +' '+ month[yyy.getMonth()] +' '+ yyy.getFullYear() + ' г. - ' + uuu.getDate() +' '+ month[uuu.getMonth()] +' '+ uuu.getFullYear() + ' г.';
if (ii<bron2.length-1) document.getElementById('cena').innerHTML += '<br>';
}
document.getElementById('cena').style.display = 'block';
document.getElementById('cena2').style.display = 'block';
document.getElementById('cena3').style.display = 'none';
document.getElementById('cena4').style.display = 'none';

}
}
});
$(".zabron").click(function() {
//  var urlVar = window.location.search;
//    var arrayVar = [];
//   var valueAndKey = [];
//   var resultArray = [];
//   arrayVar = (urlVar.substr(1)).split('&');
//   if(arrayVar[0]=="") return false;
//   for (i = 0; i < arrayVar.length; i ++) {
//   valueAndKey = arrayVar[i].split('=');
//   resultArray[valueAndKey[0]] = valueAndKey[1];
// get = "http://www.eisk-sea.ru/online-order.html";
// get+="?var=";
// get+="";
// get+="&datearr=";
// get+="";
// get+="&datedep=";
// get+="";
jQuery.scrollTo('#bron-zag', 1000);
document.getElementById('modbook-arrival-date').value = startarr[2] + '.' + startarr[1] + '.' + startarr[0];
document.getElementById('modbook-departure-date').value = endarr[2] + '.' + endarr[1] + '.' + endarr[0];;
});
});