<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_seperator/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'category_seperator', 'Category Seperator', $I18N->msg('category_seperator_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_seperator/classes/class.rex_category_seperator.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_seperator/settings.inc.php');

	if ($REX['ADDON']['category_seperator']['hide_cat_id'] != '') {
		rex_register_extension('OUTPUT_FILTER', 'rex_category_seperator::appendToBody');
	}
}


