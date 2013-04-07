<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/update_date/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'update_date', 'Update Date', $I18N->msg('update_date_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);
}

// includes
include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/update_date/classes/class.rex_update_date.inc.php');
