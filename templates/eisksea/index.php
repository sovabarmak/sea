<?php
/**
* Template for Joomla by Babkin Alexey
* @author     Babkin Alexey
* @copyright  Copyright (c) 2012, www.gtalk.kz
* @license    GNU GPL
*/
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.modal', 'a.modal');
$input = JFactory::getApplication()->input;
$view = $input->get('view', null);
$desc = $input->get('start', null);
$document   = & JFactory::getDocument();
$config   = & JFactory::getConfig();
?>
    <?php 
$limit =  $input->getInt('limitstart', 0);
if ($limit){
$mytitle = $document->getTitle();
$desc = $document->getMetadata('description');
$numpage = $limit / 7 + 1;
$titletext =' - страница '.$numpage;
$document->setTitle($mytitle.$titletext);
$document->setMetadata('description', $desc.$titletext);
}
  $curtitle = $document->title.' — '.$config->getValue('sitename');
$document->setTitle( $curtitle );

$app = JFactory::getApplication();
$menu = $app->getMenu();

if ($menu->getActive() == $menu->getDefault() || $menu->getActive()->alias == 'estate') {
	require_once(JPATH_BASE.'/components/com_objcreate/helpers/objcreatefilterlisthelper.php');
	$filtr = new  ObjCreateFilterListHelper();
	$cats = $filtr->getOptionsLists('category');
	$districts = $filtr->getOptionsLists('district');
	$distances = $filtr->getOptionsLists('distance_sea');
	$lang = JFactory::getLanguage();
	$extension = 'com_objcreate';
	$base_dir = JPATH_SITE;
	$language_tag = 'ru-RU';
	$reload = true;
	$lang->load($extension, $base_dir.'/components/com_objcreate/', $language_tag, $reload);
}
?>
    <!DOCTYPE HTML>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">

    <head>
        <script src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/jquery-1.11.2.min.js"></script>
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <jdoc:include type="head" />
		<?php
			if ($menu->getActive() == $menu->getDefault() || $menu->getActive()->id = 103 ) {
		?>
		 <link rel="stylesheet" type="text/css" href="/components/com_objcreate/views/objcreates/style.css" />
		<?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/system/css/system.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/system/css/general.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>media/system/css/modal.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/template.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/jquery.datetimepicker.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/jquery.fancybox.css" />
        <script type="text/javascript" src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/main.js"></script>
        <script type="text/javascript" charset="utf-8" src="/components/callme/js/callme.js"></script>
        <script type="text/javascript">
        <?php echo 'var baseurl = "'.$this->baseurl.'";';?>
        </script>
        <script src="<?php echo $this->baseurl?>/modules/mod_book/tmpl/mychange.js"></script>
        <script src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/jquery.datetimepicker.js"></script>
        <script src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="templates/eisksea/js/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="templates/eisksea/js/jquery.fancybox.pack.js"></script>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    </head>

    <body class="<?php
if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') ) echo 'firefox';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') ) echo 'chrome';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') ) echo 'safari';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') ) echo 'opera';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) echo 'ie6';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) echo 'ie7';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) echo 'ie8';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') ) echo 'ie9';
elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0') ) echo 'ie10';
?>">
<div class="caption" style="display:none;"></div>
        <div class="caption2 t" style="background: url('http://www.eisk-sea.ru/templates/eisksea/images/main-bg.jpg') no-repeat bottom center; height: 386px; margin-bottom: 20px;">
            <div class="caption-inner">
            </div>
            <div class="new-menu">
              <div class="hidden-menu"><i class="fa fa-bars"></i>МЕНЮ</div>
                <?php if($this->countModules('nav')) : ?>
                <jdoc:include type="modules" name="nav" style="xhtml" />
                <? endif ?>
