var modalPopup = null;
var errr=0;
$(document).ready( function() {
    calendarItems = $('#booking-container .booking-calendar').first();
    bookingItems = $('#booking-container .booking-items').first();
    body = $('#booking-container .booking-body').first();
    grid = $('#booking-container .booking-body .booking-grid').first();
	

    generateRows();
    createGrid();
    setBookingData();
    initLayout();
    initFilter();
    
    setTimeout(function(){
        initSelector();
        initMenu();
        initTips();
    }, 1000);
	if (errr > 0) alert('На странице '+errr+' пересечений');
	
	
});

function generateRows() 
{
    // Создаем левый столбец с названиями объектов и контекстным меню
    var list = $('#booking-items-list');
    var i = 0;
    
    for (var j = 0; j < bookingArray.length; j++)
    {
        var item = bookingArray[j];
        var item_id = item.id;
        
        var x = 0;
        
        for (var room_id in item.booking.rooms)
        {
            var room = item.booking.rooms[room_id];
            
            var titleStr = '';//((!empty(item.booking.note) && x == 0) ? item.booking.note : '') + (!empty(room.note) ? room.note : '');
            
            if (x == 0)
            {
	            if (item.owner)
	            	titleStr += item.owner.name + "<br />";
	
	            if (item.address)
	            	titleStr += item.address + "<br />";
	
	            if (item.owner)
	            	titleStr += item.owner.phone + "<br />";
	        	
	        	titleStr += item.note ? item.note : '';
            }
            else
            {
            	titleStr += room.note ? item.note : '';
            }
            
            var bookingItemRow = jQuery('<li/>',  {
                'id':'booking-item-'+item_id+'-'+room_id,
                'data-item-id':item_id,
                'data-room-id':room_id,
                'data-realty-type':(x == 0 ? 'realty' : 'room'),
                'class':'booking-item'+' '+
                        (item.disabled ? 'disabled' : '')+' '+
                        'row-'+(i % 2).toString()+' '+
                        (!empty(titleStr) ? 'hasTooltip2 has-note' : ''),
                'data-placement':'right',
                'title':titleStr,
                'disabled':(item.disabled ? 'disabled' : '')
            });
            
            if (room_id != 0)
            {
                bookingItemRow.attr('related-item', item_id);
            }
            
            bookingItemRow.appendTo(list);
            
            var title = jQuery('<span/>', {
                'class':'booking-item-title'
            });
            
            title.text(x == 0 ? item.title : room.title);
            title.appendTo(bookingItemRow);
            
            x = 1;
        }
        
        i++;
    }
}

function createGrid()
{   
    // Заполняем Grid
    rows = '';
	
    for (var i = 0; i < bookingArray.length; i++) 
    {
        var item = bookingArray[i];
        var item_id = item.id;
        
        for (var room_id in item.booking.rooms) 
        {
            var room = item.booking.rooms[room_id];

            rows += '<div id="row-'+item_id+'-'+room_id+'" class="booking-grid-row">';
			
            for (var month_id in calendarDays) 
            { 
                month = calendarDays[month_id];
                
                for (var day = 1; day <= month.days; day++) 
                { 
                    cell = '<div id="cell-'+item_id+'-'+room_id+'-'+month_id+'-'+day+'" class="booking-grid-cell month-'+month_id+' '+(item.disabled ? 'disabled' : '')+'" disabled="'+(item.disabled ? 'disabled' : '')+'"></div>';
                    rows += cell;
                }
				
            } 
            rows += '</div>';
        }
    }
call = '<ul>';
for (var month_id in calendarDays) 
            { 
                month = calendarDays[month_id];
                call += '<li style="width:'+(month.days*(cell_width+1)-1)+'px;background-color:'+month.color+';">'+month.title+'<ul>'
                for (var day = 1; day <= month.days; day++) 
                { 
					if (day != month.days) call += '<li>'+day+'</li>'; else call += '<li style="border-right:0;">'+day+'</li>'
                }
				call += '</ul></li>';
            } 
call += '</ul>';
    calendarItems.append(call);
    grid.append(rows);
	
    if (userRole != 'dealer')
    {
	    $('.booking-grid-cell').click(function() {
	        var infoIds = $(this).attr('id').split('-');
			var info = {};
			info.cat_id = bookingInfo[parseInt(infoIds[1], 10)]['catid'];
			info.counts = bookingInfo[parseInt(infoIds[1], 10)]['count_of_nums'];
	        info.item_id = infoIds[1];
	        info.item_title = bookingInfo[parseInt(infoIds[1], 10)]['title'];
	        info.room_id = infoIds[2];
	        info.start = (infoIds[4].toString().length == 1 ? '0'+infoIds[4] : infoIds[4])+"."+(infoIds[3].toString().length == 1 ? '0'+infoIds[3] : infoIds[3])+'.'+year.toString();
	        info.end = (infoIds[4].toString().length == 1 ? '0'+infoIds[4] : infoIds[4])+"."+(infoIds[3].toString().length == 1 ? '0'+infoIds[3] : infoIds[3])+'.'+year.toString();
	        info.room_title = Object.keys(bookingInfo[parseInt(infoIds[1], 10)]['booking']['rooms']).length > 1 ? bookingInfo[parseInt(infoIds[1], 10)]['booking']['rooms'][infoIds[2]]['title'] : null;
	        info.reservation_id = -1;
	        info.request_id = '';
			info.status = 2;
	        popup = new InfoPopup(info);
	        modalPopup = $(popup.el).modal();
	    });
    }
}

