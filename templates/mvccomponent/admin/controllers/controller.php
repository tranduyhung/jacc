<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
* @version		$Id: default_controller.php 136 2013-09-24 14:49:14Z michel $ $Revision$ $DAte$ $Author$ $
* @package		##Component##
* @subpackage 	Controllers
* @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
* @license ###license##
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');
jimport('joomla.application.component.controllerform');

/**
 * ##Component####Name## Controller
 *
 * @package    ##Component##
 * @subpackage Controllers
 */
class ##Component##Controller##Name## extends JControllerForm
{
	public function __construct($config = array())
	{
	
		$this->view_item = '##name##';
		$this->view_list = '##plural##';
		parent::__construct($config);
	}	
}// class
##codeend##