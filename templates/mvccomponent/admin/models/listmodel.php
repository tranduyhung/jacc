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

jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_##component##/tables');

/**
 * ##Plural## model class.
 */
class ##Component##Model##plural## extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				// Add fields here.
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState();
		$app = JFactory::getApplication();
		$jinput = $app->input;
		$id = $jinput->get('id', 0, 'integer');

		$this->setState('##name##list.id', $id);

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
		$this->setState('list.limit', $limit);

		$limitstart = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		$this->setState('list.start', $limitstart);

		$ordering = $app->getUserStateFromRequest($this->context . '.ordercol', 'filter_order', $ordering);
		$this->setState('list.ordering', $ordering);

		<?php if($this->uses_categories): ?>
		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id', '');
		$this->setState('filter.category_id', $categoryId);
		<?php endif;?>

		$direction = $app->getUserStateFromRequest($this->context . '.orderdirn', 'filter_order_Dir', $direction);
		$this->setState('list.direction', $direction);

		<?php if($this->publishedField): ?>
		$state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);
		<?php endif; ?>
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id         A prefix for the store id.
	 * @return  string  A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':'.$this->getState('##name##list.id');
		<?php if($this->uses_categories): ?>
		$id .= ':' . $this->getState('filter.category_id');
		<?php endif;?>
		<?php if($this->publishedField): ?>
		$id .= ':' . $this->getState('filter.state');
		<?php endif; ?>
		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery.
	 */
	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		<?php if($this->uses_categories): ?>
		$catid = (int) $this->getState('filter.category_id', 0);
		<?php endif; ?>

##ifdefFieldaliasStart##
		$query->select('a.*, '
		. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug');
##ifdefFieldaliasEnd##
##ifnotdefFieldaliasStart##
		$query->select('a.*');
##ifnotdefFieldaliasEnd##
		$query->from('##table## as a');

		<?php if($this->uses_categories): ?>
		// Filter by category.
		$categoryId = $this->getState('filter.category_id');

		if (is_numeric($categoryId))
		{
			$query->where('a.<?php echo $this->category_field; ?> = ' . (int) $categoryId);
		}
		<?php endif; ?>

		<?php if(count($this->searchableFields)):
		$wheres = array();
		foreach($this->searchableFields as $field) {
			$wheres[] = 'a.'.$field->get('key')." LIKE ' . \$search . ' ";
		}
		$searchquery = implode(' OR ', $wheres); 
		?>

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . $db->escape($search, true) . '%');
				$query->where('(<?php echo $searchquery; ?>)');
			}
		}
		<?php endif; ?>
<?php if($this->publishedField): ?>
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.<?php echo $this->publishedField; ?> = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.<?php echo $this->publishedField; ?> IN (0, 1))');
		}
<?php endif; ?>

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', '<?php echo $this->defaultOrderField; ?>');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		if (empty($orderCol))
			$orderCol = '<?php echo $this->defaultOrderField; ?>';

		if (empty($orderDirn))
			$orderDirn = 'DESC';

		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}
}