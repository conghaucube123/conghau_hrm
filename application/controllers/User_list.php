<?php
    date_default_timezone_set('Asia/Bangkok');
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
            $data['header'] = 'component/header';
            $data['footer'] = 'component/footer';
            $data['sidebar'] = 'component/sidebar';
            $data = array_merge($data, $message);
            
            // View User list screen
            $this->load->view('user_list/user_list', $data);
        }

        /**
         * Filter data for datatable
         */
        public function filterData($data = [])
        {
            $draw = (int)($this->input->post("draw"));
            $columnOrder = ['login_id', 'gender', 'name', 'email', 'employee_id', 'image','status',] ;
            $order = $columnOrder[(int)$this->input->post('order[0][column]')];
            $dir = $this->input->post('order[0][dir]');
            $recordsTotal = count($this->Profile_model->getSearch());
            $dataSearch = [
                'employeeId' => trim($this->input->post('employeeId')),
                'name' => trim($this->input->post('name')),
                'email' => trim($this->input->post('email')),
                'available' => $this->input->post('available'),
                'unavailable' => $this->input->post('unavailable'),
            ];
            $recordsFilter = count($this->Profile_model->getSearch($dataSearch));
            $dataFilter = [
                'order' => $dir,
                'orderBy' => $order,
                'limit' => (int)$this->input->post('length'),
                'offset' => (int)$this->input->post('start'),
            ];
            $data = array_merge($dataSearch, $dataFilter);
            $profiles = $this->Profile_model->getSearch($data);
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
                $temp['image'] = '';
                if ($profile['status'] === '1') {
                    $temp['status'] = 'Available';
                } else {
                    $temp['status'] = 'Unavailable';
                }
                $temp['id'] = $profile['profile_id'];
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
            
            //Check image size
            if ($_FILES['avatar']['size'] > 10485760) {
                $error['imageSize'] = "The image can not be over 5MB";
                $error['flag'] = TRUE;
            }
            
            // Check image extension
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_type_allow = array('png', 'jpg', 'jpeg', 'gif');
            if (!in_array(strtolower($file_type), $file_type_allow)) {
                $error['imageType'] = "The image extension is not right.";
                $error['flag'] = TRUE;
            }
            
            // Check image exist
            if (file_exists($target_file)) {
                $error['imageExist'] = "The image name is already exist in this server.";
                $error['flag'] = TRUE;
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
                        $error['loginId'] = "Login ID is used";
                        $error['flag'] = TRUE;
                    }
                }
            }
            if (isset($data['email']) && !empty($data['email'])) {
                if ($this->Profile_model->getProfile(['email' => $data['email'],])) {
                    $profile = $this->Profile_model->getProfile(['email' => $data['email'],]);
                    if (strcasecmp($profile['id'], $data['id']) != 0) {
                        $error['email'] = "Email is used";
                        $error['flag'] = TRUE;
                    }
                }
            }
            if (isset($data['employeeId']) && !empty($data['employeeId'])) {
                if ($this->Profile_model->getProfile(['employeeId' => $data['employeeId'],])) {
                    $profile = $this->Profile_model->getProfile(['employeeId' => $data['employeeId'],]);
                    if (strcasecmp($profile['id'], $data['id']) != 0) {
                        $error['employeeId'] = "Employee ID is used";
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
        private function showEditView($error = [])
        {
            // Set data to view Edit screen
            $id = trim($this->uri->segment('3'));
            $data['positions'] = $this->Position_model->getPosition();
            $data['departments'] = $this->Department_model->getDepartment();
            $data['contractTypes'] = $this->Contract_type_model->getContractType();
            $data['profile'] = $this->Profile_model->getProfile(['id' => $id,]);
            $data['user'] = $this->User_model->getUser(['profileId' => $id]);
            $data['header'] = 'component/header';
            $data['footer'] = 'component/footer';
            $data['sidebar'] = 'component/sidebar';
            $data = array_merge($data, $error);
            
            // View Edit screen
            $this->load->view('user_list/edit', $data);
        }

        /**
         * Edit features
         */
        public function edit()
        {
            $error = [];
            if (!$this->input->post('edit-submit')) {
                $this->showEditView();

                return;
            }

            // Handle image
            $target_file = '';
            $file_name = '';
            if(!empty($_FILES['avatar'])) {
                // Create image link
                $target_dir = "C:/xampp/htdocs/conghau_hrm/public/images/";
                $target_file = $target_dir . basename($_FILES['avatar']['name']);
                $file_name = basename($_FILES['avatar']['name']);
                
            }
            
            // Draw input data
            $id = trim($this->uri->segment('3'));
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
                // 'imager' => $_FILES['avatar'],
            ];
            $error = array_merge($error, $returnData);

            $imageError = $this->imageCheck($target_file);
            if (!$imageError['flag']) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            } else {
                $error = array_merge($error, $imageError);
                $this->showEditView($error);

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
                $this->showEditView($error);

                return;
            }
            
            // Update data
            try {
                $this->db->trans_start();
                $this->User_model->updateUser($dataUser);
                $this->Profile_model->updateProfile($dataProfile);
                $this->db->trans_complete();
                $data['message'] = 'Update successfully!';
                $this->showEditView($data);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
            }
        }

        /**
         * Create screen
         * 
         * @param array error of data if any
         */
        private function showCreateView($error = [])
        {
            // Set data to view Create screen
            $data['positions'] = $this->Position_model->getPosition();
            $data['departments'] = $this->Department_model->getDepartment();
            $data['contractTypes'] = $this->Contract_type_model->getContractType();
            $data['header'] = 'component/header';
            $data['footer'] = 'component/footer';
            $data['sidebar'] = 'component/sidebar';
            $data = array_merge($data, $error);

            // View Create screen
            $this->load->view('user_list/create', $data);
        }

        public function create()
        {
            $error = [];
            if (!$this->input->post('create-submit')) {
                $this->showCreateView();

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

            // Draw input data
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
            ];
            $error = array_merge($error, $returnData);

            $imageError = $this->imageCheck($target_file);
            if (!$imageError['flag']) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            } else {
                $error = array_merge($error, $imageError);
                $this->showCreateView($error);

                return;
            }
            
            // Check data before update
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
                $this->showCreateView($error);

                return;
            }
            
            // Create User
            try {
                $this->db->trans_start();
                $profile_id = $this->Profile_model->createProfile($dataProfile);
                $profileId['profile_id'] = $profile_id;
                $dataUser = array_merge($dataUser, $profileId);
                $this->User_model->createUser($dataUser);
                $this->db->trans_complete();
                $this->showCreateView(['message' => 'Create successfully!']);
            } catch (Exception $e) {
                // echo $e;
                $this->db->trans_rollback();
            }
        }

        /**
         * Delete User
         */
        public function delete()
        {
            $id = trim($this->uri->segment('3'));
            // Delete User
            try {
                $this->db->trans_start();
                $this->Profile_model->deleteProfile($id);
                $this->User_model->deleteUser($id);
                $this->db->trans_complete();
                $this->list(['message' => 'Delete successfully!']);
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
            }
        }
    }