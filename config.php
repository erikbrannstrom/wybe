<?php

/**
 * Application configuration
 *
 * This file must return an array containing the required
 * application configuration settings.
 */

return array(

	// Set up application routes
	'app.routes' => array(

		// Example base route
		'/' => function ($params = null) {
			View::create('views/index')->render(array(
				'title' => 'My first Barebones application!'
			));
		},

		// Example profile route
		'/users/:name' => function ($params = null) {
			View::create('views/index')->render(array(
				'title' => 'Welcome home, ' . $params['name']
			));
		},

	)

);