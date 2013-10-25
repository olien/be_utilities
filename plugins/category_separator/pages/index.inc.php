<?php
$cat_id = trim(rex_request('cat_id', 'string'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/category_separator/settings.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['category_separator']['cat_id'] = $cat_id;

	$content = '
		$REX[\'ADDON\'][\'category_separator\'][\'cat_id\'] = "' . $cat_id . '";
	';

	if (rex_replace_dynamic_contents($config_file, str_replace("\t", "", $content)) !== false) {
		echo rex_info($I18N->msg('be_utilities_configfile_update'));
	} else {
		echo rex_warning($I18N->msg('be_utilities_configfile_nosave'));
	}
}

if (!is_writable($config_file)) {
	echo rex_warning($I18N->msg('be_utilities_configfile_nowrite'), $config_file);
}

$linkButton = rex_input::factory('linkbutton');
$linkButton->setButtonId(1);
$linkButton->setValue($REX['ADDON']['category_separator']['cat_id']);
$linkButton->setAttribute('name', 'cat_id');
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_utilities" />
					<input type="hidden" name="subpage" value="plugin.category_separator" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row">
						<div class="rex-form-col-a">
							<label for="cat_id"><?php echo $I18N->msg('category_separator_divide_after'); ?></label>
							<?php echo $linkButton->getHtml(); ?>
						</div>
					</div>

					<div class="rex-form-row rex-form-element-v2">
						<p class="rex-form-submit">
							<input type="submit" class="rex-form-submit" name="sendit" value="<?php echo $I18N->msg('be_utilities_settings_save'); ?>" />
						</p>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

