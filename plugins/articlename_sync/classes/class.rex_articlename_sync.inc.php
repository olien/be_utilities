<?php

class rex_articlename_sync {
	function syncArtname2Catname($params) {
		global $REX;
		$id = $params['id'];
		$clang = $params['clang'];
		$sql = new rex_sql();

		$sql->setTable($REX['TABLE_PREFIX'] . 'article');
		$sql->setWhere("(id=$id OR (re_id=$id AND startpage=0)) AND clang=$clang");
		$sql->setValue('catname', $params['data']['name']);
		$sql->addGlobalUpdateFields();
		$sql->update();  

		rex_deleteCacheArticle($id, $clang);
	}

	function syncCatname2Artname($params) {
		global $REX;
		$id = $params['id'];
		$clang = $params['clang'];
		$sql = new rex_sql();

		$sql->setTable($REX['TABLE_PREFIX'].'article');
		$sql->setWhere('id=' . $id . ' AND clang=' . $clang);
		$sql->setValue('name', $params['data']['catname']);
		$sql->addGlobalUpdateFields();
		$sql->update();

		rex_deleteCacheArticle($id, $clang);
	}
}
