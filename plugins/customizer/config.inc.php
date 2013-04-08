<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/customizer/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'customizer', 'Customizer', $I18N->msg('customizer_description'), '1.3.1', 'Jan Kristinus', 'www.redaxo.org/de/forum', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/customizer/classes/class.rex_customizer_utils.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/customizer/settings.inc.php');

	// add stuff to ep's
	rex_register_extension('PAGE_HEADER', 'rex_customizer_utils::addToPageHeader');

	if ($REX['ADDON']['customizer']['showlink']) {
		rex_register_extension('OUTPUT_FILTER', 'rex_customizer_utils::addToOutputFilter');
	}

	if ($REX['ADDON']['customizer']['textarea'] || $REX['ADDON']['customizer']['liquid']) {
		rex_register_extension('PAGE_BODY_ATTR', 'rex_customizer_utils::addToPageBodyAttribute');
	}
}
