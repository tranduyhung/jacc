<?php
/**
 * File name: $HeadURL: svn://tools.janguo.de/jacc/trunk/admin/views/plugins/view.html.php $
 * Revision: $Revision: 178 $
 * Last modified: $Date: 2013-12-22 18:44:34 +0100 (So, 22. Dez 2013) $
 * Last modified by: $Author: michel $
 * $Id: view.html.php 178 2013-12-22 17:44:34Z michel $
 * @copyright	Copyright (C) 2011-2013, Michael Liebler. All rights reserved.
 * @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
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

 
class JaccViewPlugins  extends JViewLegacy {

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
		$this->items = $this->get('Data');
		
		$this->user = JFactory::getUser();
		$this->lists = $lists;			
		
		parent::display();
	}
	
	/**
	 *  Displays the form
 	 * @param string $tpl   
     */
	public function _displayForm($tpl)
	{
		JHtml::_('behavior.formvalidation');			
		JHTML::stylesheet( 'fields.css', 'administrator/components/com_jacc/assets/' );
		JFactory::getLanguage()->load('com_plugins', JPATH_ADMINISTRATOR);
		
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
		
		$archive = 'plg_'.JFilterOutput::stringURLSafe($item->name);
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
		    $item->files = $model->getFiles($archive);
		}
	
		$lists['published'] 		= JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published );
		
	 	$this->form = $form;
	 
		$this->lists = $lists;
		$this->item = $item;
		$this->isNew = $isNew;
	
		parent::display($tpl);
	}
}
?>