<?php
/**
 * File name: $HeadURL: svn://tools.janguo.de/jacc/branches/2013-09.24-joomla3x/script.jacc.php $
 * Revision: $Revision: 147 $
 * Last modified: $Date: 2013-10-06 10:58:34 +0200 (So, 06. Okt 2013) $
 * Last modified by: $Author: michel $
 * $Id: script.jacc.php 147 2013-10-06 08:58:34Z michel $
 * @copyright	Copyright (C) 2011-2013, Michael Liebler. All rights reserved.
 * @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');


class com_jaccInstallerScript
{
 
	function update($parent) {
		$db = JFactory::getDBO();

		if(method_exists($parent, 'extension_root')) {
			$sqlfile = $parent->getPath('extension_root').'/sql/install.mysql.sql';
		} else {
			$sqlfile = $parent->getParent()->getPath('extension_root').'/sql/install.mysql.sql';
		}
		// Don't modify below this line
		$buffer = file_get_contents($sqlfile);
		if ($buffer !== false) {
			jimport('joomla.installer.helper');
			$queries = JInstallerHelper::splitSql($buffer);
			if (count($queries) != 0) {
				foreach ($queries as $query)
				{
					$query = trim($query);
					if ($query != '' && $query{0} != '#') {
						$db->setQuery($query);
						if (!$db->query()) {
							JError::raiseWarning(1, JText::sprintf('JLIB_INSTALLER_ERROR_SQL_ERROR', $db->stderr(true)));
							return false;
						}
					}
				}
			}
		}
	}
}