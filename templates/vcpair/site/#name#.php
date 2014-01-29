<?php
/**
* @version		$Id: #name#.php 168 2013-11-12 16:14:31Z michel $
* @package		##Component##
* @subpackage 	Controllers
* @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
* @license ###license##
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * ##Component####Name## Controller
 *
 * @package    ##Component##
 * @subpackage Controllers
 */
class ##Component##Controller##Name## extends ##Component##Controller
{
	/**
	 * Constructor
	 */
	protected $_viewname = '##name##'; 
	 
	public function __construct($config = array ()) 
	{
		parent::__construct($config);
		JRequest::setVar('view', $this->_viewname);

	}
	
	public function display() {
		
		$document = JFactory::getDocument();
	
		$viewType	= $document->getType();
		$view = $this->getView($this->_viewname,$viewType);
		$model = $this->getModel($this->_mainmodel);
	
		//$view->setModel($model,true);		
		$view->display();
	}		
}// class
?>