<?php
/**
 * decaf_upload_precompressor
 *
 * @author DECAF
 * @version $Id$
 */

$mypage = 'upload_precompressor';
$message = false;

$page = rex_request('page', 'string');
$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$thisPlugin = $mypage;
	$settings = (array) rex_post('settings', 'array', array());

	rex_backend_utilities::replaceSettings($thisPlugin, $settings);
	rex_backend_utilities::updateSettingsFile($thisPlugin);
}

// check for large jpg in mediapool
$scalable_mime_types = array('image/jpeg', 'image/jpg', 'image/pjpeg');
$max_pixel = $REX['ADDON']['upload_precompressor']['settings']['max_pixel'];



$FILESQL = rex_sql::factory();
// $FILESQL->debugsql = 1;
$FILESQL->setTable($REX['TABLE_PREFIX'].'file');
$where = "(";
foreach ($scalable_mime_types as $type)
{
  $where .= 'filetype="'.$type.'" OR ';
}
$where = substr($where, 0, strlen($where)-3).') ';
$where .= "AND (width > ".$max_pixel." OR height > ".$max_pixel.")";
$FILESQL->setWhere($where . ' ORDER BY pixel asc'); // rex_sql has no special method for adding sort-order
$FILESQL->select('*, (width * height) AS pixel');

$files = $FILESQL->getArray();

if (rex_get('scale') == 'scale') {
  ob_end_clean();
  $initial = rex_get('initial');
  $progress = $initial - count($files);
  if ($progress) {
    $td_width=round( ( $progress / $initial ) * 100 );
  } else {
    $td_width = 0;
  }
  $td2_width = 100-$td_width;

  if (rex_post('btn_update', 'string') != '' || rex_get('update_continue')) {
    ob_start();
    echo '<span style="font-family: sans-serif; font-size: 12px;">'.$I18N->msg('dcf_precomp_caption_progress').'</span><br />';
    echo '<table cellpadding=0 cellspacing=0 border=0 style="height: 32px; width: 100%"><tr><td style="width: '.$td_width.'%; background: #3c9ed0; color: #fff; font-size: 12px; font-weight: bold; font-family: sans-serif; text-align: left">&nbsp;&nbsp;'.$progress.'</td><td style="width:'.$td2_width.'%; text-align: right; font-size: 12px; font-weight: bold; font-family: sans-serif">&nbsp;</td></tr></table>';
    if (!count($files))
    {
      echo '<br /><span style="font-family: sans-serif; font-size: 12px; font-weight: bold">'.$I18N->msg('dcf_precomp_caption_finished').'</span>';
    } else
    {
      echo '<br /><span style="font-family: sans-serif; font-size: 12px;">'.$I18N->msg('dcf_precomp_no_reload').'</span>';
    }
    $i=0;
    foreach($files as $file)
    {
      if ($file['width'] > $file['height'])
      {
        $ratio = $REX['ADDON']['upload_precompressor']['settings']['max_pixel'] / $file['width'];
      }
      else
      {
        $ratio = $REX['ADDON']['upload_precompressor']['settings']['max_pixel'] / $file['height'];
      }
      $newwidth = round($file['width'] * $ratio);
      $newheight = round($file['height']  * $ratio);

      // Load
      $image = imagecreatetruecolor($newwidth, $newheight);
      $source = imagecreatefromjpeg($REX['MEDIAFOLDER'].'/'.$file['filename']);

      // Resize
      imagecopyresized($image, $source, 0, 0, 0, 0, $newwidth, $newheight, $file['width'], $file['height']);

      // save Image
      imagejpeg($image, $REX['MEDIAFOLDER'].'/'.$file['filename'], $REX['ADDON']['upload_precompressor']['settings']['jpg_quality']);

      // update db entry
      $size = @getimagesize($REX['MEDIAFOLDER'].'/'.$file['filename']);
      $filesize = @filesize($REX['MEDIAFOLDER'].'/'.$file['filename']);

      $FILESQL = rex_sql::factory();
      // $FILESQL->debugsql = 1;
      $FILESQL->setTable($REX['TABLE_PREFIX'].'file');
      $FILESQL->setWhere('file_id="'. $file['file_id'].'"');
      $FILESQL->setValue('filesize',$filesize);
      $FILESQL->setValue('width',$size[0]);
      $FILESQL->setValue('height',$size[1]);
      $FILESQL->update();

      $i++;
      if ($i>=10 || $file == end($files))
      {
        echo '<script>
          document.location.href="index.php?page=be_utilities&subpage=plugin.upload_precompressor&update_continue=1&scale=scale&initial='.$initial.'";
        </script>';
        flush();
        if( ob_get_level() > 0 ) ob_flush();
        exit;
      }
    }
  }
  flush();
  if( ob_get_level() > 0 ) ob_flush();
  exit;
}


