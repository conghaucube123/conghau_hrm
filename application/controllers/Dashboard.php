<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    class Dashboard extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Profile_model');
        }

        public function index($message = [])
        {
            // Set data to load User list view
            $profiles = $this->Profile_model->getProfilesSearch();
            $male = 0;
            $female = 0;
            $available = 0;
            $unavailable = 0;
            $recent = 0;
            $mon = 0;
            $tue = 0;
            $wed = 0;
            $thu = 0;
            $fri = 0;
            $sta = 0;
            $sun = 0;
            $day_names = [
                1 => "Monday",
                2 => "Tuesday",
                3 => "Wednesday",
                4 => "Thursday",
                5 => "Friday",
                6 => "Saturday",
                7 => "Sunday"
            ];
            $days = [];
            $date = date('Y-m-d');
            $begin = strtotime($date);
            $datetime = new DateTime($date);
            $today  = (int)$datetime->format('w');
            for ($i = 0; $i < $today; $i++) {
                $days[$day_names[$today - $i]] = (string)(date("Y-m-d", $begin - (60*60*24*$i)));
            }
            for ($i = $today; $i < 7; $i++) {
                $days[$day_names[7-$i+$today]] = (string)(date("Y-m-d", $begin + (60*60*24*(7 - $i))));
            }
            foreach ($profiles as $profile) {
                if ($profile['gender'] === '1') {
                    $male = $male + 1;
                } else {
                    $female = $female + 1;
                }
                if ($profile['status'] === '1') {
                    $available = $available + 1;
                } else {
                    $unavailable = $unavailable + 1;
                }
                $time = substr($profile['recent_login'], 0, 10);
                if (strcasecmp($time, $days['Monday']) === 0) {
                    $mon = $mon + 1;
                } else if (strcasecmp($time, $days['Tuesday']) === 0) {
                    $tue = $tue + 1;
                } else if (strcasecmp($time, $days['Wednesday']) === 0) {
                    $wed = $wed + 1;
                } else if (strcasecmp($time, $days['Thursday']) === 0) {
                    $thu = $thu + 1;
                } else if (strcasecmp($time, $days['Friday']) === 0) {
                    $fri = $fri + 1;
                } else if (strcasecmp($time, $days['Saturday']) === 0) {
                    $sta = $sta + 1;
                } else if (strcasecmp($time, $days['Sunday']) === 0) {
                    $sun = $sun + 1;
                } else {
                    $recent = $recent + 1;
                }
            }
            $message['recent'] = $recent;
            $message['mon'] = $mon;
            $message['tue'] = $tue;
            $message['wed'] = $wed;
            $message['thu'] = $thu;
            $message['fri'] = $fri;
            $message['sta'] = $sta;
            $message['sun'] = $sun;
            $message['male'] = $male;
            $message['female'] = $female;
            $message['available'] = $available;
            $message['unavailable'] = $unavailable;
            $content = $this->load->view('dashboard/index', $message ,true);
            
            // View User list screen
            $this->load->view('master_page', ['content' => $content]);
        }
    }