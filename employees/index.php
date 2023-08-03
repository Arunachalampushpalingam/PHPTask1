<?php
require_once '../webservices/job.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "tester";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    echo "tester2";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'resignationapply') {
    echo "tester2";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'resignation_status_update') {
    echo "tester2";
}
?>