function setBookingData()
{   

    for (var item_id in bookingInfo)
    {
        for (var room_id in bookingInfo[item_id]['booking']['rooms'])
        {
            for (var i in bookingInfo[item_id]['booking']['rooms'][room_id]['booking'])
            {
                var start = bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].start.split('.');
                var end = bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].end.split('.');
                var m1 = parseInt(start[1], 10);
                var m2 = parseInt(end[1], 10);
                for (var m = m1; m <= m2; m++)
                {
                    var d1 = parseInt(m != start[1] ? 1 : start[0], 10);
                    var d2 = parseInt(m != end[1] ? calendarDays[m.toString()]['days'] : end[0], 10);
                    
                    for (var d = d1; d <= d2; d++)
                    {
                        var cell = $('#cell-'+item_id.toString()+'-'+room_id.toString()+'-'+parseInt(m, 10).toString()+'-'+parseInt(d, 10).toString());
                        var status = cell.attr('rel') ? 'x' : bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].status;
                        if (status=='x') errr++;
                        cell
                        .addClass('status-'+status)
                        .addClass('hasTooltip2')
                        .attr('rel', 'info-'+item_id.toString()+'-'+room_id.toString()+'-'+i.toString())
                        .attr('title', status != 'x' ? statuses[status].title+'::'+bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].start+' - '+bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].end+'::'+bookingInfo[item_id]['booking']['rooms'][room_id]['booking'][i].note : statuses[status].title);
                        
                        if (status != 'x')
                        {
                            cell.off('click');
                            if (userRole != 'dealer')
                            {
	                            cell.click(function() {
	                                var infoIds = $(this).attr('rel').split('-');
									var info = bookingInfo[parseInt(infoIds[1], 10)]['booking']['rooms'][infoIds[2]]['booking'][parseInt(infoIds[3], 10)];
	                                info.item_id = infoIds[1];
	                                info.item_title = bookingInfo[parseInt(infoIds[1], 10)]['title'];
	                                info.room_id = infoIds[2];
	                                info.room_title = Object.keys(bookingInfo[parseInt(infoIds[1], 10)]['booking']['rooms']).length > 1 ? bookingInfo[parseInt(infoIds[1], 10)]['booking']['rooms'][infoIds[2]]['title'] : null;
	                                info.reservation_id = infoIds[3];
	                                popup = new InfoPopup(info);
	                                modalPopup = $(popup.el).modal();
	                            });
                            }
                        }
                        else
                        {
                            cell.off('click');
                        }
                    }
                }
            }            
        }            
    }
}

