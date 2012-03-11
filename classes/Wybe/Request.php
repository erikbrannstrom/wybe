<?php

namespace Wybe;

/**
 * HTTP Request
 *
 * Class for encapsulating a simple HTTP request representation.
 */
class Request
{
	/**
	 * Application's base URL
	 */
	public $baseUrl;

	/**
	 * URL of current HTTP request
	 */
	public $url;

	/**
	 * Construct a new request object, automatically setting the public variables.
	 */
	public function __construct()
	{
		$this->baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
		$this->url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	/**
	 * Return the path of the current request.
	 *
	 * @return string Request path
	 */
	public function getPath()
	{
		return str_replace($this->baseUrl, '', $this->url);
	}
}