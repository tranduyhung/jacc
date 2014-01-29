<?php
defined('JPATH_BASE') or die;
?>
##codestart##
/**
 * @package     ##Component##
 * @version     ##version##
 * @author      CMExtension Team
 * @copyright   Copyright (C) 2012-2014 CMExtension Team http://www.cmext.vn/
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

/**
 * Modal for selecting item.
 */
class JFormFieldModal_##Name## extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var string
	 */
	protected $type = 'Modal_##Name##';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_##component##/tables');

		// Build the script.
		$script = array();
		$script[] = '	function jSelectChart_'.$this->id.'(id, name, object) {';
		$script[] = '		document.id("'.$this->id.'_id").value = id;';
		$script[] = '		document.id("'.$this->id.'_name").value = name;';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

		// Setup variables for display.
		$html = array();
		$link = 'index.php?option=com_##component##&amp;view=##plural##&amp;layout=modal&amp;tmpl=component&amp;function=jSelectChart_'.$this->id;

		$item = JTable::getInstance('##name##', 'Table');

		$value = (int)  $this->value;

		if ($value)
		{
			$item->load($value);
			$title = $item-><?php echo $this->hident; ?>;
		}
		else
		{
			$title = JText::_('Select a ##Name##');
		}

		$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current user display field.
		$html[] = '<span class="input-append">';
		$html[] = '<input type="text" class="input-medium" id="'.$this->id.'_name" value="'.$title.'" disabled="disabled" size="35" /><a class="modal btn" title="'.JText::_('Select a ##Name##').'"  href="'.$link.'&amp;'.JSession::getFormToken().'=1" rel="{handler: \'iframe\', size: {x: 800, y: 450}}"><i class="icon-file"></i> '.JText::_('JSELECT').'</a>';
		$html[] = '</span>';

		// The active id field.
		if (0 == (int) $this->value)
		{
			$value = '';
		}
		else
		{
			$value = (int) $this->value;
		}

		// class='required' for client side validation
		$class = '';

		if ($this->required)
		{
			$class = ' class="required modal-value"';
		}

		$html[] = '<input type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value="'.$value.'" />';

		return implode('\n', $html);
	}
}