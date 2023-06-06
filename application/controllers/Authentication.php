<?php
    class Authentication extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('User_model');
            $this->load->model('Profile_model');
        }

        public function index()
        {
           $this->load->view('login/login'); 
        }

        /**
         * Login screen
         */
        public function login()
        {
            // Validate input
            $this->form_validation->set_rules('loginId', 'login ID', 'required|max_length[30]|min_length[3]');
            $this->form_validation->set_rules('password', 'password', 'required|max_length[255]|min_length[3]');
            $this->form_validation->set_message('required', '<span style="margin-left:135px; color:red"> Please enter your %s.</span>');
            $this->form_validation->set_message('min_length', '<span style="margin-left:135px; color:red"> The %s must have at least {param} character.</span>');
            $this->form_validation->set_message('max_length', '<span style="margin-left:135px; color:red"> The %s must have maximum {param} character.</span>');
            if (!$this->form_validation->run()) {
                $this->load->view('login');

                return;
            }
            
            // Authenticate user. Redirect to User_list screen if authenticate successful
            $data = [
                'loginId' => $this->input->post('loginId'),
                'password' => md5($this->input->post('password')),
            ];
            $user = $this->User_model->getUser($data);
            if (!$user) {
                echo '<script type="text/javascript">alert("The login ID or password is incorrect"); window.location="'.base_url().'Authentication";</script>';
                return;
            } else {
                $profile = $this->Profile_model->getProfile(['id' => $user['profile_id'],]);
                $sess = [
                    'loginId' => $data['loginId'],
                    'password' => $data['password'],
                    'logged_in' => 1,
                    'lang' => 'english',
                    'img' => $profile['image'],
                ];
                $this->session->set_userdata($sess);
                $redirect_url = $this->session->userdata('return_url');
                if (!empty($redirect_url)) {
                    redirect ($redirect_url);
                } else {
                    redirect('/User_list/list', 'location');
                }                
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