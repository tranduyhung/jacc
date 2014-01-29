<?php defined('_JEXEC') or die('Restricted access'); ?>

<table class="table table-striped table-bordered contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	
		<?php
		foreach( $this->results as $result ) : ?>
		<tr>
		<td>
		<span small<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
						<?php echo $this->pagination->limitstart + $result->count.'. ';?>
		</span>
		</td>
		<td>	
			<fieldset>
				<div>
					
					<?php if ( $result->href ) :
					if ( $result->section ) : ?>
												
						<h5><?php echo $this->escape($result->section); ?></h5>
												
						<?php endif; 
										
						if ($result->browsernav == 1 ) : ?>
							<a href="<?php echo JRoute::_($result->href); ?>" target="_blank">
						<?php else : ?>
							<a href="<?php echo JRoute::_($result->href); ?>">
						<?php endif; ?>
					  <h4> <?php 	echo $this->escape($result->title); ?></h4>
                       <?php 
						if ( $result->href ) : ?>
							</a>
						<?php endif; 
					 endif; ?>
				</div>
				<div>
					<?php echo $result->text; ?>
				</div>
				<?php
					if ( $this->params->get( 'show_date' )) : ?>
				<div class="small<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
					<?php echo $result->created; ?>
				</div>
				<?php endif; ?>
			</fieldset>
			</td>
			</tr>			
		<?php endforeach; ?>
		
	<tr>
		<td colspan="3">
			<div align="center">
				<?php echo $this->pagination->getPagesLinks( ); ?>
			</div>
		</td>
	</tr>
</table>

