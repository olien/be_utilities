<?php

$func = rex_request('func', 'string');

if ($func == 'update') {
	$thisPlugin = 'colorizer';
	$settings = (array) rex_post('settings', 'array', array());

	rex_backend_utilities::replaceSettings($thisPlugin, $settings);
	rex_backend_utilities::updateSettingsFile($thisPlugin);

	if ($REX['ADDON']['colorizer']['settings']['colorize_favicon'] && $REX['ADDON']['colorizer']['settings']['labelcolor'] != '') {
		$hexColor = $REX['ADDON']['colorizer']['settings']['labelcolor'];
		$pluginMediaPath = realpath($REX['HTDOCS_PATH'] . $REX['MEDIA_ADDON_DIR']) . DIRECTORY_SEPARATOR . 'be_utilities/plugins/colorizer/';

		// generate favicon
		rex_colorizer_utils::makeFavIcon($hexColor, $pluginMediaPath);

		// change color immediately 
		echo '<link rel="shortcut icon" href="../' . $REX['MEDIA_ADDON_DIR'] . '/be_utilities/plugins/colorizer/' . rex_colorizer_utils::getColorizedFavIconName($hexColor) . '" />' . PHP_EOL;
		echo '<style>#rex-navi-logout { border-bottom: 10px solid ' . $hexColor . '; }</style>' . PHP_EOL;
	}
}

echo '
  <div class="rex-addon-output">
  <div class="rex-form">
    <form action="index.php" method="post">
      <input type="hidden" name="page" value="be_utilities" />
      <input type="hidden" name="subpage" value="plugin.colorizer" />
      <input type="hidden" name="func" value="update" />

          <h2 class="rex-hl2">' . $I18N->msg('be_utilities_settings') . '</h2>

            <fieldset class="rex-form-col-1">

              <div class="rex-form-wrapper">

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="labelcolor">'.$I18N->msg("colorizer_labelcolor").'</label>
                    <input class="rex-form-text" type="text" id="labelcolor" name="settings[labelcolor]" value="'. $REX['ADDON']['colorizer']['settings']['labelcolor'].'" />
                  </p>
                </div>

				<div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
					<input type="hidden" name="settings[colorize_favicon]" value="0" />
                    <input class="rex-form-checkbox" type="checkbox" id="colorize_favicon" name="settings[colorize_favicon]" value="1" ';
                    if ($REX['ADDON']['colorizer']['settings']['colorize_favicon']) echo 'checked="checked"';
                    echo ' />
                    <label for="colorize_favicon">'.$I18N->msg("colorizer_colorize_favicon").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-submit">
                    <input type="submit" class="rex-form-submit" name="sendit" value="'.$I18N->msg("colorizer_update").'" />
                  </p>
                </div>

               </div>

            </fieldset>

    </form>
  </div>
  </div>
  ';
?>

<script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('<img src="../<?php echo rex_colorizer_utils::getMediaAddonDir(); ?>/be_utilities/plugins/colorizer/colorpicker/images/colorpicker_background.png" />');

	jQuery('#labelcolor').keyup(function() {
		updateColorPreview();
	});

	jQuery('#labelcolor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#labelcolor').val('#' + hex);
			jQuery('#rex-navi-logout').css('border-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});

function updateColorPreview() {
	jQuery('#rex-navi-logout').css('border-color', jQuery('#labelcolor').val());
}
</script>
