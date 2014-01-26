<?php
class rex_frontend_link {
	static function addFrontendLinkByOutputFilterEP($params) {
		$content = $params['subject'];

		$posBeginUL = strpos($content, 'rex_logout');
		
		if ($posBeginUL === false) {
			return $content;
		} else {
			$posEndUL = strpos($content, '</ul>', $posBeginUL);	
			$content = substr($content, 0, $posEndUL) . self::getMetaMenuListItem() . substr($content, $posEndUL);
			
			return $content;
		}
	}

	static function addFrontendLinkByMetaNaviEP($params) {
		$params['subject']['frontend_link'] = self::getMetaMenuListItem();

		return $params['subject'];
	}

	static function getMetaMenuListItem() {
		global $REX, $I18N;

		$sanitizedUrl = self::getFrontendUrl();

		// link text
		switch ($REX['ADDON']['frontend_link']['metamenu_link']) {
			case 'default': 
				$linkText = $I18N->msg('frontend_link_metamenu_link_default');
				break;
			case 'rex_server':
				$linkText = $sanitizedUrl;
				break;
			case 'userdef':
				$linkText = $REX['ADDON']['frontend_link']['metamenu_link_text'];
				break;
		}

		return '<li><a id="frontend-link" href="http://' . $sanitizedUrl . '" target="_blank">' . $linkText . '</a></li>';
	}

	static function addToOutputFilter($params)	{
		global $REX;

		$params['subject'] = str_replace('<div id="rex-website">', '<div id="rex-website"><h1 class="be-utilities-frontend_link-title"><a href="http://' . self::getFrontendUrl() . '" onclick="window.open(this.href); return false">' . $REX['SERVERNAME'] . '</a></h1>', $params['subject']);

		return $params['subject'];
	}

	static function addToPageHeader($params)	{
		$insert = '<!-- BEGIN frontend_link -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/frontend_link/frontend_link.css" />' . PHP_EOL;
		$insert .= '<!-- END frontend_link -->' . PHP_EOL;

		return $params['subject'] . PHP_EOL . $insert;
	}

	static function getFrontendUrl() {
		global $REX;

		return self::sanitizeUrl($REX['SERVER']);
	}

	static function sanitizeUrl($url) {
		return preg_replace('@^https?://|/.*|[^\w.-]@', '', $url);
	}

	static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}
}
