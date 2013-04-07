<?php

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/phpinfo/lang/');

	/// register plugin
	rex_plugin_factory::registerPlugin('be_extensions', 'phpinfo', 'PHP-Info', $I18N->msg('phpinfo_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);
}
