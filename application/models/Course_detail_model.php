<?php
    class Course_detail_model extends CI_Model
    {        
        public function getEmployeeList($data = [])
        {
            $this->db->select('*');
            $this->db->from('course_details');
            $this->db->join('profiles', 'profiles.id = course_details.profile_id');
            $this->db->where('course_details.del_flag', '0');
            $this->db->where('course_details.course_id', $data['courseId']);
            if (!empty($data['order'])) {
                $this->db->order_by($data['orderBy'], $data['order']);
            }
            
            return $this->db->get()->result_array();
        }

        public function getCourseDetail($data = [])
        {
            $this->db->where($data);
            return $this->db->get('course_details')->row_array();
        }

        public function addEmployee($data = [])
        {
            $this->db->insert('course_details', $data);
            return $this->db->insert_id();
        }

        public function deleteEmployee($data = [])
        {
            $this->db->set('del_flag', '1');
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('profile_id', $data['profileId']);
            $this->db->where('course_id', $data['courseId']);
            $this->db->update('course_details');
        }
    }