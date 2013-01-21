<?php

class rex_extension {
	var $name;
	var $title;
	var $description;
	var $version;
	var $author;
	var $supportPage;
	var $hasBackendPage;
	var $permission;

	function __construct($name, $title, $description, $version, $author, $supportPage, $hasBackendPage, $permission = '') {
		$this->name = $name;
		$this->title = $title;
		$this->description = $description;
		$this->version = $version;
		$this->author = $author;
		$this->supportPage = $supportPage;
		$this->hasBackendPage = $hasBackendPage;
		$this->permission = $permission;
	}

	function getName() {
		return $this->name;
	}

	function getTitle() {
		return $this->title;
	}

	function getDescription() {
		return $this->description;
	}

	function getVersion() {
		return $this->version;
	}

	function getAuthor() {
		return $this->author;
	}

	function getSupportPage() {
		return $this->supportPage;
	}

	function hasBackendPage() {
		return $this->hasBackendPage;
	}

	function getPermission() {
		return $this->permission;
	}
}
