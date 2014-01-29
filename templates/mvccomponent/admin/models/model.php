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

jimport('joomla.application.component.modeladmin');

/**
 * ##Name## model class.
 */
class ##Component##Model##Name##  extends JModelAdmin
{
	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form. [optional]
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not. [optional]
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_##component##.##name##', '##name##', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

<?php if($this->uses_categories): ?>     
		// Determine correct permissions to check.
		if ($this->getState('##name##.<?php echo $this->hident ?>'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('<?php echo $this->category_field; ?>', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('<?php echo $this->category_field; ?>', 'action', 'core.create');
		}
<?php endif; ?>
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();
		$data = $app->getUserState('com_##component##.edit.##name##.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}
##codeend##