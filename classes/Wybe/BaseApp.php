<?php

namespace Wybe;

/**
 * BaseApp
 * 
 * Abstract class that the main application should extend. It contains
 * much of the basic logic required to run an app.
 */
abstract class BaseApp
{
	protected $config;
	protected $request;
	
	/**
	 * Create a new application with the specified configuration.
	 * 
	 * @param array $config Array containing configuration values
	 */
	public function __construct(array $config = array())
	{
		$this->request = new Request();
		$this->config = new Config();
		$this->config->load($config);
	}

	/**
	 * Returns the object containing configuration settings.
	 * 
	 * @return Config
	 */
	public function config()
	{
		return $this->config;
	}

	/**
	 * Returns the HTTP request object.
	 * 
	 * @return Request
	 */
	public function request()
	{
		return $this->request;
	}

	/**
	 * Run the application, effectively finding a matching route and
	 * execute the defined action.
	 */
	public function run()
	{
		// Fetch routes and URL path
		$routes = $this->config()->get('app.routes');
		$path = $this->request()->getPath();

		$match = false;

		// Loop through the routes to find a match
		foreach ($routes as $route => $action) {
			if ($path == $route) {
				// Check for exact match of route
				$match = array('route' => $route, 'action' => $action);
			} else {
				// Perform pattern matching of routes against path
				$routeMatches = array();
				preg_match_all('/:(?P<params>[a-z]+)(\/|\z)/', $route, $routeMatches);
				
				// Create route regex
				$regexRoute = str_replace('/', '\/', $route);
				foreach ($routeMatches['params'] as $param) {
					$regexRoute = str_replace(':' . $param, '(?P<values>[a-zA-Z0-9\-_.]+)', $regexRoute);
				}
				$regexRoute = '/^' . $regexRoute . '$/';
				
				$regexPath = array();
				// Check for match
				if (preg_match_all($regexRoute, $path, $regexPath)) {
					$match = array('route' => $route, 'action' => $action, 'params' => array_combine($routeMatches['params'], $regexPath['values']));
				}
			}

			if ($match !== false) {
				break;
			}
		}

		if ($match === false) {
			throw new \Exception("No matching route found.");
		} else {
			$match['action']($match['params']);
		}
	}

}