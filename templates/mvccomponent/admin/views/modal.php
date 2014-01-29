<?php defined('_JEXEC') or die('Restricted access'); ?>
##codestart##
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::_('bootstrap.tooltip');

$input     = JFactory::getApplication()->input;
$function  = $input->getCmd('function', 'jSelect##Name##');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
##codeend##
<form action="##codestart## echo JRoute::_('index.php?option=com_##component##&view=##plural##&layout=modal&tmpl=component&function='.$function);##codeend##" method="post" name="adminForm" id="adminForm" class="form-inline">
	<fieldset class="filter clearfix">
		<div class="btn-toolbar">
			<div class="btn-group pull-left">
				<label for="filter_search">
					##codestart## echo JText::_('JSEARCH_FILTER_LABEL'); ?>
				</label>
				<input type="text" name="filter_search" id="filter_search" value="##codestart## echo $this->escape($this->state->get('filter.search')); ##codeend##" size="30" />
			</div>
			<div class="btn-group pull-left">
				<button type="submit" class="btn hasTooltip" data-placement="bottom" title="##codestart## echo JText::_('JSEARCH_FILTER_SUBMIT'); ##codeend##">
					<i class="icon-search"></i></button>
				<button type="button" class="btn hasTooltip" data-placement="bottom" title="##codestart## echo JText::_('JSEARCH_FILTER_CLEAR'); ##codeend##" onclick="document.id('filter_search').value='';this.form.submit();">
					<i class="icon-remove"></i></button>
			</div>
			<input onclick="if (window.parent) window.parent.##codestart## echo $this->escape($function);##codeend##('0', '##codestart## echo $this->escape(addslashes(JText::_('SELECT_AN_ITEM'))); ##codeend##', null, null);" class="btn" type="button" value="" />
			<div class="clearfix"></div>
		</div>
		<hr class="hr-condensed" />

	</fieldset>

	<table class="table table-striped table-condensed">
		<thead>
			<tr>				
				<?php foreach ($this->listfieldlist as $field): ?>
				<th class="title">
					##codestart## echo JHTML::_('grid.sort', '<?php echo ucFirst($field); ?>', 'a.<?php echo $field; ?>', $listDirn, $listOrder ); ##codeend##
				</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="<?php echo (count($this->listfieldlist)) ?>">
				##codestart## echo $this->pagination->getListFooter(); ##codeend##
			</td>
		</tr>
	</tfoot>
	<tbody>

		##codestart## foreach ($this->items as $i => $item) : ##codeend##
			<tr class="row##codestart##  echo $i % 2; ##codeend##">
			<?php foreach ($this->listfieldlist as $field): ?>
				<?php if($field == $this->hident): ?>
				<td>
					<a class="pointer" onclick="if (window.parent) window.parent.##codestart## echo $this->escape($function);##codeend##('##codestart## echo $item->id; ##codeend##', '##codestart## echo $this->escape(addslashes($item->name)); ##codeend##');">
						##codestart## echo $this->escape($item-><?php echo $field; ?>); ##codeend##</a>
				</td>
				<?php else:?> 		
				<td>##codestart## echo $item-><?php echo $field; ?>; ##codeend##</td>
				<?php endif;?>
			<?php endforeach;?>
			</tr>
			##codestart## endforeach; ##codeend##
		</tbody>
	</table>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="##codestart## echo $listOrder; ##codeend##" />
	<input type="hidden" name="filter_order_Dir" value="##codestart## echo $listDirn; ##codeend##" />
	##codestart## echo JHtml::_('form.token'); ##codeend##
</form>