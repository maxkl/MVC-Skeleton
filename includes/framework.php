<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Die Hauptklasse.
 *
 * Hier wird entschieden welche/r Controller/Action ausgeführt werden soll
 * und es wird der HTML-Code zusammengestellt
 *
 * @author Max Klein <max@kleinleibold.de>
 */
class Application {

	/**
	 * $request enthält alle GET und POST Parameter
	 *
	 * @var Request
	 */
	private $request;

	/**
	 * Hier werden der passende Controller instantiiert und seine passende Methode aufgerufen
	 *
	 * @param Request $request Enthält alle GET und POST Parameter
	 */
	public function __construct($request) {
		$this->request = $request;

		// Controller, Action und Argumente auslesen
		Router::route($this->request);
	}

	private function dispatch() {
		// Pfad zur Datei des Controllers. Der Dateiname muss in Kleinbuchstaben sein!
		// Bsp.: / ... /controllers/home.php
		$controller_file = PATH_CONTROLLERS . "/" . strtolower($this->request->controller_name) . ".php";

		if (file_exists($controller_file)) {
			// Datei des Controllers einbinden
			require_once $controller_file;
		}

		// Groß-/Kleinschreibung ist egal
		// Bsp.: HomeController
		$controller_class = $this->request->controller_name . "Controller";

		// Groß-/Kleinschreibung ist egal
		// Bsp.: IndexAction
		$controller_method = $this->request->action_name . "Action";

		if (class_exists($controller_class) && method_exists($controller_class, $controller_method)) {
			// Controller instantiieren
			//$controller = new $controller_class($this->request);
			//if (method_exists($controller_class, $controller_method)) {
			// TODO
			//$controller = new $controller_class($this->request);
			//$controller->$controller_method();
			//}
		} else {
			require_once PATH_CONTROLLERS . "/error.php";
			$controller_class = "ErrorController";
			$controller_method = "404";
		}

		$controller = new $controller_class($this->request);
		$controller->$controller_method();
	}

	/**
	 * Erzeugt den endgültigen HTML-Code
	 *
	 * @return string Der HTML-Code
	 */
	public function execute() {
		ob_start();

		$this->dispatch();

		return ob_get_clean();
	}

}

/**
 * Setzt Controller und Action mithilfe des requests
 */
class Router {

	/**
	 * Wenn der Controller nicht angegeben wird,
	 * wird dieser Wert benutzt
	 *
	 * @var string
	 */
	public static $default_controller = "home";

	/**
	 * Wenn die Action nicht angegeben wird,
	 * wird dieser Wert benutzt
	 *
	 * @var string
	 */
	public static $default_action = "index";

	/**
	 * Extrahiert Controller, Action und Argumente aus $path
	 *
	 * @param Request $request Das request-Objekt das geroutet werden soll
	 */
	public static function route(&$request) {
		$path = $request->path;
		$path = preg_replace("(^/+|/+$|\s)", "", $path);
		$path = preg_replace("(/+)", "/", $path);

		$parts = ($path !== "") ? explode("/", $path) : array();
		$request->controller_name = count($parts) >= 1 ? $parts[0] : self::$default_controller;
		$request->action_name = count($parts) >= 2 ? $parts[1] : self::$default_action;
		$request->params = count($parts) >= 3 ? array_slice($parts, 2) : array();
	}

}

/**
 * Repräsentiert eine Anfrage an den Server
 */
class Request {

	/**
	 * Enthält alle $_GET und $_POST parameter
	 *
	 * @var array
	 */
	public $params;

	/**
	 * Der angeforderte Pfad
	 * zB: /home/login
	 *
	 * @var string
	 */
	public $path;

	/**
	 * Der Name des Controllers
	 *
	 * @var string
	 */
	public $controller_name;

	/**
	 * Die Methode des Controllers
	 * zB: 'login' bei /home/login
	 *
	 * @var string
	 */
	public $action_name;

	/**
	 * Führt GET und POST zusammen
	 * und setzt $path
	 */
	public function __construct() {
		$this->params = array_merge($_POST, $_GET);

		$this->path = isset($this->params['path']) ? $this->params['path'] : "";
	}

}
