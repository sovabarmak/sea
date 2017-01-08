<?php
defined('_JEXEC') or die;
JHTML::_('behavior.modal');
JHtml::_('behavior.keepalive');
$input = JFactory::getApplication()->input;
$view = $input->get('view', null);
?>
<div class="block mod_block red">
    <div class="zag" id="bron-zag">Онлайн-заявка</div>
    <form action="<?php echo JRoute::_('/modules/mod_book/send.php'); ?>" method="post" id="book-form" >
	<input type="hidden" name="varr" value="<?php $var = $_GET['id'];$vari = modBookHelper::getVari($var); echo $vari;?>">
        <div class="row">
            <label for="modbook-username">Как вас зовут? *</label>
            <input id="modbook-username" type="text" name="username" class="inputbox" validate="name" required="true"/>
        </div>
		<div class="row">
			<label for="place_from">Откуда Вы приезжаете? *</label>
			<input type="text" name="place_from" id="place_from" class="inputbox" validate="name" required="true">
		</div>
		<div class="row">
            <label for="modbook-phone">Контактный телефон *</label>
            <input id="modbook-phone" type="text" name="phone" class="inputbox"  validate="phone" required="true"/>
        </div>
        <div class="row">
            <label for="modbook-email">Электронная почта</label>
            <input id="modbook-email" type="text" name="email" class="inputbox"  validate="email" />
        </div>
        <div class="row">
            <label for="modbook-amount-adults">Общее количество человек *</label>
            <input id="modbook-amount-adults" type="text" name="amount-adults" class="inputbox"  validate="amount" required="true"/>
        </div>
        <div class="row">
            <label for="modbook-amount-children">Количество детей и их возраст</label>
            <input id="modbook-amount-children" type="text" name="amount-children" class="inputbox" />
        </div>
        <div class="row date">
            <label for="modbook-arrival-date">Дата приезда *</label>            
            <?php 
			#$row->date;
			echo JHtml::calendar('', 'modbook-arrival-date', 'modbook-arrival-date', '%d.%m.%Y');?>
            <div class="icon" id="datearrival"></div>
        </div>
        <div class="row date">
            <label for="modbook-departure-date">Дата отъезда *</label>
            <?php echo JHtml::calendar('', 'modbook-departure-date', 'modbook-departure-date', '%d.%m.%Y');?>
            <div class="icon" id="datedepart"></div>
        </div>   		
        <?php if($view == "variant") : ?>
        <div class="row type" style="display: none;">
        <?php else: ?>
        <div class="row type">
        <?php endif; ?>
		
            <label>Тип размещения</label>
            <ul>
			
                <?php foreach ($list as $item) : ?>
				
                    <?php if($catid == $item->id) : ?>
                        <li>
						    <input id="modbook-type-<?= $item->id; ?>" type="checkbox" name="cat_<?= $item->id; ?>" class="checkbox" checked="checked" />
                            <label for="modbook-type-<?= $item->id; ?>"><?php echo $item->category; ?></label>
                        </li>
                    <?php else: ?>
									<? if (($item->id != 17) && ($item->id != 12)) {?>
                        <li>
                            <input id="modbook-type-<?= $item->id; ?>" type="checkbox" name="cat_<?= $item->id; ?>" class="checkbox"/>
                            <label for="modbook-type-<?= $item->id; ?>"><?php echo $item->category; ?></label>
                        </li>    
									<?}?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>     
	<div class="clear"></div>
        <div class="row">
            <label>Где вас встречать?</label>        
            <ul>
                <li>
                    <input id="modbook-meet1" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet1" class="radio">ЖД вокзал г. Ейск</label>
                </li>
                <li>
                    <input id="modbook-meet2" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet2" class="radio">Аэропорт г. Ейск</label>
                </li>
                <li>
                    <input id="modbook-meet3" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet3" class="radio">Автовокзал г. Ейска</label>
                </li>
                <li>
                    <input id="modbook-meet4" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet4" class="radio">ЖД станция "Староминская"</label>
                </li>
                <li>
                    <input id="modbook-meet5" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet5" class="radio">Аэропорт г. Ростов-на-Дону</label>
                </li>
                <li>
                    <input id="modbook-meet6" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet6" class="radio">Аэропорт г. Краснодар</label>
                </li>
                <li>
                    <input id="modbook-meet7" type="radio" name="meet" class="radio" />
                    <label for="modbook-meet7" class="radio">На въезде в г. Ейск</label>
                </li>                
            </ul>
        </div>
        <div class="row time">
            <label>Время встречи</label>             
            <input id="modbook-time-hours" type="text" size="2" name="time-hours" class="inputbox" validate="hours" value="12"/>
            <span>:</span>
            <input id="modbook-time-minuts" type="text" size="2" name="time-minuts" class="inputbox"  validate="minuts" value="00"/>            
            <div class="arrows">
                <div class="plus"></div>
                <div class="minus"></div>
            </div>
        </div>
		<div id="agree-row" class="row">
<input id="terms-agree" class="required" name="terms-agree" tabindex="9" type="checkbox">
<label for="terms-agree">
<a href="http://www.eisk-sea.ru/info/select-booking.html" target="_blank">Согласен с правилами подбора и бронирования жилья на сайте www.eisk-sea.ru</a>
<span class="req">*</span>
</label>
<div class="error-box"></div>
</div>
<div class="reqq">* поля, обязательные для заполнения</div>
        <input id="modbook-send" class="button disabled" name="submit" type="submit" value="Отправить заявку" />                    
    </form>
    <div id="book-msg-in-modal" style="display: none;"></div>    
</div>