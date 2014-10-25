<?php

$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$thisPlugin = 'codemirror';
	$settings = (array) rex_post('settings', 'array', array());

	rex_backend_utilities::replaceSettings($thisPlugin, $settings);
	rex_backend_utilities::updateSettingsFile($thisPlugin);
}

$themes = array();

foreach (glob($REX["INCLUDE_PATH"]. "/addons/be_utilities/plugins/codemirror/files/vendor/theme/*.css") as $filename) {
	$themes[] = substr(basename($filename), 0, -4);
}

$tselect = new rex_select;
$tselect->setSize(1);
$tselect->setName('settings[theme]');
$tselect->setStyle('class="rex-form-select"');
$tselect->setId('theme');

foreach($themes as $theme) {
	$tselect->addOption($theme,$theme);
}

$tselect->setSelected($REX['ADDON']['codemirror']['settings']['theme']);
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_utilities" />
					<input type="hidden" name="subpage" value="plugin.codemirror" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row">
						<p class="rex-form-col-a rex-form-select">
							<label for="theme"><?php echo $I18N->msg("codemirror_theme"); ?></label>
							<?php echo $tselect->get(); ?>
						</p>
					</div>
					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-col-a rex-form-read">
							<label for="codemirror_fullscreen_key"><?php echo $I18N->msg("codemirror_fullscreen_key"); ?></label>
							<span id="codemirror_fullscreen_key" class="rex-form-read">F11</span>
						</p>
					</div>
					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-col-a rex-form-read">
							<label for="codemirror_version_info"><?php echo $I18N->msg("codemirror_version_info"); ?></label>
							<span id="codemirror_version_info" class="rex-form-read">3.21 (16-01-2014)</span>
						</p>
					</div>
					<div class="rex-form-row hint">
						<p class="rex-form-col-a rex-form-select codemirror_hint">
							<label for="codemirror_hint"><?php echo $I18N->msg("codemirror_hint"); ?></label>
							<span><?php echo $I18N->msg("codemirror_info"); ?></span>
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
.codemirror_hint {
	line-height: 16px;
}

.codemirror_hint span {
	display: block;
	margin-right: 20px;
}

.codemirror_hint label {
	height: 70px;
}
</style>

