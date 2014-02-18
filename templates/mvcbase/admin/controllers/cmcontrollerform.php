##codestart##
/**
 * @package     ##Component##
 * @version     ##version##
 * @author      CMExtension Team
 * @copyright   Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.controllerform');

/**
 * JControllerForm abstract class for Joomla 2.x and 3.x compatibility.
 */

if (version_compare(JVERSION, '3.0', 'lt'))
{
	abstract class CMControllerForm extends JControllerForm
	{
		/**
		 * Function that allows child controller access to model data
		 * after the data has been saved.
		 *
		 * @param   JModel  &$model     The data model object.
		 * @param   array   $validData  The validated data.
		 *
		 * @return  void
		 */
		protected function postSaveHook(JModel &$model, $validData = array())
		{
			$this->CMPostSaveHook($model, $validData);
		}

		abstract protected function CMPostSaveHook($model, $validData);
	}
}
else
{
	abstract class CMControllerForm extends JControllerForm
	{
		/**
		 * Function that allows child controller access to model data
		 * after the data has been saved.
		 *
		 * @param   JModelLegacy  $model      The data model object.
		 * @param   array         $validData  The validated data.
		 *
		 * @return  void
		 */
		protected function postSaveHook(JModelLegacy $model, $validData = array())
		{
			$this->CMPostSaveHook($model, $validData);
		}

		abstract protected function CMPostSaveHook($model, $validData);
	}
}