<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		##Component##
* @subpackage 	Views
* @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
* @license ###license##
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class ##Component##View##Name##  extends JViewLegacy 
{

	protected $form;

	protected $item;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

		$app = JFactory::getApplication('site');
		
		// Initialise variables.		
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}
		
		//Get Params and Merge
		$this->params	= $this->state->get('params');
		$active	= $app->getMenu()->getActive();
		$temp	= clone ($this->params);
		$temp->merge($this->item->params);
		$this->item->params = $temp;
		
		parent::display($tpl);
	}
}
##codeend## 