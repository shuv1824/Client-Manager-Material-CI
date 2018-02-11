<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  
  // The constuctor funtion
  public function __construct(){
    parent::__construct();

    $this->load->model('user_model');
    $this->load->library('form_validation');
    $this->load->helper('url');

  }

  // The user list view method
  public function index(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Users';
      
      if($this->session->userdata['role'] != 'super_admin'){
        $this->load->view('unauthorized', $data);
      }else{
        $users = $this->user_model->get_users();
        $data['users'] = $users;
        $this->load->view('users/index', $data);
      }
    }else{
      redirect('login');
    }
    
  }

  // The user add form view method
  public function show(){
    if($this->session->userdata['validated']){
      $data = ['title' => 'Users'];

      if($this->session->userdata['role'] != 'super_admin'){
        $this->load->view('unauthorized', $data);
      }else{
        $this->load->view('users/create', $data);
      }
    }else{
      redirect("login");
    }
  }

  // User create method
  public function store(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
      $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('password_confirmation', 'Password', 'trim|required|xss_clean|matches[password]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('user/add');
      } else {
        $img_name = str_replace(' ', '', strtolower($this->input->post('name')));
        $config['upload_path']          = 'assets/img/users';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $img_name;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('photo'))
        {
          $this->session->set_flashdata('message_display', $this->upload->display_errors());
          redirect('user/add');
        }
        else
        {
          $upload_data = $this->upload->data();
          $file_name = $upload_data['file_name'];
        }
        
        $data = array(
          'username' => $this->input->post('name'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')),
          'password2' => md5($this->input->post('password_confirmation')),
          'role' => $this->input->post('role'),
          'image' => $file_name
        );

        if($data['password'] == $data['password2']){
          unset($data['password2']);
          $result = $this->user_model->set_user($data);
          if ($result == TRUE) {
            $this->session->set_flashdata( 'message_display', 'User created Successfully !');
            redirect('users');
          } else {
            $this->session->set_flashdata( 'message_display', 'Email already exists!');
            redirect('user/add');
          }
        }else{
          $this->session->set_flashdata( 'message_display', 'Password did not match! Please try again.');
          redirect('user/add');
        }
      }
    }else{
      redirect('login');
    }
  }

  // User edit method
  public function edit($id){
    if($this->session->userdata['validated']){
      $data['title'] = 'Users';

      if($this->session->userdata['role'] != 'super_admin'){
        $this->load->view('unauthorized', $data);
      }else{
        $user = $this->user_model->get_users($id);
        $data['user'] = $user;
        $this->load->view('users/edit', $data);
      }  
    }else{
      redirect('login');
    }
  }

  // User info update
  public function update(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
      $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata( 'message_display', $this->form_validation->error());
        redirect('user/edit/'.$this->input->post('id'));
      } else {
        if(!isset($_FILE)){
          $img_name = str_replace(' ', '', strtolower($this->input->post('name')));
          $config['upload_path']          = 'assets/img/users';
          $config['allowed_types']        = 'jpeg|jpg|png';
          $config['max_size']             = 1024;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;
          $config['file_name']            = $img_name;
  
          $this->load->library('upload', $config);
  
          if ( ! $this->upload->do_upload('photo'))
          {
            $this->session->set_flashdata('message_display', $this->upload->display_errors());
            redirect('user/edit/'.$this->input->post('id'));
          }
          else
          {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
          }
        }else{
          $info = $this->user_model->get_users($this->input->post('id'));
          $file_name = $info['image'];
        }    

        $data = array(
          'id'    => $this->input->post('id'),
          'username'  => $this->input->post('name'),
          'email' => $this->input->post('email'),
          'role'  => $this->input->post('role'),
          'image' => $file_name
        );

        $result = $this->user_model->update_user($data);
        if ($result == TRUE) {
          $this->session->set_flashdata( 'message_display', 'User information updated Successfully!');
          redirect('users');
        } else {
          $this->session->set_flashdata( 'message_display', 'Email already exists!');
          redirect('user/edit/'.$this->input->post('id'));
        }
      }
    }else{
      redirect('login');
    }
  }

  // User delete
  public function destroy($id){
  if($this->session->userdata['validated']){
    $this->load->helper("file");
    $info = $this->user_model->get_users($id);

    if(unlink('assets/img/users/'.$info['image']) && $this->db->delete('users', array('id' => $id))){
      $this->session->set_flashdata('message_display', 'User deleted!');
      redirect('users');
    }else{
      $this->session->set_flashdata('message_display', 'User not deleted!');
      redirect('users');
    }
  }else{
    redirect('login');
  }
  }

  // User activation toggle
  public function toggleActive($id){
    if($this->session->userdata['validated']){
      $result = $this->user_model->user_active_toggle($id);
      if ($result == TRUE) {
        $this->session->set_flashdata( 'message_display', 'User Activation state changed successfully');
        redirect('users');
      } else {
        $this->session->set_flashdata( 'message_display', 'Something went wrong');
        redirect('users');
      }
    }else{
      redirect('login');
    }
  }
}
