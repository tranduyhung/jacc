<?php
/**
* @version		$Id: view.html.php 178 2013-12-22 17:44:34Z michel $
* @package		Jacc
* @subpackage 	Tables
* @copyright	Copyright (C) 2011, Michael Liebler. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class JaccViewPackages  extends JViewLegacy {

	public function display($tpl = null) 
	{
		$app = JFactory::getApplication('');
		
		if ($this->getLayout() == 'form') {
		
			$this->_displayForm($tpl);		
			return;
		}
		$context			= 'com_jacc'.'.'.strtolower($this->getName()).'.list.';
		$filter_state = $app->getUserStateFromRequest($context . 'filter_state', 'filter_state', '', 'word');		
		$filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->get('DefaultFilter'), 'cmd');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$search = $app->getUserStateFromRequest($context . 'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		
		// Get data from the model
		$this->items = $this->get('Data');
		$this->total = $this->get('Total');
		$this->pagination = $this->get('Pagination');			
		//create the lists
		$lists = array();
		$lists['state'] = JHTML::_('grid.state', $filter_state);			
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		// search filter
		$lists['search'] = $search;
		
		$this->user= JFactory::getUser();
		$this->lists = $lists;	
		parent::display($tpl);
	}
	
	
	public function _displayForm($tpl)
	{
		JHtml::_('behavior.formvalidation');		
		JHTML::stylesheet( 'fields.css', 'administrator/components/com_jacc/assets/' );

		$db			= JFactory::getDBO();
		$uri 		= JFactory::getURI();
		$user 		= JFactory::getUser();
		$form		= $this->get('Form');
		
		$lists = array();

		$editor = JFactory::getEditor();

		//get the item
		$item	= $this->get('item');
		
		
		//Get Versions
		$model=$this->getModel();
		
		$item->files = array();
				
		if(!version_compare(JVERSION,'3.0','lt')) {
			$form->bind(JArrayHelper::fromObject($item));
		} else {
			$form->bind($item);
		}
		
		$isNew		= ($item->id < 1);			

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$item->published = 1;
		} else {
		    $item->files = $model->getFiles('pkg_'.$item->alias);
		}
	
		$lists['published'] 		= JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published );
		
	 	$this->form  = $form;
	 
		$this->lists = $lists;
		$this->item = $item;
		$this->isNew = $isNew;
		parent::display($tpl);
	}	
}
?>