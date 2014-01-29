<?php
/**
 * @version		$Id: category.php 170 2013-11-12 22:44:37Z michel $
 * @package		##Component##
 * @subpackage	Helpers
 * @copyright	Copyright (C) ##year## Open Source Matters, Inc. All rights reserved.
 * @license		##license##
 */

// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');

jimport('joomla.application.categories');

require_once(JPATH_ADMINISTRATOR.'/components/com_##component##/helpers/##component##.php');  
/**
 * ##Component## Component Category Tree
 *
 * @static
 * @package		##Component##
 * @subpackage	Helpers
 */

class ##Component##Categories extends JCategories
{

	public function __construct($options = array())
	{

		$extensions = ##Component##Helper::getExtensions();

		foreach ($extensions as $extension) {
			$name = is_object($extension->name) ? $extension->name->__toString() : $extension->name;
			if ($options['extension'] ==  'com_##component##.'.$name) {
				$options['table'] = is_object($extension->table) ? $extension->table->__toString() : $extension->table;
				$options['field'] = is_object($extension->field) ? $extension->field->__toString() : $extension->field;
				$options['statefield'] = is_object($extension->statefield) ? $extension->statefield->__toString() : $extension->statefield;
			}
		}
		parent::__construct($options);
	}
}
