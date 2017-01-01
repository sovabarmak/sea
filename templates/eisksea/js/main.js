jQuery(document).ready(function ($) {
    $('.hidden-menu').click(function(){
		$('.new-menu .moduletable').toggle(200);
	});
	if (window.matchMedia("(max-width: 1023px)").matches) {
	$('.caption2 ul.menu li.deeper').prepend('<div class="menu-more">+</div>');
	$('.menu-more').click(function(){
		$(this).siblings('ul').toggle(200);
	});
	$('.big_img').each(function () {
        $(this).siblings('.img_carousel').insertAfter(this);
    });

};
	
	$('#prv').on('click', function(){
	    var $last = $('#car-wrap>.latestnews>li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $('#car-wrap>.latestnews>li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('#nxt').on('click', function(){
	    var $first = $('#car-wrap>.latestnews>li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $('#car-wrap>.latestnews>li:last').after($first);
	    });
	});

	$('.bl1 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl1').find('.bl1');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl1 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl1').find('.bl1');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});

	$('.bl2 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl2').find('.bl2');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl2 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl2').find('.bl2');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});

	$('.bl3 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl3').find('.bl3');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl3 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl3').find('.bl3');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});

	$('.bl4 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl4').find('.bl4');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl4 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl4').find('.bl4');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});

	$('.bl5 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl5').find('.bl5');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl5 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl5').find('.bl5');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});

	$('.bl6 .carousel-nav #prv').on('click', function(){
		$ul = $(this).parents('.bl6').find('.bl6');
	    var $last = $ul.find('li:last');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $ul.find('li:first').before($last);
	    $last.animate({ 'margin-left': '6px' }, 500); 
	});

	$('.bl6 .carousel-nav #nxt').on('click', function(){
		$ul = $(this).parents('.bl6').find('.bl6');
	    var $first = $ul.find('li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '6px' });
	        $ul.find('li:last').after($first);
	    });
	});


  $(document).bind('click', function(e) {
		var clicked = $(e.target);
		if (!clicked.parents().hasClass('dropdown')) {
			$('span.selectbox ul.dropdown').hide().find('li.sel').addClass('selected');
			$('span.selectbox').removeClass('focused');
		}
	});

	$('select.select').each(function() {

		var option = $(this).find('option');
		var optionSelected = $(this).find('option:selected');
		var dropdown = '';
		var selectText = $(this).find('option:first').text();
		if (optionSelected.length) selectText = optionSelected.text();

		for (i = 0; i < option.length; i++) {
			var selected = '';
			var disabled = ' class="disabled"';
			if ( option.eq(i).is(':selected') ) selected = ' class="selected sel"';
			if ( option.eq(i).is(':disabled') ) selected = disabled;
			dropdown += '<li' + selected + '>'+ option.eq(i).text() +'</li>';
		}

		$(this).before(
			'<span class="selectbox" style="display: inline-block; position: relative">'+
				'<span class="select" style="float: left; position: relative; z-index: 100"><span class="text">' + selectText + '</span>'+
					'<b class="trigger"><i class="arrow"></i></b>'+
				'</span>'+
				'<ul class="dropdown" style="position: absolute; z-index: 101; overflow: auto; overflow-x: hidden; list-style: none">' + dropdown + '</ul>'+
			'</span>'
		).css({position: 'absolute', left: -9999});

		var ul = $(this).prev().find('ul');
		var selectHeight = $(this).prev().outerHeight();
		if ( ul.css('left') == 'auto' ) ul.css({left: 0});
		if ( ul.css('top') == 'auto' ) ul.css({top: selectHeight});
		var liHeight = ul.find('li').outerHeight();
		var position = ul.css('top');
		ul.hide();

		/* при клике на псевдоселекте */
		$(this).prev().find('span.select').click(function() {

			/* умное позиционирование */
			var topOffset = $(this).parent().offset().top;
			var bottomOffset = $(window).height() - selectHeight - (topOffset - $(window).scrollTop());
			if (bottomOffset < 0 || bottomOffset < liHeight * 6)	{
				ul.height('auto').css({top: 'auto', bottom: position});
				if (ul.outerHeight() > topOffset - $(window).scrollTop() - 20 ) {
					ul.height(Math.floor((topOffset - $(window).scrollTop() - 20) / liHeight) * liHeight);
				}
			} else if (bottomOffset > liHeight * 6) {
				ul.height('auto').css({bottom: 'auto', top: position});
				if (ul.outerHeight() > bottomOffset - 20 ) {
					ul.height(Math.floor((bottomOffset - 20) / liHeight) * liHeight);
				}
			}

			$('span.selectbox').css({zIndex: 1}).removeClass('focused');
			if ( $(this).next('ul').is(':hidden') ) {
				$('ul.dropdown:visible').hide();
				$(this).next('ul').show();
			} else {
				$(this).next('ul').hide();
			}
			$(this).parent().css({zIndex: 2});
			return false;
		});

		/* при наведении курсора на пункт списка */
		$(this).prev().find('li:not(.disabled)').hover(function() {
			$(this).siblings().removeClass('selected');
		})
		/* при клике на пункт списка */
		.click(function() {
			$(this).siblings().removeClass('selected sel').end()
				.addClass('selected sel').parent().hide()
				.prev('span.select').find('span.text').text($(this).text())
			;
			option.removeAttr('selected').eq($(this).index()).attr({selected: 'selected'});
			$(this).parents('span.selectbox').next().change();
		});

		/* фокус на селекте при нажатии на Tab */
		$(this).focus(function() {
			$('span.selectbox').removeClass('focused');
			$(this).prev().addClass('focused');
		})
		/* меняем селект с клавиатуры */
		.keyup(function() {
			$(this).prev().find('span.text').text($(this).find('option:selected').text()).end()
				.find('li').removeClass('selected sel').eq($(this).find('option:selected').index()).addClass('selected sel');
		});

	});

});




