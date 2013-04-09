<?php
$metamenu_link = trim(rex_request('metamenu_link', 'string'));
$metamenu_link_text = trim(rex_request('metamenu_link_text', 'string'));
$metamenu_header_link = trim(rex_request('metamenu_header_link', 'string'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_utilities/plugins/frontend_link/settings.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['frontend_link']['metamenu_link'] = $metamenu_link;
	$REX['ADDON']['frontend_link']['metamenu_link_text'] = $metamenu_link_text;
	$REX['ADDON']['frontend_link']['metamenu_header_link'] = $metamenu_header_link;

	$content = '
		$REX[\'ADDON\'][\'frontend_link\'][\'metamenu_link\'] = "' . $metamenu_link . '";
		$REX[\'ADDON\'][\'frontend_link\'][\'metamenu_link_text\'] = "' . $metamenu_link_text . '";
		$REX[\'ADDON\'][\'frontend_link\'][\'metamenu_header_link\'] = "' . $metamenu_header_link . '";
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

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_utilities_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_utilities" />
					<input type="hidden" name="subpage" value="plugin.frontend_link" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row">
						<p class="rex-form-col-a rex-form-select">
							<label for="metamenu_link"><?php echo $I18N->msg('frontend_link_metamenu_link_label'); ?></label>
							<select name="metamenu_link" size="1" id="metamenu_link" class="rex-form-select">
								<option value="none" <?php if ($REX['ADDON']['frontend_link']['metamenu_link'] == 'none') { echo 'selected="selected"'; } ?>><?php echo $I18N->msg('frontend_link_metamenu_link_none'); ?></option>
								<option value="default" <?php if ($REX['ADDON']['frontend_link']['metamenu_link'] == 'default') { echo 'selected="selected"'; } ?>><?php echo $I18N->msg('frontend_link_metamenu_link_default'); ?></option>
								<option value="rex_server" <?php if ($REX['ADDON']['frontend_link']['metamenu_link'] == 'rex_server') { echo 'selected="selected"'; } ?>><?php echo rex_frontend_link::getFrontendUrl(); ?></option>
								<option value="userdef" <?php if ($REX['ADDON']['frontend_link']['metamenu_link'] == 'userdef') { echo 'selected="selected"'; } ?>><?php echo $I18N->msg('frontend_link_metamenu_link_userdef'); ?>:</option>
							</select>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1" id="row_userdef" style="display: none;">
						<p class="rex-form-text">
							<label for="metamenu_link_text"></label>
							<input class="rex-form-text" type="text" id="metamenu_link_text" name="metamenu_link_text" value="<?php echo $REX['ADDON']['frontend_link']['metamenu_link_text']; ?>" />
						</p>
					</div>


					<div class="rex-form-row">
						<p class="rex-form-col-a rex-form-checkbox">
							<input class="rex-form-checkbox" type="checkbox" id="metamenu_header_link" name="metamenu_header_link" value="1" <?php if ($REX['ADDON']['frontend_link']['metamenu_header_link']) echo 'checked="checked"'; ?> />
							<label for="metamenu_header_link"><?php echo $I18N->msg("frontend_link_header_link_label"); ?></label>
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

<script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('#metamenu_link').change(function() {
  		if (jQuery(this).val() == "userdef") {
			jQuery('#row_userdef').show();
		} else {
			jQuery('#row_userdef').hide();
		}
		
	});

	jQuery('#metamenu_link').change();
});
</script>
