<?php
$liquidLayout = trim(rex_request('liquid_layout', 'int'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/agk_skin_plus/settings.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['agk_skin_plus']['liquid_layout'] = $liquidLayout;

	$content = '
		$REX[\'ADDON\'][\'agk_skin_plus\'][\'liquid_layout\'] = ' . $liquidLayout . ';
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
?>

<div class="rex-addon-output">
	<div class="rex-form">
		<h2 class="rex-hl2"><?php echo $I18N->msg('agk_skin_plus_features'); ?></h2>
		<div class="rex-form-wrapper">
			<ul id="features">
				<li><?php echo $I18N->msg('agk_skin_plus_feature1'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature2'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature3'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature4'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature5'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature7'); ?></li>
				<li><?php echo $I18N->msg('agk_skin_plus_feature6'); ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_utilities" />
					<input type="hidden" name="subpage" value="plugin.agk_skin_plus" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="liquid_layout"><?php echo $I18N->msg('agk_skin_plus_liquid_layout'); ?></label>
							<input type="checkbox" name="liquid_layout" id="liquid_layout" value="1" <?php if ($REX['ADDON']['agk_skin_plus']['liquid_layout'] == 1) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
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
#features li {
	margin-bottom: 9px;
	margin-left: 10px;
}

</style>

