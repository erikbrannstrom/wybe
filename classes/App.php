<?php

/**
 * Application
 *
 * Main application class that extends abstract Wybe\BaseApp.
 */
class App extends \Wybe\BaseApp
{
	
	/**
	 * Construct a new application using the specified configuration
	 * data.
	 *
	 * @param array $config Configuration data
	 */
	function __construct(array $config = array())
	{
		parent::__construct($config);
	}
}