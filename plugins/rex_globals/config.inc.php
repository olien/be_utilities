<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/rex_globals/lang/');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['rex_globals']['settings'] = array(
		'include_template_id' => 0
	);

	// overwrite default settings with user settings
	rex_backend_utilities::includeSettingsFile('rex_globals');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'rex_globals', 'Rex Globals', $I18N->msg('rex_globals_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// include template
	if (!$REX['SETUP'] && $REX['ADDON']['rex_globals']['settings']['include_template_id'] > 0) {
		rex_register_extension('ADDONS_INCLUDED','includeGlobalTemplate');

		function includeGlobalTemplate() { 
			global $REX;
			
			$sql = rex_sql::factory();
			$qry = 'SELECT content FROM '. $REX['TABLE_PREFIX']  .'template WHERE id = ' . $REX['ADDON']['rex_globals']['settings']['include_template_id'] . '';
			$sql->setQuery($qry);

			if ($sql->getRows() == 1) {
				eval('?>' . $sql->getValue('content'));
			}
		}
	}

	// check for media addon dir var introduced in REX 4.5
	if (isset($REX['MEDIA_ADDON_DIR'])) {
		$mediaAddonDir = $REX['MEDIA_ADDON_DIR'];
	} else {
		$mediaAddonDir = 'files/addons';
	}

	// include css
	$insert = PHP_EOL;
	$insert .= '<!-- BEGIN rex_globals -->' . PHP_EOL;
	$insert .= '<link rel="stylesheet" type="text/css" href="../' . $mediaAddonDir . '/be_utilities/plugins/rex_globals/rex_globals.css" />' . PHP_EOL;
	$insert .= '<!-- END rex_globals -->';
	
	rex_register_extension('PAGE_HEADER', create_function('$params', 'return $params[\'subject\'] . \''. $insert . '\';'));
}
