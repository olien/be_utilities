<?php

class rex_hide_startarticle {
	static function appendToBody($params) {
		global $REX;

		$script = '
			<!-- hide_startarticle -->
			<script type="text/javascript">
			jQuery(function($) {
				$("a.rex-i-article-startpage").parents("tr").css("display", "none");
				$("li.rex-linkmap-startpage").css("display", "none");
			});
			</script>
			<!-- end hide_startarticle -->
		';
		
		return str_replace('</body>', $script . '</body>', $params['subject']);
	}
}
