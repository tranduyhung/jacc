<?php
/**
 * @package    ##Component##
 * @author     CMExtension Team <cmext.vn@gmail.com>
 * @copyright  Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license    GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

/**
 * ##Component## controller class.
 */
class ##Component##Controller extends JControllerLegacy
{
	/**
	 * @var string  The default view.
	 */
	protected $default_view = '##defaultviewname##';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean         If true, the view output will be cached.
	 * @param   array           An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController     This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false)
	{
		/*
		$jinput = JFactory::getApplication()->input;

		$view	= $jinput->get('view', '##defaultviewname##');
		$layout	= $jinput->get('layout', 'default');
		$id		= $jinput->get('id', 0, 'integer');
		*/

		parent::display();
		return $this;
	}

}
?>