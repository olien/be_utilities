<?php

class rex_articlename_sync {
	static function syncArtname2Catname($params) {
		global $REX, $I18N;

		$id = $params['id'];
		$clang = $params['clang'];
		$name = '';

		if (isset($params['data']['name']) && $params['data']['name'] != '') {
			// ART_UPDATED
			$name = $params['data']['name'];
		} else {
			// ART_META_UPDATED
			$name = $params['name'];
		}

		if ($name != '') {
			$sql = new rex_sql();
			$sql->setTable($REX['TABLE_PREFIX'] . 'article');
			$sql->setWhere("(id=$id OR (re_id=$id AND startpage=0)) AND clang=$clang");
			$sql->setValue('catname', $name);
			$sql->addGlobalUpdateFields();
			$sql->update();

			rex_deleteCacheArticle($id, $clang);
		}
	}

	static function syncCatname2Artname($params) {
		global $REX, $I18N;

		$id = $params['id'];
		$clang = $params['clang'];
		$name = $params['data']['catname'];

		if ($name != '') {
			$sql = new rex_sql();
			$sql->setTable($REX['TABLE_PREFIX'].'article');
			$sql->setWhere('id=' . $id . ' AND clang=' . $clang);
			$sql->setValue('name', $name);
			$sql->addGlobalUpdateFields();
			$sql->update();

			rex_deleteCacheArticle($id, $clang);
		}
	}
}
