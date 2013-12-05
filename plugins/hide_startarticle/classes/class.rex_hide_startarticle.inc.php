<?php

class rex_hide_startarticle {
	static function hideStartArticle($params) {
		global $REX;

		$params['subject'] = str_replace('<tr>
              <td class="rex-icon"><a class="rex-i-element rex-i-article-startpage"', '<tr id="rex-structure-startpage">
              <td class="rex-icon"><a class="rex-i-element rex-i-article-startpage"', $params['subject']);

		$insert = '
			<!-- hide_startarticle -->
			<style type="text/css">
				tr#rex-structure-startpage { display: none; }
				li.rex-linkmap-startpage { display: none; }
			</style>
			<!-- hide_startarticle -->
		';

		$params['subject'] = str_replace('</head>', $insert . '</head>', $params['subject']);
		
		return $params['subject'];
	}
}
