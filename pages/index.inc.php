<?php
$addon = 'be_utilities';
$subpage = rex_request('subpage', 'string', '');
$plugin = str_replace('plugin.', '', $subpage);

// layout top
include($REX['INCLUDE_PATH'] . '/layout/top.php');

// title and menu
rex_title($REX['ADDON']['name']['be_utilities'] . ' <span class="version">' . $REX['ADDON']['version'][$addon] . '</span>', $REX['ADDON'][$addon]['SUBPAGES']);

if ($subpage != '') {
	// plugin headline
	echo '<h2 class="main plugin">' . rex_plugin_factory::getPluginTitle('be_utilities', $plugin) . '</h2>';

	// include plugin page
	include($REX['INCLUDE_PATH'] . '/addons/' . $addon . '/plugins/' . $plugin . '/pages/index.inc.php');
} else {
	// show plugin list
	rex_plugin_factory::printPluginList($addon, $I18N->msg('be_utilities_available_plugins'), $I18N->msg('be_utilities_no_plugins_installed'));
}

// layout bottom
include($REX['INCLUDE_PATH'] . '/layout/bottom.php');
?>
