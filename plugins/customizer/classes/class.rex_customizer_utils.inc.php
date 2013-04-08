<?php
class rex_customizer_utils {
	public static function addToPageHeader($params) {
		global $REX;

		$color = htmlspecialchars($REX['ADDON']['customizer']['labelcolor']);

		$insert = '<!-- BEGIN customizer -->' . PHP_EOL;

		// color bar
		if ($color != '') { 
			$insert .= '<style>#rex-navi-logout { border-bottom: 10px solid ' . $color . '; }</style>' . PHP_EOL;
		}

		// colorized favicon
		if ($REX['ADDON']['customizer']['colorize_favicon'] && $color != '') { 
			$insert .= '<link rel="shortcut icon" href="../' . $REX['MEDIA_ADDON_DIR'] . '/be_utilities/plugins/customizer/' . self::getColorizedFavIconName($color) . '" />' . PHP_EOL;
		}

		// css file
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/customizer/customizer.css" media="screen" />' . PHP_EOL;

		// colorpicker only for plugin page
		if (rex_request('page') == 'be_utilities' && rex_request('subpage') == 'plugin.customizer') {
			$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/customizer/colorpicker/colorpicker.css" />' . PHP_EOL;
			$insert .= '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/customizer/colorpicker/colorpicker.js"></script>' . PHP_EOL;
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

	public static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}

	public static function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}

	public static function rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)
	}

	public static function makeFavIcon($hexColor, $path) {
		$rgbColor = rex_customizer_utils::hex2rgb($hexColor);
		$favIconOriginal = $path . 'favicon.png';
		$favIconNew = $path . self::getColorizedFavIconName($hexColor);

		$im = imagecreatefrompng($favIconOriginal);
		imagealphablending($im, false);

		imagesavealpha($im, true);

		if ($im && imagefilter($im, IMG_FILTER_COLORIZE, $rgbColor[0], $rgbColor[1], $rgbColor[2], 0)) {
			imagepng($im, $favIconNew);
			imagedestroy($im);
		}
	}

	public static function getColorizedFavIconName($hexColor) {
		return 'favicon_' . ltrim($hexColor, '#') . '.png';
	}
}
