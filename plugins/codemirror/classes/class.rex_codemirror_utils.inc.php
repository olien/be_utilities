<?php

class rex_codemirror_utils {
	public static function addToOutputFilter($params) {
		global $REX, $I18N;
	
		// head stuff
		$code = "\n" . '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/redaxo.css" media="screen" />';
		$code .= "\n" . '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/vendor/codemirror.css" media="screen" />';
		$code .= "\n" . '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/vendor/theme/' . $REX['ADDON']['codemirror']['settings']['theme'] . '.css" media="screen" />';

		$params['subject'] = str_replace('</head>', $code . '</head>', $params['subject']);

		// body stuff
		$code = "\n" . '<script type="text/javascript">
			var cmSettings = new Array;
			cmSettings["theme"] = "' . $REX['ADDON']['codemirror']['settings']['theme'] . '";
		</script>';

		$code .= "\n" . '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/vendor/codemirror.minimum.min.js"></script>';
		$code .= "\n" . '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/codemirror/redaxo.js"></script>';

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
