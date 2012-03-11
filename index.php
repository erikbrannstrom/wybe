<?php

/**
 * Autoloader
 * 
 * The autoloader is based on the PSR-0 standard, though it expects classes
 * to be found in the classes folder. Also, app-specific classes are not 
 * expected to have a vendor namespace, which is a digression from PSR-0.
 */
spl_autoload_register(function ($class) {
	$base = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
	$classPath = str_replace('\\', '/', $class);
	$classPath = str_replace('_', '/', $classPath);
    
    if (file_exists($base . $classPath . '.php')) {
        require $base . $classPath . '.php';
    } else if (file_exists($base . 'Wybe/' . $classPath . '.php')) {
    	require $base . 'Wybe/' . $classPath . '.php';
    	\class_alias('Wybe\\' . $class, $class);
    }
});

/**
 * Let's get this show on the road.
 *
 * Load config array, instantiate the application object and run!
 */

$config = require 'config.php';
$app = new \App($config);
$app->run();