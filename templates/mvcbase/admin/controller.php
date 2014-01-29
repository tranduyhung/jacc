<?php
/**
 * @version		$Id:controller.php 1 ##date##Z ##sauthor## $
 * @author	   	##author##
 * @package    ##Component##
 * @subpackage Controllers
 * @copyright  	Copyright (C) ##year##, ##author##. All rights reserved.
 * @license ##license##
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * ##Component## Standard Controller
 *
 * @package ##Component##   
 * @subpackage Controllers
 */
class ##Component##Controller extends JControllerLegacy
{
	/**
	 * @var		string	The default view.
	 * @since   1.6
	 */
	protected $default_view = '##defaultviewname##';
	
	/**
	 * Method to display a view.
	 *
	 * @param   boolean			If true, the view output will be cached
	 * @param   array  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController		This object to support chaining.
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
	
		if(version_compare(JVERSION,'3','<')){
			$view   = JRequest::getVar('view', '##defaultviewname##');
			$layout = JRequest::getVar('layout', 'default');
			$id     = JRequest::getInt('id');
		} else {
			$view   = $this->input->get('view', '##defaultviewname##');
			$layout = $this->input->get('layout', 'default');
			$id     = $this->input->getInt('id');
		}
		
		parent::display();
	
		return $this;
	}

}// class
  
?>