<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Nur ein Test
 * @author Max Klein <max@kleinleibold.de>
 */
class TestModel {

	private $db;


	public function __construct($db) {
		$this->db = $db;
	}

	public function getTestVar() {
		return "hellbraun";
	}
}