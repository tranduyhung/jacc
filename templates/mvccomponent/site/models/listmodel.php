 <?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		##Component##
* @subpackage 	Models
* @copyright	Copyright (C) ##year##, ##author##.
* @license ###license##
*/

// 

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
/**
 * Methods supporting a list of contact records.
 *
 * @package     Joomla.Site
 * @subpackage  ##Component##
 */
class ##Component##Model##plural## extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
	          <?php foreach($this->fieldlist as $field): ?>
	          '<?php echo $field; ?>', 'a.<?php echo $field; ?>',
	          <?php endforeach; ?>
			);

			$app = JFactory::getApplication();

		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}
<?php if($this->uses_categories): ?>
		$category = $this->getUserStateFromRequest($this->context . '.category', 'category'); 
		$this->setState('filter.category', $category);
<?php endif;?>
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
<?php if($this->publishedField): ?>	
		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);
<?php endif;?>

		// List state information.
		parent::populateState('a.<?php echo $this->hident; ?>', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id    A prefix for the store id.
	 *
	 * @return  string  A store id.
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
<?php if($this->uses_categories): ?>
		$id .= ':' . $this->getState('filter.category');
<?php endif; ?>
<?php if($this->publishedField): ?>		
		$id .= ':' . $this->getState('filter.published');
<?php endif;?>

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();
		$app = JFactory::getApplication();

		$select_fields = $this->getState('list.select', 'a.*'); 
		
		// Select the required fields from the table.
		$query->select( $select_fields);
		
		$query->from('##table## AS a');

<?php if($this->publishedField): ?>	
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$query->where('a.<?php echo $this->publishedField; ?> = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.<?php echo $this->publishedField; ?> = 0 OR a.<?php echo $this->publishedField; ?> = 1)');
		}
<?php endif; ?>	
<?php if($this->uses_categories): ?>     

		// Filter by a single or group of categories.
		$categoryId = $this->getState('filter.category');
		if (is_numeric($categoryId))
		{
			$query->where('a.<?php echo $this->category_field ?> = ' . (int) $categoryId);
		}
		elseif (is_array($categoryId) && ($categoryId != 'all'))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('a.<?php echo $this->category_field ?> IN (' . $categoryId . ')');
		}
<?php endif; ?>   
		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			$query->where('LOWER(a.name) LIKE ' . $this->_db->Quote('%' . $search . '%'));		
		}


		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.<?php echo $this->hident; ?>');
		$orderDirn = $this->state->get('list.direction', 'asc');
		
		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}
}
 