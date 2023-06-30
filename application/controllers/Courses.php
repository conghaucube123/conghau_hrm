<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require_once 'vendor/autoload.php';
    class Courses extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Profile_model');
            $this->load->model('Course_model');
            $this->load->model('Course_detail_model');
        }

        /**
         * Courses screen
         */
        public function index($message = [])
        {
            // Set data to view Courses screen
            $content = $this->load->view('courses/index', $message ,true);
            
            // View Courses screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * Filter Course data for datatable
         */
        public function filterCourseData($data = [])
        {
            $draw = (int)($this->input->post("draw"));
            $columnOrder = ['name', 'course_type', 'time', 'weekdays', 'start_date', 'end_date',] ;
            $order = $columnOrder[(int)$this->input->post('order[0][column]')];
            $dir = $this->input->post('order[0][dir]');
            $recordsTotal = count($this->Course_model->getCoursesSearch());
            $dataSearch = [
                'name' => trim($this->input->post('name')),
                'weekDay' => trim($this->input->post('weekDay')),
                'time' => date($this->input->post('time')),
                'startDate' => date($this->input->post('startDate')),
                'endDate' => date($this->input->post('endDate')),
                'course' => $this->input->post('course'),
                'event' => $this->input->post('event'),
            ];
            $recordsFilter = count($this->Course_model->getCoursesSearch($dataSearch));
            $dataFilter = [
                'order' => $dir,
                'orderBy' => $order,
                'limit' => (int)$this->input->post('length'),
                'offset' => (int)$this->input->post('start'),
            ];
            $data = array_merge($dataSearch, $dataFilter);
            $courses = $this->Course_model->getCoursesSearch($data);
            $dataResult = [];
            foreach ($courses as $course) {
                $temp = [];
                $temp['name'] = $course['name'];
                $temp['time'] = substr($course['time'], 0, 5);
                $temp['weekDay'] = $course['weekdays'];
                $temp['startDate'] = $course['start_date'];
                $temp['endDate'] = $course['end_date'];
                if ($course['course_type'] === '1') {
                    $temp['type'] = 'Course';
                } else {
                    $temp['type'] = 'Event';
                }
                $temp['id'] = $course['id'];
                $dataResult[] = $temp;
            }
            $result = [
                "draw" => $draw,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFilter,
                "data" => $dataResult,
            ];
            echo json_encode($result);
        }

        /**
         * Filter Employee list data for datatable
         */
        public function filterEmployeeListData($data = [])
        {
            $courseId = trim($this->input->post('courseId'));
            $draw = (int)($this->input->post("draw"));
            if (empty($courseId)) {
                $result = [
                    "draw" => $draw,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => [],
                ];
                echo json_encode($result);

                return;
            }
            $columnOrder = ['employee_id', 'name', 'email', 'birthday', 'address', 'mobile', 'gender',] ;
            $order = $columnOrder[(int)$this->input->post('order[0][column]')];
            $dir = $this->input->post('order[0][dir]');
            $dataSearch = [
                'courseId' => $courseId,
            ];
            $recordsFilter = count($this->Course_detail_model->getEmployeeList($dataSearch));
            $recordsTotal = $recordsFilter;
            $dataFilter = [
                'order' => $dir,
                'orderBy' => $order,
            ];
            $data = array_merge($dataSearch, $dataFilter);
            $course_details = $this->Course_detail_model->getEmployeeList($data);
            $dataResult = [];
            foreach ($course_details as $course_detail) {
                $temp = [];
                $temp['employeeID'] = $course_detail['employee_id'];
                $temp['name'] = $course_detail['name'];
                $temp['birthday'] = $course_detail['birthday'];
                if ($course_detail['gender'] === '1') {
                    $temp['gender'] = 'Male';
                } else {
                    $temp['gender'] = 'Female';
                }
                $temp['address'] = $course_detail['address'];
                $temp['email'] = $course_detail['email'];
                $temp['mobile'] = $course_detail['mobile'];
                $temp['image'] = $course_detail['image'];
                $temp['profileId'] = $course_detail['profile_id'];
                $temp['courseId'] = $course_detail['course_id'];
                $dataResult[] = $temp;
            }
            $result = [
                "draw" => $draw,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFilter,
                "data" => $dataResult,
            ];
            echo json_encode($result);
        }

        /**
         * Get Employee list data for add employee modal
         */
        public function getProfileData()
        {
            $profiles = $this->Profile_model->getProfile();
            $dataResult = [];
            foreach ($profiles as $profile) {
                $temp = [];
                $temp['id'] = $profile['id'];
                $temp['image'] = $profile['image'];
                $temp['employeeId'] = $profile['employee_id'];
                $temp['name'] = $profile['name'];
                $temp['birthday'] = $profile['birthday'];
                $temp['mobile'] = $profile['mobile'];
                $temp['gender'] = $profile['gender'];
                $temp['email'] = $profile['email'];
                $temp['address'] = $profile['address'];
                $dataResult[] = $temp;
            }
            echo json_encode($dataResult);
        }

        /**
         * Data check
         * 
         * @param   array data to check duplicate
         * @return  array  error of data duplication if any
         */
        private function dataCheck($data = [])
        {
            // Initialize error array
            $error = [
                'flag' => FALSE,
                'name' => '',
                'profileId' => '',
            ];
            if (!empty($data['name'])) {
                if ($this->Course_model->getCourse(['name' => $data['name'],])) {
                    $course = $this->Course_model->getCourse(['name' => $data['name'],]);
                    if (strcasecmp($course['id'], $data['id']) != 0) {
                        $error['name'] = lang('C_NAME003');
                        $error['flag'] = TRUE;
                    }
                }
            }
            if (!empty($data['profileId']) && !empty($data['courseId'])) {
                $find = [
                    'profile_id' => $data['profileId'],
                    'course_id' => $data['courseId'],
                ];
                if ($this->Course_detail_model->getCourseDetail($find)) {
                    $error['profileId'] = lang('PROFILEID001');
                    $error['flag'] = TRUE;
                }
            }

            return $error;
        }

        /**
         * Edit screen
         * 
         * @param array message if any
         * @param string id of profile
         */
        private function showEditView($id = '', $error = [])
        {
            // Set data to view Edit screen
            $data['course'] = $this->Course_model->getCourse(['id' => $id,]);
            $data['course_details'] = $this->Course_detail_model->getEmployeeList(['courseId' => $id,]);
            $data = array_merge($data, $error);
            $content = $this->load->view('courses/edit', $data ,true);
            
            // View Edit screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * Edit action
         * 
         * @param string id of profile
         */
        public function edit($id = '')
        {
            $error = [];
            if ($this->input->post('name')) {
                // Drawl input data
                $weekDays = $this->input->post('weekDays');
                $weekdays = '';
                if (!empty($weekDays)) {
                    $weekdays = $weekDays[0];
                    for ($i = 1; $i < count($weekDays); $i++) {
                        $weekdays = $weekdays . ', ' . $weekDays[$i];
                    }
                }
                if ($this->input->post('type') === 2) {
                    $weekdays = NULL;
                }
                $dataCourse = [
                    'id' => $id,
                    'name' => trim($this->input->post('name')),
                    'time' => date($this->input->post('time')),
                    'courseType' => $this->input->post('type'),
                    'startDate' => date($this->input->post('startDate')),
                    'endDate' => date($this->input->post('endDate')),
                    'weekDays' => $weekdays,
                    'updateUser' => $this->session->userdata('loginId'),
                ];

                $returnData = [
                    'namer' => $dataCourse['name'],
                    'timer' => $dataCourse['time'],
                    'courseTyper' => $dataCourse['courseType'],
                    'startDater' => $dataCourse['startDate'],
                    'endDater' => $dataCourse['endDate'],
                    'weekDaysr' => $weekdays,
                ];
                $error = array_merge($error, $returnData);

                // Check data before update
                $dataCheck = [
                    'id' => $id,
                    'name' => $dataCourse['name'],
                ];
                $dataError = $this->dataCheck($dataCheck);
                
                // Return error if any
                if ($dataError['flag']) {
                    $error = array_merge($error, $dataError);
                    $this->showEditView($id, $error);

                    return;
                }

                // Update Course information
                try {
                    $this->db->trans_start();
                    $this->Course_model->updateCourse($dataCourse);
                    $this->db->trans_complete();
                    $name = $this->Course_model->getCourse(['id' => $id,])['name'];
                    $message = lang('update_course') .' '. $name .' '. lang('success');
                    $this->session->set_flashdata('message', $message);
                    redirect('/Courses/edit/'.$id, 'location');
                } catch (Exception $e) {
                    echo $e;
                    $this->db->trans_rollback();
                    $message = lang('update_course') .' '. $name .' '. lang('fail') . ' ' . lang('wrong');
                    $this->session->set_flashdata('message', $message);
                    redirect('/Courses/edit/'.$id, 'location');
                }
            } else {
                $this->showEditView($id);

                return;
            }
        }

        /**
         * Add Employee to Course detail
         */
        public function addEmployee()
        {
            // Drawl input data
            $employeeName = trim($this->input->post('fullname_'));
            $courseName = trim($this->input->post('courseName_'));
            $dataEmployee = [
                'profile_id' => trim($this->input->post('profileId_')),
                'course_id' => trim($this->input->post('courseId_')),
                'updated_user' => $this->session->userdata('loginId'),
                'created_user' => $this->session->userdata('loginId'),
            ];

            // Check data before add
            $dataCheck = [
                'profileId' => $dataEmployee['profile_id'],
                'courseId' => $dataEmployee['course_id'],
            ];
            $dataError = $this->dataCheck($dataCheck);

            // Return error if any
            if ($dataError['flag']) {
                echo json_encode([
                    'success' => false,
                    'message'=> $dataError['profileId'] . '<br>',
                ]);

                return;
            }
            
            // Add Employee to Course Detail
            try {
                $this->db->trans_start();
                $this->Course_detail_model->addEmployee($dataEmployee);
                $this->db->trans_complete();
                $message = lang('add_course_detail_1') .' '. $employeeName .' '. lang('add_course_detail_2') .' '. $courseName .' '. lang('success');
                $this->session->set_flashdata('message', $message);
                echo json_encode([
                    'success' => true,
                    'message'=> $message,
                ]);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('add_course_detail_1') .' '. $employeeName .' '. lang('add_course_detail_2') .' '. $courseName .' '. lang('fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                redirect(current_url(), 'location');
            }
        }

        /**
         * Upload file Employee list in Edit course screen
         */
        public function upload()
        {
            $excelFile = $_FILES["file-upload-employee-list-hidden"]["tmp_name"];
            $fileName = $_FILES['file-upload-employee-list-hidden']['name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);
            $typeAllow = ['xls', 'csv', 'xlsx'];
            $checkExt = explode('.', $fileName);
            $fileExt = end($checkExt);
            if (!in_array(strtolower($fileExt), $typeAllow)) {
                echo json_encode([
                    'success' => false,
                    'message'=> lang('UPLOAD005') . '<br>',
                ]);

                return;
            }
            $data = $spreadsheet->getActiveSheet()->toArray($excelFile);
            if ((count($data) === 1) || (count($data) === 0)) {
                echo json_encode([
                    'success' => false,
                    'message'=> lang('UPLOAD008') . '<br>',
                ]);

                return;
            }
            $error = [
                'count' => 0,
                'error' => '',
            ];
            for ($i = 1; $i < count($data); $i++) {
                $checkEmp = explode('.', $data[$i][0]);
                $emp = end($checkEmp);
                $checkEma = explode('.', $data[$i][5]);
                $ema = end($checkEma);
                if (($emp === 'tmp') && ($ema === 'tmp')) {
                    $error['error'] = $error['error'] . '&nbsp;&nbsp;&nbsp;&nbsp; - ' . lang('UPLOAD002') . ' ' . ($i + 2) . ':<br>' . '&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; + ' . lang('UPLOAD003')  . '<br>' . '&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; + ' . lang('UPLOAD004') . '<br>';
                    $error['count'] = $error['count'] + 2;
                } else if ($emp === 'tmp') {
                    $error['error'] = $error['error'] . '&nbsp;&nbsp;&nbsp;&nbsp; - ' . lang('UPLOAD002') . ' ' . ($i + 2) . ': ' . lang('UPLOAD003') . '<br>';
                    $error['count'] = $error['count'] + 1;
                } else if ($ema === 'tmp') {
                    $error['error'] = $error['error'] . '&nbsp;&nbsp;&nbsp;&nbsp; - ' . lang('UPLOAD002') . ' ' . ($i + 2) . ': ' . lang('UPLOAD004') . '<br>';
                    $error['count'] = $error['count'] + 1;
                }
            }
            if ($error['count'] > 0) {
                echo json_encode([
                    'success' => false,
                    'message'=> lang('UPLOAD006') . ' (' . $error['count'] . ' ' . lang('UPLOAD007') . '):<br>' . $error['error'],
                ]);

                return;
            }
            $dataList = [];
            for ($i = 1; $i < count($data); $i++) {
                $temp = [];
                $temp['course_id'] = trim($this->input->post('courseId'));
                $temp['profile_id'] = $this->Profile_model->getProfile(['employeeId' => (string)($data[$i][0]),])['id'];
                $temp['updated_user'] = $this->session->userdata('loginId');
                $temp['created_user'] = $this->session->userdata('loginId');
                $dataList[] = $temp;
            }
            $dataUpdate = [
                'courseId' => $dataList['0']['course_id'],
                'updatedUser' => $this->session->userdata('loginId'),
            ];
            try {
                $this->db->trans_start();
                $this->Course_detail_model->updateEmployeeByUpload($dataUpdate);
                $this->Course_detail_model->addEmployeeByUpload($dataList);
                $this->db->trans_complete();
                $message = lang('upload_employee_list');
                $this->session->set_flashdata('message', $message);
                echo json_encode([
                    'success' => true,
                    'message'=> $message,
                ]);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('upload_fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                echo json_encode([
                    'success' => false,
                    'message'=> $message,
                ]);
            }
        }

        /**
         * Export template of Employee list
         */
        public function exportEmployeeListTemplate()
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            // $spreadsheet = $reader->load(base_url('public/file/employee_list_template.xlsx'));
            if ($this->session->userdata('site_lang') === 'vietnamese') {
                $filePath = 'views/courses/employee_list_template_vi.xlsx';
            } else {
                $filePath = 'views/courses/employee_list_template_en.xlsx';
            }
            $spreadsheet = $reader->load(APPPATH . $filePath);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="employee_list_template.xlsx"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }

        /**
         * Add screen
         * 
         * @param array message if any
         */
        private function showAddView($message = [])
        {
            // Set data to view Add screen
            $content = $this->load->view('courses/add', $message ,true);
            
            // View Add screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * Add action
         */
        public function add()
        {
            $error = [];
            if (!$this->input->post('name')) {
                $this->showAddView();

                return;
            }

            // Drawl input data
            $weekDays = $this->input->post('weekDays');
            $weekdays = '';
            if (!empty($weekDays)) {
                $weekdays = $weekDays[0];
                for ($i = 1; $i < count($weekDays); $i++) {
                    $weekdays = $weekdays . ', ' . $weekDays[$i];
                }
            }
            $dataCourse = [
                'name' => trim($this->input->post('name')),
                'time' => date($this->input->post('time')),
                'course_type' => $this->input->post('type'),
                'start_date' => date($this->input->post('startDate')),
                'end_date' => date($this->input->post('endDate')),
                'weekdays' => $weekdays,
                'updated_user' => $this->session->userdata('loginId'),
                'created_user' => $this->session->userdata('loginId'),
            ];

            $returnData = [
                'namer' => $dataCourse['name'],
                'timer' => $dataCourse['time'],
                'courseTyper' => $dataCourse['course_type'],
                'startDater' => $dataCourse['start_date'],
                'endDater' => $dataCourse['end_date'],
                'weekDaysr' => $weekDays,
            ];
            $error = array_merge($error, $returnData);

            // Check data before add
            $dataCheck = [
                'id' => '0',
                'name' => $dataCourse['name'],
            ];
            $dataError = $this->dataCheck($dataCheck);
            
            // Return error if any
            if ($dataError['flag']) {
                $error = array_merge($error, $dataError);
                $this->showAddView($error);

                return;
            }
            
            // Add Course
            try {
                $this->db->trans_start();
                $id = $this->Course_model->addCourse($dataCourse);
                $this->db->trans_complete();
                redirect('/Courses/edit/'.$id, 'location');
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('add_course') .' '. lang('fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                redirect('/Courses/add', 'location');
            }
        }

        /**
         * Delete Course
         */
        public function deleteCourse()
        {
            // Set up data to delete
            $name = trim($this->input->post('name'));
            $dataDelete = [
                'id' => trim($this->input->post('id')),
                'updateUser' => $this->session->userdata('loginId'),
            ];
            // Delete Course
            try {
                $this->db->trans_start();
                $this->Course_model->deleteCourse($dataDelete);
                $this->db->trans_complete();
                $message = lang('delete_course') .' '. $name .' '. lang('success');
                $this->session->set_flashdata('message', $message);
                header('Content-Type', 'application/json');
                echo json_encode([
                    'success' => true,
                    'message'=> $message,
                ]);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('delete_course') .' '. $name .' '. lang('fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                redirect('/Courses', 'location');
            }
        }

        /**
         * Delete Employee
         */
        public function deleteEmployee()
        {
            // Set up data to delete
            $dataDelete = [
                'profileId' => trim($this->input->post('profileId')),
                'courseId' => trim($this->input->post('courseId')),
                'updateUser' => $this->session->userdata('loginId'),
            ];
            $name = $this->Profile_model->getProfile(['id' => $dataDelete['profileId'],])['name'];
            // Delete Employee
            try {
                $this->db->trans_start();
                $this->Course_detail_model->deleteEmployee($dataDelete);
                $this->db->trans_complete();
                $message = lang('delete_employee') .' '. $name .' '. lang('success');
                $this->session->set_flashdata('message', $message);
                header('Content-Type', 'application/json');
                echo json_encode([
                    'success' => true,
                    'message'=> $message,
                ]);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('delete_employee') .' '. $name .' '. lang('fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                redirect(current_url(), 'location');
            }
        }
    }