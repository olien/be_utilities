<?php
$page = 'be_extensions';
$subpage = rex_request('subpage', 'string', '');

// layout top
include($REX['INCLUDE_PATH'] . '/layout/top.php');

// title and menu
rex_title($I18N->msg('be_extensions') . ' <span style="font-size:14px; color:silver;">' . $REX['ADDON']['version'][$page] . '</span>', $REX['ADDON'][$page]['SUBPAGES']);

if ($subpage != '') {
	// include plugin page
	$pluginName = str_replace('plugin.', '', $subpage);
	include($REX['INCLUDE_PATH'] . '/addons/' . $page . '/plugins/' . $pluginName . '/pages/index.inc.php');
} else {
	// show plugin list
	echo '<table class="rex-table">';
	echo '<tr><th>' . $I18N->msg('be_extensions_overview') . '</th></tr>';

	// make extension overview list
	foreach ($REX['extension_manager']->getExtensions() as $extension) {
		$htmlDescription = '';

		if ($extension->getDescription() != '') {
			$htmlDescription = '<p>&nbsp;&nbsp;&nbsp;' . $extension->getDescription() . '</p>';
		}

		echo '<tr><td>&raquo; ';

		if ($extension->hasBackendPage() == true) {
			echo '<a href="index.php?page=' . $page . '&amp;subpage=plugin.' . $extension->getName() . '">' . $extension->getTitle() . '</a>' . $htmlDescription;
		} else {
			echo '<span>' . $extension->getTitle() . '</span>' . $htmlDescription;
		}

		echo '</td></tr>';
	}
	
	echo '</table>';
}

// layout bottom
include($REX['INCLUDE_PATH'] . '/layout/bottom.php');
?>

<style type="text/css">
table.rex-table th {
	font-size: 1.2em;
}

table.rex-table td p {
	margin-top: 8px;
	color: grey;
}

table.rex-table td a,
table.rex-table td span {
	font-weight: bold;
}
</style>
