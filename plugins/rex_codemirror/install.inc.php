<?php
/**
 * Codemirror2 be_extensions Plugin for Redaxo
 *
 * @version 1.0.8
 * @link https://github.com/marijnh/CodeMirror2
 * @author Redaxo be_extensions plugin: rexdev.de
 * @package redaxo 4.3.x/4.4.x
 */

$error = '';

if ($error != '') {
  $REX['ADDON']['installmsg']['rex_codemirror'] = $error;
} else {
  $REX['ADDON']['install']['rex_codemirror'] = true;
}
