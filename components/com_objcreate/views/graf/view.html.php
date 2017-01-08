<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку представления Joomla.
jimport('joomla.application.component.view');
 
/**
 * HTML представление сообщения компонента ObjCreate.
 */
class ObjCreatesViewGraf extends JViewLegacy
{
    /**
     * Сообщение.
     *
     * @var string 
     */
    protected $msg;
    protected $f_categorys;
    /**
     * Сообщения.
     *
     * @var array 
     */
    protected $items;
    
    /**
     * Постраничная навигация.
     *
     * @var object
     */
    
    
    /**
     * Параметры.
     *
     * @var object
     */
    protected $params;
 
    /**
     * Переопределяем метод display класса JViewLegacy.
     * 
     * @return void
     */
    public function display($tpl = null) 
    {            
	$doc=JFactory::getDocument();
if (($doc->base != 'http://sea.sovabarmak.in.ua/graf') && ($doc->base !='http://sea.sovabarmak.in.ua/graf.html') && ($doc->base !='http://sea.sovabarmak.in.ua/')) { die('Restricted access');}
	
        // Получаем данные из модели.
        $this->items = $this->get('Items');
		
        
        if(isset($this->items[0]->category) && !empty($this->items[0]->category)) {				
            $this->msg = $this->items[0]->category;
        } else {
            $this->msg = JText::_('COM_OBJCREATE_CATEGORY_ALL_CATEGORIES');
        }
 
        // Получаем объект постраничной навигации.
       
        //Add the state
        $this->state = $this->get('State');
        $filter_lists = new ObjCreateFilterListHelper();
		$this->f_categorys = $filter_lists->getOptionsLists2();
        // Есть ли ошибки.
        if (count($errors = $this->get('Errors')))
        {
            throw new Exception(implode('<br />', $errors), 500);
        }                
 
        // Получаем параметры приложения.
        $app = JFactory::getApplication();
        $this->params = $app->getParams();
		
        
 
        // Подготавливаем документ.
        $this->_prepareDocument();
 
        
        // Отображаем представление.
        parent::display($tpl);
    }
 
    /**
     * Подготавливает документ.
     *
     * @return void
     */
    protected function _prepareDocument()
    {
        $app = JFactory::getApplication();
        $menus = $app->getMenu();
        $title = null;
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/bootstrap.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/font-awesome-4.0.3/css/font-awesome.min.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/bootstrap-toggle-buttons.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/bootstrap.notify.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/bootstrap-datetimepicker.min.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/bootstrap-combobox.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/alert-blackgloss.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/css.css");
		$document->addStyleSheet(JURI::root() . "components/com_objcreate/views/graf/css/booking.css");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/jquery-2.1.0.min.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/jquery-ui-1.9.2.custom.min.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/jquery.formatDateTime.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/jquery.toggle.buttons.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/bootstrap.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/bootstrap.notify.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/bootstrap-datetimepicker.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/bootstrap-datetimepicker.ru.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/bootstrap-combobox.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/router.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/routing");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/js.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/html2canvas.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/FileSaver.js");
		$document->addScript(JURI::root() . "components/com_objcreate/views/graf/js/booking-jquery.js");
        // Так как приложение устанавливает заголовок страницы по умолчанию, 
        // мы получаем его из пункта меню.
        $menu = $menus->getActive();
        if ($menu)
        {
            $this->params->def('page_heading', $this->params->get('page_title', $menu->title));
        }
        else 
        {
            $this->params->def('page_heading', JText::_('COM_OBJCREATE_DEFAULT_PAGE_TITLE'));
        }
 
        // Получаем заголовок страницы в браузере из параметров.
        $title = $this->params->get('page_title', '');
 
        if (empty($title)) 
        {
            $title = $app->getCfg('sitename');
        }
        elseif ($app->getCfg('sitename_pagetitles', 0) == 1) 
        {
            $title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
        }
        elseif ($app->getCfg('sitename_pagetitles', 0) == 2) 
        {
            $title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
        }
 
        // Устанавливаем загаловок страницы в браузере.
        $this->document->setTitle($title);

        
        if ($this->params->get('menu-meta_description'))
        {
            $this->document->setDescription($this->params->get('menu-meta_description'));
        }

        if ($this->params->get('menu-meta_keywords'))
        {
            $this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
        }

        if ($this->params->get('robots'))
        {
            $this->document->setMetadata('robots', $this->params->get('robots'));
        }

    }
    }