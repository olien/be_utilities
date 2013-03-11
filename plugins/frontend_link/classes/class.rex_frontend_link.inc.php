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
			if ($REX['ADDON']['frontend_link']['colorize_link'] == '1') {
				$style = ' style="color: ' . $REX['ADDON']['frontend_link']['color'] . ';"';
			} else {
				$style = '';
			}
			$posEndUL = strpos($content, '</ul>', $posBeginUL);	
			$content = substr($content, 0, $posEndUL) . '<li><a id="frontend-link"' . $style . ' href="' . $REX['SERVER'] . '" target="_blank">' . $linkText . '</a></li>' . substr($content, $posEndUL);
			
			return $content;
		}
	}

	static function getFrontendUrl() {
		global $REX;

		$frontendUrl = ltrim($REX['SERVER'], 'http://');
		$frontendUrl = rtrim($frontendUrl, '/');

		return $frontendUrl;
	}

	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN frontend_link -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/plugins/frontend_link/colorpicker.css" />' . PHP_EOL;
		$insert .= '<script type="text/javascript" src="../files/addons/be_utilities/plugins/frontend_link/colorpicker.js"></script>' . PHP_EOL;
		$insert .= '<!-- END frontend_link -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}
}
