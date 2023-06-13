<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/RestController.php';

class ApiEmployeeController extends RestController
{
    public function __construct()    
    {
       parent::__construct();
       $this->load->model('EmployeeModel'); 
    }

    public function index_get()
    {
        $employee = new EmployeeModel;
        $result_emp = $employee->get_employee();
        $this->response($result_emp, 200);
    }

    public function storeEmployee_post()
    {
        $employee = new EmployeeModel;
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
        ];
        $result = $employee->insertEmployee($data);

        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'New Employee Created'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'Failed TO Create Employee'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function findEmployee_get($id)
    {
        $employee = new EmployeeModel;
        $result = $employee->editEmployee($id);
        $this->response($result, 200);
    }

    public function updateEmployee_post($id)
    {
            $employee = new EmployeeModel;
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            ];
            $update_result = $employee->update_Employee($id, $data);
            if($update_result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'Employee Updated'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'Failed TO Update Employee'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteEmployee_get($id)
    {
            $employee = new EmployeeModel;
            $result = $employee->delete_Employee($id);
            if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'Employee Deleted'
            ], RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'Failed TO Delete Employee'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}

?>