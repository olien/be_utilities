<?php
$codeExample = '<?php 
// Standardausgabe des aktuellen Update Datums: ' . rex_update_date::getDate() . '
echo rex_update_date::getDate();

// Benutzerdefinierte Ausgabe des aktuellen Update Datums: ' . rex_update_date::getDate('m-d-Y') . '  
echo rex_update_date::getDate(\'m-d-Y\'); 
?>';
?>

<div class="rex-addon-output">
	<h2 class="rex-hl2">Hilfe</h2>
	<div class="rex-area-content">
		<p class="info-msg">Codebeispiele:</p>
		<p class="info-msg"><?php rex_highlight_string($codeExample); ?></p>
		<p class="info-msg">Das Datum kann über die PHP-üblichen Formatierungsoptionen formatiert werden:<br /><a class="extern" href="http://php.net/manual/de/function.date.php">http://php.net/manual/de/function.date.php</a></p>
	</div>
</div>

<style type="text/css">
p.info-msg,
.rex-code {
	margin-bottom: 10px;
}
</style>
