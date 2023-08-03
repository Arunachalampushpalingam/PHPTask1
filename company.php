<?php
require_once 'config/database.php';
class Company
{
    private $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
}

?>