<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Der Error Controller
 * @author Max Klein <max@kleinleibold.de>
 */
class ErrorController extends Controller {

	/**
	 * Zeigt die Startseite
	 */
	public function IndexAction() {
		$vars = array();
		$vars['title'] = "Fehler";

		$this->render($vars);
	}

	public function Error404Action() {
		header("HTTP/1.1 404 Not Found");
		$vars['title'] = "Fehler 404";
		$this->render($vars, "error/404");
	}

	public function Error403Action() {
		header("HTTP/1.1 403 Forbidden");
		$vars['title'] = "Fehler 403";
		$this->render($vars, "error/403");
	}

	public function __call($name, $args) {
		if(preg_match("/[0-9]+/", $name)) {
			$method = "Error{$name}Action";
			if(method_exists($this, $method)) {
				$this->$method();
			}
		}
	}

}
