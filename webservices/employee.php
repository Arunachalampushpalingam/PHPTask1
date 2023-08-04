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

    // Get employeelist
    public function employeelist($post_data)
    {

        $data = array();
        $res = array();
        $sql = "SELECT 
        emp.id AS employee_id,
        emp.emp_code,
        emp.first_name,
        emp.last_name,
        emp.department,
        emp.designation,
        emp.joining_date,
        emp.last_date_of_employment,
        emp.salary,
        emp.country,
        emp.state,
        emp.city,
        emp.status,
        emp.company_id,
        emp.created_at,
        emp.updated_at,
        GROUP_CONCAT(DISTINCT CONCAT_WS('|', qual.id, qual.institution_name, qual.percentage, qual.year_of_passing, qual.created_at, qual.updated_at)) AS qualifications,
        GROUP_CONCAT(DISTINCT CONCAT_WS('|', exp.id, exp.job_title, exp.job_description, exp.joining_date, exp.relieving_date, exp.achievements, exp.reference_name, exp.reference_contact)) AS experiences
        FROM 
            tbo_employee AS emp
        LEFT JOIN 
            tbo_employee_qualification AS qual ON emp.id = qual.employee_id
        LEFT JOIN 
            tbo_employee_previous_experience AS exp ON emp.id = exp.employee_id";
        $sql .= ' where 1=1 ';
        //Filter by position
        if (isset($post_data['position']) && $post_data['position'] != '') {
            $sql .= '  && emp.designation=' . $post_data['position'] . '';
        }
        //Filter by emp status
        if (isset($post_data['status']) && $post_data['status'] != '') {
            $sql .= ' AND emp.status = "' . $post_data['status'] . '"';
        }
        //filter by salary
        if (isset($post_data['min_salary']) && $post_data['min_salary'] != '' && isset($post_data['max_salary']) && $post_data['max_salary'] != '') {
            $sql .= ' AND emp.salary BETWEEN ' . $post_data['min_salary'] . ' AND ' . $post_data['max_salary'];
        }

        $sql .= "  GROUP BY emp.id;";

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

    // createemployee
    public function createemployee($post_data)
    {

        $emp_code = 'EMP' . rand();
        $first_name = $post_data['first_name'];
        $last_name = $post_data['last_name'];
        $department = $post_data['department'];
        $designation = $post_data['designation'];
        $joining_date = $post_data['joining_date'];
        $last_date_of_employment = $post_data['last_date_of_employment'];
        $salary = $post_data['salary'];
        $country = $post_data['country'];
        $state = $post_data['state'];
        $city = $post_data['city'];
        $status = $post_data['status'];
        $company_id = $post_data['company_id'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        //insert employee 
        $sql = "INSERT INTO tbo_employee (emp_code, first_name, last_name, department, designation, joining_date, last_date_of_employment, salary, country, state, city, status, company_id, created_at, updated_at) 
        VALUES ('$emp_code','$first_name','$last_name','$department','$designation','$joining_date','$last_date_of_employment','$salary','$country','$state','$city','$status','$company_id','$created_at','$updated_at')";

        if ($this->conn->query($sql) === TRUE) {

            $emp_last_id = $this->conn->insert_id;
            for ($i = 0; $i < count($post_data['qualification']); $i++) {
                //insert employee qualification
                $employee_id = $emp_last_id;
                $company_id = $post_data['company_id'];
                $institution_name = $post_data['qualification'][$i]['institution_name'];
                $percentage = $post_data['qualification'][$i]['percentage'];
                $year_of_passing = $post_data['qualification'][$i]['year_of_passing'];
                $created_at_qualification = $post_data['qualification'][$i]['created_at_qualification'];
                $updated_at_qualification = $post_data['qualification'][$i]['updated_at_qualification'];

                $sql_qualification = "INSERT INTO tbo_employee_qualification (employee_id, company_id, institution_name, percentage, year_of_passing, created_at, updated_at) 
                VALUES ('$employee_id','$company_id','$institution_name','$percentage','$year_of_passing','$created_at_qualification','$updated_at_qualification')";

                if ($this->conn->query($sql_qualification) === TRUE) {
                    $sql_qualification = true;
                } else {
                    $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);
                }
                //end insert employeee qualification

            }
            if ($sql_qualification === TRUE) {

                //insert employee experience
                for ($i = 0; $i < count($post_data['employee_previous_experience']); $i++) {

                    $employee_id_experience = $emp_last_id;
                    $company_id_experience = $post_data['company_id'];
                    $job_title = $post_data['employee_previous_experience'][$i]['job_title'];
                    $job_description = $post_data['employee_previous_experience'][$i]['job_description'];
                    $joining_date_experience = $post_data['employee_previous_experience'][$i]['joining_date_experience'];
                    $relieving_date = $post_data['employee_previous_experience'][$i]['relieving_date'];
                    $achievements = $post_data['employee_previous_experience'][$i]['achievements'];
                    $reference_name = $post_data['employee_previous_experience'][$i]['reference_name'];
                    $reference_contact = $post_data['employee_previous_experience'][$i]['reference_contact'];


                    $sql_experience = "INSERT INTO tbo_employee_previous_experience (employee_id, company_id, job_title, job_description, joining_date, relieving_date, achievements, reference_name, reference_contact) 
                    VALUES ('$employee_id_experience','$company_id_experience','$job_title','$job_description','$joining_date_experience','$relieving_date','$achievements','$reference_name','$reference_contact')";
                    if ($this->conn->query($sql_experience) === TRUE) {
                        $employee_previous_experience = true;
                    } else {
                        $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);
                    }
                    //end insert employee experience
                }

                if ($employee_previous_experience === TRUE) {
                    $response = array('status' => 1, 'message' => 'Data added successfully');
                }

            } else {
                $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);
            }

        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;

    }


    // applyresignation
    public function applyresignation($post_data)
    {

        $employee_id = $post_data['employee_id'];
        $company_id = $post_data['company_id'];
        $reason_for_leaving = $post_data['reason_for_leaving'];
        $last_date_of_employment = $post_data['last_date_of_employment'];
        $approval_date = $post_data['approval_date'];
        $approved_by = $post_data['approved_by'];
        $status = 'pending';
        $reason_for_rejection = $post_data['reason_for_rejection'];
        $created_at = $post_data['created_at'];
        $updated_at = $post_data['updated_at'];

        $sql = "INSERT INTO tbo_resignation (employee_id, company_id, reason_for_leaving, last_date_of_employment, approval_date, approved_by, status, reason_for_rejection, created_at, updated_at) 
        VALUES ('$employee_id','$company_id','$reason_for_leaving', '$last_date_of_employment', '$approval_date', $approved_by, $status, '$reason_for_rejection', '$created_at', '$updated_at')";

        if ($this->conn->query($sql) === TRUE) {

            $response = array('status' => 1, 'message' => 'Data added successfully');
        } else {

            $response = array('status' => 0, 'message' => 'Error adding data: ' . $this->conn->error);

        }
        return $response;
    }

    // resignation_status_update
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