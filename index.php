<?php

/**
 * Ein kleines simples php mvc framework
 * @author Max Klein <max@kleinleibold.de>
 */

/**
 * Diese Konstante wird in eingebundenen Dateien überprüft um direkten Zugriff zu verhindern.
 */
define('_EXEC', 1);

/**
 * Für das error handling
 */
define('ENVIRONMENT', "debug");

if(defined('ENVIRONMENT')) {
	switch (ENVIRONMENT) {
		case "debug":
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
			break;
		case "production":
			ini_set('display_errors', 0);
			error_reporting(0);
			break;
		default:
			break;
	}
}

/**
 * Konstante für das Hauptverzeichnis.
 */
define('PATH_BASE', dirname(__FILE__));

//Die restlichen Konstanten definieren.
require_once PATH_BASE . "/includes/defines.php";

//Enthält die Application-Klasse
require_once PATH_INCLUDES . "/controller.php";
require_once PATH_INCLUDES . "/framework.php";

// Request erstellen
$request = new Request();

// Hauptklasse instantiieren
$app = new Application($request);

// Ausgabe des HTML-Codes
echo $app->execute();
