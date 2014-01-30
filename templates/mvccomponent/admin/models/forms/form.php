<?php defined('_JEXEC') or die('Restricted access'); 
$format = '%Y-%m-%d';
$datesize = 10;?>
<<?php echo '?'?>xml version="1.0" encoding="utf-8"##codeend##
<form>
	<fields>
<?php foreach ($this->formfield as $field) {
		if ($field->get('additional')) continue;
		if ($field->get('key') == 'params') continue;

		$required = $field->get('required') ? $field->get('required') : 'false';
		$size= $field->get('size') ? $field->get('size') : '40';
		$label= $field->get('label') ? $field->get('label') : ucfirst($field->get('key'));

		switch($field->get('key')) {
			case 'catid':
			case 'category_id':
				if($this->uses_categories):
?>

		<field name="<?php echo $field->get('key') ?>"
			type="categoryedit"
			label="JCATEGORY"
			required="true"
			extension="com_##component##.##name##"
			description="JFIELD_CATEGORY_DESC"
			class="inputbox"
			addfieldpath="/administrator/components/com_categories/models/fields"
			size="1" />
<?php
				endif;
				break;

			case $this->primary:
?>

		<field name="<?php echo $this->primary ?>"
			type="hidden"
			default="0"
			required="true"
			readonly="true" />
<?php
				break;

			default:
				switch (strtolower($field->get('formfield'))) {
					case 'list':
?>

		<field name="<?php echo $field->get('key') ?>"
			type="list"
			class="inputbox"
			default="1"
			required="<?php echo $required ?>"
			size="1"
			label="<?php echo $label ?>"
			description="<?php echo $field->get('key') ?>_DESC">
			<option value="0">Option None</option>
			<option value="1">First Option</option>
			<option value="2">Second Option</option>
			<option value="3">And so on</option>
		</field>
<?php
				break;
			case 'published': ?>

		<field name="published"
			type="list"
			class="inputbox"
			default="1"
			size="1"
			label="JField_Published_Label"
			description="JField_Published_DESC">
				<option value="1">JPUBLISHED</option>
				<option value="0">JUNPUBLISHED</option>
				<option value="-1">JARCHIVED</option>
				<option value="-2">JTRASHED</option>
		</field>
<?php
				break;
			case 'editor':
?>

		<field name="<?php echo $field->get('key') ?>"
			type="editor"
			label="<?php echo $label ?>"
			description="<?php echo $field->get('key') ?>_DESC"
			class="inputbox"
			buttons="readmore,pagebreak" />
<?php
				break;

			case 'calendar':
				if ($field->get('fieldtype') == 'datetime') {
					$format = '%Y-%m-%d %H-%M-%S'; 
					$datesize = 16;

					switch ($field->get('key'))
					{
						case 'created':
							$label = 'JGLOBAL_FIELD_CREATED_LABEL';
							$desc = '';
							break;
						case 'modified':
							$label = 'JGLOBAL_FIELD_MODIFIED_LABEL';
							$desc = '';
							break;
						default:
							$desc = $field->get('key') . '_DESC';
							break;
					}
}
?>

		<field name="<?php echo $field->get('key') ?>"
			type="calendar"
			required="<?php echo $required ?>"
			label="<?php echo $label ?>"
			description="<?php echo $desc ?>"
			class="inputbox"
			size="<?php echo $datesize ?>"
			format="<?php echo $format ?>"
			filter="user_utc" />
<?php
				break;
			case 'text':
?>

		<field name="<?php echo $field->get('key') ?>"
			type="text"
			required="<?php echo $required ?>"
			label="<?php echo $label ?>"
			description="<?php echo $field->get('key') ?>_DESC"
			class="inputbox"
			size="40" />
<?php
				break;
			case 'null':
?>

		<field name="<?php echo $field->get('key') ?>"
			type="hidden"
			filter="unset" />
<?php
				break;
			default:
?>

		<field name="<?php echo $field->get('key') ?>"
			required="<?php echo $required ?>"
			type="<?php echo $field->get('formfield') ?>"
			label="<?php echo $label ?>"
			description="<?php echo $field->get('key') ?>_DESC"
			class="inputbox"
			size="<?php echo $size ?>" />
<?php
		}
	}
}
?>
	</fields>
<?php if (isset($this->formfield['params'])): ?>

	<fields name="params">
		<fieldset name="basic">
			<field name="example_param"
				type="list"
				default=""
				label="Params_Example_Label"
				description="Params_Example_DESC">
					<option value="0">No</option>
					<option value="1">Yes</option>
			</field>
		</fieldset>
	</fields>
<?php endif; ?>
</form>