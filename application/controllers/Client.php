<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
  
  // The constuctor funtion
  public function __construct(){
    parent::__construct();

    $this->load->model('client_model');
    $this->load->model('user_model');
    $this->load->library('form_validation');
    $this->load->helper('url');

  }

  // The Client list view method
  public function index(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Clients';
      
      if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin') || ($this->session->userdata['role'] == 'customer_relation')){
        $clients = $this->client_model->get_clients();
        $data['clients'] = $clients;

        $users = $this->user_model->getSomeUsers();
        $data['users'] = $users;

        $this->load->view('clients/index', $data);
      }else{
        $this->load->view('unauthorized', $data);
      }
    }else{
      redirect('login');
    }
    
  }

  // The client add form view method
  public function show(){
    if($this->session->userdata['validated']){
      $data = ['title' => 'Clients'];
      if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin') || ($this->session->userdata['role'] == 'customer_relation')){
        $this->load->view('clients/create', $data);
      }else{
        $this->load->view('unauthorized', $data);
      }
    }else{
      redirect("login");
    }
  }

  // Client create method
  public function store(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('name', 'Client Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('designation', 'Client Designation', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
      $this->form_validation->set_rules('phone', 'Contact No.', 'trim|required|xss_clean');
      $this->form_validation->set_rules('company', 'Company Name', 'trim|xss_clean');
      $this->form_validation->set_rules('address', 'Company Address', 'trim|xss_clean');
      $this->form_validation->set_rules('type', 'Business Type', 'trim|xss_clean');
      $this->form_validation->set_rules('phone2', 'Alternative Contact No.', 'trim|xss_clean');
      $this->form_validation->set_rules('website', 'Website Link', 'trim|valid_url');
      $this->form_validation->set_rules('facebook', 'Facebook Page Link', 'trim|valid_url');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message_display', validation_errors());
        $this->load->view('client/add');
      } else {
        // Photo upload
        if(!isset($_FILES["photo"]["name"]) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE){
          $file_name = "noimage.png";
        }else{
          $uploaded_file1 = $this->uploadFile($this->input->post('name'), 'photo', 'pic');

          if($uploaded_file1['status']){
            $file_name = $uploaded_file1['file_name'];
          }else{
            $this->session->set_flashdata('message_display', $uploaded_file1['error']);
            redirect('client/add');
          }
        } 

        // Visiting Card Upload
        if(!isset($_FILES["visiting_card"]["name"]) || $_FILES['visiting_card']['error'] == UPLOAD_ERR_NO_FILE){
          $card_file_name = "nocard.png";
        }else{
          $uploaded_file2 = $this->uploadFile($this->input->post('name'), 'visiting_card', 'card');
          
          if($uploaded_file2['status']){
            $card_file_name = $uploaded_file2['file_name'];
          }else{
            $this->session->set_flashdata('message_display', $uploaded_file1['error']);
            redirect('client/add');
          }
        }
        
        $data = array(
          'name'          => $this->input->post('name'),
          'designation'   => $this->input->post('designation'),
          'email'         => $this->input->post('email'),
          'phone'         => $this->input->post('phone'),
          'phone2'        => $this->input->post('phone2'),
          'company'       => $this->input->post('company'),
          'address'       => $this->input->post('address'),
          'type'          => $this->input->post('type'),
          'website'       => $this->input->post('website'),
          'facebook'      => $this->input->post('facebook'),
          'photo'         => $file_name,
          'visiting_card' => $card_file_name,
          'created_by'    => $this->session->userdata['id']
        );

        $result = $this->client_model->set_client($data);
        if ($result == TRUE) {
          $this->session->set_flashdata( 'message_display', 'Client created Successfully !');
          redirect('clients');
        }else{
          $this->session->set_flashdata('message_display', 'Client not created');
          redirect('client/add');
        }
      }
    }else{
      redirect('login');
    }
  }

  // User edit method
  public function edit($id){
    if($this->session->userdata['validated']){
      $data['title'] = 'Clients';
      
      if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin') || ($this->session->userdata['role'] == 'customer_relation')){
        $client = $this->client_model->get_clients($id);

        if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')){
          $data['client'] = $client;
          $this->load->view('clients/edit', $data);
        }
        else if(($this->session->userdata['role'] == 'customer_relation') && ($this->session->userdata['id'] == $client['created_by'])){
          $data['client'] = $client;
          $this->load->view('clients/edit', $data);
        }else{
          $this->session->set_flashdata('message_error', 'Sorry! you can not edit this client information');
          redirect('clients/assigned');
        }
      }else{
        $this->load->view('unauthorized', $data);
      }
    }else{
      redirect('login');
    }
  }

  // Client update method
  public function update(){
    if($this->session->userdata['validated']){
      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('name', 'Client Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('designation', 'Client Designation', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
      $this->form_validation->set_rules('phone', 'Contact No.', 'trim|required|xss_clean');
      $this->form_validation->set_rules('company', 'Company Name', 'trim|xss_clean');
      $this->form_validation->set_rules('address', 'Company Address', 'trim|xss_clean');
      $this->form_validation->set_rules('type', 'Business Type', 'trim|xss_clean');
      $this->form_validation->set_rules('phone2', 'Alternative Contact No.', 'trim|xss_clean');
      $this->form_validation->set_rules('website', 'Website Link', 'trim|valid_url');
      $this->form_validation->set_rules('facebook', 'Facebook Page Link', 'trim|valid_url');

      if ($this->form_validation->run() == FALSE) {
        //$this->session->set_flashdata('message_display', validation_errors());
        $this->load->view('client/edit/'.$this->input->post('id'));
      } else {
        // Photo upload
        if(!isset($_FILES["photo"]["name"]) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE){
          $info = $this->client_model->get_clients($this->input->post('id'));
          $file_name = $info['photo'];         
        }else{
          $uploaded_file1 = $this->uploadFile($this->input->post('name'), 'photo', 'pic');
          
          if($uploaded_file1['status']){
            $file_name = $uploaded_file1['file_name'];
          }else{
            $this->session->set_flashdata('message_display', $uploaded_file1['error']);
            redirect('client/edit/'.$this->input->post('id'));
          }
        } 

        // Visiting Card upload
        if(!isset($_FILES["visiting_card"]["name"]) || $_FILES['visiting_card']['error'] == UPLOAD_ERR_NO_FILE){
          $info = $this->client_model->get_clients($this->input->post('id'));
          $card_file_name = $info['visiting_card'];       
        }else{
          $uploaded_file2 = $this->uploadFile($this->input->post('name'), 'visiting_card', 'card');
          
          if($uploaded_file2['status']){
            $card_file_name = $uploaded_file2['file_name'];
          }else{
            $this->session->set_flashdata('message_display', $uploaded_file2['error']);
            redirect('client/edit/'.$this->input->post('id'));
          }
        }
        
        $data = array(
          'id'            => $this->input->post('id'),
          'name'          => $this->input->post('name'),
          'designation'   => $this->input->post('designation'),
          'email'         => $this->input->post('email'),
          'phone'         => $this->input->post('phone'),
          'phone2'        => $this->input->post('phone2'),
          'company'       => $this->input->post('company'),
          'address'       => $this->input->post('address'),
          'type'          => $this->input->post('type'),
          'website'       => $this->input->post('website'),
          'facebook'      => $this->input->post('facebook'),
          'photo'         => $file_name,
          'visiting_card' => $card_file_name,
          'is_approved'   => 0
        );

        $result = $this->client_model->update_client($data);
        if ($result == TRUE) {
          $this->session->set_flashdata( 'message_display', 'Client information updated Successfully !');
          redirect('clients');
        }else{
          $this->session->set_flashdata('message_display', 'Client information not updated');
          redirect('client/edit/'.$this->input->post('id'));
        }
      }
    }else{
      redirect('login');
    }
  }

  // Client delete
  public function destroy($id){
    if($this->session->userdata['validated']){
    $this->load->helper("file");
    $info = $this->client_model->get_clients($id);

    if($info['photo'] != "noimage.png"){
      unlink('assets/img/clients/'.$info['photo']);
      if($info['visiting_card'] != "nocard.png"){
        unlink('assets/img/clients/'.$info['visiting_card']);
        if($this->db->delete('clients', array('id' => $id))){
          $this->session->set_flashdata('message_display', 'User deleted!');
          redirect('clients');
        }else{
          $this->session->set_flashdata('message_display', 'User not deleted!');
          redirect('clients');
        }
      }else{
        if($this->db->delete('clients', array('id' => $id))){
          $this->session->set_flashdata('message_display', 'User deleted!');
          redirect('clients');
        }else{
          $this->session->set_flashdata('message_display', 'User not deleted!');
          redirect('clients');
        }
      }
    }else{
      if($this->db->delete('clients', array('id' => $id))){
        $this->session->set_flashdata('message_display', 'User deleted!');
        redirect('clients');
      }else{
        $this->session->set_flashdata('message_display', 'User not deleted!');
        redirect('clients');
      }
    }
    }else{
      redirect('login');
    }
  }

  // Client approval
  public function approveClient($id){
    if($this->session->userdata['validated']){
      $result = $this->client_model->client_approval($id);
      if ($result == TRUE) {
        $this->session->set_flashdata( 'message_display', 'Client approved successfully');
        redirect('clients');
      } else {
        $this->session->set_flashdata( 'message_display', 'Something went wrong');
        redirect('clients');
      }
    }else{
      redirect('login');
    }
  }

  // Client activation toggle
  public function toggleActive($id){
    if($this->session->userdata['validated']){
      $result = $this->client_model->client_active_toggle($id);
      if ($result == TRUE) {
        $this->session->set_flashdata( 'message_display', 'Client Activation state changed successfully');
        redirect('clients');
      } else {
        $this->session->set_flashdata( 'message_display', 'Something went wrong');
        redirect('clients');
      }
    }else{
      redirect('login');
    }
  }

  // Assign client to a user
  public function assignToUser(){
    if($this->session->userdata['validated']){
      $data = array(
        'client_id'   => $this->input->post('client_id'),
        'user_id'     => $this->input->post('user_id')
      );

      $result = $this->client_model->assignToUser($data);

      if($result){
        echo json_encode(array('status' => 'User assigned successfully'));
      }else{
        echo json_encode(array('status' => 'User assignment failed'));
      }
    }else{
      redirect('login');
    }
  }

  // Get my client list
  public function myClients(){
    if($this->session->userdata['validated']){
      $data['title'] = 'Clients';
      $id = $this->session->userdata['id'];
      
      $clients = $this->client_model->get_my_clients($id);
      $data['clients'] = $clients;

      $this->load->view('clients/index', $data);
    }else{
      redirect('login');
    }
  }

  // File upload method
  public function uploadFile($name, $fieldname, $suffix){
    $img_name = str_replace(' ', '', strtolower($name."_".$suffix));
    $config['upload_path']          = 'assets/img/clients';
    $config['allowed_types']        = 'jpeg|jpg|png|JPEG|JPG|PNG';
    $config['max_size']             = 2048;
    $config['max_width']            = 4096;
    $config['max_height']           = 4096;
    $config['file_name']            = $img_name;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload($fieldname))
    {
      $uploadStatus = array(
        'file_name' => '',
        'status'    => false,
        'error'     => $this->upload->display_errors()
      );
    }
    else
    {
      $upload_data = $this->upload->data();
      
      $uploadStatus = array(
        'file_name' => $upload_data['file_name'],
        'status'    => true
      );
    }

    return $uploadStatus;
  }
}