jQuery(document).ready(function ($) {
	var mgRight = 7;
	
	$(".img_carousel").each(function(k, v) {
		var str = $(v).html().toString();
		if(str.indexOf("<img") != -1) {
			$(v).html('<div class="inner">' + $(v).html() + '</div>');
			corouselBuild ($(v));
		}
	});
	
	function corouselBuild (artC) {
		var ul = artC.find("ul"),
			block = artC.closest(".item-page"),
			bigImg = block.find(".big_img"),
			aW = artC.outerWidth() - 46,
			ulW = ul.width(),
			n = 0,
			liW = ul.find("li").first().width(),
			s = 350,
			counter = 0;
		ul.children("li").each(function(k,v) {
			var str = $(v).attr("class");
			if(typeof str === 'string') {
				if(str.indexOf("hide") == -1) {
					n++;
				}
			} else {
				n++;
			}
		});
		artC.children().before('<a class="img_carousel_prev"></a><a class="img_carousel_next"></a>');
		var prev = $(".img_carousel_prev"),
			next = $(".img_carousel_next");
			ulW = (liW + mgRight) * n;
			ul.width(ulW);
		
		next.click(function() {
			var u = $(this).parent().find("ul"),
				uw = u.width(),
				c = 0,
				step = 0,
				ulL = Math.floor(u.position().left),
				d = 0;
			u.children("li").each(function(k,v) {
				var str = $(v).attr("class");
				if(typeof str === 'string') {
					if(str.indexOf("hide") == -1) {
						c++;
					}
				} else {
					c++;
				}
			});
			step = Math.floor(uw/c);
			d = Math.floor((ulL-23)%step);
			if((ulL - aW - 30 + uw - 146) > 0) {
				u.stop().animate({left: ulL - step - d - 23}, s);
			}
			return false;
		});
		prev.click(function() {
			var u = $(this).parent().find("ul"),
				uw = u.width(),
				c = 0,
				step = 0,
				ulL = Math.floor(u.position().left),
				d = 0;
			u.children("li").each(function(k,v) {
				var str = $(v).attr("class");
				if(typeof str === 'string') {
					if(str.indexOf("hide") == -1) {
						c++;
					}
				} else {
					c++;
				}
			});
				step = Math.floor(uw/c);
				d = Math.floor((ulL-23)%step);
			if((ulL - 20 )< 0) {
				u.stop().animate({left: ulL + step - d - 23}, s);
			}
			return false;
		})
		
		ul.find("img").click(function(){

		});
	}
});

