<?php

/**
 * REDAXO customizer
 *
 * Marijn Haverbeke <marijnh@gmail.com>
 * @package redaxo4
 * @version svn:$Id$
 */

if ($REX['REDAXO']) {
	$mypage = 'customizer';

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/customizer/lang/');

	// register plugin
	rex_plugin_factory::registerPlugin('be_utilities', $mypage, 'Customizer', $I18N->msg('customizer_description'), '1.3.1', 'Jan Kristinus', 'www.redaxo.org/de/forum', true);

	// includes
	include($REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/customizer/settings.inc.php');

  function rex_be_utilities_customizer_css_add($params)
  {
    global $REX;

	// check for media addon dir var introduced in REX 4.5
	if (isset($REX['MEDIA_ADDON_DIR'])) {
		$mediaAddonDir = $REX['MEDIA_ADDON_DIR'];
	} else {
		$mediaAddonDir = 'files/addons';
	}

    $add = "\n" . '<link rel="stylesheet" type="text/css" href="../' . $mediaAddonDir . '/be_utilities/plugins/customizer/customizer.css" media="screen" />';
    
    if ($REX['ADDON']['customizer']['labelcolor'] != '') {
      $add .= "\n" . '<style>#rex-navi-logout {  border-bottom: 10px solid ' . htmlspecialchars($REX['ADDON']['customizer']['labelcolor']) . '; }</style>';
    }
    return str_replace('</body>', $add . '</body>', $params['subject']);
  }
  rex_register_extension('OUTPUT_FILTER', 'rex_be_utilities_customizer_css_add');


  function rex_be_utilities_customizer_extra($params)
  {
    global $REX;
    $server = $REX['SERVER'];
    if (substr($REX['SERVER'], 0, 4) != 'http') {
      $server = 'http://' . $REX['SERVER'];
    }
    $class = (strlen($REX['SERVERNAME']) > 50) ? ' be-style-customizer-small' : '';
    $params['subject'] = str_replace('<div id="rex-extra">',
      '<div id="rex-extra"><h1 class="be-style-customizer-title' . $class . '"><a href="' . $server . '" onclick="window.open(this.href); return false">' . $REX['SERVERNAME'] . '</a></h1>',
      $params['subject']);
    return $params['subject'];
  }
  if ($REX['ADDON']['customizer']['showlink']) {
    rex_register_extension('OUTPUT_FILTER', 'rex_be_utilities_customizer_extra');
  }


  function rex_be_utilities_customizer_body($params)
  {
    global $REX;
    if ($REX['ADDON']['customizer']['textarea'])
      $params['subject']['class'][] = 'be-style-customizer-textarea-big';
    if ($REX['ADDON']['customizer']['liquid'])
      $params['subject']['class'][] = 'rex-layout-liquid';
    return $params['subject'];
  }
  if ($REX['ADDON']['customizer']['textarea'] || $REX['ADDON']['customizer']['liquid']) {
    rex_register_extension('PAGE_BODY_ATTR', 'rex_be_utilities_customizer_body');
  }

}
