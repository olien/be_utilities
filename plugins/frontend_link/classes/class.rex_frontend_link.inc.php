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
		switch ($REX['ADDON']['frontend_link']['link_text_mode']) {
			case 'default': 
				$linkText = $I18N->msg('frontend_link_goto_website');
				break;
			case 'rex_server':
				$linkText = $sanitizedUrl;
				break;
			case 'userdef':
				$linkText = $REX['ADDON']['frontend_link']['link_text'];
				break;
		}

		return '<li><a id="frontend-link" href="http://' . $sanitizedUrl . '" target="_blank">' . $linkText . '</a></li>';
	}

	static function getFrontendUrl() {
		global $REX;

		return self::sanitizeUrl($REX['SERVER']);
	}

	static function sanitizeUrl($url) {
		return preg_replace('@^https?://|/.*|[^\w.-]@', '', $url);
	}
}
