<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
jimport('joomla.application.module.helper');

?>
<div id="objcreate-content" class="objcreate-detail">
    <form id="objcreate-filter-bar" action="<?php echo JRoute::_('index.php?option=com_objcreate&view=search'); ?>" method="post">
        <div class="filter-select">
            <ul>
                <li>
                    <select name="filter_catid" class="select">
                        <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_CATEGORY');?>...</option>
                        <?php echo JHtml::_('select.options', $this->f_categorys, 'value', 'text', $this->state->get('filter.catid'));?>
                    </select>
                </li>
                <li>
                    <select name="filter_districtid" class="select">
                        <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_DISTRICT');?>...</option>
                        <?php echo JHtml::_('select.options', $this->f_districts, 'value', 'text', $this->state->get('filter.districtid'));?>
                    </select>
                </li>
                <li>
                    <select name="filter_distanceid" class="select">
                        <option value="0"><?php echo JText::_('OBJCREATE_JOPTION_SELECT_DISTANCE');?>...</option>
                        <?php echo JHtml::_('select.options', $this->f_distances, 'value', 'text', $this->state->get('filter.distanceid'));?>
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

    <?php if ($this->params->get('show_page_heading')) : ?>
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    <?php endif; ?>

    <?php
	foreach ($this->items as $item):
        $pri=strip_tags($item->price);
		$pri=str_replace(array("\r","\n"), '', $pri);
		$pri=preg_replace('/Время.*/', '', $pri);
		$pri=preg_replace('/\*.*/', '', $pri);
		$pri=preg_replace('/4-м.*/', '', $pri);
		$pri=preg_replace('/\D+/', ' ', $pri);
		$pri=preg_replace('/^\s/', '', $pri);
		$pri=preg_replace('/^\d\s/', '', $pri);
		$pri=preg_replace('/\s*&/', '', $pri);
		$pri=preg_replace('/(\s\d)&/', '', $pri);
        /*if(!empty($item->images))
        {
            $images = array();
            $data = json_decode($item->images);
            $images = $data->images;
			$min_t_id = $images[0]->title;
			$big_img = $images[1]->src;
			foreach($images as $t) {
				if($t->title < $min) {
					$min_t_id = $t->title;
					$big_img = $t->src;
				}
			}
        }*/

        ?>
		<input type="hidden" name="pri" id="pri" value="<?php echo $pri;?>">
		<input type="hidden" name="bro" id="bro" value="<?php echo $item->brr;?>">
		<input type="hidden" name="conums" id="conums" value="<?php echo $item->count_of_nums;?>">
        <div class="item-page objcreate-item">
            <div class="zag zagg">
			<div class="zag2">
                <?php echo $item->name; ?>
</div>
<div class="zag3">
               <a href="/estate/online-order.html?idd=<?php echo (int)$item->id;?>">Бронировать</a>
