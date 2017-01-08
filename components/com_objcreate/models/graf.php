<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
 
// Подключаем библиотеку modellist Joomla.
jimport('joomla.application.component.modellist');
 
/**
 * Модель сообщения компонента ObjCreate.
 */
class ObjCreatesModelGraf extends JModelList
{
    /**
     * Сообщения.
     *
     * @var array
     */
    protected $messages;
    
    public function getItems()
    {
        #$items = parent::getItems();
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Load the list items.
		$query = $this->_getListQuery();
		$items = $this->_getList($query, $this->getStart(), 0);

		foreach ($items as $item)
        {
            $item->owner = $this->getOwner($item->id);
			$item->booking = $this->getRooms($item->id, $item->count_of_nums);
			$item->id = intval($item->id);
			$item->count_of_nums = intval($item->count_of_nums);
			$item->catid = intval($item->catid);
			$item->title = $item->name;
			unset($item->name);
        }
		// Check for a database error.
		if ($this->_db->getErrorNum())
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Add the items to the internal cache.
		$this->cache[$store] = $items;
		return $this->cache[$store];
		
    }
    
public function getOwner($var = 0){
$db = JFactory::getDBO();
$query ='SELECT fio,phone,email,paymentDetails FROM #__objcreate WHERE id='.$var;
$own2 = $this->_getList($query, $this->getStart(), 0);
$own->name = $own2[0]->fio;
$own->phone = $own2[0]->phone;
$own->email = $own2[0]->email;
$own->paymentDetails = $own2[0]->paymentDetails;
return $own;
}
	
public function getRooms($var = 0, $num = 1){
for ($i=1; $i<=$num; $i++){
$iii = $var.'_'.$i;
if ($num > 1) $ii = $i; else $ii = 0;
$rooms->rooms[$iii]->id = $i;
$rooms->rooms[$iii]->title = $i.' номер';
$rooms->rooms[$iii]->booking = $this->getBooks($var, $ii);
}
return $rooms;
}

public function getBooks($var = 0, $num = 0){
$db = JFactory::getDBO();
$query ='SELECT id,date_from,date_to,paid,comments,date_booked,fio,deposit,nomer,etags,etag,people,childs,childs_years,pet,nomer_bron,days,sum_per,period1,period2,period3,period4,total FROM #__objcreate_bookings WHERE unit_id='.$var.' AND num_id='.$num;
$books2 = $this->_getList($query, $this->getStart(), 0);
foreach ($books2 as $book2)
        {
		$books[$book2->id]->id = intval($book2->id);
		$books[$book2->id]->note = $book2->comments;
		$books[$book2->id]->start = date('d.m.Y H:i' ,strtotime($book2->date_from));
		$books[$book2->id]->end = date('d.m.Y H:i' ,strtotime($book2->date_to));
		$books[$book2->id]->booked = date('d.m.Y' ,strtotime($book2->date_booked));
		$books[$book2->id]->fio = $book2->fio;
		$books[$book2->id]->deposit = $book2->deposit;
		$books[$book2->id]->nomer = $book2->nomer;
		$books[$book2->id]->etags = $book2->etags;
		$books[$book2->id]->etag = $book2->etag;
		$books[$book2->id]->people = $book2->people;
		$books[$book2->id]->childs = $book2->childs;
		$books[$book2->id]->childs_years = $book2->childs_years;
		$books[$book2->id]->pet = $book2->pet;
		$books[$book2->id]->nomer_bron = $book2->nomer_bron;
		$books[$book2->id]->days = $book2->days;
		$books[$book2->id]->sum_per = $book2->sum_per;
		$books[$book2->id]->period1 = $book2->period1;
		$books[$book2->id]->period2 = $book2->period2;
		$books[$book2->id]->period3 = $book2->period3;
		$books[$book2->id]->period4 = $book2->period4;
		$books[$book2->id]->total = $book2->total;
		
		
		if ($book2->paid == 1) $books[$book2->id]->status = 2; else $books[$book2->id]->status = 1;		
		}
		
return $books;
}
	 
	 
    /**
     * Метод для построения SQL запроса для загрузки списка данных.
     *
     * @return string SQL запрос.
     */
    protected function getListQuery($id = 0)
    {
        // Создаем новый query объект.
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
 
        if (!is_array($this->messages))
        {
            $this->messages = array();
        }

        if (!isset($this->messages[$id])) 
        {
            // Получаем объект Запроса.
            $input = JFactory::getApplication()->input;
            
            // Получаем Id сообщения из Запроса.
            $id = $input->getInt('id');                                  
			if ($id == 17) {$id = 0;}
            
            // Выбераем поля.
            $query->select('a.id, a.name, a.address, a.count_of_nums, a.catid, b.category')        
                ->from('#__objcreate as a')
				->join('LEFT','#__objcreate_category as b on b.id=a.catid');
            ;            
            
            // Filter by access category.    
			if ($id==0) $id=2;

            $where = "";            
            
            if(is_numeric($id) && $id > 0) {
                $where .= ' AND a.catid='.$id;
            }            
                                    
            
            $query->where('a.public=1'.$where);               
        }                                              
        $query->order('a.id ASC');
        return $query;
    }    
    
    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since       1.6
     */
    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState('a.name', 'asc');
    } 
}