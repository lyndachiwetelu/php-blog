<?php declare(strict_types=1);

namespace App\Helpers;

class Request
{
	protected $request;

	public function __construct($request)
	{
		$this->request = $request;
		return $this->request;
	}

	public function get($key)
	{
		if (isset($this->request[$key])) {
			return $this->request[$key];
		}

		return null;
	}
}