</div>
           </div>
            <div class="img_carousel">
                <ul>
                    <?php if(!empty($item->nums)) {
                        foreach($item->nums as $num) {
                            foreach($num->photos as $photo) {
                            ?>
                            <li id="num_photo_<?php echo $photo->id;?>" rel="num_id_<?php echo $num->id; ?>">
                                <div>
                                <a href="javascript:showPhoto(<?php echo $photo->id;?>)" rel1="<?php echo '/'.$photo->folder.'/'.$photo->file; ?>" rel2="<?php echo '/'.$photo->folder.'/tl_'.$photo->file; ?>">
                                    <img class="titleid_<?php echo $num->id; ?>" rel="photo_id_<?php echo $photo->id; ?>" src="<?php echo '/'.$photo->folder.'/ts_'.$photo->file; ?>" />
                                </a>
                                </div>
                            </li>
                        <?
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <ul style="display: none;">
                <?php if(!empty($item->nums)) {
                    foreach($item->nums as $num) {
                        foreach($num->photos as $photo) {
                        ?>
                        <li>
                            <a id="hidden_lytebox_<?php echo $photo->id; ?>" href="<?php echo '/'.$photo->folder.'/'.$photo->file; ?>" class="fancybox" rel="group:orion<?php echo JRoute::_((int)$item->id); ?>" title="<?php echo $num->title; ?>">

                            </a>
                        </li>
                    <?
                        }
                    }
                }
                ?>
            </ul>

            <div class="clear"></div>
            <div class="num_title">
                <?php echo $item->nums[0]->title; ?>
            </div>
            <div class="big_img" id="main_img">
                <?php
                if (!empty($item->nums))
                {
                    $mainPhoto = null;
                    // Найдём первое попавшееся фото в номерах
                    foreach ($item->nums as $num)
                    {
                        if (!empty($num->photos))
                        {
                            $mainPhoto = $num->photos[0];
                            break;
                        }
                    }

                    if (!empty($mainPhoto))
                    {
                        ?>
                        <a class="lbZoom" href="javascript:showLytebox(<?php echo $mainPhoto->id; ?>)"> <!-- <?php echo '/'.$mainPhoto->folder.'/'.$mainPhoto->file; ?> -->
                            <img src="<?php echo '/'.$mainPhoto->folder.'/tl_'.$mainPhoto->file; ?>" />
                            <div></div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="numbers-list">
                <ul>
                    <?php foreach($item->nums as $num) : ?>
                        <li><a id="titleid_<?php echo $num->id; ?>" href="#"><?php echo $num->title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="number_list_butt">
                    <a class="all_photo" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=gallery&id='.(int)$item->id); ?>"><?php echo JText::_('COM_OBJCREATE_CATEGORY_BUTTS_BLOCK_ALL_PHOTO'); ?></a>
                    <a class="my_selection" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$item->id); ?>"><?php echo JText::_('COM_OBJCREATE_CATEGORY_BUTTS_BLOCK_M_SELECTION'); ?></a>
                </div>
            </div>
            <div class="clear"></div>
            <ul class="num-desc-price">
                <?php foreach($item->nums as $num) : ?>
                    <li id="num_<?php echo $num->id; ?>">
                        <div class="num-desc"><?php echo $num->desc; ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="num-prices">
                <?php echo $item->numsprices; ?>
                <div id="sep1" class="vert-sep"></div>
                <div id="sep2" class="vert-sep"></div>
                <div id="sep3" class="vert-sep"></div>
            </div>
            <div class="num-price-note">* <?php echo JText::_('COM_OBJCREATE_DETAIL_NUMBER_PRICE_NOTE'); ?></div>

			<?php if ($item->catid<>12) { ?>
            <h3>Расчет стоимости:</h3>
				<div class="calc">
<input class="date_bronn" id="date_startt" placeholder="Дата заезда" name="date_fromm" type="text">
<input class="date_bronn" id="date_endd" placeholder="Дата выезда" name="date_too" type="text">
<button type="button" id="calcBtn" class="calculate big-btn big-btn-blue2">
<span>Рассчитать</span>
</button>
<p></p>
<div id="cena2">Примерная стоимость проживания:</div><div id="cena">0 руб.</div>
<p id="cena3">*Размер оплаты может незначительно меняться в меньшую сторону в зависимости от времени приезда и отъезда</p>
<div class="row-cont" id="cena4" style="display:none;">
<div class="col-cont">
<h3>Звоните прямо сейчас!</h3>
<p class="contact phone1">+7 (861) 299-92-75</p><br>
<p class="contact mts">+7 (918) 33-111-39</p><br>
<p class="contact beeline">+7 (961) 850-888-0</p><br>
<p class="contact megafon">+7 (928) 04-37-555</p><br>

<h3 style="margin-top:20px;">или пишите</h3>
<p class="contact email"><a href="mailto:info@eisk-sea.ru">info@eisk-sea.ru</a></p><br>
<p class="contact skype">eisk-sea</p><br>
<br>
</div><div class="col-bron">
<a class="zabron big-btn big-btn-blue2" href="/estate/online-order.html?idd=<?php echo $_GET['id'] ?>">
<span>Забронировать онлайн</span>
</a>
</div></div><div style="clear: both;"></div>
	</div>
			<?php } ?>
			<div class="clear"></div>
            <iframe id="map_canvas" name="map" frameborder="0" src="http://www.eisk-sea.ru/maps.html?id=<?php echo $item->id; ?>&height=430&layout=google" height="430" width="640" ></iframe>

            <div class="location_info">
                <div class="inf_title"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LOCATION_INFO_TITLE'); ?>:</div>
                <? if(!empty($item->district)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_DISTRICT'); ?>: </span>
                    <span class="val"><?php echo $item->district; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->location)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_STREET'); ?>: </span>
                    <span class="val"><?php echo $item->location; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->pond)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_POND_SEA'); ?>: </span>
                    <span class="val"><?php echo $item->pond; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->distance_sea)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_DISTANSE_SEA'); ?>: </span>
                    <span class="val"><?php echo $item->distance_sea; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->to_center)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_TO_CENTER'); ?>: </span>
                    <span class="val"><?php echo $item->to_center; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->to_park)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_TO_PARK_LABEL'); ?>: </span>
                    <span class="val"><?php echo $item->to_park; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->to_water_park)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_WATER_PARK_LABEL'); ?>: </span>
                    <span class="val"><?php echo $item->to_water_park; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->to_dolphin_aquarium)) : ?>
                <div class="row">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_DOLPHIN_AQUARIUM_LABEL'); ?>: </span>
                    <span class="val"><?php echo $item->to_dolphin_aquarium; ?></span>
                </div>
                <? endif; ?>
                <? if(!empty($item->infrastructure)) : ?>
                <div class="rowlast">
                    <span class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_INFRASTRUCTURE_LABEL'); ?>: </span>
                    <span><?php echo $item->infrastructure; ?></span>
                </div>
                <? endif; ?>
                <div class="vert_sep"></div>
            </div>
            <div class="clear"></div>
            <div class="detal-info">
                <div class="inf_title"><?php echo JText::_('COM_OBJCREATE_CATEGORY_DETAIL_INTO_TITLE'); ?></div>



                <? if(!empty($item->inf_text)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_OBJECT_DESC'); ?>:</div>
                        <div class="value"><?php echo $item->inf_text; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->floor)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_FLOOR_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->floor; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->accomodation_units)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_ACCOMODATION_UNITS_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->accomodation_units; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->rooms)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_ROOMS_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->rooms; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->capacity)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_CAPACITY'); ?>:</div>
                        <div class="value"><?php echo $item->capacity; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->sleeps)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_SLEEPS_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->sleeps; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->household_appliances)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_HOUSEHOLD_APPLIANCES_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->household_appliances; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->food)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_FOOD_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->food; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->wv)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_WV_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->wv; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->parking)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_PARKING_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->parking; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->availability_hosts)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_AVAILABILITY_HOSTS_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->availability_hosts; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->children)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_CHILDREN_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->children; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->pet)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_PET_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->pet; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->prepayment)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_PREPAYMENT_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->prepayment; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->payment)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_PEYMENT_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->payment; ?></div>
                    </div>
                <? endif; ?>
                <? if(!empty($item->additional_services)) : ?>
                    <div class="field">
                        <div class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_ADDITIONAL_SERVICES_LABEL'); ?>:</div>
                        <div class="value"><?php echo $item->additional_services; ?></div>
                    </div>
                <? endif; ?>
				<?php if(isset($this->prev) || isset($this->next)){ ?>
				<div class="clear" style="height: 50px;"></div>
				<center>
				<div class="prev_next">
				<?php if(isset($this->prev)){ ?><img src="/media/system/images/arrow_rtl.png" width="13px" height="13px">
<a id="but1" class="button" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$this->prev->id); ?>">
                    <?php echo $this->prev->name; ?></a><?php } ?>
				<a class="button" href="<?php  echo substr($this->document->base, 0, 22); echo JRoute::_('index.php?option=com_objcreate'); ?>">Назад в Категорию</a>

				<?php if(isset($this->next)){ ?>
                <a id="but2" class="button" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$this->next->id); ?>">
                    <?php echo $this->next->name; ?></a><img src="/media/system/images/arrow.png" width="13px" height="13px"><? } ?>

            </div></center><?php } ?>
			<div class="clear"></div>
			<center> <div class="prev_next"><a class="button" href="<?php  echo $this->document->base; ?>">Перейти на главную страницу</a></div></center>
            </div>
            <div class="rightblocks">
                <div class="cantact">
                    <?php
                        $modules = JModuleHelper::getModules('comcantact');
                        foreach($modules as $module)
                        {
                            echo JModuleHelper::renderModule($module);
                        }
                    ?>
                </div>
                <div class="clear"></div>
				<a name="bron"></a>
                <div class="book">
                    <?php
                        $modules = JModuleHelper::getModules('combook');
                        foreach($modules as $module)
                        {
                            echo JModuleHelper::renderModule($module);
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
<!--            <div class="butts_block">
                <a class="more" href="#">
                    <?php // echo JText::_('COM_OBJCREATE_CATEGORY_BUTTS_BLOCK_MORE'); ?>
                </a>
                <a class="my_selection" href="#">
                    <?php // echo JText::_('COM_OBJCREATE_CATEGORY_BUTTS_BLOCK_M_SELECTION'); ?>
                </a>
            </div>-->
            <div class="clear"></div>
        </div><div class="bott"></div>
        <div class="clear"></div>
    <? endforeach; ?>
</div>