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

		$posBeginUL = strpos($content, 'rex_logout');
		
		if ($posBeginUL === false) {
			return $content;
		} else {
			$posEndUL = strpos($content, '</ul>', $posBeginUL);	
			$content = substr($content, 0, $posEndUL) . '<li><a href="' . $REX['SERVER'] . '" target="_blank">' . $linkText . '</a></li>' . substr($content, $posEndUL);
			
			return $content;
		}
	}

	static function getFrontendUrl() {
		global $REX;

		$frontendUrl = ltrim($REX['SERVER'], 'http://');
		$frontendUrl = rtrim($frontendUrl, '/');

		return $frontendUrl;
	}
}