function initLayout()
{
    var scrollBarWidth = getScrollBarWidth();
    $('#booking-container').css('height', $(document).height() - $('#booking-container').position().top - 8);
    
    calendarItems.css('width', $(document.body).width() - 2 * $('#booking-container').position().left - first_col_width);
    bookingItems.css('height', $(document).height() - $('#booking-container').position().top - top_cell_height - 6 - scrollBarWidth);
    body.css('width', $(document.body).width() - 2 * $('#booking-container').position().left - first_col_width);
    var bHeight = $(document).height() - $('#booking-container').position().top - top_cell_height - 2;
    
    if (bHeight > roomCount * (cell_height+2))
        bHeight = roomCount * (cell_height+2) + scrollBarWidth;
        
    body.css('height', bHeight);
    
    calendarItems.scrollLeft((cell_width + 1)*31);
    body.scrollLeft((cell_width + 1)*31);
    
    body.scroll(function() {
        calendarItems.scrollLeft(body.scrollLeft());
        bookingItems.scrollTop(body.scrollTop());
    });
    
    function getScrollBarWidth () {
      var inner = document.createElement('p');
      inner.style.width = "100%";
      inner.style.height = "200px";

      var outer = document.createElement('div');
      outer.style.position = "absolute";
      outer.style.top = "0px";
      outer.style.left = "0px";
      outer.style.visibility = "hidden";
      outer.style.width = "200px";
      outer.style.height = "150px";
      outer.style.overflow = "hidden";
      outer.appendChild (inner);

      document.body.appendChild (outer);
      var w1 = inner.offsetWidth;
      outer.style.overflow = 'scroll';
      var w2 = inner.offsetWidth;
      if (w1 == w2) w2 = outer.clientWidth;

      document.body.removeChild (outer);

      return (w1 - w2);
    };
    
}

function initSelector() 
{
    var startCol = 0;
    var endCol = 0;
    
    $('.booking-calendar ul li ul li').mousedown(function(event) {
        
        startCol = getColFromPos(event.pageX);
        console.log('Start: '+startCol);
        $(body).find('.selector').remove();
        $(calendarItems).find('.selector').remove();
        
        $(document.body).mouseup(function(event) {
            var endCol = getColFromPos(event.pageX);
            console.log('End: '+endCol);
            
            $(document.body).off('mousemove');
            $(document.body).off('mouseup');
            
            markCells(startCol, endCol);
            markCalendar(startCol, endCol);
        });
        
        $(document.body).mousemove(function(event) {
             var col = getColFromPos(event.pageX);
             markCells(startCol, col);
             markCalendar(startCol, col);
        });
    });    
    
	$('#booking-container').dblclick(function(event){
	$(body).find('.selector').remove();
    $(calendarItems).find('.selector').remove();
    });
	
    function getColFromPos(x)
    {
        return Math.floor((x - body.offset().left + body.scrollLeft())/(cell_width + 1));
    }

    function markCells(start, end) 
    {
        if (start > end)
        {
            var newEnd = start;
            start = end;
            end = newEnd;
        }
        
        if (body.find('.selector').length === 0)
        {
            var selector = jQuery('<div/>', {'class':'selector'});
            
            selector.css({
                    'position':'absolute',
                    'background-color':'#000',
                    'opacity':0.5,
                    'z-index':20,
                    'top':0,
                    'left':start * (cell_width + 1),
                    'height':grid.height(),
                    'width':end * (cell_width + 1) - start * (cell_width + 1) + cell_width 
            });
            
            body.append(selector);
        }
        else
        {
            var selector = body.find('.selector').first();
            selector.css({
                'left':start * (cell_width + 1),
                'width':end * (cell_width + 1) - start * (cell_width + 1) + cell_width 
            });        
        }
    }

    function markCalendar(start, end) 
    {
        if (start > end)
        {
            var newEnd = start;
            start = end;
            end = newEnd;
        }
        
        if (calendarItems.find('.selector').length === 0)
        {
            var selector = jQuery('<div/>', {'class':'selector'});
            
            selector.css({
                    'position':'absolute',
                    'background-color':'#000',
                    'opacity':0.5,
                    'z-index':20,
                    'top':top_cell_height/2,
                    'left':start * (cell_width + 1),
                    'height':top_cell_height/2,
                    'width':end * (cell_width + 1) - start * (cell_width + 1) + cell_width + 1 
            });
            
            selector.mousedown(function(event){
                        $(body).find('.selector').remove();
                        $(calendarItems).find('.selector').remove();
            });
            
            calendarItems.append(selector);
        }
        else
        {
            var selector = calendarItems.find('.selector').first();
            selector.css({
                'left':start * (cell_width + 1),
                'width':end * (cell_width + 1) - start * (cell_width + 1) + cell_width + 1 
            });
        }
    }    
}

