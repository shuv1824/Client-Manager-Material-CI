<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
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

  // Get notifications
  public function get_notifications(){
      $id = $this->session->userdata['id'];

      $notifications = $this->notification_model->get_notifications($id);

      $data['notifications'] = $notifications;
      $data['num'] = $this->notification_model->unreadNotifications($id);

      $this->load->view('layouts/notifications', $data);
  }

  // Get All Notifications 
  public function allNotifications(){
    if($this->session->userdata['validated']){
      $data['title'] = "Notifications";
      $id = $this->session->userdata['id'];
      
      $notifications = $this->notification_model->get_notifications($id);
      
      $data['notifications'] = $notifications;
      //$data['num'] = count($notifications);
      
      $this->load->view('notifications', $data);
    }else{
      redirect('login');
    }
  }

  // Mark as read
  public function markAsRead($id){
    if($this->session->userdata['validated']){
      
      $result = $this->notification_model->markAsRead($id);
      
      if($result == true){
        echo "Marked as read";
      }else{
        echo "Something went wrong. Please try again";
      }
    }else{
      redirect('login');
    }
  }

  // Mark as old
  public function markAsOld($id){
    if($this->session->userdata['validated']){
      
      $result = $this->notification_model->markAsOld($id);
      
      if($result == true){
        $this->session->set_flashdata( 'message_display', 'Notification removed from list');
        redirect('notifications');
      }else{
        $this->session->set_flashdata( 'message_error', 'Something went wrong. Please try again');
        redirect('notifications');
      }
    }else{
      redirect('login');
    }
  }
}