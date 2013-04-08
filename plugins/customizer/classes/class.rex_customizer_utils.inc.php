<?php
class rex_customizer_utils {
	public static function addToPageHeader($params) {
		global $REX;

		$insert = '<!-- BEGIN customizer -->' . PHP_EOL;

		// css file
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/customizer/customizer.css" media="screen" />';

		// color bar
		if ($REX['ADDON']['customizer']['labelcolor'] != '') { 
			$insert .= '<style>#rex-navi-logout { border-bottom: 10px solid ' . htmlspecialchars($REX['ADDON']['customizer']['labelcolor']) . '; }</style>' . PHP_EOL;
		}

		$insert .= '<!-- END customizer -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}

	public static function addToOutputFilter($params)	{
		global $REX;

		$server = $REX['SERVER'];

		if (substr($REX['SERVER'], 0, 4) != 'http') {
			$server = 'http://' . $REX['SERVER'];
		}

		$class = (strlen($REX['SERVERNAME']) > 50) ? ' be-utilities-customizer-small' : '';
		$params['subject'] = str_replace('<div id="rex-extra">', '<div id="rex-extra"><h1 class="be-utilities-customizer-title' . $class . '"><a href="' . $server . '" onclick="window.open(this.href); return false">' . $REX['SERVERNAME'] . '</a></h1>', $params['subject']);

		return $params['subject'];
	}

	public static function addToPageBodyAttribute($params) {
		global $REX;

		if ($REX['ADDON']['customizer']['textarea']) {
			$params['subject']['class'][] = 'be-utilities-customizer-textarea-big';
		}

		if ($REX['ADDON']['customizer']['liquid']) {
			$params['subject']['class'][] = 'rex-layout-liquid';
		}

		return $params['subject'];
	}

	protected static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}
}
