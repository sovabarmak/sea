<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
?>
<div id="objcreate-content" class="objcreate-category">
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
    <div class="pagination">
        <?php echo $this->pagination->getPagesLinks();?>
		<?php if ($this->pagination->getPagesLinks()){?>
		<br>
		<?php } ?>
    </div>
    <?php if ($this->params->get('show_page_heading')) : ?>
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    <?php endif; ?>

    <?php foreach ($this->items as $item):                 
                
        /*if(!empty($item->images))
        {        
            $images = array();
            $data = json_decode($item->images);
            $images = $data->images;            
        }*/
        
        ?>
        <div class="item-page objcreate-item item-<?php echo $item->id;?>"> 
            <div class="zag">
                <a href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$item->id); ?>">
                    <?php echo $item->name; ?>
                </a>
                <span class="show_on_map">
                    <a href="<?php echo "/maps.html?id="; echo $item->id; echo "&layout=google"; ?>" class="varmap">
                        <?php echo JText::_('COM_OBJCREATE_CATEGORY_SHOW_ON_MAP'); ?>
                    </a>
                </span>
           </div>
		 
		 
            <div class="big_img">
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
                        <a class="lbZoom" href="javascript:showLytebox(<?php echo $mainPhoto->id; ?>)">
                            <img src="<?php echo '/'.$mainPhoto->folder.'/tm_'.$mainPhoto->file; ?>" />                           
                            <div></div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="block_info">
                <div class="inf_title"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_INF_TITLE'); ?>:</div>
                <div class="inside">
                    <?php echo $item->inf_desc; ?>
                    <div class="inf_location">
                        <div class="inf_title"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_LOCATION_TITLE'); ?>: </div>
                        <div class="inside">
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
                            <? if(!empty($item->rooms)) : ?>
                                <div class="row">
                                    <span class="label"><?php echo JText::_('COM_OBJCREATE_OBJCREATE_FIELD_ROOMS_LABEL'); ?>: </span>
                                    <span class="val"><?php echo $item->rooms; ?></span>
                                </div>
                            <? endif; ?>
                            <? if(!empty($item->capacity)) : ?>
                                <div class="row">
                                    <span class="label"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_CAPACITY'); ?>: </span>
                                    <span class="val"><?php echo $item->capacity; ?></span>
                                </div>
                            <? endif; ?>                            
                        </div>
                    </div>
                    <div class="inf_price">
                        <div class="inf_title"><?php echo JText::_('COM_OBJCREATE_CATEGORY_LIST_PRICE_TITLE'); ?>:</div>
                        <div class="inside"><?php echo $item->price; ?></div>
                    </div>
                </div>
                <?php  ?>
            </div>
            <div class="clear"></div>
            <div class="img_carousel">
                <ul>
                    <?php if(!empty($item->nums)) { 
                        foreach($item->nums as $num) {
                            foreach($num->photos as $photo) {
                            ?>
                            <li id="num_photo_<?php echo $photo->id;?>">
                                <div>
                                <a href="javascript:showPhoto(<?php echo $photo->id;?>, <?php echo $item->id;?>)" rel1="<?php echo '/'.$photo->folder.'/'.$photo->file; ?>" rel2="<?php echo '/'.$photo->folder.'/tm_'.$photo->file; ?>">
                                    <img src="<?php echo '/'.$photo->folder.'/ts_'.$photo->file; ?>" />
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
            <div class="butts_block in-cat-butts">
				<a class="more" href="/estate/online-order.html?idd=<?php echo $item->id;?>">
					Забронировать
				</a>
                <a  class="bron_but" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$item->id); ?>">
                    <?php echo JText::_('COM_OBJCREATE_CATEGORY_BUTTS_BLOCK_MORE'); ?>
                </a>
                
            </div>
            <div class="clear"></div>
        </div><div class="bott"></div>
        <div class="clear"></div>
    <? endforeach; ?>
    
     <div class="pagination">
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
    
</div>