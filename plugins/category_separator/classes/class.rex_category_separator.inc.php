<?php

class rex_category_separator {
	static function appendToBody($params) {
		global $REX;

		$catId = $REX['ADDON']['category_separator']['hide_cat_id'];

		$script = '
			<!-- category_separator -->
			<script type="text/javascript">
			jQuery(function($) {
				var $tableOne = $("a[href^=\'index.php?page=structure&category_id=' . $catId . '\']").parents("table").attr("id", "newTable1");
				var $tableTwo = $tableOne.clone().attr("id","newTable2").insertAfter("#newTable1");

				$tableOne.find("tr:gt(' . $catId . ')").remove();
				$tableTwo.find("tr:lt(' . ($catId + 1) . ')").remove();
			});
			</script>
			<!-- end category_separator -->
		';
		
		return str_replace('</body>', $script . '</body>', $params['subject']);
	}
}
