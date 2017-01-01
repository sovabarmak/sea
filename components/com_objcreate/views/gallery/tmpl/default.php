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

    <?php foreach ($this->items as $item):                 
          
        ?>
        <div class="item-page objcreate-item"> 
           <div class="zag zagg">
			   <h2 class="zag2 gal-zag">
					<?php echo $item->name.' - '.JText::_('COM_OBJCREATE_CATEGORY_GALLERY_RESULTS'); ?>                
			   </h2> 
			</div>
            <div class="gallery">
				<?php 
					if(!empty($item->nums)) { 
						foreach($item->nums as $num) {
							foreach($num->photos as $photo) {	// onclick="return jsiBoxOpen(this)" class="gallery_item" 								
                                ?>
                                <a href="<?php echo '/'.$photo->folder.'/'.$photo->file; ?>" rel="group:orion<?php echo JRoute::_((int)$item->id); ?>" class="fancybox" title="<?php echo str_replace('"', "'", $num->title);?>">
                                    <img class="titleid_<?php echo $num->id?>" src="<?php echo '/'.$photo->folder.'/ts_'.$photo->file; ?>">
                                    <span class="titname"><?php echo $num->title;?></span>
                                </a>                                
                                <?php
							}
						}
					}
				?>
            </div>
          
            <div class="back_butt">
                <a class="button" href="<?php echo JRoute::_('index.php?option=com_objcreate&view=variant&id='.(int)$this->items[0]->id); ?>">
                    <?php echo JText::_('COM_OBJCREATE_CATEGORY_BACK_TO_VARIANT'); ?>
                </a>
            </div>
        </div>
        <div class="clear"></div>
    <? endforeach; ?>
</div>