jQuery(document).ready(function ($) {
	
	$(".rsform-block-file2").css("display", "none");
	$(".rsform-block-file3").css("display", "none");
	$(".rsform-block-file4").css("display", "none");
	$(".rsform-block-file5").css("display", "none");
	$(".rsform-block-file6").css("display", "none");
	$(".rsform-block-file7").css("display", "none");
	$(".rsform-block-file8").css("display", "none");
	$(".rsform-block-file9").css("display", "none");
	$(".rsform-block-file10").css("display", "none");
	$(".rsform-block-file11").css("display", "none");
	$(".rsform-block-file12").css("display", "none");
	$(".rsform-block-file13").css("display", "none");
	$(".rsform-block-file14").css("display", "none");
	$(".rsform-block-file15").css("display", "none");
	$(".rsform-block-file16").css("display", "none");
	$(".rsform-block-file17").css("display", "none");
	$(".rsform-block-file18").css("display", "none");
	$(".rsform-block-file19").css("display", "none");
	$(".rsform-block-file20").css("display", "none");
	$(".rsform-block-file21").css("display", "none");
	$(".rsform-block-file22").css("display", "none");
	$(".rsform-block-file23").css("display", "none");
	$(".rsform-block-file24").css("display", "none");
	$(".rsform-block-file25").css("display", "none");
	$(".rsform-block-file26").css("display", "none");
	$(".rsform-block-file27").css("display", "none");
	$(".rsform-block-file28").css("display", "none");
	$(".rsform-block-file29").css("display", "none");
	$(".rsform-block-file30").css("display", "none");
	$(".rsform-block-file31").css("display", "none");
	$(".rsform-block-file32").css("display", "none");
	$(".rsform-block-file33").css("display", "none");
	$(".rsform-block-file34").css("display", "none");
	$(".rsform-block-file35").css("display", "none");
	$(".rsform-block-file36").css("display", "none");
	$(".rsform-block-file37").css("display", "none");
	$(".rsform-block-file38").css("display", "none");
	$(".rsform-block-file39").css("display", "none");
	$(".rsform-block-file40").css("display", "none");
	$("#sbox-window #sbox-content iframe document html body img").css("display", "none");
	
	initDescPricesBlock();
    
	var i=0;
	$("#add").click(function(){
		i++
		if(i == 1){$(".rsform-block-file2").css("display", "block");}
		if(i == 2){$(".rsform-block-file3").css("display", "block");}
		if(i == 3){$(".rsform-block-file4").css("display", "block");}
		if(i == 4){$(".rsform-block-file5").css("display", "block");}
		if(i == 5){$(".rsform-block-file6").css("display", "block");}
		if(i == 6){$(".rsform-block-file7").css("display", "block");}
		if(i == 7){$(".rsform-block-file8").css("display", "block");}
		if(i == 8){$(".rsform-block-file9").css("display", "block");}
		if(i == 9){$(".rsform-block-file10").css("display", "block");}
		if(i == 10){$(".rsform-block-file11").css("display", "block");}
		if(i == 11){$(".rsform-block-file12").css("display", "block");}
		if(i == 12){$(".rsform-block-file13").css("display", "block");}
		if(i == 13){$(".rsform-block-file14").css("display", "block");}
		if(i == 14){$(".rsform-block-file15").css("display", "block");}
		if(i == 15){$(".rsform-block-file16").css("display", "block");}
		if(i == 16){$(".rsform-block-file17").css("display", "block");}
		if(i == 17){$(".rsform-block-file18").css("display", "block");}
		if(i == 18){$(".rsform-block-file19").css("display", "block");}
		if(i == 19){$(".rsform-block-file20").css("display", "block");}
		if(i == 20){$(".rsform-block-file21").css("display", "block");}
		if(i == 21){$(".rsform-block-file22").css("display", "block");}
		if(i == 22){$(".rsform-block-file23").css("display", "block");}
		if(i == 23){$(".rsform-block-file24").css("display", "block");}
		if(i == 24){$(".rsform-block-file25").css("display", "block");}
		if(i == 25){$(".rsform-block-file26").css("display", "block");}
		if(i == 26){$(".rsform-block-file27").css("display", "block");}
		if(i == 27){$(".rsform-block-file28").css("display", "block");}
		if(i == 28){$(".rsform-block-file29").css("display", "block");}
		if(i == 29){$(".rsform-block-file30").css("display", "block");}
		if(i == 30){$(".rsform-block-file31").css("display", "block");}
		if(i == 31){$(".rsform-block-file32").css("display", "block");}
		if(i == 32){$(".rsform-block-file33").css("display", "block");}
		if(i == 33){$(".rsform-block-file34").css("display", "block");}
		if(i == 34){$(".rsform-block-file35").css("display", "block");}
		if(i == 35){$(".rsform-block-file36").css("display", "block");}
		if(i == 36){$(".rsform-block-file37").css("display", "block");}
		if(i == 37){$(".rsform-block-file38").css("display", "block");}
		if(i == 38){$(".rsform-block-file39").css("display", "block");}
		if(i == 39){$(".rsform-block-file40").css("display", "block"); $("#add").css("display", "none");}
	});
	
	if(document.location.href == 'http://www.eisk-sea.ru/questions.html')
	{
		$(".commentsheader").css('display','none');
		$("#comments-list").css('display','none');
		$("#comments-list-footer").css('display','none');
		$("#content .item-page img").css('border','none');
		$("#content .item-page img").css('margin-left','100px');
	}
    
	if(document.location.href == 'http://www.eisk-sea.ru/addquestion.html')
	{
		$(".commentsheader").css('display','none');
		$("#comments-list").css('display','none');
		$("#comments-list-footer").css('display','none');
		$("#content .item-page img").css('display','none');
	}

	function initDescPricesBlock() {
		$(".objcreate-detail .num-desc-price li").hide();
		$(".objcreate-detail .num-desc-price li").first().show();
	}
	function random(max){
		math.floor(math.random() * max);
	}
	var arr = ['http://www.eisk-sea.ru/templates/eisksea/images/img_bg.jpg','http://www.eisk-sea.ru/templates/eisksea/images/img_bg_2.jpg','http://www.eisk-sea.ru/templates/eisksea/images/img_bg_3.jpg'];
	var urll = arr[Math.floor(Math.random()*3)];
	$(".caption").css('backgroundImage', 'url('+urll+')');
	
	$('.item-page .img_carousel img').each(function(){
	  $(this).load(function(){
            var height = $(this).height();
            $(this).css('margin-top',-(height/2-49));
          });
    });
	
});

