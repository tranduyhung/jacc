<?php
/**
* @version		$Id: view.text.php 168 2013-11-12 16:14:31Z michel $
* @package		Jacc
* @subpackage 	Views
* @copyright	Copyright (C) 2010, mliebler. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
//--No direct access
defined('_JEXEC') or die('=;)');

jimport( 'joomla.application.component.view');

class  JaccViewJacc   extends JViewLegacy
{
	
	private $uses_categories = false;
	
	private $hasOrdering = false;
	
	private $hasCheckin = false;
	
	private $defaultOrderField = false;
	
	private $publishedField = false;
	
	private $hasAliasField = false;
	
	private $fieldlist = array();
	
	private $listfieldlist = array();
	
	private $parsedFields = array();
	
	private $searchableFields = array();
	
	private $hident = null;
	
	private $curtable = null;
	
	private $category_field = null;
	
	/**
	 * componenthelp view display method
	 *
	 * @return void
	 **/
	public function display($tpl = null)
	{

		$this->addTemplatePath(JPATH_COMPONENT.'/templates/mvctriple');
		$db =  JFactory::getDBO();
		
		$config = JFactory::getConfig();
		$dbprefix = version_compare(JVERSION,'3.0','lt') ? $config->getValue('config.dbprefix') : $config->get('dbprefix');
		$model= $this->getModel();
		
		//get the Component to create
		$item= $this->get('Item');
		
		//Get Table and Template
		$mvcTable = $this->get('MvcTable');
		if($this->curtable != $mvcTable) {
			$this->hasOrdering;			
			$this->category_field = "";						
			$this->uses_categories =  false;			
			$this->hasCheckin = false;			
			$this->defaultOrderField = false;			
			$this->publishedField = false;			
			$this->hasAliasField = false;			
			$this->fieldlist = array();			
			$this->listfieldlist = array();			
			$this->parsedFields = array();			
			$this->searchableFields = array();			
			$this->hident = null;			
			$this->curtable =  $mvcTable;
		}
		$this->category_field = $model->TableHas($this->curtable,'category');
		$this->uses_categories =  ($this->category_field && $item->params->get('uses_categories'));
		
		$mvcTemplate = $this->get('MvcTemplate');
		
		$mvcType = $this->get('MvcElementtype');
		
		
		
		//init the strings that replaces the fields and fieldslist pattern
		$freplace = "\n";
		$fdetailsreplace = "\n";
		$fparamsreplace = "\n";
		$fdescreplace = "\n";
		$fsubdescreplace = "\n";
		
		$flistreplace = "\n";

		$time =  $item->created;
		
		$tableFields = $model->getTableFields($mvcTable);
		
		
		$this->parsedFields = array();
		
		$allfields = $tableFields->get('all');
		
		if(!count($this->fieldlist)) {
			$fieldlist = $allfields;
		
			foreach($fieldlist as $field) {
				$this->fieldlist[] = $field->get('key');
			}
		
			$listfieldlist = $tableFields->get('list');
		
			foreach($listfieldlist as $field) {
				$this->listfieldlist[] = $field->get('key');
			}
			$this->listfieldlist = array_unique($this->listfieldlist);
		}
		
		$hidentField = $allfields['hident'];		
		$this->hident = $hidentField->get('key');

		$primaryField = $allfields['primary'];		
		$this->primary = $primaryField->get('key');
				
		$this->parsedFields = $tableFields->get('all');
		
		$this->searchableFields = $tableFields->get('searchable');
		
		switch($mvcType) {
				case 'table':
					$this->parsedFields = $tableFields->get('all'); 
					break;
				case 'tmplfrontend':
					$this->parsedFields = $tableFields->get('list'); 
					break;					
				case 'adminform' :					
					$this->formfield = $tableFields->get('groups');
					
					break;
				case 'xmlmodel' :
					$this->formfield = $tableFields->get('all');					
					break;					
				case 'templ' :
					$this->parsedFields = $tableFields->get('list');
					break;
				default: 					
					$freplace .='';			
		}
		
		foreach ($this->parsedFields  as $field) {
			$this->field = $field;
			if ($field->get('key') == 'ordering') {
				$this->hasOrdering = true; 
				$this->defaultOrderField = 'ordering';
			}
			
			if (($field->get('key') == 'created' || $field->get('key') == 'created_time' ) && empty($this->defaultOrderField)) {
				$this->defaultOrderField = $field->get('key');
			}
			
			if ($field->get('key') == 'checked_out') {
				$this->hasCheckin = true;
			}
			
			if ($field->get('key') == 'alias') {
				$this->hasAliasField = true;
			}
			
			if ($field->get('key') == 'published' || $field->get('key') == 'state') {
				$this->publishedField = $field->get('key');
			}
			
			/**
			switch($mvcTemplate) {
				case 'table':
					if (!$field->get('additional')) {
						$prim = $field->get('prim', false) ? '- Primary Key' : '';
						$default = $field->get('default') ? '"'.$field->get('default').'"' : 'null' ;						
						
					}
					break;	
				case 'tmplfrontend' :
	
						$freplace .= $this->replace_field($field, 'tmplfrontendrow');
					break;	
				case 'templ' :
					$freplace .= $this->replace_field($field, 'templhead');
					if ($field->get('key') == 'ordering') {
						
						$flistreplace.= $this->loadTemplate('templordering');
					} elseif ($field->get('key') == $this->hident) {
						$flistreplace .= $this->replace_field($field, 'templlist_hident');
					} else {
						
						$flistreplace .= $this->replace_field($field, 'templlist');
					}
					break;
				default:$freplace .='';
			}
			**/
		}

		if(empty($this->defaultOrderField)) {
			$this->defaultOrderField = $this->hident;
		}
		
		$com_component = $item->name;
		$date = JFactory::getDate();
				
		//Component Name as first part of camel case class names 
		$ComponentName = ucfirst(strtolower(str_replace('com_', '', $com_component)));

		//Replace the patterns
		$file = $this->loadTemplate($mvcTemplate);
		$file = str_replace("##Component##", $ComponentName, $file);
		$file = str_replace("##COMPONENT##", strtoupper($ComponentName), $file);
		$file = str_replace("##date##", $date->format('Y-m-d H:i:s'), $file);
		$file = str_replace("##com_component##", $com_component, $file);
		$file = str_replace("##title##", $this->hident, $file);
		$file = str_replace("##Name##", ucfirst($this->get('ItemSingular')), $file);
		$file = str_replace("##name##", strtolower($this->get('ItemSingular')), $file);
		$file = str_replace("##Plural##", ucfirst( $this->get('ItemPlural')), $file);
		$file = str_replace("##plural##", strtolower($this->get('ItemPlural')), $file);
		
		
		$file = str_replace("##primary##", $this->primary, $file);
		$file = str_replace("##time##", $time, $file);
		$file = str_replace("##codestart##", '<?php', $file);
		$file = str_replace("##codeend##", '?>', $file);
		$file = str_replace("##table##", $mvcTable, $file);
		
				
		//remove unneeded code parts
		$deleteList =  $tableFields->get('delete');
		
				
		foreach ($deleteList as $field) {
			$pattern = '/##ifdefField'.$field.'Start##.*##ifdefField'.$field.'End##/isU';
			$file	= preg_replace($pattern, '', $file);
		}

		$pattern = '/##ifnotdefField'.$field.'Start##.*##ifnotdefField'.$field.'End##/isU';
		$allFields = $tableFields->get('all');
		foreach ($allFields  as $field) {		
			$pattern = '/##ifnotdefField'.$field->get('key').'Start##.*##ifnotdefField'.$field->get('key').'End##/isU';
			$file	= preg_replace($pattern, '', $file);
		}		
		
		$pattern = '/\s+##ifdefField.*[Start|End]##+?/isU';
		$file	= preg_replace($pattern, '', $file);
		
		$pattern = '/\s+##ifnotdefField.*[Start|End]##+?/isU';
		$file	= preg_replace($pattern, '', $file);
		
		$file = str_replace("\n\r", "\n", $file);
		
		if (JRequest::getVar('mode') == 'return') {
			return $file;
		}
		while (@ob_end_clean());

		//Begin writing headers
		header("Cache-Control: max-age=60");
		header("Cache-Control: private");
		header("Content-Description: File Transfer");

		//Use the switch-generated Content-Type
		header("Content-Type: text/plain");

		//Force the download
		header("Content-Disposition: attachment; filename=\"".strtolower(JRequest::getVar('name')).".php\"");
		header("Content-Transfer-Encoding: binary");

		print $file;
	}

	/**
	 * costum loadTempate method
	 */
	
	public function loadTemplate($tpl) {
		
		$path = JPATH_COMPONENT_ADMINISTRATOR.'/templates/'.$tpl;
		$altpath = JPATH_COMPONENT_ADMINISTRATOR.'/usertemplates/'.$tpl;
		$this->_template = JFile::exists($altpath) ? $altpath : $path;   
		if (!JFile::exists($this->_template)) $this->_template = false; 
		if ($this->_template != false)
		{
		
			// Never allow a 'this' property
			if (isset($this->this))
			{
				unset($this->this);
			}
		
			// Start capturing output into a buffer
			ob_start();
		
			// Include the requested template filename in the local scope
			// (this will execute the view logic).
			include $this->_template;
		
			// Done with the requested template; get the buffer and
			// clear it.
			$this->_output = ob_get_contents();
			ob_end_clean();
		
			return $this->_output;
		}
		else
			
		{
			echo $path."<br />";
			echo JText::sprintf('JLIB_APPLICATION_ERROR_LAYOUTFILE_NOT_FOUND', $tpl); exit;
			throw new Exception(JText::sprintf('JLIB_APPLICATION_ERROR_LAYOUTFILE_NOT_FOUND', $tpl), 500);
			
		}
	} 

}// class
