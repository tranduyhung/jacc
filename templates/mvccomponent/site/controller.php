<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
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
	 * Method to display a view.
	 *
	 * @param   boolean         If true, the view output will be cached.
	 * @param   array           An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController     This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;
		<?php if($this->uses_categories): ?> 
		$user		= JFactory::getUser();

		// Set the default view name and format from the Request.
		// Note we are using w_id to avoid collisions with the router and the return page.
		// Frontend is a bit messier than the backend.
		if(version_compare(JVERSION,'3','<')) {
			$id    = JRequest::getInt('id');
			$vName = JRequest::getVar('view', 'categories');
			JRequest::setVar('view', $vName);
			$rMethod = JRequest::getMethod();		
			
		} else {
			$id    = $this->input->getInt('id');
			$vName = $this->input->get('view', 'categories');
			$this->input->set('view', $vName);
			$rMethod = $this->input->getMethod();
			
		}		

		if ($user->get('id') ||($rMethod == 'POST' && $vName = 'categories'))
		{
			$cachable = false;
		}

		$safeurlparams = array(
			'id'				=> 'INT',
			'limit'				=> 'UINT',
			'limitstart'		=> 'UINT',
			'filter_order'		=> 'CMD',
			'filter_order_Dir'	=> 'CMD',
			'lang'				=> 'CMD'
		);

		// Check for edit form.
		if ($vName == 'form' && !$this->checkEditId('com_##component##.edit.##firstnames##', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			return JError::raiseError(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		}
		<?php else: ?>
			if(version_compare(JVERSION,'3','<')) {
				$vName = JRequest::getVar('view', '##firstnames##');			
				JRequest::setVar('view', $vName);
			} else {
				$vName = $this->input->get('view', '##firstnames##');
				$this->input->set('view', $vName);
			}	
			$safeurlparams = array(
			'id'				=> 'INT',
			
		);
		<?php endif; ?> 
		return parent::display($cachable, $safeurlparams);
	}	
	

}// class
##codeend##