<?php
class rex_backend_utilities {
	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN be_utilities -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/be_utilities.css" />' . PHP_EOL;
		$insert .= '<!-- END be_utilities -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}
}
?>
