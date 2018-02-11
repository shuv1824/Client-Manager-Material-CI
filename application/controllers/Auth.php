<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  // The constuctor funtion
  public function __construct(){
    parent::__construct();

    $this->load->model('user_model');
    $this->load->helper('form');
    $this->load->helper('security');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');

  }

  // Login page view
  public function index(){
    $data['title'] = "Login";
    $this->load->view('login', $data);
  }

  // The login method
  public function login(){
    $this->form_validation->set_rules('email', 'email:', 'required|trim|xss_clean|callback_validation');  
    $this->form_validation->set_rules('password', 'Password:', 'required|trim');  

    if($this->form_validation->run()){
      $data = $this->user_model->get_user_by_email($this->input->post('email'));
      unset($data['password']);
      $data['validated'] = true;
      $this->session->set_userdata($data);

      $this->session->set_flashdata('success_msg', 'Logged in successfully');

      redirect(site_url());
    }else{
      redirect('login'); 
    }
  } 

  public function validation(){
    if($this->user_model->login_user()){
      return true;
    }else{
      $this->session->set_flashdata('error_msg', 'Wrong login credentials, Please try again');  
      return false;
    }
  }

  // Logout
  public function logout(){
    $this->session->sess_destroy();  
    redirect('login');  
  }

  // Password Reset page view
  public function viewPassReset(){
    if($this->session->userdata['validated']){
      $data['title'] = "Password Reset";
      $user = $this->user_model->get_users($this->session->userdata['id']);
      $data['user'] = $user;
      $this->load->view('resetpassword', $data);
    }else{
      redirect('login');
    }
  }

  // Password reset
  public function resetPass(){
    if($this->session->userdata['validated']){
      $id = $this->session->userdata['id'];

      $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|xss_clean');  
      $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|xss_clean');
      $this->form_validation->set_rules('new_password_confirmation', 'New Password Confirmation', 
                                        'required|trim|xss_clean');

      if($this->form_validation->run()){
        if($this->checkOldPass($id, $this->input->post('current_password'))){
          if($this->passwordMatch($this->input->post('new_password'), $this->input->post('new_password_confirmation'))){
            $password = md5($this->input->post('new_password'));
            $result = $this->user_model->update_password($id, $password);

            if($result == true){
              $this->session->set_flashdata('success_msg', 'Password reset successfully');
              
              $this->logout();
            }else{
              $this->session->set_flashdata('message_error', 'Sorry!! Password was not reset');
              
              redirect('resetpassword');
            }
          }else{
            $this->session->set_flashdata('message_error', 'New passwords didn\'t match!!!');
            
            redirect('resetpassword');
          }
        }else{
          $this->session->set_flashdata('message_error', 'Your current password is not correct.');
          
          redirect('resetpassword');
        }
      }
    }else{
      redirect('login');
    }
  }

  public function passwordMatch($pass1, $pass2){
    if(md5($pass1) == md5($pass2)){
      return true;
    }else{
      return false;
    }
  }

  public function checkOldPass($id, $pass){
    $user = $this->user_model->get_users($id);

    if($user['password'] == md5($pass)){
      return true;
    }else{
      return false;
    }
  }
}
