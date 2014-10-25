<?php
class rex_colorizer_utils {
	public static function addToPageHeader($params) {
		global $REX;

		$insert = '<!-- BEGIN colorizer -->' . PHP_EOL;

		// color bar
		if ($REX['ADDON']['colorizer']['settings']['labelcolor'] != '') { 
			$insert .= '<style>#rex-navi-logout { border-bottom: 10px solid ' . $REX['ADDON']['colorizer']['settings']['labelcolor'] . '; }</style>' . PHP_EOL;
		}

		// colorpicker only for plugin page
		if (rex_request('page') == 'be_utilities' && rex_request('subpage') == 'plugin.colorizer') {
			$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/colorizer/colorpicker/colorpicker.css" />' . PHP_EOL;
			$insert .= '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/colorizer/colorpicker/colorpicker.js"></script>' . PHP_EOL;
		}

		$insert .= '<!-- END colorizer -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}

	public static function addToOutputFilter($params)	{
		global $REX;

		// the colorized favicon
		$replace = '<link rel="shortcut icon" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/colorizer/' . self::getColorizedFavIconName($REX['ADDON']['colorizer']['settings']['labelcolor']) . '" />' . PHP_EOL;

		$params['subject']  = str_replace('<link rel="shortcut icon" href="media/favicon.ico" />', $replace, $params['subject']);
		
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
		$rgbColor = rex_colorizer_utils::hex2rgb($hexColor);
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
		return 'favicon-' . ltrim($hexColor, '#') . '.png';
	}
}
