<?php

$info = '';
$warning = '';
$func = rex_request("func", "string");

$themes = array();

foreach (glob($REX["INCLUDE_PATH"]. "/addons/be_utilities/plugins/codemirror/files/vendor/theme/*.css") as $filename) {
	$themes[] = substr(basename($filename), 0, -4);
}

$tselect = new rex_select;
$tselect->setSize(1);
$tselect->setName('theme');
$tselect->setStyle('class="rex-form-select"');
$tselect->setId('theme');

foreach($themes as $theme) {
	$tselect->addOption($theme,$theme);
}

if ($func == 'update') {
	$REX['ADDON']['codemirror']['theme'] = htmlspecialchars(substr(rex_request("theme","string"), 0, 20));
 	
	$content = '
$REX[\'ADDON\'][\'codemirror\'][\'theme\'] = "' . $REX['ADDON']['codemirror']['theme'] . '";
  ';

	$config_file = $REX['INCLUDE_PATH'] .'/addons/be_utilities/plugins/codemirror/settings.inc.php';

	if ($warning == '' && rex_replace_dynamic_contents($config_file, $content) !== false) {
		echo rex_info($I18N->msg("codemirror_config_updated"));
	} else {
		echo rex_warning($I18N->msg("codemirror_config_update_failed",$config_file));
	}
}

$tselect->setSelected($REX['ADDON']['codemirror']['theme']);

if ($warning != '') {
	echo rex_warning($warning);
}
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
							<label for="include_template_id"><?php echo $I18N->msg("codemirror_theme"); ?></label>
							<?php echo $tselect->get(); ?>
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

