<?php

$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$thisPlugin = 'articlename_sync';
	$settings = (array) rex_post('settings', 'array', array());

	rex_backend_utilities::replaceSettings($thisPlugin, $settings);
	rex_backend_utilities::updateSettingsFile($thisPlugin);
}
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_utilities" />
					<input type="hidden" name="subpage" value="plugin.articlename_sync" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="sync_cat_to_art"><?php echo $I18N->msg('articlename_sync_cat_art'); ?></label>
							<input type="hidden" name="settings[sync_cat_to_art]" value="0" />
							<input type="checkbox" name="settings[sync_cat_to_art]" id="sync_cat_to_art" value="1" <?php if ($REX['ADDON']['articlename_sync']['settings']['sync_cat_to_art']) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="sync_art_to_cat"><?php echo $I18N->msg('articlename_sync_art_cat'); ?></label>
							<input type="hidden" name="settings[sync_art_to_cat]" value="0" />
							<input type="checkbox" name="settings[sync_art_to_cat]" id="sync_art_to_cat" value="1" <?php if ($REX['ADDON']['articlename_sync']['settings']['sync_art_to_cat']) { echo 'checked="checked"'; } ?>>
					  	</p>
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

<style type="text/css">
div.rex-form-row label {
	width: 230px !important; 
}

</style>
