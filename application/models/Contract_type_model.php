<?php
    class Contract_type_model extends CI_Model
    {
        public function getContractType()
        {
            return $this->db->get('contract_type')->result_array();
        }
    }