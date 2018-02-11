<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    // The constuctor funtion
    public function __construct(){
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('client_model');
        $this->load->model('notification_model');
        $this->load->model('assignment_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('date');
    }

    public function index(){
        if(isset($this->session->userdata['validated'])){
            $data['title'] = "Dashboard";
            $id = $this->session->userdata('id');
            
            $data['user'] = $this->session->userdata(); 

            $data['active_clients'] = $this->client_model->activeClientNum();
            $data['assigned_clients'] = $this->client_model->assignedClientNum($id);
            $data['upcoming_meetings'] = $this->assignment_model->assignedNum($id);

            if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')){
                $data['assignments'] = $this->assignment_model->get_upcoming_assignments();
            }else{
                $data['assignments'] = $this->assignment_model->getIndAssignments($id);
            }

            $this->load->view('dashboard', $data);
        }else{
            redirect('login');
        }
    }
}