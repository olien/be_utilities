<?php
if ($REX['REDAXO']) {
	// register addon
	$REX['ADDON']['name']['be_utilities'] = 'Backend Utilities';
	$REX['ADDON']['perm']['be_utilities'] = 'be_utilities[]';
	$REX['ADDON']['version']['be_utilities'] = '1.5.1';
	$REX['ADDON']['author']['be_utilities'] = 'RexDude';
	$REX['ADDON']['supportpage']['be_utilities'] = 'forum.redaxo.de';
	$REX['PERM'][] = 'be_utilities[]';

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/lang/');

	// sub pages
	$REX['ADDON']['be_utilities']['SUBPAGES'] = array();
	$REX['ADDON']['be_utilities']['SUBPAGES'][] = array('' , $I18N->msg('be_utilities_overview'));

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/classes/class.rex_plugin_factory.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/classes/class.rex_be_utilities.inc.php');

	// add css/js files to page header
	if (rex_request('page') == 'be_utilities') {
		rex_register_extension('PAGE_HEADER', 'rex_backend_utilities::appendToPageHeader');
	}
}
?>
