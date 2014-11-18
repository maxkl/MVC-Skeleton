<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Soll später die Nutzer verwalten
 */
class UsersModel {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getName() {
		return "Peter";
	}
}