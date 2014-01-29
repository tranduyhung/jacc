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

		parent::display($tpl);
	}
}
##codeend##