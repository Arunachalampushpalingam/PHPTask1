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
    public function employeelist($post_data)
    {
        $data = array();
        $res = array();
        $sql = "SELECT * FROM   tbo_employee";
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
    public function createemployee($post_data)
    {
        echo "testers";
    }
    public function applyresignation($post_data)
    {

        $employee_id = $post_data['employee_id'];
        $company_id = $post_data['company_id'];
        $reason_for_leaving = $post_data['reason_for_leaving'];
        $last_date_of_employment = $post_data['last_date_of_employment']; // Assuming it is a date string (e.g., '2023-08-03')
        $approval_date = $post_data['approval_date']; // Assuming it is a date string (e.g., '2023-08-03')
        $approved_by = $post_data['approved_by'];
        $status = 'pending';
        $reason_for_rejection = $post_data['reason_for_rejection'];
        $created_at = $post_data['created_at']; // Assuming it is a datetime string (e.g., '2023-08-03 10:00:00')
        $updated_at = $post_data['updated_at']; // Assuming it is a datetime string (e.g., '2023-08-03 11:00:00')

        $sql = "INSERT INTO tbo_resignation (employee_id, company_id, reason_for_leaving, last_date_of_employment, approval_date, approved_by, status, reason_for_rejection, created_at, updated_at) 
        VALUES ($employee_id, $company_id, '$reason_for_leaving', '$last_date_of_employment', '$approval_date', $approved_by, $status, '$reason_for_rejection', '$created_at', '$updated_at')";



        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }
    public function resignation_status_update($post_data)
    {
        $id = $post_data['resignation_id'];
        $status = $post_data['status'];
        $reason = $post_data['reason'];
        if ($post_data['status'] == 0) {
            $sql = "UPDATE tbo_resignation SET status = '$status',reason_for_rejection='$reason' WHERE id = '$id'";
        } else {

            $sql = "UPDATE tbo_resignation SET status = '$status' WHERE id = '$id'";
        }
        if ($this->conn->query($sql) === TRUE) {
            $response = array('status' => 1, 'message' => 'Data updated successfully');
        } else {
            $response = array('status' => 0, 'message' => 'Error updating data: ' . $this->conn->error);
        }
        return $response;
    }
}
?>