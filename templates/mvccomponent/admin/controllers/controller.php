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

require_once 'cmcontrollerform.php';

/**
 * ##Component####Name## controller class.
 */
class ##Component##Controller##Name## extends CMControllerForm
{
	public function __construct($config = array())
	{
		$this->view_item = '##name##';
		$this->view_list = '##plural##';
		parent::__construct($config);
	}

	/**
	 * Function that allows child controller access to model data after the data has been saved.
	 *
	 * @param   JModel/JModelLegacy $model      The data model object.
	 * @param   array               $validData  The validated data.
	 *
	 * @return  void
	 */
	protected function CMPostSaveHook($model, $validData = array())
	{
		$task = $this->getTask();

		if ($task == 'save')
		{
			$this->setRedirect(JRoute::_('index.php?option=com_##component##&view=##plural##', false));
		}
	}
}
##codeend##