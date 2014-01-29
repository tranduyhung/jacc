<?php
/**
 * File name: $HeadURL: svn://tools.janguo.de/jacc/branches/2013-09.24-joomla3x/admin/models/fields/tablelist.php $
 * Revision: $Revision: 168 $
 * Last modified: $Date: 2013-11-12 17:14:31 +0100 (Di, 12. Nov 2013) $
 * Last modified by: $Author: michel $
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Jacc
 * @subpackage	fields
 */
class JFormFieldTableList extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	public $type = 'TableList';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{

		$db = JFactory::getDBO();
		$tables= $db->getTableList();
		$config = JFactory::getConfig();
		$options = array();
		$db = JFactory::getDBO();
		for ($i=0;$i<count($tables);$i++) {
			//only tables with primary key
			$db->setQuery("SHOW FIELDS FROM `".$tables[$i]."` WHERE LOWER( `Key` ) = 'pri'");
			if ($db->loadResult()) {
				$dbprefix = version_compare(JVERSION,'3.0','lt') ? $config->getValue('config.dbprefix') : $config->get('dbprefix');
				$options[$i] = new stdClass;
				$options[$i]->value = str_replace($dbprefix, '#__', $tables[$i]);
				$options[$i]->text = $tables[$i];
			}
		}

		return $options;
	}
}
