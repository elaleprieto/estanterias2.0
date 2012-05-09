<?php
	/**
	 * Application level Controller
	 *
	 * This file is application-wide controller file. You can put all
	 * application-wide controller-related methods here.
	 *
	 * PHP versions 4 and 5
	 *
	 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
	 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
	 * @link          http://cakephp.org CakePHP(tm) Project
	 * @package       cake
	 * @subpackage    cake.app
	 * @since         CakePHP(tm) v 0.2.9
	 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
	 */

	/**
	 * Application Controller
	 *
	 * Add your application-wide methods in the class below, your controllers
	 * will inherit them.
	 *
	 * @package       cake
	 * @subpackage    cake.app
	 */
	class AppController extends Controller {
		var $components = array('RequestHandler', 'Session');

		public function beforeFilter() {
			// check for mobile devices
			if ($this -> RequestHandler -> isMobile()) {
				// if device is mobile, change layout to mobile
				$this -> layout = 'mobile';
				// and if a mobile view file has been created for the action, serve it instead of the default view file
				$mobileViewFile = VIEWS . strtolower($this -> params['controller']) . '/mobile/' . $this -> params['action'] . '.ctp';
				if (file_exists($mobileViewFile)) {
					$mobileView = strtolower($this -> params['controller']) . '/mobile/';
					$this -> viewPath = $mobileView;
				}
			} else if(isset($this->params['admin'])) {
				$this->layout = 'admin';
			} else if(isset($this->params['mostrador'])) {
				$this->layout = 'mostrador';
			}
		}

	}