<a href="/"><div class="home-but"><img src="http://www.eisk-sea.ru/templates/eisksea/images/home-but.png"></div></a>
            </div>
            <div class="inner-block">
                <div class="left-block2">
                    <div class="title1">ОТДЫХ В ЕЙСКЕ 2017</div>
                    <div class="title2">Город Ейск - это Азовское море, инфраструктура
                        <br> для отдыха с детьми, чистые пляжи и мягкий климат
                        <br>Ейск 2017 - отдых в Краснодарском крае без забот!</div>
                    <div class="bottom-block">
                        <div class="title3">К вашим услугам:</div>
                        <ul>
                            <li>Информация о городе и развлечениях</li>
                            <li>База жилья с фотографиями и описанием</li>
                            <li>Предварительное бронирование</li>
                            <li>Скидки и горячие предложения</li>
                            <li>Бесплатная встреча на вокзале</li>
                        </ul>
                    </div>
                </div>
                <div class="right-block">
                    <a href="/"><img src="http://www.eisk-sea.ru/templates/eisksea/images/logo.png" alt="logo" class="logo2"></a>
					<div class="phone1">+7 (861) 299-92-75</div>
					<div class="phone2">+7 (918) 33-111-39</div>
					<div class="phone3">+7 (961) 850-888-0</div>
					<div class="phone4">+7 (928) 04-37-555</div>
					<div class="right-contacts">
						<div class="r-mail">info@eisk-sea.ru</div>
						<div class="r-skype">eisk-sea</div>
					</div>
                                        <a class="order" href="/estate/online-order.html">ОНЛАЙН-ЗАЯВКА</a>
  
                </div>
            </div>
        </div>
        <?php if($this->countModules('categorys')) : ?>
        <div class="categorys">
            <jdoc:include type="modules" name="categorys" style="xhtml" />
        </div>
        <?php endif; ?>
		<?php
		
		if ($menu->getActive() == $menu->getDefault() || $menu->getActive()->alias == 'estate') {
		?>
			<div id="form-wrapp" class="content">
			<form id="objcreate-filter-bar" action="<?php echo JRoute::_('index.php?option=com_objcreate&view=search'); ?>" method="post">       
            <div class="filter-select"> 
                <ul>
                    <li>
                        <select name="filter_catid" class="select">
                            <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_CATEGORY');?>...</option>
                            <?php echo JHtml::_('select.options', $cats, 'value', 'text');?>
                        </select>
                    </li>
                    <li>
                        <select name="filter_districtid" class="select">
                            <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_DISTRICT');?>...</option>
                            <?php echo JHtml::_('select.options', $districts, 'value', 'text');?>
                        </select>
                    </li>
                    <li>
                        <select name="filter_distanceid" class="select">
                            <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_DISTANCE');?>...</option>
                            <?php echo JHtml::_('select.options', $distances, 'value', 'text');?>
                        </select>            
                    </li>
					<li>
						<input placeholder="Цена от:" name="min" class="price2" type="text">
						<input placeholder="Цена до:" name="max" class="price2" type="text">
						<input class="date_bron" id="date_start" placeholder="Дата от:" name="date_from" type="text">
						<input class="date_bron" id="date_end" placeholder="Дата до:" name="date_to" type="text">
					</li>
				</ul>
			</div>
			<button class="button fa fa-search" type="submit" name="submit"></button>
							
		</form>
		</div>
		<?php } ?>
		
        <?php if($this->countModules('banner')) : ?>
        <div class="baner">
            <jdoc:include type="modules" name="banner" style="xhtml" />
        </div>
        <? endif; ?>
            <?php if($this->countModules('search')) : ?>
            <div id="search">
                <jdoc:include type="modules" name="search" style="xhtml" />
            </div>
            <? endif; ?>
                <div class="content">
                    <?php if($this->countModules('position-2')) : ?>
                    <div class="breadcrumbs">
                        <jdoc:include type="modules" name="position-2" style="xhtml" />
                    </div>
                    <? endif; ?>
					 <?php if($this->countModules('hot')) : ?>
                            <div class="clear"></div>
                            <? if($view != "variant") : ?>
                                <div class="block oran hot new-page">
                                    <jdoc:include type="modules" name="hot" style="oranhtml" />
                                </div>
                                <div class="clear"></div>
                                <? endif; ?>
                                    <? endif; ?>
                        <?php 
          $all_width = $this->params->get('all_width');     
          ?>
                        <div class="leftblocks <?php if (!empty($all_width) && $all_width=='1') {echo 'all_width';}?>">
                           
                                        <?php if($this->countModules('touristguide')) : ?>
                                        <div class="block purp touristguide">
                                            <jdoc:include type="modules" name="touristguide" style="purphtml" />
                                        </div>
                                        <div class="clear"></div>
                                        <? endif; ?>
                                            <?php if($this->countModules('reviews')) : ?>
                                            <div class="block green reviews">
                                                <jdoc:include type="modules" name="reviews" style="xhtml" />
                                                <a class="button_green rev_but add_reviews" href="add_review.html">
                            Добавить отзыв
                        </a>
                                                <a class="button_green rev_but all_reviews" href="reviews.html">
                            Все отзывы
                        </a>
                                            </div>
                                            <div class="clear"></div>
                                            <? endif; ?>
                                                <?php if($this->countModules('entertainment')) : ?>
                                                <div class="block blue entertainment">
                                                    <jdoc:include type="modules" name="entertainment" style="xhtml" />
                                                </div>
                                                <div class="clear"></div>
                                                <? endif; ?>
                                                    <?php if($this->countModules('faq-latest')) : ?>
                                                    <div class="block oran faq-latest">
                                                        <div class="tit">
                                                            <div class="oran"><span>ВОПРОС-ОТВЕТ</span></div>
                                                        </div>
                                                        <div class="butts_block">
                                                            <a class="all_question" href="<?php echo $this->baseurl?>/questions.html">Все вопросы</a>
                                                            <a class="ask" href="<?php echo $this->baseurl?>/addquestion.html" rel="nofollow">Задать вопрос</a>
                                                        </div>
                                                        <jdoc:include type="modules" name="faq-latest" />
                                                    </div>
                                                    <? endif; ?>
                        </div>
                         <div class="rightblocks">            
                
                <?php if($this->countModules('cantact')) : ?>
