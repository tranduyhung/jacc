<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
 * @package    ##Component##
 * @author     CMExtension Team <cmext.vn@gmail.com>
 * @copyright  Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license    GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.controlleradmin');

/**
 * ##Name## list controller class.
 */
class ##Component##Controller##Plural## extends JControllerAdmin
{
	/**
	 * Constructor.
	 *
	 * @param   array   $config     An optional associative array of configuration settings.
	 *
	 * @return  ##Component##Controller##plural##
	 */
	public function __construct($config = array())
	{
		$this->view_list = '##plural##';
		parent::__construct($config);
	}

	/**
	 * Proxy for getModel.
	 *
	 * @param   string   $name      The name of the model.
	 * @param   string   $prefix    The prefix for the PHP class name.
	 *
	 * @return  JModel
	 */
	public function getModel($name = '##Name##', $prefix = '##Component##Model', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 */
	public function saveOrderAjax()
	{
		// Get the input.
		$pks = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');

		// Sanitize the input.
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model.
		$model = $this->getModel();

		// Save the ordering.
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application.
		JFactory::getApplication()->close();
	}

	/**
	 * Function that allows child controller access to model data
	 * after the item has been deleted.
	 *
	 * @param   JModelLegacy  $model  The data model object.
	 * @param   integer       $ids    The array of ids for items being deleted.
	 *
	 * @return  void
	 */
	protected function postDeleteHook(JModelLegacy $model, $ids = null)
	{
	}
}