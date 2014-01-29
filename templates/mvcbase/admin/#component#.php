<?php
/**
 * @version ##version##
 * @package    joomla
 * @subpackage ##Component##
 * @author	   	##author##
 *  @copyright  	Copyright (C) ##year##, ##author##. All rights reserved.
 *  @license ##license##
 */

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');

require_once(JPATH_COMPONENT.'/helpers/##component##.php');
$controller = JControllerLegacy::getInstance('##component##');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();