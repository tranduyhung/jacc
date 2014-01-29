<?php defined('_JEXEC') or die('Restricted access'); ?>

<form class="form" id="searchForm"
	action="<?php echo JRoute::_( 'index.php?option=com_search' );?>"
	method="post" name="searchForm">
	<div class="control-group">
		<label class="control-label" for="search_searchword"> <?php echo JText::_( 'Search Keyword' ); ?>:
		</label>
		<div class="controls">
			<input type="text" name="searchword" id="search_searchword" size="30"
				maxlength="20"
				value="<?php echo $this->escape($this->searchword); ?>"
				class="inputbox search-query" />

			<button name="Search" onclick="this.form.submit()" class="btn">				
				<i class="icon-search"></i>
			</button>
		</div>

	</div>

	<div class="control-group">
		<label class="control-label" for="ordering"> <?php echo JText::_( 'Ordering' );?>:
		</label>
		<div class="controls">
			<?php echo $this->lists['ordering'];?>
		</div>
	</div>
	<?php if ($this->params->get( 'search_areas', 1 )) : ?>
	<?php echo JText::_( 'Search Only' );?>
	:
	<div class="control-group">
		<div class="controls">
	<?php foreach ($this->searchareas['search'] as $val => $txt) :
	$checked = is_array( $this->searchareas['active'] ) && in_array( $val, $this->searchareas['active'] ) ? 'checked="checked"' : '';
	?>
	 
	<label
		class="checkbox inline" for="area_<?php echo $val;?>"> <?php echo JText::_($txt); ?>
	
	<input  type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area_<?php echo $val;?>" <?php echo $checked;?> />
	</label>
		 
	<?php endforeach; ?>
	</div>
	</div>
	<?php endif; ?>

	<div class="navbar">
		<div class="navbar-inner"  style="padding-bottom:5px;padding-top:10px;">
			<div class="pull-left">			
			<?php echo JText::_( 'Search Keyword' ) .' <b>'. $this->escape($this->searchword) .'</b>'; ?><br />
				<?php echo $this->result; ?>
			</div>	
			<div></div>
			<div class="pull-right">								
				<?php echo $this->pagination->getLimitBox( ); ?>
				<label class="pull-left" for="limit"> <?php echo JText::_( 'Display Num' ); ?>
					</label>
			</div>	
	</div>
	</div>
	<br />
	<?php if($this->total > 0) : ?>
	<div align="center">
		<div style="float: right;">

	</div>
	<?php endif; ?>

	<input type="hidden" name="task" value="search" />
</form>