function initMenu()
{
   

    if (userRole != 'dealer')
    {
	    $('.booking-item').click(function(event) {
	        event.stopPropagation();
	        
	        if ($(this).data('realty-type') == 'realty')
	        	editObject($(this).data('item-id'));
	        return;
	        
	        
	    });
    }
}

function initTips()
{   
    $('.hasTooltip2').each(function(index, el) {
        var title = $(el).attr('title');
        if (title) {
            var parts = title.split('::', 3);
            var html = '<h6>'+parts[0]+'</h6>'+(parts[1] ? parts[1] : '')+(parts[2] ? '<br />'+parts[2] : '');
            $(el).attr('title', html);
        }                                               
    });
    
    $('.hasTooltip2').tooltip({html:true, container:'body'});
}

var InfoPopup = Class.extend({
    el:null,
    info:null, 
    init: function(info)
    {
        var that = this;

    	this.info = info;
        this.el = $('#InfoPopupTmpl').clone();
        this.el.find('span[class=InfoPopupTitle]').first().text(info.item_title + (info.room_title ? ' / '+info.room_title : '' ));
        this.el.find('input[name=start]').first().val(info.start);
        this.el.find('input[name=end]').first().val(info.end);
		this.el.find('input[name=date_booked]').first().val(info.booked);
		this.el.find('input[name=fio]').first().val(info.fio);
		this.el.find('input[name=deposit]').first().val(info.deposit);
		this.el.find('input[name=nomer]').first().val(info.nomer);
		this.el.find('input[name=etags]').first().val(info.etags);
		this.el.find('input[name=etag]').first().val(info.etag);
		this.el.find('input[name=people]').first().val(info.people);
		this.el.find('input[name=childs]').first().val(info.childs);
		this.el.find('input[name=childs_years]').first().val(info.childs_years);
		this.el.find('input[name=pet]').first().val(info.pet);
		this.el.find('input[name=nomer_bron]').first().val(info.nomer_bron);
		this.el.find('input[name=days]').first().val(info.days);
		this.el.find('input[name=sum_per]').first().val(info.sum_per);
		this.el.find('input[name=period1]').first().val(info.period1);
		this.el.find('input[name=period2]').first().val(info.period2);
		this.el.find('input[name=period3]').first().val(info.period3);
		this.el.find('input[name=period4]').first().val(info.period4);
		this.el.find('input[name=total]').first().val(info.total);
		
		
        this.el.find('textarea[name=note]').first().val(info.note);
        this.el.find('input[name=request_id]').first().val(info.request_id);
        this.el.find('select[name=status]').first().find('option').each(function(index, option) {
            option.selected = $(option).val() == info.status;
        });
        
      
	   if (info.reservation_id == -1)
        {
            this.el.find('a[name=delete]').first().css('display', 'none');
        }
        else
        {
			 this.el.find('a[name=delete]').first().attr('onclick', 'deleteReservation(event, '+info.item_id+', '+info.room_id+', '+info.reservation_id+')');
        }

        this.el.find('div.date-start').first().datetimepicker({
            pickSeconds: false,
            dateFormat:"dd.mm.yy hh:mm",
	        language:'ru',
	        weekStart:1,
	        maskInput: true,
        });
        
        this.el.find('div.date-end').first().datetimepicker({
            pickSeconds: false,
            dateFormat:"dd.mm.yy",
	        language:'ru',
	        weekStart:1,
	        maskInput: true,
        });
		 this.el.find('div.date_booked').first().datetimepicker({
            pickSeconds: false,
            dateFormat:"dd.mm.yy",
	        language:'ru',
	        weekStart:1,
	        maskInput: true,
			pickTime:false
        });
		
		  this.el.find('a[name=delete]').first().click(function(){
            data = '';
			var room = that.info.room_id.split('_');
            data = 'd=del&id='+info.reservation_id;
		$.ajax({
           type: "POST",
           url: 'components/com_objcreate/views/graf/js/book.php',
           data: data,
           success: function(d) {
window.location.reload();
		   }
		});
        });        
        
        this.el.find('a[name=submit],a#save-as-img').click(function(){
            var startDate0Str = that.el.find('input[name=start]').first().val();
            var endDate0Str = that.el.find('input[name=end]').first().val();
			var bookedDate0Str = that.el.find('input[name=date_booked]').first().val();
            var startDate0Arr = startDate0Str.split(' ')[0].split('.'); // Дата начала в массиве
            var endDate0Arr = endDate0Str.split(' ')[0].split('.'); // Дата окончания в массиве
			var bookedDate0Arr = bookedDate0Str.split(' ')[0].split('.'); // Дата брони в массиве
            if (startDate0Str.split(' ').length > 1)
            {
                var startTime0Arr = startDate0Str.split(' ')[1].split(':');;
            }
            else
            {
                var startTime0Arr = [0, 0];
            }
             if (endDate0Str.split(' ').length > 1)
            {
                var endTime0Arr = endDate0Str.split(' ')[1].split(':');
            }
            else
            {
                var endTime0Arr = [0, 0];
            }
			
            var start0Sec = mktime(startTime0Arr[0], startTime0Arr[1], startDate0Arr[0], startDate0Arr[1], startDate0Arr[2]); // Таймстэмп начала
            var end0Sec = mktime(endTime0Arr[0], endTime0Arr[1], endDate0Arr[0], endDate0Arr[1], endDate0Arr[2]); // Таймстэмп окончания
            if (end0Sec < start0Sec)
            {
            	$(modalPopup).find('.alert').first().css('display', 'block').text('Выбраны не верные даты: дата начала брони превышает дату окончания');
                return;
            }
                        
            var request_id = that.el.find('input[name=request_id]').first().val();
            var note = that.el.find('textarea[name=note]').first().val();
			var fio = that.el.find('input[name=fio]').first().val();
			var deposit = that.el.find('input[name=deposit]').first().val();
			var nomer = that.el.find('input[name=nomer]').first().val();
			var etags = that.el.find('input[name=etags]').first().val();
			var etag = that.el.find('input[name=etag]').first().val();
			var people = that.el.find('input[name=people]').first().val();
			var childs = that.el.find('input[name=childs]').first().val();
			var childs_years = that.el.find('input[name=childs_years]').first().val();
			var pet = that.el.find('input[name=pet]').first().val();
			var nomer_bron = that.el.find('input[name=nomer_bron]').first().val();
			var days = that.el.find('input[name=days]').first().val();
			var sum_per = that.el.find('input[name=sum_per]').first().val();
			var period1 = that.el.find('input[name=period1]').first().val();
			var period2 = that.el.find('input[name=period2]').first().val();
			var period3 = that.el.find('input[name=period3]').first().val();
			var period4 = that.el.find('input[name=period4]').first().val();
			var total = that.el.find('input[name=total]').first().val();
			
			
            var status = '';
            that.el.find('select[name=status]').first().find('option').each(function(index, option) {
                if (status == '')
                    status = $(option).is(':selected') ? $(option).val() : '';
            });
			
			//to img
			var room = that.info.room_id.split('_');
			$('#bron_id').text(nomer_bron);
			$('#bron_date').text(bookedDate0Arr[2]+'-'+bookedDate0Arr[1]+'-'+bookedDate0Arr[0]);
			$('#bron_fio').text(fio);
			$('#bron_deposit').text(deposit);
			$('#bron_cat').text($('#cat-tiomg').val());
			$('#bron_nid').text((info.counts == "1")? "0" : room[1]);
			$('#bron_nomer').text(nomer);
			$('#bron_etags').text(etags);
			$('#bron_etag').text(etag);
			$('#bron_people').text(people);
			$('#bron_childs').text(childs);
			$('#bron_childs_years').text(childs_years);
			$('#bron_pet').text(pet);
			$('#bron_date_start').text(startDate0Arr[0]+'-'+startDate0Arr[1]+'-'+startDate0Arr[2]);
			$('#bron_time_start').text(startTime0Arr[0]+':'+startTime0Arr[1]);
			$('#bron_date_end').text(endDate0Arr[0]+'-'+endDate0Arr[1]+'-'+endDate0Arr[2]);
			$('#bron_time_end').text(endTime0Arr[0]+':'+endTime0Arr[1]);
			$('#bron_days').text(days);
			$('#bron_sum_per').text(sum_per);
			$('#period-wrapp').html('<div class="toimg-cell cell960"><div class="toimg-cell">'+period1+'</div><div class="toimg-cell cell">'+period2+'</div></div><div class="toimg-cell cell960"><div class="toimg-cell cell960">'+period3+'</div><div class="toimg-cell cell960">'+period4+'</div></div>');
			$('#bron_total').text(total);
			
			
			
			if($(this).attr('id')=='save-as-img') {
				$('#toimg').toggle();
									var canvas = document.getElementById('toimg');
						html2canvas(canvas, {
					  onrendered: function(canvas) {
						canvas.toBlob(function(blob) {
						saveAs(blob, "bron_"+nomer_bron+".png");
						$('#toimg').toggle();
					});
					  }
					});
			return;
			}
			
			
			
            // Проверка на пересечение с другими бронями и поиск возможных горячих предоложений
            var overlap = false;
            var hot = false;
            var hotInfo = null;
            var hotStart = null;
            var hotEnd = null;
            var now = Math.round(new Date().getTime() / 1000);
            var nowStr = $.formatDateTime('dd.mm.yy', new Date())
            
            for (var i in bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'])
            {
                if (that.info.reservation_id.toString() == "-1" || i.toString() != that.info.reservation_id.toString())
                {
                    // Дата начала
                    var startDate1Str = bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i].start;
                    // Дата окончания
                    var endDate1Str = bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i].end;
					// Дата брони
                    var bookedDate1Str = bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i].date_booked;

                    // Дата начала в массиве
                    var startDate1Arr = startDate1Str.split(' ')[0].split('.');
                    // Дата окончания в массиве
                    var endDate1Arr = endDate1Str.split(' ')[0].split('.');
					// Дата брони в массиве
                    var bookedDate1Arr = bookedDate1Str.split(' ')[0].split('.');
                    
                    if (startDate1Str.split(' ').length > 1)
                    {
                        // Время начала в массиве
                        var startTime1Arr = startDate1Str.split(' ')[1].split(':');
                        // Время окончания в массиве
                        var endTime1Arr = endDate1Str.split(' ')[1].split(':');
						// Время брони в массиве
                        var bookedTime1Arr = bookedDate1Str.split(' ')[1].split(':');
                    }
                    else
                    {
                        var startTime1Arr = [0, 0];
                        var endTime1Arr = [0, 0];
						var bookedTime1Arr = [0, 0];
                    }                    
                    
                    var start1Sec = mktime(startTime1Arr[0], startTime1Arr[1], startDate1Arr[0], startDate1Arr[1], startDate1Arr[2]);
                    var end1Sec = mktime(endTime1Arr[0], endTime1Arr[1], endDate1Arr[0], endDate1Arr[1], endDate1Arr[2]);
					var booked1Sec = mktime(bookedTime1Arr[0], bookedTime1Arr[1], bookedDate1Arr[0], bookedDate1Arr[1], bookedDate1Arr[2]);
                    
                    if (start0Sec <= end1Sec && start1Sec <= end0Sec)
                    {
                        overlap = true;
                        break;
                    }
                    
                    if (!hot && (end0Sec < start1Sec || end1Sec < start0Sec))
                    {
                        var diff = 0;
                        
                        if (end0Sec < start1Sec)
                        {
                            if (end0Sec > now)
                            {
                                diff = start1Sec - end0Sec;
                                hotStart = endDate0Str;
                                hotStartSec = end0Sec;
                            }
                            else
                            {
                                diff = start1Sec - now;
                                hotStart = nowStr;
                                hotStartSec = now;
                            }
                                
                            hotEnd = startDate1Str;
                        }
                        else
                        {
                            if (end1Sec > now)
                            {
                                diff = start0Sec - end1Sec;
                                hotStart = endDate1Str;
                                hotStartSec = start1Sec;
                            }
                            else
                            {
                                diff = start0Sec - now;
                                hotStart = nowStr;
                                hotStartSec = now;
                            }
                                
                            hotEnd = startDate0Str;
                        }
                        
                        if (diff >= 3 * 24 * 3600 && diff <= 7 * 24 * 3600)
                        {
                            hot = true;
                            hotInfo = bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i];
                        }
                    }
                }
            }
            
            if (hotStart)
            {
                var hotStartDateParts = hotStart.split(' ')[0].split('.');
                hotStartDateParts[0] = parseInt(hotStartDateParts[0], 10) + 1;
                hotStart = hotStartDateParts.join('.') + ' ' + hotStart.split(' ')[1];
                
                var hotEndDateParts = hotEnd.split(' ')[0].split('.');
                hotEndDateParts[0] = parseInt(hotEndDateParts[0], 10) - 1;
                hotEnd = hotEndDateParts.join('.') + ' ' + hotEnd.split(' ')[1];
            }
            
            if (overlap)
            {
            	var error = 'Введенные даты пересекаются с другой бронью: '+bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i].start + ' - ' +bookingInfo[that.info.item_id]['booking']['rooms'][that.info.room_id]['booking'][i].end;
            	$(modalPopup).find('.alert').first().css('display', 'block').text(error);
                return;
            }
            data = '';
			
			if (info.reservation_id == -1)
        {
            data = 'd=add&nomer_bron='+nomer_bron+'&days='+days+'&sum_per='+sum_per+'&period1='+period1+'&period2='+period2+'&period3='+period3+'&period4='+period4+'&total='+total+'&people='+people+'&childs='+childs+'&childs_years='+childs_years+'&pet='+pet+'&etags='+etags+'&etag='+etag+'&nomer='+nomer+'&deposit='+deposit+'&fio='+fio+'&booked_date='+bookedDate0Arr[2]+'-'+bookedDate0Arr[1]+'-'+bookedDate0Arr[0]+'&start='+startDate0Arr[2]+'-'+startDate0Arr[1]+'-'+startDate0Arr[0]+' '+startTime0Arr[0]+':'+ startTime0Arr[1]+'&end='+endDate0Arr[2]+'-'+endDate0Arr[1]+'-'+endDate0Arr[0]+' '+endTime0Arr[0]+':'+ endTime0Arr[1]+'&prim='+note+'&cat_id='+that.info.cat_id+'&unit_id='+that.info.item_id+'&num_id=';
			(info.counts == "1")? data += "0" : data += room[1];
        }
        else
        {
           data = 'd=change&nomer_bron='+nomer_bron+'&days='+days+'&sum_per='+sum_per+'&period1='+period1+'&period2='+period2+'&period3='+period3+'&period4='+period4+'&total='+total+'&people='+people+'&childs='+childs+'&childs_years='+childs_years+'&pet='+pet+'&etags='+etags+'&etag='+etag+'&nomer='+nomer+'&deposit='+deposit+'&fio='+fio+'&booked_date='+bookedDate0Arr[2]+'-'+bookedDate0Arr[1]+'-'+bookedDate0Arr[0]+'&start='+startDate0Arr[2]+'-'+startDate0Arr[1]+'-'+startDate0Arr[0]+' '+startTime0Arr[0]+':'+ startTime0Arr[1]+'&end='+endDate0Arr[2]+'-'+endDate0Arr[1]+'-'+endDate0Arr[0]+' '+endTime0Arr[0]+':'+ endTime0Arr[1]+'&prim='+note+'&id='+that.info.reservation_id;
        }
		$.ajax({
           type: "POST",
           url: 'components/com_objcreate/views/graf/js/book.php',
           data: data,
           success: function(d) {
			   window.location.reload();
		   }
		});
        });
    }
});

