<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/articlename_sync/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'articlename_sync', 'Articlename Sync', $I18N->msg('articlename_sync_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/articlename_sync/settings.inc.php');
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/articlename_sync/classes/class.rex_articlename_sync.inc.php');
	
	// sync cat to art
	if ($REX['ADDON']['articlename_sync']['sync_cat_to_art'] == 1) {
		rex_register_extension('CAT_UPDATED', 'rex_articlename_sync::syncCatname2Artname');
	}

	// sync art to cat
	if ($REX['ADDON']['articlename_sync']['sync_art_to_cat'] == 1) {
		rex_register_extension('ART_UPDATED', 'rex_articlename_sync::syncArtname2Catname');
	}
}
