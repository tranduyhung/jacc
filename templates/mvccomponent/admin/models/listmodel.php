 ##codestart##


jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_##component##/tables');

class ##Component##Model##plural## extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
			parent::populateState();
			$app = JFactory::getApplication();
			$id = JRequest::getVar('id', 0, '', 'int');
			$this->setState('##name##list.id', $id);			
			
			// Load the filter state.
			$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
			$this->setState('filter.search', $search);

			$app = JFactory::getApplication();
			$value = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
			$limit = $value;
			$this->setState('list.limit', $limit);
			
			$value = $app->getUserStateFromRequest($this->context.'.limitstart', 'limitstart', 0);
			$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
			$this->setState('list.start', $limitstart);
			
			$value = $app->getUserStateFromRequest($this->context.'.ordercol', 'filter_order', $ordering);
			$this->setState('list.ordering', $value);			
			<?php if($this->uses_categories): ?>	
			$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id', '');
			$this->setState('filter.category_id', $categoryId);
			<?php endif;?>
			$value = $app->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir', $direction);
			$this->setState('list.direction', $value);

		<?php if($this->publishedField): ?>
			$state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
			$this->setState('filter.state', $state);
		<?php endif; ?>
			
	}
    <?php if($this->uses_categories): ?>	
    	
	/**
	 * Method to get the maximum ordering value for each category.
	 */
	public function &getCategoryOrders()
	{
		if (!isset($this->cache['categoryorders']))
		{
			$db = $this->getDbo();
			$query = $db->getQuery(true)
			->select('MAX(ordering) as ' . $db->quoteName('max') . ', <?php echo $this->category_field; ?>')
			->select('<?php echo $this->category_field; ?>')
			->from('##table##')
			->group('<?php echo $this->category_field; ?>');
			$db->setQuery($query);
			$this->cache['categoryorders'] = $db->loadAssocList('<?php echo $this->category_field; ?>', 0);
		}
		return $this->cache['categoryorders'];
	}	
	<?php endif;?>
		
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('##name##list.id');
		<?php if($this->uses_categories): ?>
		$id .= ':' . $this->getState('filter.category_id');
		<?php endif;?>
		<?php if($this->publishedField): ?>
		$id .= ':' . $this->getState('filter.state');
		<?php endif; ?>
		return parent::getStoreId($id);
	}	
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return	object	A JDatabaseQuery object to retrieve the data set.
	 */
	protected function getListQuery()
	{
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);			
		 <?php if($this->uses_categories): ?>
		$catid = (int) $this->getState('filter.category_id', 1);
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
		if(empty($orderCol)) $orderCol = '<?php echo $this->defaultOrderField; ?>';
		if(empty($orderDirn)) $orderDirn = 'DESC'; 		
		$query->order($db->escape($orderCol . ' ' . $orderDirn));
							
		return $query;
	}	
}