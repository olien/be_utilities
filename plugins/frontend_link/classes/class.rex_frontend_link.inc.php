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

	public static function addToOutputFilter($params)	{
		global $REX;

		$class = (strlen($REX['SERVERNAME']) > 50) ? ' be-utilities-colorizer-small' : '';
		$params['subject'] = str_replace('<div id="rex-extra">', '<div id="rex-extra"><h1 class="be-utilities-colorizer-title' . $class . '"><a href="http://' . self::getFrontendUrl() . '" onclick="window.open(this.href); return false">' . $REX['SERVERNAME'] . '</a></h1>', $params['subject']);

		return $params['subject'];
	}

	static function getFrontendUrl() {
		global $REX;

		return self::sanitizeUrl($REX['SERVER']);
	}

	static function sanitizeUrl($url) {
		return preg_replace('@^https?://|/.*|[^\w.-]@', '', $url);
	}
}
