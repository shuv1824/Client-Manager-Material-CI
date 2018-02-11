<?php
class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Get user data 
    public function get_users($id = FALSE){
        if($id === FALSE){
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    // Get user by email
    public function get_user_by_email($email){
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }

    // Get some users
    public function getSomeUsers(){
        $this->db->where('role !=', 'super_admin');
        $this->db->where('is_active', 1);
        $query = $this->db->get('users');

        return $query->result_array();
    }

    // User Create method
    public function set_user($data){
        $this->load->helper('url');

        if($this->email_check($data['email'])){
            // User data insert
            return $this->db->insert('users', $data);
        }else{
            return false;
        }
        
    }

    // User activation toggle method
    public function user_active_toggle($id){
        $user = $this->get_users($id);

        if($user['is_active'] == 1){
            $sql = "UPDATE users SET is_active = 0 WHERE id = '$id'";
            return $this->db->query($sql);
        }else{
            $sql = "UPDATE users SET is_active = 1 WHERE id = '$id'";
            return $this->db->query($sql);
        }
    }

    // User info update method
    public function update_user($data){
        $this->load->helper('url');
        // User data update
        $this->db->where('id', $data['id']);
        //unset($data['id']);

        return $this->db->update('users', $data);
    }

    // Get all active users
    public function getActiveUsers(){
        $this->db->where('is_active', 1);
        $query = $this->db->get('users');
        
        return $query->result_array();
    }

    // Check if email id already exists
    public function email_check($email){
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $res = $this->db->query($sql);

        if($res->num_rows() == 0){
            return true;
        }else{
            return false;
        }
    }

    // User Login function
    public function login_user(){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('is_active', '1');

        $res = $this->db->get('users');

        if($res->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    // user password update
    public function update_password($id, $pass){
        $sql = "UPDATE users SET `password` = '$pass' WHERE id = '$id'";
        return $this->db->query($sql);
    }
}
