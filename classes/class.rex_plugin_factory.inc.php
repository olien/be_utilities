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

	static function printPluginList($addon, $headline, $noPluginsAvailabeMsg) {
		$plugins = self::getAvailablePlugins($addon);

		if (count($plugins) < 1) {
			echo rex_info($noPluginsAvailabeMsg);
		} else {
			echo '<table id="be-utilities-overview" class="rex-table">';
			echo '<tr><th>' . $headline . '</th></tr>';

			foreach ($plugins as $plugin) {
				// description
				$htmlDescription = '';
				$description = self::getPluginDescription($addon, $plugin);

				if ($description != '') {
					$htmlDescription = '<p>' . $description . '</p>';
				}

				// link
				$htmlLink = 'index.php?page=' . $addon . '&amp;subpage=plugin.' . $plugin;

				// title and css class
				if (self::hasPluginSubpage($addon, $plugin)) {
					$htmlTitle = '<a href="' . $htmlLink . '">' .  self::getPluginTitle($addon, $plugin) . '</a>' . $htmlDescription;
					$htmlIcon = '<a href="' . $htmlLink . '"><div class="plugin-icon"></div></a>';
				} else {
					$htmlTitle = '<span>' .  self::getPluginTitle($addon, $plugin) . '</span>' . $htmlDescription;
					$htmlIcon = '<div class="plugin-icon grey"></div>';
				}

				// table row
				echo '<tr><td>' . $htmlIcon . '<div class="right">';
				echo $htmlTitle;
				echo '</div></td></tr>';
			}

			echo '</table>';
		}
	}

	static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}
}
