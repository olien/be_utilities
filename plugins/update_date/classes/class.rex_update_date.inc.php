<?php

class rex_update_date {
	static function getUpdateDate($format = 'd.m.Y') {
		global $REX;

		$query =  'SELECT updatedate FROM ' . $REX['TABLE_PREFIX'] . 'article WHERE updatedate <> 0 ORDER BY updatedate DESC LIMIT 1';
		$sql = new sql();
		$sql->setQuery($query);

		return date($format, $sql->getValue('updatedate'));
	}
}
