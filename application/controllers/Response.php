<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {
  
  // The constuctor funtion
  public function __construct(){
    parent::__construct();

    $this->load->model('user_model');
    $this->load->model('client_model');
    $this->load->model('assignment_model');
    $this->load->model('notification_model');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->helper('date');

  }

  // View Response page
  public function responseView($id){
    if($this->session->userdata['validated']){   
      $assignment = $this->assignment_model->getAssignment($id);

      $data['title'] = "Assignments";

      if($this->session->userdata['id'] == $assignment['user_id']){
        $data['assignment'] = $assignment;
        $this->load->view('responses/add_response', $data);
      }else{
        $this->session->set_flashdata('message_error', 'Sorry! you can not respond to this meeting assignment');
        redirect("assignments/assigned");
      }
    }else{
      redirect("login");
    }  
  }

  // Add a response
  public function insertResponse(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('assignment_id', 'User', 'trim|required|xss_clean');
      $this->form_validation->set_rules('datetime', 'Date & Time', 'trim|required|xss_clean');
      $this->form_validation->set_rules('nextdatetime', 'Next Date & Time', 'trim|xss_clean');
      $this->form_validation->set_rules('duration', 'Duration', 'trim|required|xss_clean');
      $this->form_validation->set_rules('results', 'Results', 'trim|xss_clean');
      $this->form_validation->set_rules('comments', 'Comments', 'trim|xss_clean');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message_error', validation_errors());
        $this->load->view('assignment/assign');
      } else {
        $data = array(
          'assignment_id'     => $this->input->post('assignment_id'),
          'meeting_time'      => $this->input->post('datetime'),
          'next_meeting_time' => $this->input->post('nextdatetime'),
          'duration'          => $this->input->post('duration'),
          'results'           => $this->input->post('results'),
          'comments'          => $this->input->post('comments'),
          'status'            => $this->input->post('status')
        );

        $result = $this->assignment_model->set_response($data);

        // Generate notification
        $assignment = $this->assignment_model->getAssignment($data['assignment_id']);
        $to     = $assignment['assigned_by'];
        $from   = $this->session->userdata['id'];

        $userdata     = $this->user_model->get_users($from);
        $clientdata   = $this->client_model->get_clients($assignment['client_id']);

        $content = "User ".$userdata['username']." responded to his/her Meeting assignment with ".$clientdata['name']." from ".$clientdata['company']." no ".
                    date('d-M-Y h:i A', strtotime($data['meeting_time']))." at ".$assignment['place'];
        
        $link = "assignment/".$data['assignment_id'];
        
        $this->insertNotification($to, $from, $content, $link);

        if ($result == TRUE) {
          $this->assignment_model->changeAssignmentStatus($data['assignment_id'], $data['status']);
          $this->session->set_flashdata( 'message_display', 'Feedback taken successfully');
          redirect("respond/".$data['assignment_id']);
        }else{
          $this->session->set_flashdata('message_error', 'Ooops!!! Something went wrong');
          redirect("respond/".$data['assignment_id']);
        }
      }
    }else{
      redirect('login');
    }
  }

  // Postpone meeting
  public function postponeMeeting(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('assignment_id', 'User', 'trim|required|xss_clean');
      $this->form_validation->set_rules('datetime', 'Date & Time', 'trim|required|xss_clean');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message_error', validation_errors());
        redirect("respond/".$this->input->post('assignment_id'));
      } else {
        $data = array(
          'id'        => $this->input->post('assignment_id'),
          'datetime'  => $this->input->post('datetime'),
          'status'    => 1
        );

        $result = $this->assignment_model->postponeAssignment($data);
        if ($result == TRUE) {
          $this->session->set_flashdata( 'message_display', 'Assignment postponed Successfully !');
          redirect("assignments/".$this->session->userdata['id']);
        }else{
          $this->session->set_flashdata('message_error', 'Something went wrong!');
          redirect("respond/".$this->input->post('assignment_id'));
        }
      }
    }else{
      redirect('login');
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