<?php
require_once 'config/database.php';
class Job
{
    private $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
}

?>