<?php
class rex_frontend_link {
	static function addFrontendLink($params) {
		global $REX;
		global $I18N;

		$content = $params['subject'];

		switch ($REX['ADDON']['frontend_link']['link_text_mode']) {
			case 'default': 
				$linkText = $I18N->msg('frontend_link_goto_website');
				break;
			case 'rex_server':
				$linkText = self::getFrontendUrl();
				break;
			case 'userdef':
				$linkText = $REX['ADDON']['frontend_link']['link_text'];
				break;
		}

		$posBeginList = strpos($content, 'rex_logout');
		$posEndList = strpos($content, '</ul>', $posBeginList);

		$content = substr($content, 0, $posEndList) . '<li><a href="' . $REX['SERVER'] . '" target="_blank">' . $linkText . '</a></li>' . substr($content, $posEndList);

		return $content;
	}

	static function getFrontendUrl() {
		global $REX;

		$frontendUrl = ltrim($REX['SERVER'], 'http://');
		$frontendUrl = rtrim($frontendUrl, '/');

		return $frontendUrl;
	}
}
