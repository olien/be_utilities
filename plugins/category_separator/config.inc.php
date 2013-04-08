<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'category_separator', 'Category Seperator', $I18N->msg('category_separator_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/classes/class.rex_category_separator.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/settings.inc.php');

	if (($REX['ADDON']['category_separator']['hide_cat_id'] != '') && (rex_request('page') == 'structure' && rex_request('category_id') == '' || rex_request('category_id') == '0')) { // only for root cats
		rex_register_extension('OUTPUT_FILTER', 'rex_category_separator::appendToBody');
	}
}


