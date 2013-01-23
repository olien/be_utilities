<?php

class rex_plugin_factory {
	static function getPluginTitle($addon, $plugin) {
		return OOPlugin::getProperty($addon, $plugin, 'page');
	}

	static function getPluginDescription($addon, $plugin) {
		return OOPlugin::getProperty($addon, $plugin, 'description');
	}

	static function getAvailablePlugins($addon) {
		return OOPlugin::getAvailablePlugins($addon);
	}

	static function hasPluginSubpage($addon, $plugin) {
		global $REX;

		$hasSubpage = false;

		for ($i = 0; $i < count($REX['ADDON'][$addon]['SUBPAGES']); $i++) {
			if ($REX['ADDON'][$addon]['SUBPAGES'][$i][0] == 'plugin.' . $plugin) {
				$hasSubpage = true;
				break;
			}
		}

		return $hasSubpage;
	}

	static function registerPlugin($addon, $plugin, $title, $description, $version, $author, $supportPage, $hasBackendPage, $permission = '') {
		global $REX;

		$REX['ADDON']['page'][$plugin] = $title;
		$REX['ADDON']['version'][$plugin] = $version;
		$REX['ADDON']['author'][$plugin] = $author;
		$REX['ADDON']['supportpage'][$plugin] =  $supportPage;
		$REX['ADDON']['description'][$plugin] = $description;

		if ($permission != '') {
			$REX['ADDON']['perm'][$plugin] = $permission;
			$REX['PERM'][] = $permission;
		}
		
		if ($hasBackendPage) {
			$REX['ADDON'][$addon]['SUBPAGES'][] = array('plugin.' . $plugin, $title);
		}
	}

	static function printPluginList($addon, $headline) {
		echo '<table class="rex-table">';
		echo '<tr><th>' . $headline . '</th></tr>';

		$plugins = self::getAvailablePlugins($addon);

		foreach ($plugins as $plugin) {
			// description
			$htmlDescription = '';
			$description = self::getPluginDescription($addon, $plugin);

			if ($description != '') {
				$htmlDescription = '<p>&nbsp;&nbsp;&nbsp;' . $description . '</p>';
			}

			echo '<tr><td>&raquo; ';

			// link
			if (self::hasPluginSubpage($addon, $plugin)) {
				echo '<a href="index.php?page=' . $addon . '&amp;subpage=plugin.' . $plugin . '">' .  self::getPluginTitle($addon, $plugin) . '</a>' . $htmlDescription;
			} else {
				echo '<span>' .  self::getPluginTitle($addon, $plugin) . '</span>' . $htmlDescription;
			}

			echo '</td></tr>';
		}
	
		echo '</table>';
	}
}
