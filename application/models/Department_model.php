<?php
    class Department_model extends CI_Model
    {
        public function getDepartment()
        {
            return $this->db->get('departments')->result_array();
        }
    }