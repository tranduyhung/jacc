<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
* @version		$Id:controller.php  1 ##date##Z ##sauthor## $
* @package		##Component##
* @subpackage 	Controllers
* @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
* @license ###license##
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * ##Component## Controller
 *
 * @package    
 * @subpackage Controllers
 */
class ##Component##Controller extends JControllerLegacy
{


	public function display($cachable = false, $urlparams = false)
	{
		$cachable	= true;	
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