var EditObjectPopup = Class.extend({
    el:null,
    info:null, 
    init: function(info)
    {
        this.info = info;
        this.el = $('#EditObjectPopupTmpl').clone();
        this.el.find('h3 span').text(info.title);
        
        this.el.find('div[name=note]').first().text(info.note);
        this.el.find('input[name=disabled]').attr('checked', info.disabled);
        
        if (info.owner)
        {
        	
        		this.el.find('div[name=owner]').first().text(info.owner.name);
        	
        	
        	this.el.find('div[name=payment]').first().text(info.owner.paymentDetails);
        	var contacts = '';
        	if (info.owner.phone) {
			if (info.owner.email) {
        		contacts = info.owner.phone+', '+info.owner.email; }
			else {
				contacts = info.owner.phone; }
			}
			else if (info.owner.email) {
			contacts = info.owner.email; }
        	
        	this.el.find('div[name=contacts]').first().text(contacts);
        }
        else
        {
        	this.el.find('div[name=owner]').first().text('Не задан');
        	this.el.find('div[name=contacts]').first().text('---');
        	this.el.find('div[name=payment]').first().text('---');
        }
        
    	this.el.find('div[name=address]').first().text(info.address ? info.address : '');
    	
    	if (userRole != 'dealer')
    	{
	    	this.el.find('a.edit-realty-site').attr('href', 'http://eisk-sea.ru/administrator/index.php?option=com_objcreate&view=objcreate&layout=edit&id='+info.item_id.toString());
	    	this.el.find('a.view-realty-site').attr('href', 'http://eisk-sea.ru/index.php?option=com_objcreate&view=variant&id='+info.item_id.toString());
	    	
    	}
    	else
    	{
	    	this.el.find('a.edit-realty-site').css('display', 'none');
	    	this.el.find('a.view-realty-site').css('display', 'none');
    	}
    	
    	$('.hasTooltip', $(this.el)).tooltip({html:true, container:$(this.el)});
    }
});

