<?php

require_once '../webservices/company.php';
$company = new Company();

//company
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $data = $company->companieslist();
    echo json_encode($data);

}

// create company
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {

    $post_data = json_decode($_POST['company_data'], true);
    $data = $company->createcompany($post_data);
    echo json_encode($data);
}
?>