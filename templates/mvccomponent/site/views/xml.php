<<?php echo '?'?>xml version="1.0" encoding="utf-8"##codeend##
<metadata>
	<layout title="##Name##">
		<help
			key = "##Name##_DESC"
		/>
		<message>
			<![CDATA[##Name##_DESC]]>
		</message>
	</layout>
	<fields name="request">
		<fieldset name="request"
			addfieldpath="/administrator/components/com_##component##/models/fields"
		>
			<field name="##primary##"
				type="modal_##name##"
				description="##Name##_SELECT_DESC"
				label="Select ##Name##"
				required="true"
			/>
		</fieldset>
	</fields>	
	<!-- Add fields to the parameters object for the layout. -->
	<fields name="params">
	</fields>
</metadata>