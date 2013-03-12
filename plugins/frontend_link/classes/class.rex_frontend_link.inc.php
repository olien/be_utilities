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

		// link text
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

		// link style
		if ($REX['ADDON']['frontend_link']['colorize_link'] == '1') {
			$linkStyle = ' style="color: ' . $REX['ADDON']['frontend_link']['color'] . ';"';
		} else {
			$linkStyle = '';
		}

		// frontend link
		$server = $REX['SERVER'];
		if (substr($REX['SERVER'], 0, 4) != 'http') {
			$server = 'http://' . $REX['SERVER'];
		}

		return '<li><a id="frontend-link"' . $linkStyle . ' href="' . $server . '" target="_blank">' . $linkText . '</a></li>';
	}

	static function getFrontendUrl() {
		global $REX;

		$frontendUrl = ltrim($REX['SERVER'], 'http://');
		$frontendUrl = rtrim($frontendUrl, '/');

		return $frontendUrl;
	}

	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN frontend_link -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/be_utilities/plugins/frontend_link/colorpicker.css" />' . PHP_EOL;
		$insert .= '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/be_utilities/plugins/frontend_link/colorpicker.js"></script>' . PHP_EOL;
		$insert .= '<!-- END frontend_link -->';
	
		return $params['subject'] . PHP_EOL . $insert;
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
