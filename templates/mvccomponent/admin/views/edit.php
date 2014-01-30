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

<form method="post" action="##codestart## echo JRoute::_('index.php?option=##com_component##&layout=edit&id='.(int) $this->item->##primary##); ##codeend##" id="adminForm" name="adminForm" class="form-horizontal">
	<div class="span8 width-60 fltlft">
		<fieldset class="adminform">
			<legend>##codestart## echo JText::_( 'Details' ); ##codeend##</legend>
			<?php
			if (isset($this->formfield['details']))
			{
				$fields = $this->formfield['details'];

				foreach ($fields as $field)
				{
					$this->field = $field;
					echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
				}
			}

			if (isset($this->formfield['desc']))
			{
				$fields = $this->formfield['desc'];

				foreach ($fields as $field) 
				{
					$this->field = $field;
					echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
				}
			}

			if (isset($this->formfield['subdesc']))
			{
				$fields = $this->formfield['subdesc'];

				foreach ($fields as $field)
				{
					$this->field = $field;
					echo $this->loadTemplate('mvccomponent/admin/views/formfields.php');
				}
			}
			?>
		</fieldset>
	</div>

	<div class="span4 width-40 fltrt">
		<?php if (isset($this->formfield['params'])): ?>
			<fieldset class="adminform">
				<legend>##codestart## echo JText::_( 'Parameters' ); ##codeend##</legend>
			<?php
			$fields = $this->formfield['params'];

			foreach ($fields as $field)
			{
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
					foreach($fieldSets  as $name =>$fieldset):
						foreach ($this->form->getFieldset($name) as $field):
							if ($field->hidden):
								echo $field->input;
							else:
				##codeend##
					<tr>
						<td class="paramlist_key" width="40%">
							##codestart## echo $field->label; ##codeend##
						</td>
						<td class="paramlist_value">
							##codestart## echo $field->input; ##codeend##
						</td>
					</tr>
				##codestart##
							endif;
						endforeach;
					endforeach;
				##codeend##
				</table>
			</fieldset>
		<?php endif; ?>
	</div>

	<input type="hidden" name="option" value="##com_component##" />
	<input type="hidden" name="cid[]" value="##codestart## echo $this->item->##primary## ##codeend##" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="view" value="##name##" />
	##codestart## echo JHTML::_('form.token'); ##codeend##
</form>