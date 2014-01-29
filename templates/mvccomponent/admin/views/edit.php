<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
##codeend##

<script language="javascript" type="text/javascript">


Joomla.submitbutton = function(task)
{
	if (task == '##name##.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
}

</script>

	 	<form method="post" action="##codestart## echo JRoute::_('index.php?option=##com_component##&layout=edit&id='.(int) $this->item->##primary##);  ##codeend##" id="adminForm" name="adminForm">
	 	<div class="col ##codestart## if(version_compare(JVERSION,'3.0','lt')):  ##codeend##width-60  ##codestart## endif; ##codeend##span8 form-horizontal fltlft">
		  <fieldset class="adminform">
			<legend>##codestart## echo JText::_( 'Details' ); ##codeend##</legend>
		<?php if (isset($this->formfield['details'])): 
								$fields = $this->formfield['details'];
								foreach ($fields as $field) {
									$this->field = $field;									
									echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
								}
		?>
		<?php endif; ?>			
		<?php if (isset($this->formfield['desc'])): 
								$fields = $this->formfield['desc'];
								foreach ($fields as $field) {
									$this->field = $field;
									echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
								}
		?>
		<?php endif; ?>			
		<?php if (isset($this->formfield['subdesc'])): 
								$fields = $this->formfield['subdesc'];
								foreach ($fields as $field) {
									$this->field = $field;
									echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
								}
		?>
		<?php endif; ?>	
						
          </fieldset>                      
        </div>
        <div class="col ##codestart## if(version_compare(JVERSION,'3.0','lt')):  ##codeend##width-30  ##codestart## endif; ##codeend##span2 fltrgt">
		<?php if (isset($this->formfield['params'])): ?>        
			<fieldset class="adminform">
				<legend>##codestart## echo JText::_( 'Parameters' ); ##codeend##</legend>
		<?php 
								$fields = $this->formfield['params'];
								foreach ($fields as $field) {
									$this->field = $field;
									echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
								}
		?>								
			</fieldset>
		<?php endif; ?>	        
<?php if (isset($this->formfield['addparams'])): ?>     		
			<fieldset class="adminform">
				<legend>##codestart## echo JText::_( 'Advanced Parameters' ); ##codeend##</legend>
				<table>				
				##codestart## 
					$fieldSets = $this->form->getFieldsets('params');
					foreach($fieldSets  as $name =>$fieldset):  ##codeend##				
				##codestart## foreach ($this->form->getFieldset($name) as $field) : ##codeend##
					##codestart## if ($field->hidden):  ##codeend##
						##codestart## echo $field->input;  ##codeend##
					##codestart## else:  ##codeend##
					<tr>
						<td class="paramlist_key" width="40%">
							##codestart## echo $field->label;  ##codeend##
						</td>
						<td class="paramlist_value">
							##codestart## echo $field->input;  ##codeend##
						</td>
					</tr>
				##codestart## endif;  ##codeend##
				##codestart## endforeach;  ##codeend##
			##codestart## endforeach;  ##codeend##
			</table>			
			</fieldset>									

<?php endif; ?>

        </div>                   
		<input type="hidden" name="option" value="##com_component##" />
	    <input type="hidden" name="cid[]" value="##codestart## echo $this->item->##primary## ##codeend##" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="##name##" />
		##codestart## echo JHTML::_( 'form.token' ); ##codeend##
	</form>