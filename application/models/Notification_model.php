<?php
class Notification_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Add a notification
    public function add_notification($data){
        $this->load->helper('url');
        return $this->db->insert('notifications', $data);   
    }

    public function get_notifications($id){
        $this->db->select('*')->from('notifications')
                    ->where('to_user_id', $id)->where('is_fresh', 1)
                    ->order_by('created_on', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Get unread notification number
    public function unreadNotifications($id){
        $query = $this->db->get_where('notifications', array('is_read' => 0, 'is_fresh' => 1, 'to_user_id' => $id));
        return $query->num_rows();
    }

    // Read Notification
    public function markAsRead($id){
        $this->load->helper('url');
        // Assignment data update
        $this->db->where('id', $id);
        return $this->db->update('notifications', array('is_read' => 1));
    }

    // Remove Notification
    public function markAsOld($id){
        $this->load->helper('url');
        // Assignment data update
        $this->db->where('id', $id);
        return $this->db->update('notifications', array('is_fresh' => 0));
    }
}