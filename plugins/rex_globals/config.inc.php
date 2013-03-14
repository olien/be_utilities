<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/rex_globals/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'rex_globals', 'Rex Globals', $I18N->msg('rex_globals_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/rex_globals/settings.inc.php');

	// include template
	if (!$REX['SETUP'] && $REX['ADDON']['rex_globals']['include_template_id'] > 0) {
		rex_register_extension('ADDONS_INCLUDED','includeGlobalTemplate');

		function includeGlobalTemplate() { 
			global $REX;
			
			$sql = rex_sql::factory();
			$qry = 'SELECT content FROM '. $REX['TABLE_PREFIX']  .'template WHERE id = ' . $REX['ADDON']['rex_globals']['include_template_id'] . '';
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
	$insert .= '<link rel="stylesheet" type="text/css" href="../' . $mediaAddonDir . '/be_utilities/plugins/rex_globals/rex_module.css" />' . PHP_EOL;
	$insert .= '<!-- END rex_globals -->';
	
	rex_register_extension('PAGE_HEADER', create_function('$params', 'return $params[\'subject\'] . \''. $insert . '\';'));
}
