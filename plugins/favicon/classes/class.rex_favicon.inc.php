<?php
class rex_favicon {
	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN favicon -->' . PHP_EOL;
		$insert .= '<link rel="shortcut icon" href="../files/addons/be_extensions/plugins/favicon/favicon.ico" />' . PHP_EOL;
		$insert .= '<!-- END favicon -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}
}
?>
