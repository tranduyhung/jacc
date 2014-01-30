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
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
<?php if($this->uses_categories): ?>
$canOrder	= $user->authorise('core.edit.state', '##com_component##.category');
<?php else: ?>
$canOrder	= $user->authorise('core.edit.state');
<?php endif; ?>
$saveOrder	= $listOrder=='ordering';
$params		= (isset($this->state->params)) ? $this->state->params : new JObject();
##codeend##

<form action="index.php?option=##com_component##&view=##name##" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search">##codestart## echo JText::_('JSEARCH_FILTER_LABEL'); ##codeend##</label>
			<input type="text" name="filter_search" id="filter_search" value="##codestart## echo $this->escape($this->state->get('filter.search')); ##codeend##" />
			<button type="submit">##codestart## echo JText::_('JSEARCH_FILTER_SUBMIT'); ##codeend##</button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();">##codestart## echo JText::_('JSEARCH_FILTER_CLEAR'); ##codeend##</button>
		</div>
		<div class="filter-select fltrt">
<?php if($this->publishedField): ?>
				##codestart##
					echo JHTML::_('grid.state', $this->state->get('filter.state'));
				##codeend##
<?php endif; ?>
		</div>
	</fieldset>
	<div class="clr"> </div>


	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="##codestart## echo JText::_('JGLOBAL_CHECK_ALL'); ##codeend##" onclick="Joomla.checkAll(this)" />
				</th>
<?php foreach ($this->listfieldlist as $field): ?>
				<th class="title">
					##codestart## echo JHTML::_('grid.sort', '<?php echo ucFirst($field); ?>', 'a.<?php echo $field; ?>', $listDirn, $listOrder ); ##codeend##
				</th>
				<?php if ($field == 'ordering'): ?>
				<th width="10%">
					##codestart## echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'ordering', $listDirn, $listOrder); ##codeend##
					##codestart## if ($canOrder && $saveOrder): ##codeend##
						##codestart## echo JHtml::_('grid.order',  $this->items, 'filesave.png', '##plural##.saveorder'); ##codeend##
					##codestart## endif; ##codeend##
				</th>
				<?php endif; ?>
<?php endforeach; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="<?php echo count($this->listfieldlist)+1; ?>">
					##codestart## echo $this->pagination->getListFooter(); ##codeend##
				</td>
			</tr>
		</tfoot>
		<tbody>
		##codestart##
		foreach ($this->items as $i => $item):
<?php if($this->hasOrdering): ?>
			$ordering = ($listOrder == 'ordering');
<?php endif; ?>
<?php if ($this->hasCheckin): ?>
			$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
<?php endif; ?>
<?php if($this->uses_categories): ?>
			$item->cat_link = JRoute::_('index.php?option=com_categories&extension=##com_component##&task=edit&type=other&cid[]='. $item-><?php echo $this->category_field; ?>);
			$canCreate = $user->authorise('core.create', '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>);
			$canEdit = $user->authorise('core.edit', '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>);
			$canChange = $user->authorise('core.edit.state', '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>) <?php if ($this->hasCheckin): ?>&& $canCheckin<?php endif; ?>;
<?php else: ?>
			$canCreate = $user->authorise('core.create');
			$canEdit = $user->authorise('core.edit');
			$canChange = $user->authorise('core.edit.state');
<?php endif; ?>
			$link = JRoute::_('index.php?option=##com_component##&view=##name##&task=##name##.edit&id=' . $item->##primary##);
		##codeend##
			<tr class="row##codestart## echo $i % 2; ##codeend##">
				<td class="center">
					##codestart## echo JHtml::_('grid.id', $i, $item->##primary##); ##codeend##
				</td>
<?php foreach ($this->listfieldlist as $field): ?>
<?php if($field == $this->hident): ?>
				<td>
<?php if ($this->hasCheckin): ?>
					##codestart## if ($item->checked_out):
					echo JHtml::_('jgrid.checkedout', $i, '', $item->checked_out_time, '##plural##.', $canCheckin);
					endif; ##codeend##
<?php endif; ?>
					##codestart## if ($canEdit): ##codeend##
					<a href="##codestart##  echo $link; ##codeend##">
					##codestart## echo $this->escape($item-><?php echo $this->hident; ?>); ##codeend##</a>
					##codestart## else : ?>
					##codestart## echo $this->escape($item-><?php echo $this->hident; ?>); ##codeend##
					##codestart## endif; ##codeend##
				</td>
<?php elseif($field == $this->publishedField): ?>
				<td class="center">
					##codestart## echo JHtml::_('jgrid.published', $item-><?php echo $this->publishedField; ?>, $i, '##plural##.', $canChange, 'cb'); ##codeend##
				</td>
<?php elseif ($field == 'ordering'): ?>
				<td class="center">
					##codestart## if ($canChange): ##codeend##
						##codestart## if ($saveOrder): ##codeend##
							##codestart## if ($listDirn == 'asc'): ##codeend##
								<span>##codestart## echo $this->pagination->orderUpIcon($i, true, '##plural##.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ##codeend##</span>
								<span>##codestart## echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, '##plural##.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ##codeend##</span>
							##codestart## elseif ($listDirn == 'desc'): ##codeend##
								<span>##codestart## echo $this->pagination->orderUpIcon($i, true, '##plural##.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ##codeend##</span>
								<span>##codestart## echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, '##plural##.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ##codeend##</span>
							##codestart## endif; ##codeend##
						##codestart## endif; ##codeend##
						##codestart## $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ##codeend##
						<input type="text" name="order[]" size="5" value="##codestart## echo $item->ordering;##codeend##" ##codestart## echo $disabled; ##codeend## class="text-area-order" />
					##codestart## else : ##codeend##
						##codestart## echo $item->ordering; ##codeend##
					##codestart## endif; ##codeend##
				</td>
<?php else: ?>
				<td class="center">##codestart## echo $item-><?php echo $field; ?>; ##codeend##</td>
<?php endif; ?>
<?php endforeach; ?>
			</tr>
		##codestart##
		endforeach;
		##codeend##
		</tbody>
	</table>

	<input type="hidden" name="option" value="##com_component##" />
	<input type="hidden" name="task" value="##name##" />
	<input type="hidden" name="view" value="##plural##" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="##codestart## echo $listOrder; ##codeend##" />
	<input type="hidden" name="filter_order_Dir" value="" />
	##codestart## echo JHTML::_('form.token'); ##codeend##
</form>