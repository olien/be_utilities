<?php

$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$thisPlugin = 'category_separator';
	$settings = (array) rex_post('settings', 'array', array());

	rex_backend_utilities::replaceSettings($thisPlugin, $settings);
	rex_backend_utilities::updateSettingsFile($thisPlugin);
}

$linkButton = rex_input::factory('linkbutton');
$linkButton->setButtonId(1);
$linkButton->setValue($REX['ADDON']['category_separator']['settings']['cat_id']);
$linkButton->setAttribute('name', 'settings[cat_id]');
$linkButton->setAttribute('id', 'cat_id');
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

