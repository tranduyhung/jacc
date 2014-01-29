	if(version_compare(JVERSION,'3','<')){
		JSubMenuHelper::addEntry(
			JText::_('##Plural##'),
			'index.php?option=com_##component##&view=##plural##',
			($vName == '##plural##')
		);	
	} else {
		JHtmlSidebar::addEntry(
			JText::_('##Plural##'),
			'index.php?option=com_##component##&view=##plural##',
			($vName == '##plural##')
		);	
	}
