<?php
$addon = 'be_utilities';
$subpage = rex_request('subpage', 'string', '');

// layout top
include($REX['INCLUDE_PATH'] . '/layout/top.php');

// title and menu
rex_title($I18N->msg('be_utilities') . ' <span class="version">' . $REX['ADDON']['version'][$addon] . '</span>', $REX['ADDON'][$addon]['SUBPAGES']);

if ($subpage != '') {
	// include plugin page
	$plugin = str_replace('plugin.', '', $subpage);
	include($REX['INCLUDE_PATH'] . '/addons/' . $addon . '/plugins/' . $plugin . '/pages/index.inc.php');
} else {
	// show plugin list
	rex_plugin_factory::printPluginList($addon, $I18N->msg('be_utilities_overview'));
}

// layout bottom
include($REX['INCLUDE_PATH'] . '/layout/bottom.php');
?>
