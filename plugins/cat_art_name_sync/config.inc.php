<?php 
// --- DYN
$REX['ADDON']['cat_art_name_sync']['sync_cat_to_art'] = 1;
$REX['ADDON']['cat_art_name_sync']['sync_art_to_cat'] = 1;
// --- /DYN

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/cat_art_name_sync/lang/');

	// add to extension manager
	$extension = new rex_extension('cat_art_name_sync', 'Cat-Art Name Sync', $I18N->msg('cat_art_name_sync_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);
	$REX['extension_manager']->addExtension($extension);

	// includes
	require_once($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/cat_art_name_sync/classes/class.rex_cat_art_name_sync.inc.php');
	
	// sync cat to art
	if ($REX['ADDON']['cat_art_name_sync']['sync_cat_to_art'] == 1) {
		rex_register_extension('CAT_UPDATED', 'rex_cat_art_name_sync::syncCatname2Artname');
	}

	// sync art to cat
	if ($REX['ADDON']['cat_art_name_sync']['sync_art_to_cat'] == 1) {
		rex_register_extension('ART_UPDATED', 'rex_cat_art_name_sync::syncArtname2Catname');
	}
}
