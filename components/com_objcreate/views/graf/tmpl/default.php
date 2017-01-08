<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;


?>
<div id="toimg">
	<img src="/bron-top.jpg">
	<div class="toimg-row">
		<div class="toimg-cell"><span class="cell-zag">Номер брони: </span><span id="bron_id"></span></div>
		<div class="toimg-cell"><span class="cell-zag">Дата бронирования: </span><span id="bron_date"></span></div>
		<div class="toimg-cell"><span class="cell-zag">Арендатор: </span><span id="bron_fio"></span></div>
		<div class="toimg-cell"><span class="cell-zag">Размер предоплаты: </span><span id="bron_deposit"></span></div>
	</div>
	<div class="toimg-row">
		<div class="to-img-row-zag">ОБЪЕКТ АРЕНДЫ:</div>
		<div class="toimg-cell"><span class="cell-zag">Категория: </span><span id="bron_cat"></span></div>
		<div class="toimg-cell"><span class="cell-zag">Порядковый номер: </span><span id="bron_nid"></span></div>
		<div class="toimg-cell"><span class="cell-zag">Номер или комната: </span><span id="bron_nomer"></span></div>
		<div class="toimg-cell cell472"><span class="cell-zag">Этажность: </span><span id="bron_etags"></span></div>
		<div class="toimg-cell cell472"><span class="cell-zag">Этаж: </span><span id="bron_etag"></span></div>
		<div class="clr"></div>
	</div>
	<div class="toimg-row">
		<div class="to-img-row-zag">СОСТАВ ГОСТЕЙ:</div>
		<div class="toimg-cell"><span class="cell-zag">Общее количество человек: </span><span id="bron_people"></span></div>
		<div class="toimg-cell cell472"><span class="cell-zag">Кол-во детей: </span><span id="bron_childs"></span></div>
		<div class="toimg-cell cell472"><span class="cell-zag">Возраст детей: </span><span id="bron_childs_years"></span></div>
		<div class="clr"></div>
		<div class="toimg-cell"><span class="cell-zag">Домашние животные: </span><span id="bron_pet"></span></div>
	</div>
	<div class="toimg-row">
		<div class="to-img-row-zag">ПЕРИОД БРОНИРОВАНИЯ И РАСЧЕТНОЕ ВРЕМЯ:</div>
		<div class="toimg-cell cell960"><span class="cell-zag">Дата заезда: </span><span id="bron_date_start"></span>г.</div>
		<div class="toimg-cell cell960"><span class="cell-zag">Время заезда: </span><span id="bron_time_start"></span></div>
		<div class="clr"></div>
		<div class="toimg-cell cell960"><span class="cell-zag">Дата отъезда: </span><span id="bron_date_end"></span>г.</div>
		<div class="toimg-cell cell960"><span class="cell-zag">Время выезда: </span><span id="bron_time_end"></span></div>
		<div class="clr"></div>
		<div class="toimg-cell"><span class="cell-zag">Общий период проживания: </span><span id="bron_days"></span></div>
		<div class="clr"></div>
	</div>
	<div class="toimg-row">
		<div class="to-img-row-zag">расчет стоимости аренды:</div>
		<div class="toimg-cell"><span class="cell-zag">Оплата за единицу размещения: </span><span id="bron_sum_per"></span></div>
		<div id="period-wrapp">
		</div>
		<div class="toimg-cell" id="total-row">Общая стоимость аренды:   <span id="bron_total"></span> руб</div>
	</div>
	<div id="toimg-foot">
		<div>
	<?php
		$articleId = 318;
		$db =& JFactory::getDBO();
		$sql = "SELECT introtext FROM #__content WHERE id = ".intval($articleId);
		$db->setQuery($sql);
		echo  $db->loadResult();
	?>
		</div>
	</div>
