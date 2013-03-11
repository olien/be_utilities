<?php

class rex_articlename_sync {
	static function syncArtname2Catname($params) {
		global $REX, $I18N;

		$id = $params['id'];
		$clang = $params['clang'];
		$sql = new rex_sql();

		$sql->setTable($REX['TABLE_PREFIX'] . 'article');
		$sql->setWhere("(id=$id OR (re_id=$id AND startpage=0)) AND clang=$clang");
		$sql->setValue('catname', $params['data']['name']);
		$sql->addGlobalUpdateFields();
		$sql->update();

		rex_deleteCacheArticle($id, $clang);

		echo rex_info($I18N->msg('articlename_sync_cat_art_msg'));
	}

	static function syncCatname2Artname($params) {
		global $REX, $I18N;

		$id = $params['id'];
		$clang = $params['clang'];
		$sql = new rex_sql();

		$sql->setTable($REX['TABLE_PREFIX'].'article');
		$sql->setWhere('id=' . $id . ' AND clang=' . $clang);
		$sql->setValue('name', $params['data']['catname']);
		$sql->addGlobalUpdateFields();
		$sql->update();

		rex_deleteCacheArticle($id, $clang);

		echo rex_info($I18N->msg('articlename_sync_art_cat_msg'));
	}
}
