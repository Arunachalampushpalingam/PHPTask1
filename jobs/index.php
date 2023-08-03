<?php
require_once '../webservices/job.php';
$jobs = new Job();

//job list
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $post_data = json_decode($_POST['filter_query'], true);
    $data = $jobs->joblist($post_data);
    echo json_encode($data);
}

//categorylist
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_POST['action']) && $_POST['action'] == 'categorylist') {

    $post_data = json_decode($_POST['job_data'], true);
    $data = $jobs->categorylist();
    echo json_encode($data);
}

//subcategorylist
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_POST['action']) && $_POST['action'] == 'subcategorylist') {

    $post_data = json_decode($_POST['job_data'], true);
    $data = $jobs->subcategorylist();
    echo json_encode($data);
}

//jobgradelist
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_POST['action']) && $_POST['action'] == 'jobgradelist') {
    $post_data = json_decode($_POST['job_data'], true);
    $data = $jobs->jobgradelist();
    echo json_encode($data);
}

//createjob
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'createjob') {
    $post_data = json_decode($_POST['job_data'], true);
    $data = $jobs->createjob($post_data);
    echo json_encode($data);
}

//createcategory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'createcategory') {
    $post_data = json_decode($_POST['category_data'], true);
    $data = $jobs->createcategory($post_data);
    echo json_encode($data);
}

//createsubcategory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'createsubcategory') {
    $post_data = json_decode($_POST['subcategory_data'], true);
    $data = $jobs->createsubcategory($post_data);
    echo json_encode($data);
}

//createjobgrade
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'createjobgrade') {

    $post_data = json_decode($_POST['jobgrade_data'], true);
    $data = $jobs->createjobgrade($post_data);
    echo json_encode($data);
}
?>