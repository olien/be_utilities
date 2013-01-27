<?php
$cat_to_art = trim(rex_request('cat_to_art', 'int'));
$art_to_cat = trim(rex_request('art_to_cat', 'int'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/cat_art_name_sync/config.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['cat_art_name_sync']['sync_cat_to_art'] = $cat_to_art;
	$REX['ADDON']['cat_art_name_sync']['sync_art_to_cat'] = $art_to_cat;

	$content = '
		$REX[\'ADDON\'][\'cat_art_name_sync\'][\'sync_cat_to_art\'] = ' . $cat_to_art . ';
		$REX[\'ADDON\'][\'cat_art_name_sync\'][\'sync_art_to_cat\'] = ' . $art_to_cat . ';
	';

	if (rex_replace_dynamic_contents($config_file, str_replace("\t", "", $content)) !== false) {
		echo rex_info($I18N->msg('be_extensions_configfile_update'));
	} else {
		echo rex_warning($I18N->msg('be_extensions_configfile_nosave'));
	}
}

if (!is_writable($config_file)) {
	echo rex_warning($I18N->msg('be_extensions_configfile_nowrite'), $config_file);
}
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_extensions_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_extensions" />
					<input type="hidden" name="subpage" value="plugin.cat_art_name_sync" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="cat_to_art"><?php echo $I18N->msg('cat_art_name_sync_cat_art'); ?></label>
							<input type="checkbox" name="cat_to_art" id="cat_to_art" value="1" <?php if ($REX['ADDON']['cat_art_name_sync']['sync_cat_to_art'] == 1) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="art_to_cat"><?php echo $I18N->msg('cat_art_name_sync_art_cat'); ?></label>
							<input type="checkbox" name="art_to_cat" id="art_to_cat" value="1" <?php if ($REX['ADDON']['cat_art_name_sync']['sync_art_to_cat'] == 1) { echo 'checked="checked"'; } ?>>
					  	</p>
					</div>

					<div class="rex-form-row rex-form-element-v2">
						<p class="rex-form-submit">
							<input type="submit" class="rex-form-submit" name="sendit" value="<?php echo $I18N->msg('be_extensions_settings_save'); ?>" />
						</p>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<style type="text/css">
div.rex-form-row label {
	width: 230px !important; 
}

</style>
