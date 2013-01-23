<?php

/**
 * jQuery UI Plugin
 * 
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 *
 * @package redaxo4
 * @version svn:$Id$
 */

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/jquery_ui/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_extensions', 'jquery_ui', 'jQuery UI', $I18N->msg('jquery_ui_description'), '1.3.0', 'Joachim Doerr', 'forum.redaxo.de', false);

	//	include jquery ui
	$arrJQueryUi['path'] = '../files/addons/be_extensions/plugins/jquery_ui';
	unset($arrJQueryUi['insert']);

	$arrJQueryUi['insert'] = <<<EOD

	<!-- jQuery UI start -->
	<link rel="stylesheet" type="text/css" href="{$arrJQueryUi['path']}/aristo/aristo.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="{$arrJQueryUi['path']}/aristo/aristo_redaxo.css" media="screen" />
	<script src="{$arrJQueryUi['path']}/jquery.cookie.js" type="text/javascript"></script>
	<script src="{$arrJQueryUi['path']}/jquery-ui.min.js" type="text/javascript"></script>
	<!-- jQuery UI end -->

EOD;
	
	rex_register_extension('PAGE_HEADER', create_function('$params', 'return $params[\'subject\'].\''. $arrJQueryUi['insert'] .'\';'));
}
