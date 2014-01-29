
	if(version_compare(JVERSION,'3','<')){
		JSubMenuHelper::addEntry(
			JText::_('##firstname##'),
			'index.php?option=com_categories&extension=com_##component##.##extension##',
			($vName == 'categories.##extension##')
		);
	} else {
		JHtmlSidebar::addEntry(
			JText::_('##firstname##'),
			'index.php?option=com_categories&extension=com_##component##.##extension##',
			($vName == 'categories.##extension##')
		);
	} 