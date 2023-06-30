<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require_once 'vendor/autoload.php';
    class User extends MY_Controller
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
                'password' => '',
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
            if (isset($data['password']) && !empty($data['password'])) {
                $dataFind = [
                    'profileId' => $data['id'],
                    'password' => $data['password'],
                ];
                if (!$this->User_model->getUser($dataFind)) {
                    $error['password'] = lang('PASSWORD007');
                    $error['flag'] = TRUE;
                }
            }

            return $error;
        }

        /**
         * User profile screen
         * 
         * @param array message if any
         * @param string Login ID of user
         */
        private function showProfileView($loginId = '', $message = [])
        {
            // Set data to view User profile screen
            $data['positions'] = $this->Position_model->getPosition();
            $data['departments'] = $this->Department_model->getDepartment();
            $data['contractTypes'] = $this->Contract_type_model->getContractType();
            $data['user'] = $this->User_model->getUser(['loginId' => $loginId,]);
            $data['profile'] = $this->Profile_model->getProfile(['id' => $data['user']['profile_id'],]);
            $data = array_merge($data, $message);
            $content = $this->load->view('user/index', $data ,true);
            
            // View User profile screen
            $this->load->view('master_page', ['content' => $content]);
        }

        /**
         * User profile action
         * 
         * @param string Login ID of user
         */
        public function profile($loginId = '')
        {
            $error = [];
            if (!$this->input->post('loginId')) {
                $this->showProfileView($loginId, $error);

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
                'id' => $this->input->post('profileId'),
                'name' => trim($this->input->post('fullname')),
                'email' => trim($this->input->post('email')),
                'birthday' => date($this->input->post('birthday')),
                'address' => trim($this->input->post('address')),
                'telephone' => trim($this->input->post('telephone')),
                'mobile' => trim($this->input->post('mobile')),
                'gender' => $this->input->post('gender'),
                'image' => $file_name,
                'updateUser' => $this->session->userdata('loginId'),
            ];
            $dataUser = [
                'id' => $this->input->post('profileId'),
                'loginId' => trim($this->input->post('loginId')),
                'updateUser' => $this->session->userdata('loginId'),
            ];

            $returnData = [
                'loginIdr' => $dataUser['loginId'],
                'namer' => $dataProfile['name'],
                'emailr' => $dataProfile['email'],
                'birthdayr' => $dataProfile['birthday'],
                'addressr' => $dataProfile['address'],
                'telephoner' => $dataProfile['telephone'],
                'mobiler' => $dataProfile['mobile'],
                'genderr' => $dataProfile['gender'],
                'imager' => $_FILES['avatar'],
            ];
            $error = array_merge($error, $returnData);

            $imageError = $this->imageCheck($target_file);
            if (!$imageError['flag']) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            } else {
                $error = array_merge($error, $imageError);
                $this->showProfileView($loginId, $error);

                return;
            }
            
            // Check data before update
            $dataCheck = [
                'id' => $dataProfile['id'],
                'email' => $dataProfile['email'],
                'loginId' => $dataUser['loginId'],
            ];
            if (!empty($this->input->post('password'))) {
                $dataCheck['password'] = $this->input->post('password');
                $dataUser['password'] = md5(trim($this->input->post('newpassword')));
            }
            $dataError = $this->dataCheck($dataCheck);
            
            // Return error if any
            if ($dataError['flag']) {
                $error = array_merge($error, $dataError);
                $this->showProfileView($loginId, $error);

                return;
            }
            
            // Update data
            try {
                $this->db->trans_start();
                $this->User_model->updateUserProfile($dataUser);
                $this->Profile_model->updateUserProfile($dataProfile);
                $this->db->trans_complete();
                $message = lang('update_user_success');
                $this->session->set_flashdata('message', $message);
                redirect('/User/profile/'.$loginId, 'location');
            } catch (Exception $e) {
                echo $e;
                $this->db->trans_rollback();
                $message = lang('update_user_fail') . ' ' . lang('wrong');
                $this->session->set_flashdata('message', $message);
                redirect('/User/profile/'.$loginId, 'location');
            }
        }

        /**
         * Logout features
         */
        public function logout()
        {
            $this->session->sess_destroy();
            redirect('/Authentication', 'location');
        }
    }