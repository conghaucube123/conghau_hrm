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
            if (!$this->session->userdata('logged_in')) {
                $this->load->view('login/index');

                return;
            }
            $redirect_url = $this->session->userdata('return_url');
            if (!empty($redirect_url)) {
                redirect ($redirect_url);
            } else {
                redirect('/Dashboard', 'location');
            }
        }

        /**
         * Login screen
         */
        public function login()
        {
            // Validate input
            // $this->form_validation->set_rules('loginId', 'login ID', 'required|max_length[30]|min_length[3]');
            // $this->form_validation->set_rules('password', 'password', 'required|max_length[255]|min_length[3]');
            // $this->form_validation->set_message('required', '<span style="margin-left:135px; color:red"> Please enter your %s.</span>');
            // $this->form_validation->set_message('min_length', '<span style="margin-left:135px; color:red"> The %s must have at least {param} character.</span>');
            // $this->form_validation->set_message('max_length', '<span style="margin-left:135px; color:red"> The %s must have maximum {param} character.</span>');
            // if (!$this->form_validation->run()) {
            //     $this->load->view('login');

            //     return;
            // }
            
            // Authenticate user. Redirect to User_list screen if authenticate successful
            $data = [
                'loginId' => trim($this->input->post('loginId')),
                'password' => md5($this->input->post('password')),
            ];
            $user = $this->User_model->getUser($data);
            if (!$user) {
                $message = lang('login_fail');
                $this->session->set_flashdata('loginIdr', $this->input->post('loginId'));
                $this->session->set_flashdata('message', $message);
                redirect('/Authentication', 'location');
            } else {
                $profile = $this->Profile_model->getProfile(['id' => $user['profile_id'],]);
                $this->User_model->updateLogin(['id' => $user['profile_id'],]);
                $sess = [
                    'loginId' => $data['loginId'],
                    'password' => $data['password'],
                    'id' => $user['profile_id'],
                    'logged_in' => 1,
                    'site_lang' => 'english',
                    'name' => $profile['name'],
                    'img' => $profile['image'],
                ];
                $this->session->set_userdata($sess);
                $redirect_url = $this->session->userdata('return_url');
                if (!empty($redirect_url)) {
                    redirect ($redirect_url);
                } else {
                    redirect('/Dashboard', 'location');
                }
            }
        }
    }