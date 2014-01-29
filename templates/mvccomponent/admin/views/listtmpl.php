 <?php defined('_JEXEC') or die('Restricted access'); 
 
 ?>
##codestart##
// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$params		= (isset($this->state->params)) ? $this->state->params : new JObject;
$saveOrder	= $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=##com_component##&task=##plural##.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();
##codeend##

<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '##codestart## echo $listOrder; ##codeend##')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<form action="index.php?option=##com_component##&view=##name##" method="post" name="adminForm" id="adminForm">

	##codestart## if (!empty( $this->sidebar)) : ##codeend##
	<div id="j-sidebar-container" class="span2">
		##codestart## echo $this->sidebar; ##codeend##
	</div>
	<div id="j-main-container" class="span10">
##codestart## else : ##codeend##
	<div id="j-main-container">
##codestart## endif;##codeend##
		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">				
				<input type="text" name="filter_search" id="filter_search" value="##codestart## echo $this->escape($this->state->get('filter.search')); ##codeend##" />
			</div>
			<div class="btn-group pull-left">
				<button type="submit" class="btn hasTooltip" title="##codestart## echo JText::_('JSEARCH_FILTER_SUBMIT'); ##codeend##"><i class="icon-search"></i></button>
				<button type="button" class="btn hasTooltip" title="##codestart## echo JText::_('JSEARCH_FILTER_CLEAR'); ##codeend##" onclick="document.id('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible">##codestart## echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');##codeend##</label>
				##codestart## echo $this->pagination->getLimitBox(); ##codeend##
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible">##codestart## echo JText::_('JFIELD_ORDERING_DESC');##codeend##</label>
				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value="">##codestart## echo JText::_('JFIELD_ORDERING_DESC');##codeend##</option>
					<option value="asc" ##codestart## if ($listDirn == 'asc') echo 'selected="selected"'; ##codeend##>##codestart## echo JText::_('JGLOBAL_ORDER_ASCENDING');##codeend##</option>
					<option value="desc" ##codestart## if ($listDirn == 'desc') echo 'selected="selected"'; ##codeend##>##codestart## echo JText::_('JGLOBAL_ORDER_DESCENDING');##codeend##</option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible">##codestart## echo JText::_('JGLOBAL_SORT_BY');##codeend##</label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value="">##codestart## echo JText::_('JGLOBAL_SORT_BY');##codeend##</option>
					##codestart## echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
				</select>
			</div>
		</div>
		<div class="clearfix"> </div>

	
<div id="editcell">
	<table class="adminlist table table-striped" id="articleList">
		<thead>
			<tr>
			<?php if($this->hasOrdering): ?>
				<th width="1%" class="nowrap center hidden-phone">
						##codestart## echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ##codeend##
				</th>
			<?php endif; ?>		
				<th width="20">
					<input type="checkbox" name="checkall-toggle" value="" title="(##codestart## echo JText::_('JGLOBAL_CHECK_ALL'); ##codeend##" onclick="Joomla.checkAll(this)" />
				</th>
				<?php foreach ($this->listfieldlist as $field): ?>
				<th class="title">
					##codestart## echo JHTML::_('grid.sort', '<?php echo ucFirst($field); ?>', 'a.<?php echo $field; ?>', $listDirn, $listOrder ); ##codeend##
				</th>
				<?php endforeach; ?>
			</tr> 			
		</thead>
		<tfoot>
		<tr>
			<td colspan="<?php echo (count($this->listfieldlist)+2) ?>">
				##codestart## echo $this->pagination->getListFooter(); ##codeend##
			</td>
		</tr>
	</tfoot>
	<tbody>
