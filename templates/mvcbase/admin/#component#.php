<?php
/**
 * @package     ##Component##
 * @version     ##version##
 * @author      CMExtension Team
 * @copyright   Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

require_once JPATH_COMPONENT . '/helpers/##component##.php';

$controller = JControllerLegacy::getInstance('##component##');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();