 <?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
 * @package     ##Component##
 * @version     ##version##
 * @author      CMExtension Team
 * @copyright   Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

/**
* ##Name## table class
*/
class Table##Name## extends JTable
{
	/**
	 * Constructor.
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object.
	 */
	public function __construct(&$db)
	{
		parent::__construct('##table##', '##primary##', $db);
	}

	/**
	 * Overloaded check method to ensure data integrity.
	 *
	 * @return  boolean  True on success.
	 */
	public function check()
	{
##ifdefFieldorderingStart##
		if ($this->##primary## === 0)
		{
##ifdefFieldcatidStart##
			$condition = ' catid = '.(int) $this->catid <?php if ($this->publishedField): ?> . ' AND <?php echo $this->publishedField; ?> >= 0 ' <?php endif; ?>
##ifdefFieldcatidEnd##
##ifdefFieldcategory_idStart##
			$condition = ' category_id = '.(int) $this->category_id <?php if ($this->publishedField): ?> . ' AND <?php echo $this->publishedField; ?> >= 0 ' <?php endif;?>
##ifdefFieldcategory_idEnd##
			$this->ordering = $this->getNextOrder(##ifdefFieldcatidStart## $condition ##ifdefFieldcatidEnd##);
		}
##ifdefFieldorderingEnd##
##ifdefFieldcreatedStart##

		if (!$this->created)
		{
			$date = JFactory::getDate();
			$this->created = $date->format('Y-m-d H:i:s');
		}
##ifdefFieldcreatedEnd##
##ifdefFieldcreated_timeStart##

		if (!$this->created_time)
		{
			$date = JFactory::getDate();
			$this->created = $date->format('Y-m-d H:i:s');
		}
##ifdefFieldcreated_timeEnd##
		// Check for valid name.
		if (trim($this-><?php echo $this->hident ?>) == '')
		{
			$this->setError(JText::_('Your ##Name## must contain a <?php echo $this->hident ?>.'));
			return false;
		}
##ifdefFieldaliasStart##

		if (empty($this->alias))
		{
			$this->alias = $this-><?php echo $this->hident ?>;
		}

		$this->alias = JFilterOutput::stringURLSafe($this->alias);

		// Check for existing alias.
		$query = $this->_db->getQuery(true);
		$query->select($this->_db->quoteName($this->getKeyName()))
			->from($this->_db->quoteName($this->_tbl))
			->where($this->_db->quoteName('alias') . ' = ' . $this->_db->quote($this->alias));
		$this->_db->setQuery($query);

		$xid = (int) $this->_db->loadResult();

		if ($xid && $xid != (int) $this->{$this->getKeyName()})
		{
			$this->setError(JText::_('Duplicated alias.'));
			return false;
		}
##ifdefFieldaliasEnd##
		return true;
	}
}