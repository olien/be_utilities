<?php
$addon = 'be_extensions';
$subpage = rex_request('subpage', 'string', '');

// layout top
include($REX['INCLUDE_PATH'] . '/layout/top.php');

// title and menu
rex_title($I18N->msg('be_extensions') . ' <span style="font-size:14px; color:silver;">' . $REX['ADDON']['version'][$addon] . '</span>', $REX['ADDON'][$addon]['SUBPAGES']);

if ($subpage != '') {
	// include plugin page
	$plugin = str_replace('plugin.', '', $subpage);
	include($REX['INCLUDE_PATH'] . '/addons/' . $addon . '/plugins/' . $plugin . '/pages/index.inc.php');
} else {
	// show plugin list
	rex_plugin_factory::printPluginList($addon, $I18N->msg('be_extensions_overview'));
}

// layout bottom
include($REX['INCLUDE_PATH'] . '/layout/bottom.php');
?>

<style type="text/css">
table.rex-table th {
	font-size: 1.2em;
}

table.rex-table td p {
	margin-top: 6px;
	color: grey;
}

table.rex-table td a,
table.rex-table td span {
	font-weight: bold;
}

div#rex-navi-page ul {
    line-height: 1.7;
	padding-top: 9px;
	padding-bottom: 8px;
	overflow: hidden;
}

div#rex-navi-page ul li {
	display: inline-block;
    float: left;
}

div#rex-navi-page ul li a {
    white-space: nowrap;
}
</style>
