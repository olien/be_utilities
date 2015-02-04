<?php
/**
 * decaf_upload_precompressor
 *
 * @author DECAF
 * @version $Id$
 */

$mypage = 'upload_precompressor';

$base_path = $REX['INCLUDE_PATH'] .'/addons/be_utilities/plugins/'.$mypage;

if ($REX['REDAXO'])
{
  if ($REX['LANG'] == 'default')
  {
    $be_lang = 'de_de_utf8';
  } 
  else {
    $be_lang = $REX['LANG'];
  }
  $I18N->appendFile($REX['INCLUDE_PATH'].'/addons/be_utilities/plugins/'.$mypage.'/lang/');
}

$error = false;
$err_msg = array();

// check for REX version < 4.3
if ( ($REX['VERSION'] < 4) || ($REX['VERSION'] == 4 && $REX['SUBVERSION'] < 3) )
{
  $err_msg[] = $I18N->msg('dcf_precomp_rex_version');
  $error = true;
}
else {
  $available_memory = getMemoryLimitInMb();
  if ($available_memory < 64 && $available_memory != -1) 
  {
    $err_msg[] = $I18N->msg('dcf_precomp_insufficient_memory');
    $error = true;
  }
}

if (!$error) 
{
  $REX['ADDON']['install'][$mypage] = true;
}
else
{
  $REX['ADDON']['installmsg']['decaf_upload_precompressor'] = implode('<br />', $err_msg);
}


function getMemoryLimitInMb()
{
  $ml = @ini_get('memory_limit');
  if ($ml == 0) return -1;
  $unit = substr($ml,strlen($ml)-1, 1);
  switch ($unit) {
    case 'G' :
    case 'g' :
     $memory = (substr($ml,0, strlen($ml)-1) * 1024);
     break;
    case 'M' :
    case 'm' :
     $memory = substr($ml,0, strlen($ml)-1);
     break;
    case 'K' :
    case 'k' :
      $memory = round((substr($ml,0, strlen($ml)-1) / 1024), 0);
      break;
    default:
      $memory = round(($ml / 1024 / 1024), 0);
  }
  return $memory;
}
?>
