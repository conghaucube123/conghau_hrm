<?php
    class Position_model extends CI_Model
    {
        public function getPosition()
        {
            return $this->db->get('positions')->result_array();
        }
    }