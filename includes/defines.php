<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Konstanten für die verschiedenen Verzeichnisse
 */
define('PATH_PUBLIC', PATH_BASE . "/public");
define('PATH_INCLUDES', PATH_BASE . "/includes");

/**
 * Pfad zur Twig Template engine
 */
define('PATH_TWIG', PATH_BASE . "/Twig");

define('PATH_MODELS', PATH_BASE . "/models");
define('PATH_VIEWS', PATH_BASE . "/views");
define('PATH_CONTROLLERS', PATH_BASE . "/controllers");

/**
 * Die Url unter der die Seite läuft
 */
define('URL', rtrim('http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']), "/"));