##codestart##
  if (count($this->items)) : 
  foreach ($this->items as $i => $item) :
				<?php if($this->hasOrdering): ?>
				$ordering  = ($listOrder == 'ordering');
				<?php endif;?>
				<?php if ($this->hasCheckin): ?>
  				$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
  				<?php endif;?>
				<?php if($this->uses_categories):?>
				$item->cat_link = JRoute::_('index.php?option=com_categories&extension=##com_component##&task=edit&type=other&cid[]='. $item-><?php echo $this->category_field; ?>);				
				$canCreate  = $user->authorise('core.create',     '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>);
				$canEdit    = $user->authorise('core.edit',       '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>);				
				$canChange  = $user->authorise('core.edit.state', '##com_component##.##name##.category.' . $item-><?php echo $this->category_field; ?>) <?php if ($this->hasCheckin): ?>&& $canCheckin<?php endif; ?>;
				<?php else: ?>
				$canCreate  = $user->authorise('core.create');
				$canEdit    = $user->authorise('core.edit');				
				$canChange  = $user->authorise('core.edit.state'); 				
				<?php endif;?>
	
				$disableClassName = '';
				$disabledLabel	  = '';
				if (!$saveOrder) {
					$disabledLabel    = JText::_('JORDERINGDISABLED');
					$disableClassName = 'inactive tip-top';
				} 
	
 				$onclick = "";
  	
    			if (JRequest::getVar('function', null)) {
    				$onclick= "onclick=\"window.parent.jSelect##Name##_id('".$item->id."', '".$this->escape($item-><?php echo $this->hident ?>)."', '','##primary##')\" ";
    			}  	
    
 				$link = JRoute::_( 'index.php?option=##com_component##&view=##name##&task=##name##.edit&id='. $item->##primary## );
 	
##ifdefFieldchecked_out_timeStart##
##ifdefFieldchecked_outStart## 	
 	$checked = JHTML::_('grid.checkedout', $item, $i );
##ifdefFieldchecked_out_timeEnd##
##ifdefFieldchecked_outEnd##
##ifnotdefFieldchecked_out_timeStart##
##ifnotdefFieldchecked_outStart## 	
 	$checked = JHTML::_('grid.id', $i, $item->##primary##);
##ifnotdefFieldchecked_out_timeEnd##
##ifnotdefFieldchecked_outEnd## 	

 	
  ##codeend##
				<tr class="row##codestart## echo $i % 2; ##codeend##"<?php if($this->uses_categories): ?> sortable-group-id="##codestart##  echo $item-><?php echo $this->category_field; ?>; ##codeend##<?php endif;?>">
			<?php if($this->hasOrdering): ?>
						<td class="order nowrap center hidden-phone">
					##codestart## if ($canChange) : ##codeend##					
						<span class="sortable-handler hasTooltip ##codestart## echo $disableClassName; ##codeend##" title="##codestart## echo $disabledLabel; ##codeend##">
							<i class="icon-menu"></i>
						</span>
						<input type="text" style="display:none" name="order[]" size="5"
							value="##codestart## echo $item->ordering;##codeend##" class="width-20 text-area-order " />
					##codestart## else : ##codeend##
						<span class="sortable-handler inactive" >
							<i class="icon-menu"></i>
						</span>
					##codestart## endif; ##codeend##
					</td>
			<?php endif; ?>		      
        			<td>##codestart## echo $checked;  ##codeend##</td>
        				
			<?php foreach ($this->listfieldlist as $field): ?>
			<?php if($field == $this->hident):?>
			        <td class="nowrap has-context">
					<div class="pull-left">
							<?php if ($this->hasCheckin): ?>
							##codestart## if ($item->checked_out) : ##codeend##
								##codestart## echo JHtml::_('jgrid.checkedout', $i, $item->checked_out_by, $item->checked_out_time, '##plural##.', $canCheckin); ##codeend##
							##codestart## endif; ##codeend##
							<?php endif; ?>
							##codestart## if ($canEdit) : ##codeend##
								<a href="##codestart##  echo $link; ##codeend##">
									##codestart##  echo $this->escape($item-><?php echo $this->hident; ?>); ##codeend##</a>
							##codestart##  else : ?>
								##codestart##  echo $this->escape($item-><?php echo $this->hident; ?>); ##codeend##
							##codestart##  endif; ##codeend##
							
						</div>
						<div class="pull-left">
							##codestart##
								// Create dropdown items
								JHtml::_('dropdown.edit', $item->##primary##, '##name##.');
								<?php if($this->publishedField): ?>
								JHtml::_('dropdown.divider');
								if ($item-><?php echo $this->publishedField; ?>) :
									JHtml::_('dropdown.unpublish', 'cb' . $i, '##plural##.');
								else :
									JHtml::_('dropdown.publish', 'cb' . $i, '##plural##.');
								endif;									
								JHtml::_('dropdown.divider');

								if ($archived) :
									JHtml::_('dropdown.unarchive', 'cb' . $i, '##plural##.');
								else :
									JHtml::_('dropdown.archive', 'cb' . $i, '##plural##.');
								endif;
								
								if ($trashed) :
									JHtml::_('dropdown.untrash', 'cb' . $i, '##plural##.');
								else :
									JHtml::_('dropdown.trash', 'cb' . $i, '##plural##.');
								endif;								
								<?php endif; ?>
								<?php if ($this->hasCheckin): ?>
								if ($item->checked_out) :
									JHtml::_('dropdown.checkin', 'cb' . $i, '##plural##.');
								endif;
								<?php endif; ?>

								// render dropdown list
								echo JHtml::_('dropdown.render');
								##codeend##
						</div>
						</td>
			<?php elseif($field == $this->publishedField): ?>
						<td>
							##codestart## echo JHtml::_('jgrid.published', $item-><?php echo $this->publishedField; ?>, $i, '##plural##.', $canChange, 'cb'); ##codeend##
						</td>		
			<?php else:?> 		
						<td>##codestart## echo $item-><?php echo $field; ?>; ##codeend##</td>
			<?php endif;?>
		<?php endforeach;?>
	</tr>
##codestart##

  endforeach;
  else:
  ##codeend##
	<tr>
		<td colspan="12">
			##codestart## echo JText::_( 'There are no items present' ); ##codeend##
		</td>
	</tr>
	##codestart##
  endif;
  ##codeend##
</tbody>
</table>
</div>
<input type="hidden" name="option" value="##com_component##" />
<input type="hidden" name="task" value="##name##" />
<input type="hidden" name="view" value="##plural##" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="##codestart## echo $listOrder; ##codeend##" />
<input type="hidden" name="filter_order_Dir" value="" />
##codestart## echo JHTML::_( 'form.token' ); ##codeend##
</form>  	