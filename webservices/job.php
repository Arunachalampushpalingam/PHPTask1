<?php
require_once '../config/database.php';
class Job
{
    private $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    public function createjob($post_data)
    {
        $code = $post_data['code'];
        $position = $post_data['position'];
        $description = $post_data['description'];
        $experience = $post_data['experience'];
        $skillset = $post_data['skillset'];
        $start_date = $post_data['start_date'];
        $end_date = $post_data['end_date'];
        $job_category = $post_data['job_category'];
        $job_subcategory = $post_data['job_subcategory'];
        $company_id = $post_data['company_id'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        $sql = "INSERT INTO  tbo_jobs (code, position, description, experience, skillset, start_date, end_date, job_category, job_subcategory, company_id, created_at, updated_at)
        VALUES ('$code', '$position', '$description', '$experience', '$skillset','$start_date', '$end_date', '$job_category','$job_subcategory','$company_id ','$created_at','$updated_at');
        ";

        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }
    public function createcategory($post_data)
    {

        $category_name = $post_data['category_name'];
        $category_desc = $post_data['category_desc'];
        $job_level = $post_data['job_level'];
        $company_id = $post_data['company_id'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        $sql = "INSERT INTO tbo_jobcategory (category_name, category_desc, job_level, company_id, created_at, updated_at) 
        VALUES ('$category_name', '$category_desc', $job_level, $company_id, '$created_at', '$updated_at')";


        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }
    public function createsubcategory($post_data)
    {


        $subcategory_name = $post_data['subcategory_name'];
        $subcategory_desc = $post_data['subcategory_desc'];
        $category_id = $post_data['category_id'];
        $company_id = $post_data['company_id'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        $sql = "INSERT INTO tbo_jobsubcategory (subcategory_name, subcategory_desc, category_id, company_id, created_at, updated_at) 
        VALUES ('$subcategory_name', '$subcategory_desc', $category_id, $company_id, '$created_at', '$updated_at')";


        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }
    public function createjobgrade($post_data)
    {

        $grade_name = $post_data['grade_name'];
        $grade_description = $post_data['grade_description'];
        $company_id = $post_data['company_id'];
        $created_by_id = $post_data['created_by_id'];
        $created_at = $post_data['created_at']; // Assuming it is a datetime string (e.g., '2023-08-03 10:00:00')
        $updated_at = $post_data['updated_at']; // Assuming it is a datetime string (e.g., '2023-08-03 11:00:00')

        $sql = "INSERT INTO tbo_jobgrade (grade_name, grade_description, company_id, created_by_id, created_at, updated_at) 
        VALUES ('$grade_name', '$grade_description', $company_id, $created_by_id, '$created_at', '$updated_at')";


        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }
    public function jobgradelist()
    {
        $data = array();
        $res = array();
        $sql = "SELECT * FROM   tbo_jobgrade";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res['status'] = '200';
            $res['message'] = 'data fetched successfully';
            $res['data'] = $data;

        } else {
            $res['status'] = '200';
            $res['message'] = 'unable to fetch data';
            $res['data'] = '';

        }
        return $res;
    }
    public function categorylist()
    {
        $data = array();
        $res = array();
        $sql = "SELECT * FROM   tbo_jobcategory";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res['status'] = '200';
            $res['message'] = 'data fetched successfully';
            $res['data'] = $data;

        } else {
            $res['status'] = '200';
            $res['message'] = 'unable to fetch data';
            $res['data'] = '';

        }
        return $res;
    }
    public function subcategorylist()
    {
        $data = array();
        $res = array();
        $sql = "SELECT * FROM  tbo_jobsubcategory";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res['status'] = '200';
            $res['message'] = 'data fetched successfully';
            $res['data'] = $data;

        } else {
            $res['status'] = '200';
            $res['message'] = 'unable to fetch data';
            $res['data'] = '';

        }
        return $res;
    }
    public function joblist($post_data)
    {
        $data = array();
        $res = array();
        $sql = "SELECT *
        FROM tbo_jobs
        INNER JOIN tbo_jobcategory ON tbo_jobs.job_category = tbo_jobcategory.id
        INNER JOIN tbo_jobsubcategory ON tbo_jobs.job_subcategory = tbo_jobsubcategory.id
        INNER JOIN tbo_jobsubcategory ON tbo_jobs.job_subcategory = tbo_jobsubcategory.id
        where  tbo_jobs.company_id='" . $post_data['company_id'] . "'";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res['status'] = '200';
            $res['message'] = 'data fetched successfully';
            $res['data'] = $data;

        } else {
            $res['status'] = '200';
            $res['message'] = 'unable to fetch data';
            $res['data'] = '';

        }
        return $res;
    }
}

?>