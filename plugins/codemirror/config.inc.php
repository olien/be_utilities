<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/codemirror/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'codemirror', 'CodeMirror', $I18N->msg('codemirror_description'), '1.0.0', 'REDAXO', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/codemirror/settings.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/codemirror/classes/class.rex_codemirror_utils.inc.php');

	// extensions
	rex_register_extension('OUTPUT_FILTER', 'rex_codemirror_utils::addToOutputFilter');
}
