<?php
/**
 * @version		$Id: inputlist.php 178 2013-12-22 17:44:34Z michel $
 * @package		Joomla.Framework
 * @subpackage	Form
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldInputlist extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Inputlist';

	/**
	 * Flag to tell the field to always be in multiple values mode.
	 *
	 * @var		boolean
	 * @since	1.6
	 */
	protected $forceMultiple = true;

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		$document = JFactory::getDocument();
		if(version_compare(JVERSION,'3','<')){
			$document->addScript(JUri::base().'components/com_jacc/assets/jquery.js');
			$document->addScript(JUri::base().'components/com_jacc/assets/jquery-noconflict.js');
		} 		
		$document->addScriptDeclaration(
		    "

			function addVcpairControl(vpairid) {
				var html='<div class=\'clr\' id=\'div-jform_params_views'+vpairid+'\'>';
					html+='<input class=\'pull-left\'  type=\'text\' class=\'inputlist\' name=\'jform[params][views]['+vpairid+'][name]\' id=\'jform_params_views'+vpairid+'\' />';
					html+='<label class=\'span2 radio inline\'>".JText::_('COM_JACC_BACKEND')."';
					html+='<input type=\'radio\' value=\'backend\' name=\'jform[params][views]['+vpairid+'][option]\'></label>';
					html+='<label class=\'span2 radio inline\'>".JText::_('COM_JACC_FRONTEND')."';
					html+='<input type=\'radio\' checked=\"checked\" value=\'frontend\' name=\'jform[params][views]['+vpairid+'][option]\'></label>';
					html+='<label class=\'span2 radio inline\'>".JText::_('COM_JACC_BOTH')."';
					html+='<input type=\'radio\' checked=\'checked\' value=\'both\' name=\'jform[params][views]['+vpairid+'][option]\'></label>';
					html+='<div class=\'clearfix\'></div>';
					html+='<button value=\'".JText::_('JACTION_DELETE')."\' id=\'rm-jform_params_views'+vpairid+'\' class=\'removeview\' type=\'button\'>".JText::_('JACTION_DELETE')."</button>';
					html+='</div><br />';
					return html;
			}	
			jQuery('document').ready(function() {
		    		
					jQuery('.removeview').click(function(event) {
						var id= this.id.replace('rm-','div-');
		    			jQuery('#' + id).remove();
		    		});
				
	 				jQuery('#addvc').click(function() {						
						var html = addVcpairControl(numcvpairs);
						numcvpairs = numcvpairs +1;
						jQuery('#vcpairs-container').append(html);
						jQuery('.removeview').click(function(event) {
							var id= this.id.replace('rm-','div-');
		    				jQuery('#' + id).remove();
		    			});
						
					});
					
					
					
			});"		
		);
		
		// Initialize some field attributes.
		
        $html[] = '<div><button type="button"  id="addvc" name="addvc" value="'.JText::_('COM_JACC_ADDVCPAIR').'">'.JText::_('COM_JACC_ADDVCPAIR').'</button></div><br />';  

		// Build the checkbox field output.
        if(is_array($this->value) && count($this->value)) {            
		    foreach ($this->value as $i => $value) {
                if(!is_array($value)) {
                    continue;   
                }
                $name = str_replace('[]','['.(int) $i.']',$this->name);     
                if(!isset($value['option'])) $value['option'] = 'frontend';
                $checked1 = ($value['option'] == 'backend') ? 'checked="checked"' : "";
                $checked2 = ($value['option'] == 'frontend') ? 'checked="checked"': "";
                $checked3 = ($value['option'] == 'both') ? 'checked="checked"': "";
                
			    $html[] = '<div id="div-'.$this->id.$i.'" >'.
					'<input class="pull-left" type="text" id="'.$this->id.$i.'" name="'.$name.'[name]"' .
					' value="'.htmlspecialchars($value['name'], ENT_COMPAT, 'UTF-8').'"/>'.
			        '<label class="span2 radio inline">'.JText::_('COM_JACC_BACKEND').'<input type="radio" name="'.$name.'[option]" value="backend" '.$checked1.' /></label>'.
			        '<label class="span2 radio inline">'.JText::_('COM_JACC_FRONTEND').'<input type="radio" name="'.$name.'[option]" value="frontend" '.$checked2.' /></label>'.
			    	'<label class="span2 radio inline">'.JText::_('COM_JACC_BOTH').'<input type="radio" name="'.$name.'[option]" value="both" '.$checked3.' /></label>'.
			    	'<div class="clearfix"></div>'.
			        '<button type="button" class="removeview" id="rm-'.$this->id.$i.'" value="'.JText::_('JACTION_DELETE').'">'.JText::_('JACTION_DELETE').'</button></div><br />';

		    }
        }         		 
		return implode($html);
	}

}
