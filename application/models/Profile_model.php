<?php
    class Profile_model extends CI_Model
    {
        public function getProfilesSearch($data = [])
        {
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->join('users', 'users.profile_id = profiles.id');
            $this->db->where('profiles.del_flag', '0');
            if (!empty($data['available']) && empty($data['unavailable'])) {
                $this->db->where('status', $data['available']);
            }
            if (!empty($data['unavailable']) && empty($data['available'])) {
                $this->db->where('status', $data['unavailable']);
            }
            if (!empty($data['employeeId'])) {
                $this->db->like('employee_id', $data['employeeId']);
            }
            if (!empty($data['name'])) {
                $this->db->like('name', $data['name']);
            }
            if (!empty($data['email'])) {
                $this->db->like('email', $data['email']);
            }
            if (!empty($data['order'])) {
                $this->db->order_by($data['orderBy'], $data['order']);
            }
            if (!empty($data['limit'])) {
                $this->db->limit($data['limit']);
            }
            if (!empty($data['offset'])) {
                $this->db->offset($data['offset']);
            }

            return $this->db->get()->result_array();
        }
        
        public function getProfile($data = [])
        {
            $this->db->where('profiles.del_flag', '0');
            if (isset($data['employeeId']) && !empty($data['employeeId'])) {
                $this->db->where('employee_id', $data['employeeId']);
            }
            if (isset($data['email']) && !empty($data['email'])) {
                $this->db->where('email', $data['email']);
            }
            if (isset($data['id']) && !empty($data['id'])) {
                $this->db->where('id', $data['id']);
            }
            if (isset($data['employeeId']) | isset($data['email']) | isset($data['id'])) {
                return $this->db->get('profiles')->row_array();
            }

            return $this->db->get('profiles')->result_array();
        }

        public function updateProfile($data = [])
        {
            $this->db->set('name', $data['name']);
            $this->db->set('email', $data['email']);
            $this->db->set('birthday', $data['birthday']);
            $this->db->set('position_id', $data['position_id']);
            $this->db->set('department_id', $data['department_id']);
            $this->db->set('address', $data['address']);
            $this->db->set('telephone', $data['telephone']);
            $this->db->set('mobile', $data['mobile']);
            $this->db->set('status', $data['status']);
            $this->db->set('gender', $data['gender']);
            if (!empty($data['image'])) {
                $this->db->set('image', $data['image']);
            }
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('id', $data['id']);
            $this->db->update('profiles');
        }

        public function addProfile($data = [])
        {
            $this->db->insert('profiles', $data);
            return $this->db->insert_id();
        }

        public function deleteProfile($data = [])
        {
            $this->db->set('del_flag', '1');
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('id', $data['id']);
            $this->db->update('profiles');
        }
    }