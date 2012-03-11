<?php

namespace Wybe;

/**
 * Configuration
 *
 * Stores and provides access to configuration variables belonging
 * to either an application or some other object or library.
 */
class Config
{
	private $data = array();

	/**
	 * Set a configuration variable. If key already exists, the old
	 * value will be overwritten without warning.
	 *
	 * @param string|integer $key Accessor for a stored value
	 * @param mixed $value Configuration value
	 */
	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Returns the configuration value belonging to a specified key.
	 * If the key does not exist, an exception will be thrown.
	 *
	 * @param string|integer $key Accessor for a stored value
	 * @return mixed Configuration value
	 */
	public function get($key) {
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		} else {
			throw new \Exception("No such config item: " . $key);
		}
	}

	/**
	 * Load an array into the configuration object. For each key/value pair
	 * the object's set function will be called.
	 *
	 * @param array $data Configuration data
	 */
	public function load(array $data)
	{
		foreach ($data as $key => $value) {
			$this->set($key, $value);
		}
	}

}