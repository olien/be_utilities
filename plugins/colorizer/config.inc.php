<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/colorizer/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['colorizer']['settings'] = array(
		'labelcolor' => '#47a1ce',
		'colorize_favicon' => false
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile('colorizer');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'colorizer', 'Colorizer', $I18N->msg('colorizer_description'), '1.3.1', 'Jan Kristinus', 'www.redaxo.org/de/forum', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/colorizer/classes/class.rex_colorizer_utils.inc.php');

	// add stuff to ep's
	if (rex_request('page') != 'mediapool' && rex_request('page') != 'linkmap') {
		rex_register_extension('PAGE_HEADER', 'rex_colorizer_utils::addToPageHeader');
	}

	if ($REX['ADDON']['colorizer']['settings']['colorize_favicon'] && $REX['ADDON']['colorizer']['settings']['labelcolor'] != '') {
		rex_register_extension('OUTPUT_FILTER', 'rex_colorizer_utils::addToOutputFilter');
	}
}
