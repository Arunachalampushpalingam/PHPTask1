<?php
require_once '../config/database.php';
class Employee
{
    private $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    public function employeelist()
    {
        echo "testers";
    }
    public function applyresignation()
    {
        echo "testers";
    }
    public function resignation_status_update()
    {
        echo "testers";
    }
}
?>