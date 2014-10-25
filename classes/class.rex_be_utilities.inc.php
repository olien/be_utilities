<?php
class rex_backend_utilities {
	static function appendToPageHeader($params) {
		$insert = '<!-- BEGIN be_utilities -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/be_utilities.css" />' . PHP_EOL;
		$insert .= '<!-- END be_utilities -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}

	public static function getSettingsFile($plugin) {
		global $REX;

		$dataDir = $REX['INCLUDE_PATH'] . '/data/addons/be_utilities/' . $plugin . '/';

		return $dataDir . 'settings.inc.php';
	}

	public static function includeSettingsFile($plugin) {
		global $REX; // important for include

		$settingsFile = self::getSettingsFile($plugin);

		if (!file_exists($settingsFile)) {
			self::updateSettingsFile($plugin, false);
		}

		require_once($settingsFile);
	}

	public static function updateSettingsFile($plugin, $showSuccessMsg = true) {
		global $REX, $I18N;

		$settingsFile = self::getSettingsFile($plugin);
		$msg = self::checkDirForFile($settingsFile);

		if ($msg != '') {
			if ($REX['REDAXO']) {
				echo rex_warning($msg);			
			}
		} else {
			if (!file_exists($settingsFile)) {
				self::createDynFile($settingsFile);
			}

			$content = "<?php\n\n";
		
			foreach ((array) $REX['ADDON'][$plugin]['settings'] as $key => $value) {
				$content .= "\$REX['ADDON']['" . $plugin . "']['settings']['$key'] = " . var_export($value, true) . ";\n";
			}

			if (rex_put_file_contents($settingsFile, $content)) {
				if ($REX['REDAXO'] && $showSuccessMsg) {
					echo rex_info($I18N->msg('be_utilities_config_ok'));
				}
			} else {
				if ($REX['REDAXO']) {
					echo rex_warning($I18N->msg('be_utilities_config_error'));
				}
			}
		}
	}

	public static function replaceSettings($plugin, $settings) {
		global $REX;

		// type conversion
		foreach ($REX['ADDON'][$plugin]['settings'] as $key => $value) {
			if (isset($settings[$key])) {
				$settings[$key] = self::convertVarType($value, $settings[$key]);
			}
		}

		$REX['ADDON'][$plugin]['settings'] = array_merge((array) $REX['ADDON'][$plugin]['settings'], $settings);
	}

	public static function createDynFile($file) {
		$fileHandle = fopen($file, 'w');

		fwrite($fileHandle, "<?php\r\n");
		fwrite($fileHandle, "// --- DYN\r\n");
		fwrite($fileHandle, "// --- /DYN\r\n");

		fclose($fileHandle);
	}

	public static function checkDir($dir) {
		global $REX, $I18N;

		$path = $dir;

		if (!@is_dir($path)) {
			@mkdir($path, $REX['DIRPERM'], true);
		}

		if (!@is_dir($path)) {
			if ($REX['REDAXO']) {
				return $I18N->msg('be_utilities_install_make_dir', $dir);
			}
		} elseif (!@is_writable($path . '/.')) {
			if ($REX['REDAXO']) {
				return $I18N->msg('be_utilities_install_perm_dir', $dir);
			}
		}
		
		return '';
	}

	public static function checkDirForFile($fileWithPath) {
		$pathInfo = pathinfo($fileWithPath);

		return self::checkDir($pathInfo['dirname']);
	}

	public static function convertVarType($originalValue, $newValue) {
		$arrayDelimiter = ',';

		switch (gettype($originalValue)) {
			case 'string':
				return trim($newValue);
				break;
			case 'integer':
				return intval($newValue);
				break;
			case 'boolean':
				return (bool) $newValue;
				break;
			case 'array':
				if ($newValue == '') {
					return array();
				} else {
					return explode($arrayDelimiter, $newValue);
				}
				break;
			default:
				return $newValue;
				
		}
	}
}
?>
