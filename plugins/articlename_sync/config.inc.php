<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/articlename_sync/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['articlename_sync']['settings'] = array(
		'sync_cat_to_art' => true,
		'sync_art_to_cat' => true
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile('articlename_sync');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'articlename_sync', 'Articlename Sync', $I18N->msg('articlename_sync_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/articlename_sync/classes/class.rex_articlename_sync.inc.php');
	
	// sync cat to art
	if ($REX['ADDON']['articlename_sync']['settings']['sync_cat_to_art']) {
		rex_register_extension('CAT_UPDATED', 'rex_articlename_sync::syncCatname2Artname');
	}

	// sync art to cat
	if ($REX['ADDON']['articlename_sync']['settings']['sync_art_to_cat']) {
		rex_register_extension('ART_UPDATED', 'rex_articlename_sync::syncArtname2Catname');
		rex_register_extension('ART_META_UPDATED', 'rex_articlename_sync::syncArtname2Catname');
	}
}
