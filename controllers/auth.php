<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * DIeser Controller regelt die Benutzerverwaltung (Anmelden, Abmelden, Registrieren, ...)
 */
class AuthController extends Controller {

	/**
	 * Wird nicht benutzt
	 */
	public function IndexAction() {

	}

	/**
	 * Nur ein Platzhalter
	 */
	public function LoginAction() {
		$vars = array();
		$vars['title'] = "Fehler";

		$this->render($vars, "error/index");
	}
}