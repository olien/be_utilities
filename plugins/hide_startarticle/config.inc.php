<?php

if ($REX['REDAXO'] && !$REX['SETUP']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/hide_startarticle/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', 'hide_startarticle', 'Hide Startarticle', $I18N->msg('hide_startarticle_description'), '1.0.0', 'RexDude', 'forum.redaxo.de', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/hide_startarticle/classes/class.rex_hide_startarticle.inc.php');

	// check if there is a startarticle to hide
	$sqlStatement = 'SELECT article_id FROM ' . $REX['TABLE_PREFIX'] . 'hidden_startarticles';

	$sql = rex_sql::factory();
	$sql->setQuery($sqlStatement);

	$currentPage = rex_request('page', 'string');

	if ($currentPage == 'structure' || $currentPage == 'linkmap') {
		for ($i = 0; $i < $sql->getRows(); $i++) {
			if (rex_request('category_id', 'int') == $sql->getValue('article_id')) {
				// hide this stararticle
				rex_register_extension('OUTPUT_FILTER', 'rex_hide_startarticle::hideStartArticle');
				break;
			}

			$sql->next();
		}
	}
}


