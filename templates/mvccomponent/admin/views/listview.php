<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
* @version		$Id:##name##.php 1 ##date##Z ##sauthor## $
* @package		##Component##
* @subpackage 	Views
* @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
* @license ###license##
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class ##Component##View##plural##  extends JViewLegacy {

<?php if($this->uses_categories): ?> 	
	protected $categories;
<?php endif;?>

	protected $items;

	protected $pagination;

	protected $state;
	
	
	/**
	 *  Displays the list view
 	 * @param string $tpl   
     */
	public function display($tpl = null)
	{
<?php if($this->uses_categories): ?> 		
		$this->categories	= $this->get('CategoryOrders');
<?php endif;?>		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		##Component##Helper::addSubmenu('##plural##');

		$this->addToolbar();
		if(!version_compare(JVERSION,'3','<')){
			$this->sidebar = JHtmlSidebar::render();
		}
		
		if(version_compare(JVERSION,'3','<')){
			$tpl = "25";
		}
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		
		$canDo = ##Component##Helper::getActions(<?php if($this->uses_categories): ?>$this->state->get('<?php echo $this->category_field; ?>')<?php endif;?>);
		$user = JFactory::getUser();
		JToolBarHelper::title( JText::_( '##Name##' ), 'generic.png' );
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('##name##.add');
		}	
		
		if (($canDo->get('core.edit')))
		{
			JToolBarHelper::editList('##name##.edit');
		}
		
		<?php if($this->publishedField): ?>		
		if ($this->state->get('filter.state') != 2)
		{
			JToolbarHelper::publish('##plural##.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('##plural##.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}
				
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('##plural##.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('##plural##.publish');
				}
			}
			
		}
		<?php endif;?>
		
		<?php if($this->hasCheckin):?>
		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::checkin('##plural##.checkin');
		}
		<?php endif; ?>
		

		if (<?php if($this->publishedField): ?>$this->state->get('filter.state') == -2 && <?php endif;?>$canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', '##plural##.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		<?php if($this->publishedField): ?>
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('##plural##.trash');
		}		
		<?php endif;?>
		
		
		JToolBarHelper::preferences('com_##component##', '550');  
		if(!version_compare(JVERSION,'3','<')){		
			JHtmlSidebar::setAction('index.php?option=##com_component##&view=##plural##');
		}
		<?php if($this->publishedField): ?>
		if(!version_compare(JVERSION,'3','<')){
			JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
			);
		}
		<?php endif; ?>
		
		<?php if($this->uses_categories): ?>
		if(!version_compare(JVERSION,'3','<')){
			JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_CATEGORY'),
				'filter_category_id',
				JHtml::_('select.options', JHtml::_('category.options', '##com_component##.##name##'), 'value', 'text', $this->state->get('filter.category_id'))
			);
		}
		
		<?php endif?>			
	}	
	

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
		 <?php foreach($this->listfieldlist as $field): 
		 		$translate = ($field == 'ordering') ? 'JGRID_HEADING_ORDERING' : ucfirst($field);
		 		if($field == 'state' || $field == 'published') $translate = ('JSTATUS');
		 		if($field == 'id') $translate = ('JGRID_HEADING_ID');
		 	?>
	          'a.<?php echo $field; ?>' => JText::_('<?php echo $translate; ?>'),
	     <?php endforeach; ?>
		);
	}	
}
##codeend##
