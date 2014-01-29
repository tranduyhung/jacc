<?php defined('_JEXEC') or die('Restricted access'); ?>
<<?php echo '?'?>xml version="1.0" encoding="utf-8"##codeend##
<metadata>
	<layout title="##Name##list">
		<help
			key = "##Name##LIST_DESC"
		/>
		<message>
			<![CDATA[##Name##LIST_DESC]]>
		</message>
	</layout>
	<?php if($this->uses_categories):?>
	<fields name="request">
		<fieldset name="request"
			addfieldpath="/administrator/components/com_categories/models/fields">
			<field name="category" 
				   type="categoryedit" label="JCATEGORY"
				   required="true" 
				   extension="##com_component##.##name##" 
				   description="JFIELD_CATEGORY_DESC"
				   class="inputbox" 				   
				   size="1">
				<option value="all">COM_##COMPONENT##_ALL_CATEGORIES</option>
			</field>
		</fieldset>
	</fields>
	<?php endif;?>
	<!-- Add fields to the parameters object for the layout. -->
	<fields name="params">
	</fields>
</metadata>