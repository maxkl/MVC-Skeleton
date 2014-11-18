<?php

/**
 * Um den direkten Zugriff zu verhindern.
 */
defined('_EXEC') or die();

/**
 * Der Standar Controller
 * @author Max Klein <max@kleinleibold.de>
 */
class HomeController extends Controller {

	/**
	 * Zeigt die Startseite
	 */
	public function IndexAction() {
		$vars = array();
		$vars['title'] = "Startseite";

		// Um loadModel zu testen
		$testmodel = $this->loadModel('Test');
		$vars['baumfarbe'] = $testmodel->getTestVar();

		// Diese array kann im Twig-Template als test_array ausgelesen werden
		$vars['test_array'] = array();
		$vars['test_array'][] = "Das Auto ist rot";
		$vars['test_array'][] = "Das Boot ist blau";

		$this->render($vars);
	}

	/**
	 * Zeigt ein Login formular
	 */
	public function LoginAction() {
		$vars = array();
		$vars['title'] = "Anmelden";

		$this->render($vars);
	}
}