</div>
<div class="navbar navbar-fixed-top navbar-inverse navbar-summer ">
<div class="navbar-inner">
<ul class="nav">
<li class="dropdown-split-left active first">
<a href="http://sea.sovabarmak.in.ua/graf.html"><i class="fa fa-calendar"></i> Бронь</a>
</li>
<li class="dropdown-split-right active last dropdown">
<a href="http://sea.sovabarmak.in.ua/graf.html" class="dropdown-toggle" data-toggle="dropdown">
<b class="caret"></b>
</a>
<ul class="pull-left menu_level_1 dropdown-menu">
<?php
for($i=1; $i < count($this->f_categorys); $i++){
echo '<li';
if ($i==1) echo ' class="first"'; else if ($i==count($this->f_categorys)) echo ' class="last"';
echo '>';
echo '<a href="http://sea.sovabarmak.in.ua/graf.html?id='.$this->f_categorys[$i]->id.'">'.$this->f_categorys[$i]->category.'</a>';
echo '</li>';
}
?>
</ul></li></ul>
<span class="brand" style="margin-left:20px; color:#fff;"><i class="fa fa-calendar"></i> Бронь: <?php echo $this->msg;?></span>
<input type="hidden" value="<?php echo $this->msg;?>" id="cat-tiomg">
<div class="pull-right">
<ul class="nav"><li>
<a href="http://sea.sovabarmak.in.ua/"><i class="fa fa-sign-out"></i> Выход</a>
</li></ul></div>
</div></div>
<div class="container-fluid space-top">
<script type="text/javascript">
var bookingInfo= <?php echo '{'."\n"; foreach($this->items as $item){ echo '\''.$item->id.'\':'; echo json_encode($item); echo ",\n"; } echo '}'?>;

    var bookingArray = [];
    for (var item_id in bookingInfo)
    {
        bookingArray.push(bookingInfo[item_id]);
    }

    var statuses = {"0":{"id":0,"title":"\u0421\u0432\u043e\u0431\u043e\u0434\u043d\u043e","color":"#d9d9d9","border_color":"#888888"},"1":{"id":1,"title":"\u041f\u0440\u0435\u0434\u0431\u0440\u043e\u043d\u044c","color":"#ff99ff","border_color":"#ff99ff"},"2":{"id":2,"title":"\u0411\u0440\u043e\u043d\u044c","color":"#ff0000","border_color":"#ff0000"},"3":{"id":3,"title":"\u0411\u0440\u043e\u043d\u044c \u0434\u0438\u043b\u0435\u0440\u0430","color":"#5c8526","border_color":"#5c8526"},"4":{"id":4,"title":"\u0427\u0443\u0436\u0430\u044f \u0431\u0440\u043e\u043d\u044c","color":"#996633","border_color":"#996633"},"5":{"id":5,"title":"\u0427\u0443\u0436\u0430\u044f \u043f\u0440\u0435\u0434\u0431\u0440\u043e\u043d\u044c","color":"#ff6c00","border_color":"#ff6c00"},"x":{"id":"x","title":"\u041f\u0415\u0420\u0415\u0421\u0415\u0427\u0415\u041d\u0418\u0415","color":"#4B0082","border_color":"#4B0082"}};
    var calendarDays = {"5":{"id":5,"title":"\u041c\u0430\u0439","days":31,"color":"#c3d69b","cell_color":"#f4f8eb"},"6":{"id":6,"title":"\u0418\u044e\u043d\u044c","days":30,"color":"#ffff00","cell_color":"#fafadf"},"7":{"id":7,"title":"\u0418\u044e\u043b\u044c","days":31,"color":"#ff950e","cell_color":"#f4e9db"},"8":{"id":8,"title":"\u0410\u0432\u0433\u0443\u0441\u0442","days":31,"color":"#ff8080","cell_color":"#f5e5e5"},"9":{"id":9,"title":"\u0421\u0435\u043d\u0442\u044f\u0431\u0440\u044c","days":30,"color":"#94bd5e","cell_color":"#eaf3de"}};
    var year = 2017;
    var cell_height = 13;
    var top_cell_height = 24;
    var cell_width = 20;
    var scrollbar_height = 21;
    var first_col_width = 150;
    var roomCount = 62;
    var calendarItems, bookingItems, body, grid;
    var userRole = 'owner';
</script>
<div class="row-fluid">
    <div class="booking-container" id="booking-container">
	<div class="booking-items">
	<ul id="booking-items-list"></ul>
	</div>
	<div class="booking-calendar">
	</div>
	<div class="booking-body">
	<div class="booking-grid">
	</div>
	</div>
