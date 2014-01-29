<?php
/**
 * @package     ##Component##
 * @version     ##version##
 * @author      CMExtension Team
 * @copyright   Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

class ##Component##Helper
{
	public static function addSubmenu($vName = '##defaultview##')
	{
##menuhelper##
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   integer  The category ID.
	 *
	 * @return  JObject
	 */
	public static function getActions($categoryId = 0)
	{
		$user = JFactory::getUser();
		$result = new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_##component##';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_##component##.category.' . (int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_##component##', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}