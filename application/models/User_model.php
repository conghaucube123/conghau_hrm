<?php
    class User_model extends CI_Model
    {
        public function getUser($data = [])
        {
            $this->db->where('del_flag', '0');
            if (isset($data['loginId']) && !empty($data['loginId'])) {
                $this->db->where('login_id', $data['loginId']);
            }
            if (isset($data['profileId']) && !empty($data['profileId'])) {
                $this->db->where('profile_id', $data['profileId']);
            }
            if (isset($data['password']) && !empty($data['password'])) {
                $this->db->where('password', $data['password']);
            }
            if (isset($data['loginId']) | isset($data['profileId']) | isset($data['password'])) {
                return $this->db->get('users')->row_array();
            }

            return $this->db->get('users')->result_array();
        }

        public function updateUser($data = [])
        {
            if (!empty($data['password'])) {
                $this->db->set('password', $data['password']);
            }
            $this->db->set('contract_type_id', $data['contractTypeId']);
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('profile_id', $data['id']);
            $this->db->update('users');
        }

        public function updateUserProfile($data = [])
        {
            if (!empty($data['password'])) {
                $this->db->set('password', $data['password']);
            }
            $this->db->set('login_id', $data['loginId']);
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('profile_id', $data['id']);
            $this->db->update('users');
        }

        public function updateLogin($data = [])
        {
            $this->db->set('recent_login', 'now');
            $this->db->where('profile_id', $data['id']);
            $this->db->update('users');
        }

        public function addUser($data = [])
        {
            $this->db->insert('users', $data);
        }

        public function deleteUser($data = [])
        {
            $this->db->set('del_flag', '1');
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('profile_id', $data['id']);
            $this->db->update('users');
        }
    }