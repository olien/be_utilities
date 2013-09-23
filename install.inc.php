<?php
// append lang file
$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/lang/');

if (OOPlugin::isAvailable('be_style', 'customizer')) {
	$REX['ADDON']['installmsg']['be_utilities'] = $I18N->msg('be_utilities_uninstall_customizer'); 
} else {
	$REX['ADDON']['install']['be_utilities'] = 1;
}

