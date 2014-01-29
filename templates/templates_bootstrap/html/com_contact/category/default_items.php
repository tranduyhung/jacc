<?php
/** $Id: default_items.php 147 2013-10-06 08:58:34Z michel $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php foreach($this->items as $item) : ?>
<tr class="sectiontableentry<?php echo $item->odd + 1; ?> contact-name">
	<th colspan="2">
		<a href="<?php echo $item->link; ?>" class="category<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $item->name; ?></a>
	</th>
</tr>
<tr class="sectiontableentry<?php echo $item->odd + 1; ?>">
	<?php if ( $this->params->get( 'show_position' ) ) : ?>
	<td>
		<?php echo $this->escape($item->con_position); ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_email' ) ) : ?>
	<td width="50%">
		<?php echo $item->email_to; ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_telephone' ) ) : ?>
	<td width="50%">
		<?php echo $this->escape($item->telephone); ?>
	</td>
	<?php endif; ?>
	
</tr>
<?php endforeach; ?>

