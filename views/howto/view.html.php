<?php
/**
* @version		$Id:jacc.php 1 2010-08-15 12:57:56Z Michael Liebler $
* @package		Jacc
* @subpackage 	Tables
* @copyright	Copyright (C) 2010, mliebler. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class JaccViewHowto  extends JViewLegacy
{

	public function display($tpl = null) 
	{
		$lang = str_replace('-','',strtolower(JFactory::getLanguage()->getTag()));
		$tpl = JFile::exists( __DIR__ .'/tmpl/default_'.$lang.'.php' ) ? $lang : null;		
		$app = JFactory::getApplication();
		JToolBarHelper::title( JText::_( 'Jacc' ).' - '.JText::_( 'Howto' ), 'generic.png' );
		JToolBarHelper::preferences('com_jacc', '550');
		JToolBarHelper::cancel();		
		parent::display($tpl);
	}
}