function editObject(item_id) {
    var popup = new EditObjectPopup({
    	item_id:item_id,
    	title:bookingInfo[item_id]['title'],
    	disabled:bookingInfo[item_id]['disabled'], 
    	owner:bookingInfo[item_id]['owner'], 
    	note:bookingInfo[item_id]['booking']['note'], 
    	address:bookingInfo[item_id]['address']
    });
    modalPopup = $(popup.el).modal();
}

function initFilter()
{
    $('#filter').keyup(function() {
        var text = $('#filter').val();
        $('#booking-items-list>li').each(function(index, el) {
            var title = $(el).find('span.booking-item-title').text();
            var item_id = $(el).attr('item-id');
            var room_id = parseInt($(el).attr('room-id'));
            
            if (room_id == 0)
            {
                if (title.match(text))
                {
                    $(el).css('display', 'list-item');
                    $('#row-'+item_id.toString()+'-'+room_id.toString()).css('display', 'block');
                    $('li[related-item='+item_id.toString()+']').each(function(index2, roomEl){
                        $(roomEl).css('display', 'list-item');
                        var item_id2 = $(roomEl).attr('item-id');
                        var room_id2 = $(roomEl).attr('room-id');
                        $('#row-'+item_id2.toString()+'-'+room_id2.toString()).css('display', 'block');
                    })
                }
                else
                {
                    $(el).css('display', 'none');
                    $('#row-'+item_id.toString()+'-'+room_id.toString()).css('display', 'none');
                    $('li[related-item='+item_id.toString()+']').each(function(index2, roomEl){
                        $(roomEl).css('display', 'none');
                        var item_id2 = $(roomEl).attr('item-id');
                        var room_id2 = $(roomEl).attr('room-id');
                        $('#row-'+item_id2.toString()+'-'+room_id2.toString()).css('display', 'none');
                    })                    
                }
            }
        });
    });
}

function mktime(hour, minute, day, month, year) {
    return new Date(year, month - 1, day, hour, minute, 0, 0).getTime() / 1000;
}

function confirmErase()
{
    $('#confirmEraseLink').css('display','none');
    $('#confirmErase').css('display','block');
}

function empty (mixed_var) {
  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, "", "0"];

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixed_var === emptyValues[i]) {
      return true;
    }
  }

  if (typeof mixed_var === "object") {
    for (key in mixed_var) {
      return false;
    }
    return true;
  }

  return false;
}