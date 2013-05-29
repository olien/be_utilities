<?php

class rex_codemirror_utils {
	public static function addToOutputFilter($params) {
		global $REX;
	
		// head stuff
		$code = "\n" . '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/vendor/codemirror.css" media="screen" />';
		$params['subject'] = str_replace('</head>', $code . '</head>', $params['subject']);

		// body stuff
		$code = "\n" . '<script type="text/javascript">var codemirror_defaulttheme="' . $REX['ADDON']['codemirror']['theme'] . '";</script>';
		$code .= "\n" . '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/rex-init.js"></script>';
		$params['subject'] = str_replace('</body>', $code . '</body>', $params['subject']);

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
