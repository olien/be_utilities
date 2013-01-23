<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/lang/');

	$REX['ADDON']['rxid']['be_extensions'] = '1045';
	$REX['ADDON']['name']['be_extensions'] = $I18N->msg('be_extensions');
	$REX['ADDON']['perm']['be_extensions'] = 'be_extensions[]';
	$REX['ADDON']['version']['be_extensions'] = '1.0.0';
	$REX['ADDON']['author']['be_extensions'] = "WebDevOne";
	$REX['ADDON']['supportpage']['be_extensions'] = 'forum.redaxo.de';
	$REX['PERM'][] = 'be_extensions[]';

	// sub pages
	$REX['ADDON']['be_extensions']['SUBPAGES'] = array();
	$REX['ADDON']['be_extensions']['SUBPAGES'][] = array('' , $I18N->msg('plugin_overview'));

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_extensions/classes/class.rex_plugin_factory.inc.php');
}
?>
