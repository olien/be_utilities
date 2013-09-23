<?php
if(isset($ADDONSsic) && $ADDONSsic['status']['website_manager']) { // workaround for OOAdon::isAvailable() for plugins
	$REX['ADDON']['installmsg']['colorizer'] = $I18N->msg('be_utilities_uninstall_website_manager'); 
} else {
  $REX['ADDON']['install']['colorizer'] = true;
}
