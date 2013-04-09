<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/colorizer/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'colorizer', 'Colorizer', $I18N->msg('colorizer_description'), '1.3.1', 'Jan Kristinus', 'www.redaxo.org/de/forum', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/colorizer/classes/class.rex_colorizer_utils.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/colorizer/settings.inc.php');

	// add stuff to ep's
	rex_register_extension('PAGE_HEADER', 'rex_colorizer_utils::addToPageHeader');
}
