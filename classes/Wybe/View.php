<?php

namespace Wybe;

/**
 * View
 *
 * Class for representing a view and its available view variables.
 */
class View {
	private $_view;
	private $_data = array();

	/**
	 * Magic setter for storing view variables.
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}

	/**
	 * Magic getter for fetching the value of a view variable.
	 * If no such variable exists, an exception is thrown.
	 */
	public function __get($key) {
		if (array_key_exists($key, $this->_data)) {
			return $this->_data[$key];
		} else {
			throw new Exception("No such variable: " . $key);
		}
	}

	/**
	 * Construct a new view object based on the file specified.
	 *
	 * @param string $view Path to view file, excluding file extension (.phtml)
	 */
	public function __construct($view) {
		$this->_view = $view;
	}

	/**
	 * Factory method for creating view objects.
	 *
	 * @param string $view Path to view file, excluding file extension (.phtml)
	 * @return View 
	 */
	public static function create($view) {
		return new self($view);
	}

	/**
	 * Render the view by loading the view file, which automaticially sends
	 * the response to the browser.
	 *
	 * @param array $data View data parameters
	 */
	public function render(array $data = array()) {
		$this->_data = array_merge($this->_data, $data);
		require_once($this->_view . '.phtml');
	}

}