<?php
require_once '../config/database.php';
class Company
{
    private $conn;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    public function createcompany($post_data)
    {
        // Assuming $post_data contains the necessary values

        $company_name = $post_data['company_name'];
        $company_address = $post_data['company_address'];
        $domain = $post_data['domain'];
        $country = $post_data['country'];
        $state = $post_data['state'];
        $city = $post_data['city'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        $sql = "INSERT INTO tbo_company (company_name, company_address, domain, country, state, city, created_at, updated_at) 
        VALUES ('$company_name', '$company_address', '$domain', '$country', '$state', '$city', '$created_at', '$updated_at')";

        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }

    public function companieslist()
    {
        $data = array();
        $res = array();
        $sql = "SELECT * FROM tbo_company";
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