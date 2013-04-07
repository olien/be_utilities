<?php

$article_id = rex_request('article_id','int');
$func = rex_request('func','string');

$info = '';
$warning = '';

// delete view
if($func == 'delete' && $article_id > 0) {
	$sql = rex_sql::factory();
	//  $sql->debugsql = true;
	$sql->setTable($REX['TABLE_PREFIX'] . 'hidden_startarticles');
	$sql->setWhere('id='. $article_id . ' LIMIT 1');

	if($sql->delete()) {
		$info = $I18N->msg('hide_startarticle_deleted');
	} else {
		$warning = $sql->getErrro();
	}
	
	$func = '';
}

// output messages
if ($info != '') {
	echo rex_info($info);
}

if ($warning != '') {
	echo rex_warning($warning);
}

// output
echo '<div class="rex-addon-output-v2">';

if ($func == '') {
	$query = 'SELECT * FROM '.$REX['TABLE_PREFIX'].'hidden_startarticles ORDER BY id';

	$list = rex_list::factory($query);
	$list->setNoRowsMessage($I18N->msg('hide_startarticle_list_rowmsg'));
	$list->setCaption($I18N->msg('hide_startarticle_list_caption'));
	$list->addTableAttribute('summary',$I18N->msg('hide_startarticle_list_table_attr'));
	$list->addTableColumnGroup(array(40, 80, '*', 90, 90));

	$list->removeColumn('id');
	$list->setColumnLabel('article_id',$I18N->msg('hide_startarticle_article_id'));

	// article name column
	$pdfFile = $I18N->msg('hide_startarticle_article_name');
	$list->addColumn($pdfFile, '', -1, array('<th>###VALUE###</th>','<td>###VALUE###</td>'));
	$list->setColumnFormat($pdfFile, 'custom',
	create_function('$params',
		'global $REX;
		$list = $params["list"];
		$article = OOArticle::getArticleById($list->getValue("article_id"));
		return $article->getName();'
	));

	// icon column
	$thIcon = '<a class="rex-i-element rex-i-generic-add" href="'. $list->getUrl(array('func' => 'add')) .'"><span class="rex-i-element-text">Ansicht erstellen</span></a>';
	$tdIcon = '<span class="rex-i-element rex-i-generic"><span class="rex-i-element-text">###name###</span></span>';
	$list->addColumn($thIcon, $tdIcon, 0, array('<th class="rex-icon">###VALUE###</th>','<td class="rex-icon">###VALUE###</td>'));
	$list->setColumnParams($thIcon, array('func' => 'edit', 'article_id' => '###id###'));

	// functions column spans 2 data-columns
	$funcs = $I18N->msg('hide_startarticle_functions');
	$list->addColumn($funcs, $I18N->msg('hide_startarticle_edit'), -1, array('<th colspan="2">###VALUE###</th>','<td>###VALUE###</td>'));
	$list->setColumnParams($funcs, array('func' => 'edit', 'article_id' => $article_id, 'article_id' => '###id###'));

	$delete = $I18N->msg('deleteCol');
	$list->addColumn($delete, $I18N->msg('hide_startarticle_delete'), -1, array('','<td>###VALUE###</td>'));
	$list->setColumnParams($delete, array('article_id' => '###id###', 'func' => 'delete'));
	$list->addLinkAttribute($delete, 'onclick', 'return confirm(\''.$I18N->msg('delete').' ?\')');

	$list->show();
} elseif ($func == 'add' || $func == 'edit' && $article_id > 0) {
	if ($func == 'edit') {
		$formLabel = $I18N->msg('hide_startarticle_formlabel_edit');
	} else if ($func == 'add') {
		$formLabel = $I18N->msg('hide_startarticle_formlabel_add');
	}

	$form = rex_form::factory($REX['TABLE_PREFIX'] . 'hidden_startarticles', $formLabel, 'id=' . $article_id);

	$form->addErrorMessage(REX_FORM_ERROR_VIOLATE_UNIQUE_KEY, $I18N->msg('hide_startarticle_article_exists'));

	$field = &$form->addLinkmapField('article_id');
	$field->setLabel($I18N->msg('hide_startarticle_select'));

	if($func == 'edit') {
		$form->addParam('article_id', $article_id);
	}

	$form->show();
}

echo '</div>';
?>
