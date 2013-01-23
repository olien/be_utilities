<?php

if ($REX['REDAXO']) {

// --- DYN
$REX['ADDON']['rex_module']['include_template_id'] = 4;
$REX['ADDON']['rex_module']['pre_include_file'][0] = "";
$REX['ADDON']['rex_module']['pre_include_file'][1] = "";
$REX['ADDON']['rex_module']['pre_include_file'][2] = "";
// --- /DYN

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/rex_module/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_extensions', 'rex_module', 'Rex Module', $I18N->msg('rex_module_description'), '1.0.0', 'WebDevOne', 'forum.redaxo.de', true);

	// include php files 
	for ($i = 0; $i < count($REX['ADDON']['rex_module']['pre_include_file']); $i++) {
		if ($REX['ADDON']['rex_module']['pre_include_file'][$i] != '') {
			require_once($REX['INCLUDE_PATH'] . $REX['ADDON']['rex_module']['pre_include_file'][$i]);
		}
	}

	// include template
	if ($REX['ADDON']['rex_module']['include_template_id'] > 0) {
		$sql = rex_sql::factory();
		$qry = 'SELECT content FROM '. $REX['TABLE_PREFIX']  .'template WHERE id = ' . $REX['ADDON']['rex_module']['include_template_id'] . '';
		$sql->setQuery($qry);

		if ($sql->getRows() == 1) {
			eval('?>' . $sql->getValue('content'));
		}
	}

	// include css
	$insert = PHP_EOL;
	$insert .= '<!-- BEGIN rex_module -->' . PHP_EOL;
	$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_extensions/plugins/rex_module/rex_module.css" />' . PHP_EOL;
	$insert .= '<!-- END rex_module -->';
	
	rex_register_extension('PAGE_HEADER', create_function('$params', 'return $params[\'subject\'] . \''. $insert . '\';'));
}
