<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Die Basisklasse aller Controller
 */
abstract class Controller {

	/**
	 * Speichert die aktuelle url
	 * @var Request
	 */
	public $request;

	/**
	 * Speichert die Datenbank
	 * @var mysqli
	 */
	public $db;

	public function __construct($request) {
		$this->request = $request;
		$this->loadDb();
	}

	/**
	 * Datenbank laden
	 */
	private function loadDb() {
		// TODO Anmeldedaten
		$this->db = new mysqli();
	}

	/**
	 * Neues Model laden
	 * @param string $name Der Name des Models
	 * @return mixed Eine Instanz des Models
	 */
	public function loadModel($name) {
		$name = strtolower($name);
		$path = PATH_MODELS . "/$name.php";
		if (file_exists($path)) {
			require_once $path;
			$class = $name . "Model";
			if (class_exists($class)) {
				return new $class($this->db);
			}
		}
	}

	/**
	 * Rendert die aktuelle Seite
	 * @param array $data [optional] Enthält variablen für das Template
	 * @param string $view_name [optional] Der Name der View, zB 'home/index'
	 */
	public function render($data = array(), $view_name = NULL) {

		$view_name = strtolower(($view_name !== NULL) ? $view_name : $this->request->controller_name . "/" . $this->request->action_name);

		// Twig einbinden
		require_once PATH_TWIG . "/lib/Twig/Autoloader.php";

		// Twig Autoloader registrieren
		Twig_Autoloader::register();

		// Twig laden
		$twig_loader = new Twig_Loader_Filesystem(PATH_VIEWS);
		$twig = new Twig_Environment($twig_loader);

		// Twig rendern. $data enthält die Variablen, die man im Template benutzen kann
		echo $twig->render($view_name . ".twig", $data);
	}

	/**
	 * Standard-Action, muss in jedem Controller vorhanden sein
	 */
	abstract public function IndexAction();
}
