<?php
/**
 * File name: $HeadURL: svn://tools.janguo.de/jacc/branches/2013-09.24-joomla3x/admin/views/packages/tmpl/form.php $
 * Revision: $Revision: 147 $
 * Last modified: $Date: 2013-10-06 10:58:34 +0200 (So, 06. Okt 2013) $
 * Last modified by: $Author: michel $
 * $Id: form.php 147 2013-10-06 08:58:34Z michel $
 * @copyright	Copyright (C) 2011-2013, Michael Liebler. All rights reserved.
 * @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// Set toolbar items for the page
$edit		= JRequest::getVar('edit', true);
$text = !$edit ? JText::_( 'COM_JACC_MANAGER_NEW' ) : JText::_( 'COM_JACC_MANAGER_EDIT' );
JToolBarHelper::title(   JText::_( 'Packages' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::apply();
JToolBarHelper::save();
if (!$edit) {
	JToolBarHelper::cancel();
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'cancel', 'JTOOLBAR_CLOSE' );
}
?>

<script language="javascript" type="text/javascript">
function vremove(file) {
	$('vremove').value = file;
	submitbutton('vremove');
}

Joomla.submitbutton = function(task)
{
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
}


</script>

	 	<form method="post" action="index.php" id="adminForm" name="adminForm">
	 	<div class="col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-60  <?php endif;?>span8 form-horizontal fltlft">
		  <fieldset class="adminform">
			<legend><?php echo JText::_( 'Details' ); ?></legend>
				<?php if($this->isNew):?>
					<p><strong>Notice:</strong> The package will be compatible with Joomla 1.6 and higher.</p>
				<?php endif;?>							
				<div class="control-group">					
				<?php echo $this->form->getLabel('name'); ?>				
				<?php echo $this->form->getInput('name');  ?>
				</div>
				<?php echo $this->form->getInput('alias');  ?>
				<div class="control-group">										
				<?php echo $this->form->getLabel('version'); ?>				
				<?php echo $this->form->getInput('version');  ?>
				</div>
				<div class="control-group">						
				<?php echo $this->form->getLabel('packagerurl'); ?>				
				<?php echo $this->form->getInput('packagerurl');  ?>
				</div>
				<div class="control-group">						
				<?php echo $this->form->getLabel('updateurl'); ?>				
				<?php echo $this->form->getInput('updateurl');  ?>
				</div>
				<div class="control-group">								
				<?php echo $this->form->getLabel('published'); ?>				
				<?php echo $this->form->getInput('published');  ?>
				</div>
				<div class="control-group">	
				<?php echo $this->form->getLabel('created'); ?>				
				<?php echo $this->form->getInput('created');  ?>			
				</div>
									
          </fieldset>
		<fieldset class="adminform">
				<legend><?php echo JText::_( 'COM_JACC_EXTENSIONS' ); ?></legend>				
				<div style="padding-left:50px;">
				<?php 
				    $field = $this->form->getField('extensions','params');
				    echo $field->input;
				?>     
				</div>
			</fieldset>									                                
        </div>
        <div class="col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-40  <?php endif;?>fltrt span4">
			<?php if(version_compare(JVERSION,'3.0','lt')): ?>
				<div style="margin-top: 10px;"></div>
			<?php endif;?>
			<fieldset class="panelform">				
				<legend><?php echo JText::_( 'JGLOBAL_DESCRIPTION' ); ?></legend>
					<?php echo $this->form->getInput('description');  ?>
			</fieldset>			        
    
		<fieldset class="panelform">			
				<legend><?php echo JText::_( 'Versions' ); ?></legend>
				<div style="padding-left:50px;">
				<?php 
				
				if ($count= count($this->item->files)):
				
				?>
				 <ul>
				 		<?php foreach($this->item->files as $file):				 					 	
				 				$isRecent = stristr($file, '-'.$this->item->version.'.');
				 				?>
				 				<li style="border-bottom:1px dotted #c0c0c0;height:24px;">
				 					<a href="<?php echo JURI::base() ?>components/com_jacc/archives/<?php echo $file?>"><?php echo $file ?></a>
				 					<?php if (!$isRecent ): ?>
				 					<a  href="Javascript:vremove('<?php echo $file?>')" class="listicon"><img class="hasTip" src="<?php echo JURI::base() ?>components/com_jacc/assets/delete.png" title="Delete::Delete This Version" \ ></a>
									<?php endif; ?>
				 				</li>
				 		<?php
				 				$count--; 
				 				endforeach; ?>
				 </ul>				 
				 
				 <?php endif;?>
				 </div>
							 
			</fieldset>					
        </div>                   
		<input type="hidden" name="option" value="com_jacc" />
	    <input type="hidden" name="cid[]" value="<?php echo $this->item->id ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="packages" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<div class="clr"></div>
	<div style="text-align:center;font-weight:bold;padding:10px;clear:both;">Jacc Version <?php print JaccHelper::getVersion() ?></div> 	