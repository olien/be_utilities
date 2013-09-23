<?php

class rex_hide_startarticle {
	static function hideStartArticle($params) {
		global $REX;

		$insert = '
			<!-- hide_startarticle -->
			<style type="text/css">
				.rex-table:not(.rex-table-mrgn) tbody tr:first-child { display: none; }
				li.rex-linkmap-startpage { display: none; }
			</style>
			<!-- hide_startarticle -->
		';
		
		return $params['subject'] . PHP_EOL . $insert;
	}
}
