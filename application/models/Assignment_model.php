<?php
class Assignment_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Insert assignment
    public function set_assignment($data){
        $this->load->helper('url');
        $result = $this->db->insert('assignments', $data);   

        if($result == true){
            $insertID = $this->db->insert_id();
            return $insertID;
        }else{
            return $result;
        }
    }

    // Get all assignment
    public function get_assignments(){
        $this->db->select('
            a.id as a_id, a.datetime, a.place, a.remarks, a.assigned_on, a.updated_on, a.status, 
            a.assigned_by as assigned_by_id, u1.username as assigned_by, 
            a.user_id as assigned_to_id, u2.username as assigned_to, 
            c.id, c.name, c.company, c.phone, c.phone2, c.email 
        ')
            ->from('assignments a')
            ->join('users u1', 'a.assigned_by = u1.id')
            ->join('users u2', 'a.user_id = u2.id')
            ->join('clients c', 'a.client_id = c.id')
            ->order_by('a.assigned_on', 'desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Get all upcoming assignment
    public function get_upcoming_assignments(){
        $this->db->select('
            a.id as a_id, a.datetime, a.place, a.remarks, a.assigned_on, a.updated_on, a.status, 
            a.assigned_by as assigned_by_id, u1.username as assigned_by, 
            a.user_id as assigned_to_id, u2.username as assigned_to, 
            c.id, c.name, c.company, c.phone, c.phone2, c.email 
        ')
            ->from('assignments a')
            ->join('users u1', 'a.assigned_by = u1.id')
            ->join('users u2', 'a.user_id = u2.id')
            ->join('clients c', 'a.client_id = c.id')
            ->where('a.datetime >', date('Y-m-d H:i:s'))
            ->where('a.status <', 3)
            ->order_by('a.assigned_on', 'desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Get individual assignments
    public function getIndAssignments($id){
        $this->db->select('
        a.id as a_id, a.datetime, a.place, a.remarks, a.assigned_on, a.updated_on, a.status,
        a.assigned_by as assigned_by_id, u1.username as assigned_by, 
        a.user_id as assigned_to_id, u2.username as assigned_to, 
        c.id, c.name, c.company, c.phone, c.phone2, c.email 
    ')
        ->from('assignments a')
        ->join('users u1', 'a.assigned_by = u1.id')
        ->join('users u2', 'a.user_id = u2.id')
        ->join('clients c', 'a.client_id = c.id')
        ->where('a.user_id', $id)
        ->where('a.status<',3)
        ->order_by('a.assigned_on', 'desc');

    $query = $this->db->get();
    return $query->result_array();
    }

    // Get a single assignment
    public function getAssignment($id){
        $query = $this->db->get_where('assignments', array('id' => $id));
        return $query->row_array();
    }

    // Get assignment details
    public function getAssignmentDetails($id){
        $this->db->select('
        a.id as a_id, a.datetime, a.place, a.remarks, a.assigned_on, a.updated_on, a.status,
        a.assigned_by as assigned_by_id, u1.username as assigned_by, 
        a.user_id as assigned_to_id, u2.username as assigned_to, 
        c.id, c.name, c.company, c.designation, c.address, c.phone, c.phone2, c.email, c.website, c.photo, c.visiting_card 
        ')
        ->from('assignments a')
        ->join('users u1', 'a.assigned_by = u1.id')
        ->join('users u2', 'a.user_id = u2.id')
        ->join('clients c', 'a.client_id = c.id')
        ->where('a.id', $id);

        $query = $this->db->get();
        return $query->row_array();
    }

    // Get responses of an assignment
    public function getResponses($id){
        $query = $this->db->get_where('responses', array('assignment_id' => $id));
        return $query->result_array();
    }

    // Update assignment
    public function update_assignment($data){
        $this->load->helper('url');
        // Assignment data update
        $this->db->where('id', $data['id']);
        return $this->db->update('assignments', $data);
    }

    // Update assignement status
    public function changeAssignmentStatus($assignment_id, $status){
        $sql = "UPDATE assignments SET `status` = '$status' WHERE id = '$assignment_id'";
        return $this->db->query($sql);
    }

    // Postpone assignment
    public function postponeAssignment($data){
        $this->load->helper('url');
        // Assignment data update
        $this->db->where('id', $data['id']);
        return $this->db->update('assignments', $data);
    }

    // Add response
    public function set_response($data){
        $this->load->helper('url');
        return $this->db->insert('responses', $data);
    }

    // Cancel Assignment
    public function cancelAssignment($id){
        $sql = "UPDATE assignments SET `status` = 4 WHERE id = '$id'";
        return $this->db->query($sql);
    }

    // Finish Assignment
    public function finishAssignment($id){
        $sql = "UPDATE assignments SET `status` = 3 WHERE id = '$id'";
        return $this->db->query($sql);
    }

    // Get assigned assignments Number
    public function assignedNum($id){
        $query = $this->db->get_where('assignments', array('user_id' => $id, 'status <' => 3, 'datetime >' => date('Y-m-d H:i:s')));
        return $query->num_rows();
    }
}