<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/lang/');

	/// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'frontend_link', 'Frontend Link', $I18N->msg('frontend_link_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/settings.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/classes/class.rex_frontend_link.inc.php');

	// add link to backend
	$thisRexVersion = $REX['VERSION']. '.' . $REX['SUBVERSION'] . '.' . $REX['MINORVERSION'];

	if (version_compare($thisRexVersion, '4.5.0', '<')) {
		rex_register_extension('OUTPUT_FILTER', 'rex_frontend_link::addFrontendLinkByOutputFilterEP');
	} else { 
		rex_register_extension('META_NAVI', 'rex_frontend_link::addFrontendLinkByMetaNaviEP');
	}
}
