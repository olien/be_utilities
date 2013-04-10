<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/phpinfo/lang/');

	/// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'phpinfo', 'PHP-Info', $I18N->msg('phpinfo_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);
}
