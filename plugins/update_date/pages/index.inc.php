<?php
$codeExample = '<?php 
// ' . $I18N->msg('update_date_comment1') . ': ' . rex_update_date::getDate() . '
echo rex_update_date::getDate();

// ' . $I18N->msg('update_date_comment2') . ': ' . rex_update_date::getDate('m-d-Y') . '  
echo rex_update_date::getDate(\'m-d-Y\'); 
?>';
?>

<div class="rex-addon-output">
	<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_help_caption'); ?></h2>
	<div class="rex-area-content">
		<p class="info-msg"><?php echo $I18N->msg('update_date_intro'); ?></p>
		<p class="info-msg"><?php rex_highlight_string($codeExample); ?></p>
		<p class="info-msg"><?php echo $I18N->msg('update_date_php_docs_info'); ?>:<br /><a class="extern" href="http://php.net/manual/de/function.date.php">http://php.net/manual/de/function.date.php</a></p>
	</div>
</div>

<style type="text/css">
p.info-msg,
.rex-code {
	margin-bottom: 10px;
}
</style>
