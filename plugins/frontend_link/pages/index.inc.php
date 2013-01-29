<?php
$link_text_mode = trim(rex_request('link_text_mode', 'string'));
$link_text = trim(rex_request('link_text', 'string'));
$color = trim(rex_request('color', 'string'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/frontend_link/settings.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['frontend_link']['link_text_mode'] = $link_text_mode;
	$REX['ADDON']['frontend_link']['link_text'] = $link_text;
	$REX['ADDON']['frontend_link']['color'] = $color;

	$content = '
		$REX[\'ADDON\'][\'frontend_link\'][\'link_text_mode\'] = "' . $link_text_mode . '";
		$REX[\'ADDON\'][\'frontend_link\'][\'link_text\'] = "' . $link_text . '";
		$REX[\'ADDON\'][\'frontend_link\'][\'color\'] = "' . $color . '";
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
					<input type="hidden" name="subpage" value="plugin.frontend_link" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row">
						<p class="rex-form-col-a rex-form-select">
							<label for="link_text_mode"><?php echo $I18N->msg('frontend_link_link_text'); ?></label>
							<select name="link_text_mode" size="1" id="link_text_mode" class="rex-form-select">
								<option value="default" <?php if ($REX['ADDON']['frontend_link']['link_text_mode'] == 'default') { echo 'selected="selected"'; } ?>><?php echo $I18N->msg('frontend_link_goto_website'); ?></option>
								<option value="rex_server" <?php if ($REX['ADDON']['frontend_link']['link_text_mode'] == 'rex_server') { echo 'selected="selected"'; } ?>><?php echo rex_frontend_link::getFrontendUrl(); ?></option>
								<option value="userdef" <?php if ($REX['ADDON']['frontend_link']['link_text_mode'] == 'userdef') { echo 'selected="selected"'; } ?>><?php echo $I18N->msg('frontend_link_userdef_link_text'); ?>:</option>
							</select>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1" id="row_userdef" style="display: none;">
						<p class="rex-form-text">
							<label for="link_text"></label>
							<input class="rex-form-text" type="text" id="link_text" name="link_text" value="<?php echo $REX['ADDON']['frontend_link']['link_text']; ?>" />
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-text">
							<label for="color">Farbe</label>
							<input class="rex-form-text" type="text" id="color" name="color" value="<?php echo $REX['ADDON']['frontend_link']['color']; ?>" />
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
	width: 100px !important; 
}

</style>

<script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('#link_text_mode').change(function() {
  		if (jQuery(this).val() == "userdef") {
			jQuery('#row_userdef').show();
		} else {
			jQuery('#row_userdef').hide();
		}
		
	});

	jQuery('#link_text_mode').change();

	jQuery('#color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val('#' + hex.toUpperCase());
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#frontend-link').css('color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});
</script>
