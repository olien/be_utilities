<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['frontend_link']['settings'] = array(
		'metamenu_link' => 'default',
		'metamenu_link_text' => '',
		'metamenu_header_link' => true
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile('frontend_link');

	/// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'frontend_link', 'Frontend Link', $I18N->msg('frontend_link_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/classes/class.rex_frontend_link.inc.php');

	// add link to backend
	$thisRexVersion = $REX['VERSION']. '.' . $REX['SUBVERSION'] . '.' . $REX['MINORVERSION'];

	if ($REX['ADDON']['frontend_link']['settings']['metamenu_link'] != 'none') {
		if (version_compare($thisRexVersion, '4.5.0', '<')) {
			rex_register_extension('OUTPUT_FILTER', 'rex_frontend_link::addFrontendLinkByOutputFilterEP');
		} else { 
			rex_register_extension('META_NAVI', 'rex_frontend_link::addFrontendLinkByMetaNaviEP');
		}
	}

	if ($REX['ADDON']['frontend_link']['settings']['metamenu_header_link'] && OOPlugin::isActivated('be_utilities', 'frontend_link')) {
		// link in header
		if (rex_request('page') != 'mediapool' && rex_request('page') != 'linkmap') {
			rex_register_extension('OUTPUT_FILTER', 'rex_frontend_link::addToOutputFilter');
		}
		
		// link in metamenu
		rex_register_extension('PAGE_HEADER', 'rex_frontend_link::addToPageHeader');
	}
}
