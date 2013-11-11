<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/agk_skin_plus/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'agk_skin_plus', 'AgkSkin Plus', $I18N->msg('agk_skin_plus_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/agk_skin_plus/settings.inc.php');
	
	// liquid layout
	if ($REX['ADDON']['agk_skin_plus']['liquid_layout'] == 1) {
		rex_register_extension('PAGE_BODY_ATTR', function($params) {
			$params['subject']['class'][] = 'rex-layout-liquid';
			$params['subject']['class'][] = 'be-style-customizer-textarea-big';

			return $params['subject'];
		});
	}

	// add css
	rex_register_extension('PAGE_HEADER', function($params) {
		global $REX;
		
		$params["subject"] .= "\n" . '  <link rel="stylesheet" type="text/css" href="../' . $REX['MEDIA_ADDON_DIR'] . '/be_utilities/plugins/agk_skin_plus/agk_skin_plus.css" media="screen, projection, print" />';
		
		return $params["subject"];
	});
}
