<?php

class Database
{
	private static $instance = null;
	private $conn;

	private $host = 'localhost';
	private $username = 'root';
	private $password = 'root';
	private $database = 'HRM';
	private function __construct()
	{
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function getConnection()
	{
		return $this->conn;
	}
}
?>