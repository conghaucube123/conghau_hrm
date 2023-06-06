<?php
    class MY_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            if (!$this->session->userdata('logged_in')) {
                $this->session->set_userdata('return_url', current_url());
                redirect('/Authentication', 'location');
            }
        }

    }