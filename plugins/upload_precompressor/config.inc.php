<?php
/**
 * decaf_upload_precompressor
 *
 * @author DECAF
 * @version $Id$
 */

if ($REX['REDAXO']) {
	$mypage = 'upload_precompressor';

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/upload_precompressor/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON'][$mypage]['settings'] = array(
		'max_pixel' => 1200,
		'jpg_quality' => 90
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile($mypage);

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'upload_precompressor', 'Upload Precompressor', $I18N->msg('upload_precompressor_description'), '1.2.0', 'DECAF, RexDude', 'forum.redaxo.de', true);

	// includes
	require_once($REX['INCLUDE_PATH']."/addons/be_utilities/plugins/".$mypage."/extensions/extension.".$mypage.".inc.php");
}