</div>
</div>
<div style="display: none;">
    <div class="modal hide fade" id="InfoPopupTmpl">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3><span class="InfoPopupTitle"></span></h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="book-edit-form">
            	<div class="alert alert-error" style="display: none;"></div>
				<div class="control-group">
                    <label class="control-label" for="nomer_bron">Номер брони</label>
                    <div class="controls">
                        <div class="input-append nomer_bron">
                            <input type="text" name="nomer_bron" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="date_booked">Дата бронирования</label>
                    <div class="controls">
                        <div class="input-append date date_booked">
                            <input type="text" name="date_booked" value="" class="span2" data-format="dd.MM.yyyy" readonly="">
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="fio">ФИО</label>
                    <div class="controls">
                        <div class="input-append fio">
                            <input type="text" name="fio" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="deposit">Предоплата</label>
                    <div class="controls">
                        <div class="input-append fio">
                            <input type="text" name="deposit" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="nomer">Номер</label>
                    <div class="controls">
                        <div class="input-append nomer">
                            <input type="text" name="nomer" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="etags">Этажность</label>
                    <div class="controls">
                        <div class="input-append etags">
                            <input type="text" name="etags" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="etag">Этаж</label>
                    <div class="controls">
                        <div class="input-append etag">
                            <input type="text" name="etag" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="people">Количество человек</label>
                    <div class="controls">
                        <div class="input-append people">
                            <input type="text" name="people" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="childs">Из них детей</label>
                    <div class="controls">
                        <div class="input-append childs">
                            <input type="text" name="childs" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="childs_years">Возраст детей</label>
                    <div class="controls">
                        <div class="input-append childs_years">
                            <input type="text" name="childs_years" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="pet">Домашние животные</label>
                    <div class="controls">
                        <div class="input-append pet">
                            <input type="text" name="pet" value="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="start">Начало периода</label>
                    <div class="controls">
                        <div class="input-append date date-start">
                            <input type="text" name="start" value="" class="span2" data-format="dd.MM.yyyy hh:mm" readonly="">
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="end">Конец периода</label>
                    <div class="controls">
                        <div class="input-append date date-end">
                            <input type="text" name="end" value="" class="span2" data-format="dd.MM.yyyy hh:mm" readonly="">
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="days">Общий период проживания:</label>
                    <div class="controls">
                        <div class="input-append days">
                            <input type="text" name="days" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="sum_per">Оплата за единицу размещения:</label>
                    <div class="controls">
                        <div class="input-append sum_per">
                            <input type="text" name="sum_per" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="period1">Период1:</label>
                    <div class="controls">
                        <div class="input-append period1">
                            <input type="text" name="period1" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="period2">Период2:</label>
                    <div class="controls">
                        <div class="input-append period2">
                            <input type="text" name="period2" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="period3">Период3:</label>
                    <div class="controls">
                        <div class="input-append period3">
                            <input type="text" name="period3" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="period4">Период4:</label>
                    <div class="controls">
                        <div class="input-append period4">
                            <input type="text" name="period4" value="">
                        </div>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="total">Общая стоимость:</label>
                    <div class="controls">
                        <div class="input-append total">
                            <input type="text" name="total" value="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="status">Статус объекта</label>
                    <div class="controls">
                        <select name="status" class="span3"></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="end">Заметка</label>
                    <div class="controls">
                        <textarea name="note" style="width: 250px;"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a class="btn btn-danger pull-left" name="delete">Удалить</a>
			<a class="btn btn-primary" id="save-as-img">Сохранить как img</a>
            <a class="btn btn-primary" name="submit">Сохранить</a>
            <a class="btn" name="submit" data-dismiss="modal">Закрыть</a>
        </div>
    </div>
</div>

<div style="display: none;">
    <div class="modal hide fade" id="EditObjectPopupTmpl">
        <div class="modal-header">
            <h3>
            	<span>Редактировать объект</span>

            	<div class="btn-group pull-right" style="margin-left:30px;">
	            	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" title="Закрыть окно"></i></button>
            	</div>

            	<div class="btn-group pull-right">
	            	<a class="btn hasTooltip edit-realty-site" href="" title="" target="_blank" data-original-title="Перейти к редактированию объекта"><i class="fa fa-edit"></i></a>

	            	<a class="btn hasTooltip view-realty-site" href="" title="" target="_blank" data-original-title="Просмотреть объект на сайте"><i class="fa fa-external-link"></i></a>
            	</div>
            </h3>
        </div>
        <div class="modal-body">
        	<div class="alert alert-error" style="display: none;"></div>

            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="owner">Владелец</label>
                    <div class="controls"><div class="plain-text" name="owner"></div></div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="owner">Контакты</label>
                    <div class="controls"><div class="plain-text" name="contacts"></div></div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="owner">Платежная информация</label>
                    <div class="controls"><div class="plain-text" name="payment"></div></div>
                </div>

                <hr>

				<div class="control-group">
                    <label class="control-label" for="note">Адрес</label>
                    <div class="controls"><div class="plain-text" name="address"></div></div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="note">Примечание</label>
                    <div class="controls"><div class="plain-text" name="note"></div></div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a class="btn" name="submit" data-dismiss="modal">Закрыть</a>
        </div>
    </div>
</div>

<div id="blocker"></div>
</div>
        <div class="notifications top-right"></div>
        <script type="text/javascript">
	    	$(document).ready(function() {
	    		CRM.initScroll();
	    		CRM.initMenus();
	            $('.hasTooltip').tooltip()
	        });
    	</script>