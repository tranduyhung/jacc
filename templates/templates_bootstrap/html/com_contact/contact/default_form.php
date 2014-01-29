<?php
/** $Id: default_form.php 168 2013-11-12 16:14:31Z michel $ */
defined( '_JEXEC' ) or die( 'Restricted access' );

$script = '<!--
function validateForm( frm ) {
var valid = document.formvalidator.isValid(frm);
if (valid == false) {
// do field validation
if (frm.email.invalid) {
alert( "' . JText::_( 'Please enter a valid e-mail address.', true ) . '" );
} else if (frm.text.invalid) {
alert( "' . JText::_( 'CONTACT_FORM_NC', true ) . '" );
}
return false;
} else {
frm.submit();
}
}
// -->';
$document = JFactory::getDocument();
$document->addScriptDeclaration($script);

	if(isset($this->error)) : ?>
<div class="error"> <?php echo $this->error; ?></div>

<?php endif; ?>

		<form action="<?php echo JRoute::_( 'index.php' );?>" method="post"
			name="emailForm" id="emailForm" class="form-validate form-horizontal">
			<div
				class="contact_email<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
				<div class="control-group">
					<label class="control-label" for="contact_name"> &nbsp;<?php echo JText::_( 'Enter your name' );?>:
					</label>
					<div class="controls">
						<input type="text" name="name" id="contact_name" size="30"
							class="inputbox" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" id="contact_emailmsg" for="contact_email"> &nbsp;<?php echo JText::_( 'Email address' );?>:
					</label>
					<div class="controls">
						<input type="text" id="contact_email" name="email" size="30"
							value="" class="inputbox required validate-email" maxlength="100" />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="contact_subject"> &nbsp;<?php echo JText::_( 'Message subject' );?>:
				</label> 
				<div class="controls">
				<input type="text" name="subject" id="contact_subject"
					size="30" class="inputbox" value="" />
					</div> 
				</div>	
					<br /> 
					<div class="control-group">
					<label class="control-label"
					id="contact_textmsg" for="contact_text"> &nbsp;<?php echo JText::_( 'Enter your message' );?>:
				</label>
				<div class="controls">
				<textarea name="text" rows="7"  id="contact_text"
					class="inputbox required"></textarea>
					</div>
				<?php if ($this->contact->params->get( 'show_email_copy' )) : ?>				
				</div>
				<div class="control-group">
				<label class="control-label"
					for="contact_email_copy"> <?php echo JText::_( 'EMAIL_A_COPY' ); ?>
				</label>
				<div class="controls">
				 <input type="checkbox" name="email_copy"
					id="contact_email_copy" value="1" /> 
					</div>
				</div>
				<?php endif; ?>
				<br /> <br />
				<button class="pull-right btn btn-primary button validate" type="submit">
					<?php echo JText::_('Send'); ?>
				</button>
			</div>

			<input type="hidden" name="option" value="com_contact" /> <input
				type="hidden" name="view" value="contact" /> <input type="hidden"
				name="id" value="<?php echo $this->contact->id; ?>" /> <input
				type="hidden" name="task" value="submit" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form> <br />


