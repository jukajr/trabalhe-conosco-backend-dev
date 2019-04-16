<?php

use MongoDB\Client;

class Base {
	protected $client;

	protected $collection;

	function __construct() {
		$user = env('DB_USERNAME');
		$pwd = env('DB_PASSWORD');
		$host = env('DB_HOST');
		$port = env('DB_PORT');

		$this->client = new Client("mongodb://${user}:${pwd}@${host}:${port}");
	}
}