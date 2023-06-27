<?php
    date_default_timezone_set('Asia/Bangkok');
    require_once 'vendor/autoload.php';
    class User_list extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('User_model');
            $this->load->model('Profile_model');
            $this->load->model('Position_model');
            $this->load->model('Department_model');
            $this->load->model('Contract_type_model');
        }

        /**
         * User list screen
         */
        public function list($message = [])
        {
            // Set data to load User list view
            $content = $this->load->view('user_list/user_list', $message ,true);
            
            // View User list screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * Filter data for datatable
         */
        public function filterUserListData($data = [])
        {
            $draw = (int)($this->input->post("draw"));
            $columnOrder = ['login_id', 'gender', 'name', 'email', 'employee_id', 'image','status',] ;
            $order = $columnOrder[(int)$this->input->post('order[0][column]')];
            $dir = $this->input->post('order[0][dir]');
            $recordsTotal = count($this->Profile_model->getProfilesSearch());
            $dataSearch = [
                'employeeId' => trim($this->input->post('employeeId')),
                'name' => trim($this->input->post('name')),
                'email' => trim($this->input->post('email')),
                'available' => $this->input->post('available'),
                'unavailable' => $this->input->post('unavailable'),
            ];
            $recordsFilter = count($this->Profile_model->getProfilesSearch($dataSearch));
            $dataFilter = [
                'order' => $dir,
                'orderBy' => $order,
                'limit' => (int)$this->input->post('length'),
                'offset' => (int)$this->input->post('start'),
            ];
            $data = array_merge($dataSearch, $dataFilter);
            $profiles = $this->Profile_model->getProfilesSearch($data);
            $positions = $this->Position_model->getPosition();
            $departments = $this->Department_model->getDepartment();
            $contractTypes = $this->Contract_type_model->getContractType();
            $dataResult = [];
            foreach ($profiles as $profile) {
                $temp = [];
                $temp['loginId'] = $profile['login_id'];
                if ($profile['gender'] === '1') {
                    $temp['gender'] = 'Male';
                } else {
                    $temp['gender'] = 'Female';
                }
                $temp['fullname'] = $profile['name'];
                $temp['email'] = $profile['email'];
                $temp['employeeId'] = $profile['employee_id'];
                $temp['image'] = $profile['image'];
                if ($profile['status'] === '1') {
                    $temp['status'] = 'Available';
                } else {
                    $temp['status'] = 'Unavailable';
                }
                $temp['id'] = $profile['profile_id'];
                $temp['recentLogin'] = $profile['recent_login'];
                $temp['createdTime'] = $profile['created_time'];
                $temp['createdUser'] = $profile['created_user'];
                $temp['mobile'] = $profile['mobile'];
                $temp['birthday'] = $profile['birthday'];
                foreach ($positions as $position) {
                    if ($profile['position_id'] === $position['id']) {
                        $temp['position'] = $position['name'];
                    }
                }
                foreach ($departments as $department) {
                    if ($profile['department_id'] === $department['id']) {
                        $temp['department'] = $department['name'];
                    }
                }
                foreach ($contractTypes as $contractType) {
                    if ($profile['contract_type_id'] === $contractType['id']) {
                        $temp['contractType'] = $contractType['name'];
                    }
                }
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
         * Export  User list
         */
        public function exportUserList()
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            // $spreadsheet = $reader->load(base_url('public/file/employee_list_template.xlsx'));
            if ($this->session->userdata('site_lang') === 'vietnamese') {
                $filePath = 'views/user_list/user_list_template_vi.xlsx';
            } else {
                $filePath = 'views/user_list/user_list_template_en.xlsx';
            }
            $spreadsheet = $reader->load(APPPATH . $filePath);
            $profiles = $this->Profile_model->getProfile();
            $data = [];
            foreach ($profiles as $profile) {
                $temp = [];
                $temp['employee_id'] = $profile['employee_id'];
                $temp['fullname'] = $profile['name'];
                $temp['birthday'] = $profile['birthday'];
                if ($profile['gender'] === '1') {
                    $temp['gender'] = 'Male';
                } else {
                    $temp['gender'] = 'Female';
                }
                $temp['address'] = $profile['address'];
                $temp['email'] = $profile['email'];
                $temp['mobile'] = $profile['mobile'];
                $data[] = $temp;
            }
            // var_dump($data);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->insertNewRowBefore(3, count($data));
            $sheet->fromArray($data, NULL, 'A2');
            $spreadsheet->setActiveSheetIndex(0);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="user_list.xlsx"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }

        /**
         * Image check
         * 
         * @param   string url to move image
         * @return  array  error of image if any
         */
        private function imageCheck($target_file = '')
        {
            // Initialize error array
            $error = [
                'flag' => FALSE,
                'imageSize' => '',
                'imageType' => '',
                'imageExist' => '',
            ];
            if (!empty($target_file)) {
                //Check image size
                if ($_FILES['avatar']['size'] > 10485760) {
                    $error['imageSize'] = lang('IMAGE002');
                    $error['flag'] = TRUE;
                }
                
                // Check image extension
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_type_allow = ['png', 'jpg', 'jpeg', 'gif'];
                if (!in_array(strtolower($file_type), $file_type_allow)) {
                    $error['imageType'] = lang('IMAGE003');
                    $error['flag'] = TRUE;
                }
                
                // Check image exist
                if (file_exists($target_file)) {
                    $error['imageExist'] = lang('IMAGE004');
                }
            }

            return $error;
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
                'loginId' => '',
                'email' => '',
                'employeeId' => '',
            ];
            if (isset($data['loginId']) && !empty($data['loginId'])) {
                if ($this->User_model->getUser(['loginId' => $data['loginId'],])) {
                    $user = $this->User_model->getUser(['loginId' => $data['loginId'],]);
                    if (strcasecmp($user['profile_id'], $data['id']) != 0) {
                        $error['loginId'] = lang('LOGINID004');
                        $error['flag'] = TRUE;
                    }
                }
            }
            if (isset($data['email']) && !empty($data['email'])) {
                if ($this->Profile_model->getProfile(['email' => $data['email'],])) {
                    $profile = $this->Profile_model->getProfile(['email' => $data['email'],]);
                    if (strcasecmp($profile['id'], $data['id']) != 0) {
                        $error['email'] = lang('EMAIL004');
                        $error['flag'] = TRUE;
                    }
                }
            }
            if (isset($data['employeeId']) && !empty($data['employeeId'])) {
                if ($this->Profile_model->getProfile(['employeeId' => $data['employeeId'],])) {
                    $profile = $this->Profile_model->getProfile(['employeeId' => $data['employeeId'],]);
                    if (strcasecmp($profile['id'], $data['id']) != 0) {
                        $error['employeeId'] = lang('EMPLOYEEID004');
                        $error['flag'] = TRUE;
                    }
                }
            }

            return $error;
        }

        /**
         * Edit screen
         * 
         * @param array error of data if any
         */
        private function showEditView($id = '', $error = [])
        {
            // Set data to view Edit screen
            $data['positions'] = $this->Position_model->getPosition();
            $data['departments'] = $this->Department_model->getDepartment();
            $data['contractTypes'] = $this->Contract_type_model->getContractType();
            $data['profile'] = $this->Profile_model->getProfile(['id' => $id,]);
            $data['user'] = $this->User_model->getUser(['profileId' => $id,]);
            $data = array_merge($data, $error);
            $content = $this->load->view('user_list/edit', $data ,true);
            
            // View Edit screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * Edit features
         */
        public function edit($id = '')
        {
            $error = [];
            if (!$this->input->post('email')) {
                $this->showEditView($id);

                return;
            }

            // Handle image
            $target_file = '';
            $file_name = '';
            if(!empty($_FILES['avatar']['name'])) {
                // Create image link
                $target_dir = "C:/xampp/htdocs/conghau_hrm/public/images/";
                $target_file = $target_dir . basename($_FILES['avatar']['name']);
                $file_name = basename($_FILES['avatar']['name']);
                
            }
            
            // Drawl input data
            $dataProfile = [
                'id' => $id,
                'name' => trim($this->input->post('fullname')),
                'email' => trim($this->input->post('email')),
                'birthday' => $this->input->post('birthday'),
                'position_id' => $this->input->post('positionId'),
                'department_id' => $this->input->post('departmentId'),
                'address' => trim($this->input->post('address')),
                'telephone' => trim($this->input->post('telephone')),
                'mobile' => trim($this->input->post('mobile')),
                'status' => $this->input->post('status'),
                'gender' => $this->input->post('gender'),
                'image' => $file_name,
                'updateUser' => $this->session->userdata('loginId'),
            ];
            $dataUser = [
                'id' => $id,
                'password' => md5(trim($this->input->post('password'))),
                'contract_type_id' => $this->input->post('contractTypeId'),
                'updateUser' => $this->session->userdata('loginId'),
            ];

            $returnData = [
                'contractTypeIdr' => $dataUser['contract_type_id'],
                'namer' => $dataProfile['name'],
                'emailr' => $dataProfile['email'],
                'birthdayr' => $dataProfile['birthday'],
                'positionIdr' => $dataProfile['position_id'],
                'departmentIdr' => $dataProfile['department_id'],
                'addressr' => $dataProfile['address'],
                'telephoner' => $dataProfile['telephone'],
                'mobiler' => $dataProfile['mobile'],
                'statusr' => $dataProfile['status'],
                'genderr' => $dataProfile['gender'],
                'imager' => $_FILES['avatar'],
            ];
            $error = array_merge($error, $returnData);

            $imageError = $this->imageCheck($target_file);
            if (!$imageError['flag']) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            } else {
                $error['im'] = $_FILES['avatar'];
                $error = array_merge($error, $imageError);
                $this->showEditView($id, $error);

                return;
            }
            
            // Check data before update
            $dataCheck = [
                'id' => $id,
                'email' => $dataProfile['email'],
            ];
            $dataError = $this->dataCheck($dataCheck);
            
            // Return error if any
            if ($dataError['flag']) {
                $error = array_merge($error, $dataError);
                $this->showEditView($id, $error);

                return;
            }
            
            // Update data
            try {
                $this->db->trans_start();
                $this->User_model->updateUser($dataUser);
                $this->Profile_model->updateProfile($dataProfile);
                $this->db->trans_complete();
                $loginId = $this->User_model->getUser(['profileId' => $id,])['login_id'];
                $data['message'] = lang('update_user') .' '. $loginId .' '. lang('success');
                $this->showEditView($id, $data);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
            }
        }

        /**
         * Add screen
         * 
         * @param array error of data if any
         */
        private function showAddView($error = [])
        {
            // Set data to view Add screen
            $data['positions'] = $this->Position_model->getPosition();
            $data['departments'] = $this->Department_model->getDepartment();
            $data['contractTypes'] = $this->Contract_type_model->getContractType();
            $data = array_merge($data, $error);
            $content = $this->load->view('user_list/add', $data ,true);
            
            // View Add screen
            $this->load->view('master_page', ['content' => $content]);
        }

        public function add()
        {
            $error = [];
            if (!$this->input->post('loginId')) {
                $this->showAddView();

                return;
            }

            // Handle image
            $target_file = '';
            $file_name = '';
            if(!empty($_FILES['avatar']['name'])) {
                // Create image link
                $target_dir = "C:/xampp/htdocs/conghau_hrm/public/images/";
                $target_file = $target_dir . basename($_FILES['avatar']['name']);
                $file_name = basename($_FILES['avatar']['name']);
                
            }

            // Drawl input data
            $dataProfile = [
                'employee_id' => trim($this->input->post('employeeId')),
                'name' => trim($this->input->post('fullname')),
                'email' => trim($this->input->post('email')),
                'birthday' => $this->input->post('birthday'),
                'position_id' => $this->input->post('positionId'),
                'department_id' => $this->input->post('departmentId'),
                'address' => trim($this->input->post('address')),
                'telephone' => trim($this->input->post('telephone')),
                'mobile' => trim($this->input->post('mobile')),
                'official_date' => $this->input->post('officialDate'),
                'probation_date' => $this->input->post('probationDate'),
                'status' => $this->input->post('status'),
                'gender' => $this->input->post('gender'),
                'image' => $file_name,
                'updated_user' => $this->session->userdata('loginId'),
                'created_user' => $this->session->userdata('loginId'),
            ];
            $dataUser = [
                'login_id' => trim($this->input->post('loginId')),
                'password' => md5(trim($this->input->post('password'))),
                'contract_type_id' => $this->input->post('contractTypeId'),
                'updated_user' => $this->session->userdata('loginId'),
                'created_user' => $this->session->userdata('loginId'),
            ];

            $returnData = [
                'loginIdr' => $dataUser['login_id'],
                'contractTypeIdr' => $dataUser['contract_type_id'],
                'employeeIdr' => $dataProfile['employee_id'],
                'namer' => $dataProfile['name'],
                'emailr' => $dataProfile['email'],
                'birthdayr' => $dataProfile['birthday'],
                'positionIdr' => $dataProfile['position_id'],
                'departmentIdr' => $dataProfile['department_id'],
                'addressr' => $dataProfile['address'],
                'telephoner' => $dataProfile['telephone'],
                'mobiler' => $dataProfile['mobile'],
                'officialDater' => $dataProfile['official_date'],
                'probationDater' => $dataProfile['probation_date'],
                'statusr' => $dataProfile['status'],
                'genderr' => $dataProfile['gender'],
                'imager' => $_FILES['avatar'],
            ];
            $error = array_merge($error, $returnData);

            $imageError = $this->imageCheck($target_file);
            if (!$imageError['flag']) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            } else {
                $error = array_merge($error, $imageError);
                $this->showAddView($error);

                return;
            }
            
            // Check data before add
            $dataCheck = [
                'id' => '0',
                'loginId' => $dataUser['login_id'],
                'employeeId' => $dataProfile['employee_id'],
                'email' => $dataProfile['email'],
            ];
            $dataError = $this->dataCheck($dataCheck);
            
            // Return error if any
            if ($dataError['flag']) {
                $error = array_merge($error, $dataError);
                $this->showAddView($error);

                return;
            }
            
            // Add User
            try {
                $this->db->trans_start();
                $profile_id = $this->Profile_model->addProfile($dataProfile);
                $profile = $this->Profile_model->getProfile(['id' => $profile_id,]);
                $profileId['profile_id'] = $profile_id;
                $dataUser = array_merge($dataUser, $profileId);
                $this->User_model->addUser($dataUser);
                $this->db->trans_complete();
                $data['message'] = lang('add_user_success').' '. $profile['employee_id'];
                $this->showAddView($data);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
            }
        }

        /**
         * Delete User
         */
        public function delete()
        {
            // Delete User
            try {
                $loginId = trim($this->input->post('login_id'));
                $dataDelete = [
                    'id' => trim($this->input->post('id')),
                    'updateUser' => $this->session->userdata('loginId'),
                ];
                $this->db->trans_start();
                $this->Profile_model->deleteProfile($dataDelete);
                $this->User_model->deleteUser($dataDelete);
                $this->db->trans_complete();
                header('Content-Type', 'application/json');
                echo json_encode([
                    'success' => true,
                    'message'=> lang('delete_user') .' '. $loginId .' '. lang('success'),
                ]);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
            }
        }
    }