<div class="clear"></div>              
                    <div class="cantact">
                        <jdoc:include type="modules"  name="cantact" style="xhtml"/>                        
                    </div>
                    <div class="clear"></div>
                <? endif; ?>  
                  
                                <?php if($this->countModules('abouteisk')) : ?>
                                <div class="block darkgreen eisk">
                                    <jdoc:include type="modules" name="abouteisk" style="xhtml" />
                                </div>
                                <div class="clear"></div>
                                <? endif; ?>
                                    <?php if($this->countModules('conkurs')) : ?>
                                    <div class="block red conkurs">
                                        <jdoc:include type="modules" name="conkurs" style="xhtml" />
                                    </div>
                                    <div class="clear"></div>
                                    <? endif; ?>
                                        <?php if($this->countModules('sport')) : ?>
                                        <div class="block blue sport">
                                            <jdoc:include type="modules" name="sport" style="xhtml" />
                                        </div>
                                        <div class="clear"></div>
                                        <? endif; ?>
                                            <?php if($this->countModules('trustus')) : ?>
                                            <div class="block red trustus">
                                                <jdoc:include type="modules" name="trustus" style="xhtml" />
                                            </div>
                                            <? endif; ?>
                                                <?php if($this->countModules('cantact2')) : ?>
                                                <? if($view != "variant") : ?>
                                                    <div class="cantact">
                                                        <jdoc:include type="modules" name="cantact2" style="xhtml" />
                                                    </div>
                                                    <div class="clear"></div>
                                                    <? endif; ?>
                                                        <? endif; ?>
                        </div>
                        <?php if($this->countModules('content')) : ?>
                        <div id="content">
                            <!--<jdoc:include type="message" />-->
                            <jdoc:include type="modules" name="maphead" />
                            <jdoc:include type="modules" name="entertainment" style="xhtml" />
                            <?php if($view<>"variant" && $view<>"search" && $view<>"gallery" && $desc=="" && $this->countModules('desc')){?>
                            <div class="desc">
                                <jdoc:include type="modules" name="desc" />
                            </div>
                            <?}?>
                                <jdoc:include type="component" />
                                <?php if($view<>"variant" && $view<>"search" && $view<>"gallery" && $desc=="" && $this->countModules('desc2')){?>
                                <div class="clear"></div>
                                <div class="desc">
                                    <jdoc:include type="modules" name="desc2" />
                                </div>
                                <?}?>
                                    <?php if($this->countModules('text_k')){?>
                                    <div id="GMapInfoFooter">
                                        <jdoc:include type="modules" name="text_k" />
                                    </div>
                                    <?}?>
                        </div>
                        <div class="clear"></div>
                        <? endif; ?>
                            <?php if($this->countModules('scroll')) : ?>
                            <jdoc:include type="modules" name="scroll" />
                            <? endif; ?>
                                <?php if($this->countModules('social')) : ?>
                                <jdoc:include type="modules" name="social" />
                                <? endif; ?>
                                    <script type="text/javascript" src="http://consultsystems.ru/script/13767/" charset="utf-8"></script>
                                    <?php if($this->countModules('book')) : ?>
                                    <div id="content">
                                        <div class="page-item">
                                            <div class="book" id="book">
                                                <jdoc:include type="modules" name="book" style="xhtml" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <? endif; ?>
                                        <?php if($this->countModules('newmaterials')) : ?>
                                        <div class="block blue newmaterials">
                                            <jdoc:include type="modules" name="newmaterials" style="xhtml" />
                                        </div>
                                        <? endif; ?>
                </div>
                <div class="clear">
                </div>
                <div class="futer">
                    <div class="line"></div>
                    <div class="info">
                        <a href="<? echo $this->baseurl ?>" class="logo"></a>
                        <div class="text">
                            <jdoc:include type="modules" name="copyrights" />
                        </div>
                        <div class="counter">
                            <!--LiveInternet counter-->
                            <script type="text/javascript">
                            document.write("<a href='http://www.liveinternet.ru/click' target=_blank><img src='//counter.yadro.ru/hit?t14.6;r" + escape(document.referrer) + ((typeof(screen) == "undefined") ? "" : ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ? screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) + ";h" + escape(document.title.substring(0, 80)) + ";" + Math.random() + "' border=0 width=88 height=31 alt='' title='LiveInternet: number of pageviews for 24 hours, of visitors for 24 hours and for today is shown'><\/a>")
                            </script>
                            <!--/LiveInternet-->
                        </div>
                        <?php if($this->countModules('counter')) : ?>
                        <jdoc:include type="modules" name="counter" style="xhtml" />
                        <? endif; ?>
                            <script>
                            (function(i, s, o, g, r, a, m) {
                                i['GoogleAnalyticsObject'] = r;
                                i[r] = i[r] || function() {
                                    (i[r].q = i[r].q || []).push(arguments)
                                }, i[r].l = 1 * new Date();
                                a = s.createElement(o),
                                    m = s.getElementsByTagName(o)[0];
                                a.async = 1;
                                a.src = g;
                                m.parentNode.insertBefore(a, m)
                            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                            ga('create', 'UA-56970561-1', 'auto');
                            ga('send', 'pageview');
                            </script>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="clear"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <!-- Yandex.Metrika counter -->
                <script type="text/javascript">
                (function(d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter23357116 = new Ya.Metrika({
                                id: 23357116,
                                webvisor: true,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true
                            });
                            w.yaCounter23381566 = new Ya.Metrika({
                                id: 23381566,
                                webvisor: true,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true
                            });
                        } catch (e) {}
                    });
                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function() {
                            n.parentNode.insertBefore(s, n);
                        };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks");
                       $(window).load(function (e) {

function showLytebox(photoid)
{
    clik=document.getElementById('hidden_lytebox_'+photoid.toString());
clik.click();
    jQuery('#hidden_lytebox_'+photoid.toString()).trigger('click');
}
    $("#consultsystems_button_0").prepend("<div class='salimCallback callme_viewform' onclick='return false;'><div>Заказать звонок</div><img width='25' src='http://www.eisk-sea.ru/templates/eisksea/images/salcall.png'></div>")
    $(".block.oran.hot").append("<div class='carousel-nav' style='position: relative; top: 60px;'><span id='prevBtn' class='saprv salBut'></span><span id='nextBtn' class='sanxt salBut'></span></div>") 
    var elem = $(".block.oran.hot ul.newsflash-horiz > li")
    var lengthSlider = elem.length;
	lengthSlider=lengthSlider-5;
	$('.block.oran.hot ul.newsflash-horiz>li:last').hide();
$('#prevBtn').on('click', function(){
	    var $last = $('.block.oran.hot ul.newsflash-horiz>li:last');
		var $first = $('.block.oran.hot ul.newsflash-horiz>li:first');
	    $last.remove().css({ 'margin-left': '-400px' });
	    $('.block.oran.hot ul.newsflash-horiz>li:first').before($last);
	    $last.animate({ 'margin-left': '0px' }, 500);
	});

	$('#nextBtn').on('click', function(){
		 var $last = $('.block.oran.hot ul.newsflash-horiz>li:last');
	    var $first = $('.block.oran.hot ul.newsflash-horiz>li:first');
	    $first.animate({ 'margin-left': '-400px' }, 500, function() {
	        $first.remove().css({ 'margin-left': '0px' });
	        $('.block.oran.hot ul.newsflash-horiz>li:last').after($first);
			
	    });
	});
});

                </script>
                <style>
                    .newsflash-horiz {
                        overflow: "hidden";
                     }
                    .salimCallback {
                        position: fixed;
                        width: 180px;
                        cursor: pointer;
                        background: #af1418;
                        background: -moz-linear-gradient(left, #e81c23 0%, #af1418 100%);
                        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#e81c23), color-stop(100%,#c5171c));
                        background: -webkit-linear-gradient(left, #e81c23 5%, #c5171c95%);
                        background: -o-linear-gradient(left, #dd1a2110%, #c5171c90%);
                        background: -ms-linear-gradient(left, #dd1a21 90%, #c5171c5%);
                        background: linear-gradient(left, #dd1a21 0%, #dd1a21 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e81c23', endColorstr='#af1418', GradientType=1 );
                        padding: 3px;       
                        border-top-right-radius: 3px;
                        top: -50px;
                        left: -150px;
                        border-bottom-right-radius: 3px;  
                        transition: all 200ms;           
                    }
                    .salimCallback:hover {
                        left: 0;                    
                    }
                    .salimCallback div {
                        line-height: 38px;
                        float: left;
                        margin-right: 29px;
                        margin-left: 8px;
                        font: bold 14px/32px Arial!important;
                        font-family: Arial!important;
                        font-weight: bold;
                        color: white;
                        text-shadow: 1px 1px 1px rgba(0,0,0,.5);
                    }
                    .salimCallback img {
                        margin-top: 5px;                      
                    }

                    .salBut {
                        width: 20px;
                        height: 60px;
                        position: absolute;  
                        cursor: pointer;         
                    }  
                
                    .rightblocks .contact {
                        margin-left: 30px;                    
                    }

                     .left_arrow {
                        left: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/prev.png") no-repeat 0px -60px !important;                 
                    }
                    .right_arrow {
                        right: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/next.png") no-repeat 0px -60px !important;                 
                    }
                    .block.oran.hot .saprv {
                        left: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/prev.png") no-repeat 0px 1px !important;                 
                    }
                    .block.oran.hot .sanxt {
                        right: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/next.png") no-repeat 0px 1px !important;                 
                    }
.block.oran.hot .saprv:hover {
                        left: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/prev.png") no-repeat 0px -56px !important;                 
                    }
                    .block.oran.hot .sanxt:hover {
                        right: 10px;
                        background: url("http://www.eisk-sea.ru/templates/eisksea/images/next.png") no-repeat 0px -56px !important;                 
                    }
                    
                </style>
                <noscript>
                    <div><img src="//mc.yandex.ru/watch/23357116" style="position:absolute; left:-9999px;" alt="" /></div>
                </noscript>
                <noscript>
                    <div><img src="//mc.yandex.ru/watch/23381566" style="position:absolute; left:-9999px;" alt="" /></div>
                </noscript>
                <!-- /Yandex.Metrika counter -->
                <script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=1479644" type="text/javascript"></script>
    </body>

    </html>