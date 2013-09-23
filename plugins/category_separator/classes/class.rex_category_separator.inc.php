<?php

class rex_category_separator {
	static function splitTable($params) {
		global $REX;

		$linkPos = strpos($params['subject'], 'index.php?page=structure&amp;category_id=' . $REX['ADDON']['category_separator']['hide_cat_id'] . '&amp;clang=0');
		$trPos = strrpos(substr($params['subject'], 0, $linkPos), '<tr>');
	
		$startCode = substr($params['subject'], 0, $trPos);
		$endCode = substr($params['subject'], $trPos, strlen($params['subject']));

		$inBetweenCode = '</tbody>
							</table>
							<table class="rex-table rex-table-mrgn">
							<colgroup>
								<col width="40">';

		if (strpos($params['subject'], '<th class="rex-small">ID</th>') !== false) {
			$inBetweenCode .= '	<col width="40">';
		}

		$inBetweenCode .= '		<col width="*">
								<col width="40">
								<col width="51">
								<col width="50">
								<col width="50">
							</colgroup>
							<tbody>';
		
		return $startCode . $inBetweenCode . $endCode;
	}
}
