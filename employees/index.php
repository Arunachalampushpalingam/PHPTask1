<?php
require_once '../webservices/employee.php';
$employee = new Employee();

//Employee list
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'employeelist') {


    $post_data = json_decode($_POST['filter_query'], true);
    $data = $employee->employeelist($post_data);
    echo json_encode($data);
}

//createemployee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'createemployee') {

    $post_data = json_decode($_POST['employee_data'], true);
    $data = $employee->createemployee($post_data);
    echo json_encode($data);
}

//Resignation apply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'resignationapply') {

    $post_data = json_decode($_POST['resignation_data'], true);
    $data = $employee->applyresignation($post_data);
    echo json_encode($data);
}

//update resignation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'resignation_status_update') {

    $post_data = json_decode($_POST['resignation_data'], true);
    $data = $employee->resignation_status_update($post_data);
    echo json_encode($data);
}
?>