<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['category_separator']['settings'] = array(
		'cat_id' => ''
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile('category_separator');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'category_separator', 'Category Separator', $I18N->msg('category_separator_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/classes/class.rex_category_separator.inc.php');

	if ($REX['ADDON']['category_separator']['settings']['cat_id'] != '' && rex_request('page') == 'structure' && (rex_request('category_id') == '' || rex_request('category_id') == '0') && rex_request('function') == '') { // only for root cats
		rex_register_extension('OUTPUT_FILTER', 'rex_category_separator::splitTable');
	}

}

