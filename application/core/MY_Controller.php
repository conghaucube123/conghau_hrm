<?php
    class MY_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->session->set_userdata('return_url', current_url());
            if (!$this->session->userdata('logged_in')) {
                redirect('/Authentication', 'location');
            }
        }

    }