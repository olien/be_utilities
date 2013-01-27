<?php
class rex_be_extensions {
	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN be_extensions -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_extensions/be_extensions.css" />' . PHP_EOL;
		$insert .= '<!-- END be_extensions -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}
}
?>
