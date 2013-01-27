<?php

if ($REX['REDAXO']) {

// --- DYN
$REX['ADDON']['frontend_link']['link_text_mode'] = "default";
$REX['ADDON']['frontend_link']['link_text'] = "";
// --- /DYN

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/frontend_link/lang/');

	/// register plugin
	rex_plugin_factory::registerPlugin('be_extensions', 'frontend_link', 'Frontend Link', $I18N->msg('frontend_link_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);

	// lang support
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/frontend_link/lang/');

	// includes
	require_once($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/frontend_link/classes/class.rex_frontend_link.inc.php');

	// add link to backend
	rex_register_extension('OUTPUT_FILTER', 'rex_frontend_link::addFrontendLink');
}
