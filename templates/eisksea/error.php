<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}
//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<?php defined('JPATH_BASE') or die();
if (($this->error->getCode()) == '404') {
header("HTTP/1.1 404 Not Found");
echo file_get_contents(JURI::root().'index.php?option=com_content&view=article&id=77');
//$doc->setTitle( 'Запрашиваемая Вами страница не найдена...' );
} 
else
{
//echo file_get_contents(JURI::root().'index.php?option=com_content&view=article&id=77');
}

?>
