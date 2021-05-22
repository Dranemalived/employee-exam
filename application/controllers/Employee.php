<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model', 'employee');
    }

    public function index()
    {
        $data['title'] = "Employee";
        $this->load->view('layout/header', $data);
        $this->load->view('employee');
        $this->load->view('layout/footer');
    }

    public function new()
    {
        $data['title'] = "Create Employee";
        $this->load->view('layout/header', $data);
        $this->load->view('new_employee');
        $this->load->view('layout/footer');
    }

    public function getEmployees()
    {
        $result = $this->employee->fetchAll();

        echo json_encode($result ? $result : []);
    }

    public function create()
    {
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'dateOfBirth' => $this->input->post('dateOfBirth'),
            'created_date' => date('Y-m-d H:i:s')
        );

        $created = $this->employee->create($data);

        if ($created) {
            $this->session->set_flashdata('alertSuccess', 'New employee created successfully!');
            echo json_encode(['error' => false]);
        }
    }

    public function update()
    {
        $data = array(
            'id' => $this->input->post('eId'),
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'dateOfBirth' => $this->input->post('dateOfBirth')
        );

        $updated = $this->employee->update($data);

        if ($updated) {
            echo json_encode(['error' => false, 'message' => 'Employee updated successfully!']);
        }
    }

    public function getEmployeeById()
    {
        $id = $this->input->post('eId');

        echo json_encode($this->employee->fetchById($id));
    }
}
