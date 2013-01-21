<?php

class rex_extension_manager {
	var $extensions;

	function __construct() {
		$this->extensions = array();
	}

	function addExtension($extension) {
		global $REX;
	
		$extensionName = $extension->getName();

		$REX['ADDON']['page'][$extensionName] = $extensionName;
		$REX['ADDON']['version'][$extensionName] = $extension->getVersion();
		$REX['ADDON']['author'][$extensionName] = $extension->getAuthor();
		$REX['ADDON']['supportpage'][$extensionName] = $extension->getSupportPage();

		if ($extension->getPermission() != '') {
			$REX['ADDON']['perm'][$extensionName] = $extension->getPermission();
			$REX['PERM'][] = $extension->getPermission();
		}
		
		if ($extension->hasBackendPage()) {
			$REX['ADDON']['be_extensions']['SUBPAGES'][] = array('plugin.' . $extensionName, $extension->getTitle());
		}
	
		$this->extensions[] = $extension;
	}

	function getExtensions() {
		return $this->extensions;
	}

	function getExtension($name) {
		for ($i = 0; $i < count($this->extensions); $i++) {
			if ($this->extensions[$i]->getName() == $name) {
				return $this->extensions[$i];
			}
		}
	}
}
