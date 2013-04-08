<?php

$info = '';
$warning = '';
$func = rex_request("func","string");

if ($func == 'update')
{

	$REX['ADDON']['colorizer']['projectname'] = htmlspecialchars(rex_request('colorizer-projectname', 'string'));

	$labelcolor = rex_request("colorizer-labelcolor","string");

	if ($labelcolor == '') {
		$REX['ADDON']['colorizer']['labelcolor'] = '';
	}
	elseif (preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $labelcolor)) {
		$REX['ADDON']['colorizer']['labelcolor'] = htmlspecialchars($labelcolor);
	}
	else {
		$warning = $I18N->msg('colorizer_labelcolor_error');
	}

	$REX['ADDON']['colorizer']['colorize_favicon'] = 0;
	
	if(rex_request("colorize_favicon") == 1) {
		$REX['ADDON']['colorizer']['colorize_favicon'] = 1;
	}

	$REX['ADDON']['colorizer']['showlink'] = 0;
	
	if(rex_request("colorizer-showlink") == 1) {
		$REX['ADDON']['colorizer']['showlink'] = 1;
	}

	$REX['ADDON']['colorizer']['textarea'] = 0;

	if(rex_request("colorizer-textarea") == 1) {
		$REX['ADDON']['colorizer']['textarea'] = 1;
	}

	$REX['ADDON']['colorizer']['liquid'] = 0;

	if(rex_request("colorizer-liquid") == 1) {
		$REX['ADDON']['colorizer']['liquid'] = 1;
	}

	$content = '
$REX[\'ADDON\'][\'colorizer\'][\'labelcolor\'] = "'.$REX['ADDON']['colorizer']['labelcolor'].'";
$REX[\'ADDON\'][\'colorizer\'][\'colorize_favicon\'] = '.$REX['ADDON']['colorizer']['colorize_favicon'].';
$REX[\'ADDON\'][\'colorizer\'][\'showlink\'] = '.$REX['ADDON']['colorizer']['showlink'].';
$REX[\'ADDON\'][\'colorizer\'][\'textarea\'] = '.$REX['ADDON']['colorizer']['textarea'].';
$REX[\'ADDON\'][\'colorizer\'][\'liquid\'] = '.$REX['ADDON']['colorizer']['liquid'].';
	';

	$config_file = $REX['INCLUDE_PATH'] .'/addons/be_utilities/plugins/colorizer/settings.inc.php';

	if($warning == '' && rex_replace_dynamic_contents($config_file, $content) !== false) {
		echo rex_info($I18N->msg("colorizer_config_updated"));
	} else {
		echo rex_warning($I18N->msg("colorizer_config_update_failed",$config_file));
	} 

	if ($REX['ADDON']['colorizer']['colorize_favicon'] && $REX['ADDON']['colorizer']['labelcolor'] != '') {
		$hexColor = $REX['ADDON']['colorizer']['labelcolor'];
		$pluginMediaPath = realpath($REX['HTDOCS_PATH'] . $REX['MEDIA_ADDON_DIR']) . DIRECTORY_SEPARATOR . 'be_utilities/plugins/colorizer/';

		// generate favicon
		rex_colorizer_utils::makeFavIcon($hexColor, $pluginMediaPath);

		// change color immediately 
		echo '<link rel="shortcut icon" href="../' . $REX['MEDIA_ADDON_DIR'] . '/be_utilities/plugins/colorizer/' . rex_colorizer_utils::getColorizedFavIconName($hexColor) . '" />' . PHP_EOL;
		echo '<style>#rex-navi-logout { border-bottom: 10px solid ' . $hexColor . '; }</style>' . PHP_EOL;
	}
}

if ($warning != '') {
  echo rex_warning($warning);
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
                    <label for="colorizer-labelcolor">'.$I18N->msg("colorizer_labelcolor").'</label>
                    <input class="rex-form-text" type="text" id="colorizer-labelcolor" name="colorizer-labelcolor" value="'. $REX['ADDON']['colorizer']['labelcolor'].'" />
                  </p>
                </div>

				<div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="colorize_favicon" name="colorize_favicon" value="1" ';
                    if($REX['ADDON']['colorizer']['colorize_favicon']) echo 'checked="checked"';
                    echo ' />
                    <label for="colorize_favicon">'.$I18N->msg("colorizer_colorize_favicon").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-showlink" name="colorizer-showlink" value="1" ';
                    if($REX['ADDON']['colorizer']['showlink']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-showlink">'.$I18N->msg("colorizer_showlink").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-textarea" name="colorizer-textarea" value="1" ';
                    if($REX['ADDON']['colorizer']['textarea']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-textarea">'.$I18N->msg("colorizer_textarea").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-liquid" name="colorizer-liquid" value="1" ';
                    if($REX['ADDON']['colorizer']['liquid']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-liquid">'.$I18N->msg("colorizer_liquid").'</label>
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

	jQuery('#colorizer-labelcolor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val('#' + hex);
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#rex-navi-logout').css('border-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});
</script>