jQuery(document).ready(function ($) {
  $(".icon").click(function() {
    $(this).addClass('iconactive');
  });  
});

jQuery(document).ready(function ($) {
		$(".fancybox")
		.attr('rel', 'gallery')
		.fancybox({
        padding : 5,
		afterShow: function() {
		$(".fancybox-next").attr("title", "Следующее фото");
        $(".fancybox-prev").attr("title", "Предыдущее фото");
		$(".fancybox-close").attr("title", "Закрыть");
        $(".fancybox-title").wrapInner('<div />').show();
        $(".fancybox-wrap").hover(function() {
        $(".fancybox-title").show();
        }, function() {
            $(".fancybox-title").hide();
        });
    },
    helpers : {
        title: {
            type: 'over'
        }
    }
    });
	$(".varmap").fancybox({
                    type:"iframe",
					padding:0,
					scrolling: 'no',
                    width:800,
                    height:500,
					afterShow: function() {
		$(".fancybox-close").attr("title", "Закрыть");
    },
                    helpers : {
                        title : null
                    }
                });
	});
	
jQuery(document).ready(function ($) {
$('#hide_contacts').click(function(){
$('#contacts').hide('slow', function() {
$('#open_contacts').css('display', 'block')
});
});
$('#open_contacts').click(function(){
$('#open_contacts').css('display', 'none');
$('#contacts').show('fast');
});
});

jQuery(document).ready(function ($) {

 $('#date_start').datetimepicker({
 lang:'ru',
  format:'Y/m/d',
  dayOfWeekStart:'1',
  onShow:function( ct ){
   this.setOptions({
    maxDate:$('#date_end').val()?$('#date_end').val():false
   })
  },
  timepicker:false
 });
 $('#date_end').datetimepicker({
 lang:'ru',
  format:'Y/m/d',
  dayOfWeekStart:'1',
  onShow:function( ct ){
   this.setOptions({
    minDate:$('#date_start').val()?$('#date_start').val():false
   })
  },
  timepicker:false
 });

 $('#date_startt').datetimepicker({
 lang:'ru',
  format:'Y/m/d',
  dayOfWeekStart:'1',
  onShow:function( ct ){
   this.setOptions({
    maxDate:$('#date_endd').val()?$('#date_endd').val():false
   })
  },
  timepicker:false
 });
 $('#date_endd').datetimepicker({
 lang:'ru',
  format:'Y/m/d',
  dayOfWeekStart:'1',
  onShow:function( ct ){
   this.setOptions({
    minDate:$('#date_startt').val()?$('#date_startt').val():false
   })
  },
  timepicker:false
});

 
});