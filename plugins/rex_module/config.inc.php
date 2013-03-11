<?php
if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/rex_module/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'rex_module', 'Rex Module', $I18N->msg('rex_module_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/rex_module/settings.inc.php');

	// include template
	if (!$REX['SETUP'] && $REX['ADDON']['rex_module']['include_template_id'] > 0) {
		rex_register_extension('ADDONS_INCLUDED','includeGlobalTemplate');

		function includeGlobalTemplate() { 
			global $REX;
			
			$sql = rex_sql::factory();
			$qry = 'SELECT content FROM '. $REX['TABLE_PREFIX']  .'template WHERE id = ' . $REX['ADDON']['rex_module']['include_template_id'] . '';
			$sql->setQuery($qry);

			if ($sql->getRows() == 1) {
				eval('?>' . $sql->getValue('content'));
			}
		}
	}

	// include css
	$insert = PHP_EOL;
	$insert .= '<!-- BEGIN rex_module -->' . PHP_EOL;
	$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/plugins/rex_module/rex_module.css" />' . PHP_EOL;
	$insert .= '<!-- END rex_module -->';
	
	rex_register_extension('PAGE_HEADER', create_function('$params', 'return $params[\'subject\'] . \''. $insert . '\';'));
}
