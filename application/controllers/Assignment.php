<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {
  
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

  // Assignment List view
  public function index(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Assignments';
      if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')){
        $data['assignments'] = $this->assignment_model->get_assignments();
        
        $this->load->view('assignments/index', $data);
      }else{
        $this->load->view('unauthorized', $data);
      }
    }else{
      redirect('login');
    }
  }

  // Individual Assignments View
  public function assignments(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Assignments';
      $id = $this->session->userdata['id'];
      
      $data['assignments'] = $this->assignment_model->getIndAssignments($id);

      $this->load->view('assignments/index', $data);
    }else{
      redirect('login');
    }
  }

  // The Assign form view method
  public function show(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Assignments';
      if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')){
        $users = $this->user_model->getSomeUsers();
        $clients = $this->client_model->getActiveClients();
    
        $data['users'] = $users;
        $data['clients'] = $clients;

        $this->load->view('assignments/assign', $data);
      }else{
        $this->load->view('unauthorized', $data);
      }
    }else{
      redirect("login");
    }
  }

  // Insert new assignment
  public function store(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('user_id', 'User', 'trim|required|xss_clean');
      $this->form_validation->set_rules('datetime', 'Date & Time', 'trim|required|xss_clean');
      $this->form_validation->set_rules('client_id', 'Client', 'trim|required|xss_clean');
      $this->form_validation->set_rules('place', 'Meeting Place', 'trim|xss_clean');
      $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message_error', validation_errors());
        $this->load->view('assignment/assign');
      } else {
        $user = $this->session->userdata['id'];
        $data = array(
          'user_id'       => $this->input->post('user_id'),
          'datetime'      => $this->input->post('datetime'),
          'client_id'     => $this->input->post('client_id'),
          'place'         => $this->input->post('place'),
          'remarks'       => $this->input->post('remarks'),
          'assigned_by'   => $user
        );

        $result = $this->assignment_model->set_assignment($data);
        if ($result != false) {

          // Generate notification
          $to     = $data['user_id'];
          $from   = $data['assigned_by'];

          $userdata     = $this->user_model->get_users($from);
          $clientdata   = $this->client_model->get_clients($data['client_id']);

          $content = "Meeting assigned with ".$clientdata['name']." from ".$clientdata['company']." no ".
                      date('d-M-Y h:i A', strtotime($data['datetime']))." at ".$data['place']." by ".$userdata['username'];
          
          $link = "assignment/".$result;
          
          $this->insertNotification($to, $from, $content, $link);

          $this->session->set_flashdata( 'message_display', 'Meeting Assigned Successfully !');
          redirect('assignments');
        }else{
          $this->session->set_flashdata('message_error', 'Something went wrong!');
          redirect('assignment/assign');
        }
      }
    }else{
      redirect('login');
    }
  }

  // Assignment Edit form view
  public function edit($id){
    if($this->session->userdata['validated']){
      $data['title'] = 'Assignments';
      $assignment = $this->assignment_model->getAssignment($id);

      if($this->session->userdata['id'] == $assignment['assigned_by']){
        $users = $this->user_model->getSomeUsers();
        $clients = $this->client_model->getActiveClients();

        $data['users'] = $users;
        $data['clients'] = $clients;
        $data['assignment'] = $assignment;
        $this->load->view('assignments/edit_assignment', $data);
      }else{
        $this->session->set_flashdata('message_error', 'Sorry! You can not edit this assignment');
        redirect("assignments/assigned");
      }

    }else{
      redirect("login");
    }
  }

  // Update assignemt
  public function update(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('user_id', 'User', 'trim|required|xss_clean');
      $this->form_validation->set_rules('datetime', 'Date & Time', 'trim|required|xss_clean');
      $this->form_validation->set_rules('client_id', 'Client', 'trim|required|xss_clean');
      $this->form_validation->set_rules('remarks', 'Remarks', 'trim|xss_clean');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message_display', validation_errors());
        $this->load->view('assignment/assign');
      } else {
        $data = array(
          'id'            => $this->input->post('id'),
          'user_id'       => $this->input->post('user_id'),
          'datetime'      => $this->input->post('datetime'),
          'client_id'     => $this->input->post('client_id'),
          'place'         => $this->input->post('place'),
          'remarks'       => $this->input->post('remarks')
        );

        $result = $this->assignment_model->update_assignment($data);
        if ($result != false) {
          // Generate notification
          $to     = $data['user_id'];
          $from   = $this->session->userdata['id'];

          $userdata     = $this->user_model->get_users($from);
          $clientdata   = $this->client_model->get_clients($data['client_id']);

          $content = "Meeting assignment UPDATED with ".$clientdata['name']." from ".$clientdata['company']." no ".
                      date('d-M-Y h:i A', strtotime($data['datetime']))." at ".$data['place']." by ".$userdata['username'];
          
          $link = "assignment/".$result;
          
          $this->insertNotification($to, $from, $content, $link);

          $this->session->set_flashdata( 'message_display', 'Assignment updated Successfully !');
          redirect('assignments');
        }else{
          $this->session->set_flashdata('message_error', 'Something went wrong!');
          redirect('assignment/edit/'.$this->input->post('id'));
        }
      }
    }else{  
      redirect('login');
    }
  }

  // Detailed assignment view
  public function assignmentDetailsView($id){
    if($this->session->userdata['validated']){
      $data['title'] = 'Assignments';
      $assignment = $this->assignment_model->getAssignmentDetails($id);

      if(($this->session->userdata['id'] == $assignment['assigned_to_id']) || ($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')){
        $responses = $this->assignment_model->getResponses($id);
        $data['assignment'] = $assignment;
        $data['responses'] = $responses;
        $this->load->view('assignments/assignment_details', $data);
      }else{
        $this->session->set_flashdata('message_error', 'Sorry! You can not view this assignment');
        redirect("assignments/assigned");
      }

    }else{
      redirect("login");
    }
  }

  // Cancel Assignment
  public function cancel($id){
    if($this->session->userdata['validated']){
      $assignment = $this->assignment_model->getAssignment($id);
      if($this->session->userdata['id'] == $assignment['assigned_by']){
        $result = $this->assignment_model->cancelAssignment($id);

        // Generate notification
        $to     = $assignment['user_id'];
        $from   = $this->session->userdata['id'];

        $userdata     = $this->user_model->get_users($from);
        $clientdata   = $this->client_model->get_clients($assignment['client_id']);

        $content = "Meeting with ".$clientdata['name']." from ".$clientdata['company']." on ".
                    date('d-M-Y h:i A', strtotime($data['datetime']))." at ".$data['place']." is cancelled by ".$userdata['username'];
        
        $link = "assignment/".$assignment['id'];
        
        $this->insertNotification($to, $from, $content, $link);

        if($result == true){
          $this->session->set_flashdata( 'message_display', 'Assignment Cancelled');
          redirect('assignments');
        }else{
          $this->session->set_flashdata( 'message_error', 'Something went wrong!!!');
          redirect('assignments');
        }
      }else{
        $this->session->set_flashdata( 'message_error', 'Sorry! you do not have permission to cancel this meeting');
        redirect('assignments');
      }
    }else{
      redirect("login");
    }
  }

  // End Assignment
  public function finish($id){
    if($this->session->userdata['validated']){
      $assignment = $this->assignment_model->getAssignment($id);
      if($this->session->userdata['id'] == $assignment['assigned_by']){
        $result = $this->assignment_model->finishAssignment($id);

        // Generate notification
        $to     = $assignment['user_id'];
        $from   = $this->session->userdata['id'];

        $userdata     = $this->user_model->get_users($from);
        $clientdata   = $this->client_model->get_clients($assignment['client_id']);

        $content = "Meeting with ".$clientdata['name']." from ".$clientdata['company']." is ended by ".$userdata['username'];
        
        $link = "/assignment/".$assignment['id'];
        
        $this->insertNotification($to, $from, $content, $link);

        if($result == true){
          $this->session->set_flashdata( 'message_display', 'Assignment Ended');
          redirect('assignments');
        }else{
          $this->session->set_flashdata( 'message_error', 'Something went wrong!!!');
          redirect('assignments');
        }
      }else{
        $this->session->set_flashdata( 'message_error', 'Sorry! you do not have permission to end this meeting');
        redirect('assignments/assigned');
      }
    }else{
      redirect("login");
    }
  }

  // Notification insert method
  public function insertNotification($to, $from, $content, $link){
    $data = array(
      'to_user_id'      => $to,
      'from_user_id'    => $from,
      'content'         => $content,
      'link'            => $link
    );

    return $this->notification_model->add_notification($data);
  }
}