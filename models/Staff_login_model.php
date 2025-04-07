<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_login_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Log staff login activity
     * 
     * @param int $original_staff_id The ID of the staff member who is impersonating
     * @param int $impersonated_staff_id The ID of the staff member being impersonated
     * @return int|boolean
     */
    public function log_impersonation_activity($original_staff_id, $impersonated_staff_id)
    {
        $data = [
            'description' => 'Staff member ID ' . $original_staff_id . ' logged in as staff ID ' . $impersonated_staff_id,
            'date'        => date('Y-m-d H:i:s'),
            'staffid'     => $original_staff_id,
        ];

        $this->db->insert(db_prefix() . 'activity_log', $data);
        return $this->db->insert_id();
    }

    /**
     * Log return to original account activity
     * 
     * @param int $original_staff_id The ID of the staff member who was impersonating
     * @return int|boolean
     */
    public function log_return_activity($original_staff_id)
    {
        $data = [
            'description' => 'Staff member returned to original account (ID: ' . $original_staff_id . ')',
            'date'        => date('Y-m-d H:i:s'),
            'staffid'     => $original_staff_id,
        ];

        $this->db->insert(db_prefix() . 'activity_log', $data);
        return $this->db->insert_id();
    }

    /**
     * Get impersonation logs
     * 
     * @param array $where Optional where clause
     * @return array
     */
    public function get_impersonation_logs($where = [])
    {
        $this->db->select('*');
        $this->db->from(db_prefix() . 'activity_log');
        $this->db->where('description LIKE', 'Staff member ID % logged in as staff ID %');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('date', 'desc');
        
        return $this->db->get()->result_array();
    }
} 