?>
<div class="rex-addon-output">
  <div class="rex-form">
    <form action="index.php" method="post">
      <input type="hidden" name="page" value="be_utilities" />
      <input type="hidden" name="subpage" value="plugin.upload_precompressor" />
      <input type="hidden" name="func" value="update" />

      <fieldset>
        <div class="rex-form-wrapper">
          <h3 class="rex-hl2"><?php echo $I18N->msg('upload_precompressor_settings'); ?></h3>
          <div class="rex-area-content">
            <p class="rex-tx1"><?php echo $I18N->msg('dcf_precomp_intro'); ?></p>
          </div>
        </div>
      </fieldset>

      <fieldset class="rex-form-col-1">
        <legend><?php echo $I18N->msg('dcf_precomp_configuration'); ?></legend>
        <div class="rex-form-wrapper">
          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-text">
              <label for="max_width"><?php echo $I18N->msg('dcf_precomp_max_pixel'); ?></label>
              <input class="rex-form-text" style="width: 100px;" type="text" name="settings[max_pixel]" id="max_pixel" value="<?php echo $REX['ADDON']['upload_precompressor']['settings']['max_pixel']; ?>" />
              <span class="rex-form-notice"><?php echo $I18N->msg('dcf_precomp_max_pixel_notice'); ?></span>
            </p>
          </div>
          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-text">
              <label for="jpg_quality"><?php echo $I18N->msg('dcf_precomp_jpg_quality'); ?></label>
              <input class="rex-form-text" style="width: 100px;" type="text" name="settings[jpg_quality]" id="jpg_quality" value="<?php echo $REX['ADDON']['upload_precompressor']['settings']['jpg_quality']; ?>" />
              <span class="rex-form-notice"><?php echo $I18N->msg('dcf_precomp_jpg_quality_notice'); ?></span>
            </p>
          </div>
        </div>
      </fieldset>

      <div class="rex-form-row">
        <p class="rex-form-submit">
          <input type="submit" class="rex-form-submit" name="btn_save" value="<?php echo $I18N->msg('dcf_precomp_save') ?>" />
        </p>
      </div>

    </form>
  </div>
</div>

<?php if (count($files)): ?>
  <div class="rex-addon-output" style="margin-top: 20px;">
    <div class="rex-form">
      <form action="index.php?page=be_utilities&subpage=plugin.upload_precompressor&scale=scale&initial=<?php echo count($files) ?>" method="post" target="scaling_frame">

        <fieldset class="rex-form-col-1">
          <div class="rex-form-wrapper">
            <h3 class="rex-hl2"><?php echo $I18N->msg('dcf_precomp_headline_update') ?> (<?php echo count($files) ?>)</h3>
            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <span class="rex-form-notice"><?php echo $I18N->msg('dcf_precomp_info_update') ?></span>
              </p>
              <p class="rex-form-col-a rex-form-text">
                <span class="rex-form-notice"><?php echo $I18N->msg('dcf_precomp_backup_update') ?></span>
              </p>
            </div>
          </div>
        </fieldset>

        <div class="rex-form-row">
          <p class="rex-form-submit">
            <input type="submit" class="rex-form-submit" name="btn_update" value="<?php echo $I18N->msg('dcf_precomp_update') ?>" onclick="if(!confirm('<?php echo $I18N->msg('dcf_precomp_confirm_update') ?>')) return false;" />
          </p>
        </div>

      </form>
    </div>
  </div>

  <iframe src="index.php?page=be_utilities&subpage=plugin.upload_precompressor&scale=scale&initial=<?php echo count($files) ?>" name="scaling_frame" width="750" height="120" align="left" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>

<?php endif ?>

