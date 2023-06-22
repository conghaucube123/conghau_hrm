<?php
    class Course_model extends CI_Model
    {
        public function getCoursesSearch($data = [])
        {
            $this->db->select('*');
            $this->db->from('course');
            $this->db->where('del_flag', '0');
            if (!empty($data['course']) && empty($data['event'])) {
                $this->db->where('course_type', $data['course']);
            }
            if (!empty($data['event']) && empty($data['course'])) {
                $this->db->where('course_type', $data['event']);
            }
            if (!empty($data['time'])) {
                $this->db->where('time', $data['time']);
            }
            if (!empty($data['startDate'])) {
                $this->db->where('start_date', $data['startDate']);
            }
            if (!empty($data['endDate'])) {
                $this->db->where('end_date', $data['endDate']);
            }
            if (!empty($data['name'])) {
                $this->db->like('name', $data['name']);
            }
            if (!empty($data['weekDay'])) {
                $this->db->like('weekdays', $data['weekDay']);
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
        
        public function getCourse($data = [])
        {
            $this->db->where('course.del_flag', '0');
            if (isset($data['id']) && !empty($data['id'])) {
                $this->db->where('course.id', $data['id']);
            }
            if (isset($data['name']) && !empty($data['name'])) {
                $this->db->where('name', $data['name']);
            }
            return $this->db->get('course')->row_array();
        }

        public function updateCourse($data = [])
        {
            $this->db->set('name', $data['name']);
            $this->db->set('time', $data['time']);
            $this->db->set('course_type', $data['courseType']);
            $this->db->set('start_date', $data['startDate']);
            $this->db->set('end_date', $data['endDate']);
            $this->db->set('weekdays', $data['weekDays']);
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('id', $data['id']);
            $this->db->update('course');
        }

        public function addCourse($data = [])
        {
            $this->db->insert('course', $data);
            return $this->db->insert_id();
        }

        public function deleteCourse($data = [])
        {
            $this->db->set('del_flag', '1');
            $this->db->set('updated_user', $data['updateUser']);
            $this->db->set('updated_time', 'now');
            $this->db->where('id', $data['id']);
            $this->db->update('course');
        }
    }