<?php

$info = '';
$warning = '';
$func = rex_request("func","string");

if ($func == 'update')
{

  $REX['ADDON']['customizer']['projectname'] = htmlspecialchars(rex_request('customizer-projectname', 'string'));

  $labelcolor = rex_request("customizer-labelcolor","string");
  if ($labelcolor == '') {
    $REX['ADDON']['customizer']['labelcolor'] = '';
  }
  elseif (preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $labelcolor)) {
    $REX['ADDON']['customizer']['labelcolor'] = htmlspecialchars($labelcolor);
  }
  else {
    $warning = $I18N->msg('customizer_labelcolor_error');
  }

  $REX['ADDON']['customizer']['showlink'] = 0;
  if(rex_request("customizer-showlink") == 1) {
    $REX['ADDON']['customizer']['showlink'] = 1;
  }

  $REX['ADDON']['customizer']['textarea'] = 0;
  if(rex_request("customizer-textarea") == 1) {
    $REX['ADDON']['customizer']['textarea'] = 1;
  }

  $REX['ADDON']['customizer']['liquid'] = 0;
  if(rex_request("customizer-liquid") == 1) {
    $REX['ADDON']['customizer']['liquid'] = 1;
  }
 
  $content = '
$REX[\'ADDON\'][\'customizer\'][\'labelcolor\'] = "'.$REX['ADDON']['customizer']['labelcolor'].'";
$REX[\'ADDON\'][\'customizer\'][\'showlink\'] = '.$REX['ADDON']['customizer']['showlink'].';
$REX[\'ADDON\'][\'customizer\'][\'textarea\'] = '.$REX['ADDON']['customizer']['textarea'].';
$REX[\'ADDON\'][\'customizer\'][\'liquid\'] = '.$REX['ADDON']['customizer']['liquid'].';
  ';

  $config_file = $REX['INCLUDE_PATH'] .'/addons/be_utilities/plugins/customizer/settings.inc.php';

  if($warning == '' && rex_replace_dynamic_contents($config_file, $content) !== false) {
  	echo rex_info($I18N->msg("customizer_config_updated"));
  } else {
  	echo rex_warning($I18N->msg("customizer_config_update_failed",$config_file));
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
      <input type="hidden" name="subpage" value="plugin.customizer" />
      <input type="hidden" name="func" value="update" />

          <h2 class="rex-hl2">' . $I18N->msg('be_utilities_settings') . '</h2>

          

            <fieldset class="rex-form-col-1">

              <div class="rex-form-wrapper">

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="customizer-labelcolor">'.$I18N->msg("customizer_labelcolor").'</label>
                    <input class="rex-form-text" type="text" id="customizer-labelcolor" name="customizer-labelcolor" value="'. $REX['ADDON']['customizer']['labelcolor'].'" />
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-showlink" name="customizer-showlink" value="1" ';
                    if($REX['ADDON']['customizer']['showlink']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-showlink">'.$I18N->msg("customizer_showlink").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-textarea" name="customizer-textarea" value="1" ';
                    if($REX['ADDON']['customizer']['textarea']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-textarea">'.$I18N->msg("customizer_textarea").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-checkbox">
                    <input class="rex-form-checkbox" type="checkbox" id="rex-form-agk-liquid" name="customizer-liquid" value="1" ';
                    if($REX['ADDON']['customizer']['liquid']) echo 'checked="checked"';
                    echo ' />
                    <label for="rex-form-agk-liquid">'.$I18N->msg("customizer_liquid").'</label>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-submit">
                    <input type="submit" class="rex-form-submit" name="sendit" value="'.$I18N->msg("customizer_update").'" />
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
	jQuery('<img src="../<?php echo rex_customizer_utils::getMediaAddonDir(); ?>/be_utilities/plugins/customizer/colorpicker/images/colorpicker_background.png" />');

	jQuery('#customizer-labelcolor').ColorPicker({
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
