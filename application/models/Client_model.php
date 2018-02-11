<?php
class Client_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Get client data 
    public function get_clients($id = FALSE){
        if($id === FALSE){
            $query = $this->db->get('clients');
            return $query->result_array();
        }

        $query = $this->db->get_where('clients', array('id' => $id));
        return $query->row_array();
    }

    // Get My Clients
    public function get_my_clients($id){
        $this->load->helper('url');
        $query = $this->db->get_where('clients', array('assigned_to_user' => $id));
        return $query->result_array();
    }

    // Client Create method
    public function set_client($data){
        $this->load->helper('url');
        return $this->db->insert('clients', $data);   
    }

    // Client info update method
    public function update_client($data){
        $this->load->helper('url');
        // User data update
        $this->db->where('id', $data['id']);
        return $this->db->update('clients', $data);
    }

    // Client activation toggle method
    public function client_active_toggle($id){
        $client = $this->get_clients($id);

        if($client['is_active'] == 1){
            $sql = "UPDATE clients SET is_active = 0 WHERE id = '$id'";
            return $this->db->query($sql);
        }else{
            $sql = "UPDATE clients SET is_active = 1 WHERE id = '$id'";
            return $this->db->query($sql);
        }
    }

    // Client Approval method
    public function client_approval($id){
        $sql = "UPDATE clients SET is_approved = 1 WHERE id = '$id'";
        return $this->db->query($sql);
    }

    // Get all active clients
    public function getActiveClients(){
        $this->db->where('is_approved', 1);
        $this->db->where('is_active', 1);
        $query = $this->db->get('clients');
        
        return $query->result_array();
    }

    // Assign client to a user
    public function assignToUser($data){
        $client_id = $data['client_id'];
        $user_id = $data['user_id'];
        $sql = "UPDATE clients SET assigned_to_user = '$user_id' WHERE id = '$client_id'";

        return $this->db->query($sql);
    }

    // Get active client number
    public function activeClientNum(){
        $query = $this->db->get_where('clients', array('is_active' => 1, 'is_approved' => 1));
        return $query->num_rows();
    }

    // Get assigned client number
    public function assignedClientNum($id){
        $query = $this->db->get_where('clients', array('is_active' => 1, 'is_approved' => 1, 'assigned_to_user' => $id));
        return $query->num_rows();
    }
}