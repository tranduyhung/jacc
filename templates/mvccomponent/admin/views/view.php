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

jimport('joomla.application.component.view');

/**
 * ##Name## view class.
 */
class ##Component##View##Name## extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Displays the view.
	 * @param   string  $tpl    Template.
	 */
	public function display($tpl = null)
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('\n', $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void.
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= ##Component##Helper::getActions(<?php if($this->uses_categories): ?>$this->state->get('<?php echo $this->category_field; ?>')<?php endif;?>);

		JToolBarHelper::title(JText::_('##Name##'), 'generic.png');

		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit') || $canDo->get('core.create'))
		{
			JToolbarHelper::apply('##name##.apply');
			JToolbarHelper::save('##name##.save');
		}

		if (!$checkedOut && $canDo->get('core.create'))
		{
			JToolbarHelper::save2new('##name##.save2new');
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create'))
		{
			JToolbarHelper::save2copy('##name##.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('##name##.cancel');
		}
		else
		{
			JToolBarHelper::cancel('##name##.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
##codeend##