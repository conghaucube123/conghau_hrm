
<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>COURSE MANAGEMENT SYSTEM</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/icon-9.png'); ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>public/jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        
        <script src="https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json"></script>
        <style>
            :root {
                --font-family-sans-serif: "Open Sans", -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
            *, *::before, *::after {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            html {
                font-family: sans-serif;
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
            nav {
                display: block;
            }
            body {
                margin: 0;
                font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                color: #515151;
                text-align: left;
            }
            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }
            a {
                color: #3f84fc;
                text-decoration: none;
                background-color: transparent;
            }
            a:hover {
                color: #0458eb;
                text-decoration: underline;
            }
            .dashboard {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                min-height: 100vh;
            }
            .dashboard-app {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-flex: 2;
                -webkit-flex-grow: 2;
                -ms-flex-positive: 2;
                flex-grow: 2;
                margin-top: 84px;
            }
            .dashboard-content {
                -webkit-box-flex: 2;
                -webkit-flex-grow: 2;
                -ms-flex-positive: 2;
                flex-grow: 2;
                padding: 25px;
            }
            .dashboard-nav {
                min-width: 238px;
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                overflow: auto;
                background-color: #373193;
                z-index: 1000;
            }
            .dashboard-compact .dashboard-nav {
                display: none;
            }
            .dashboard-nav header {
                min-height: 84px;
                padding: 8px 27px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .dashboard-nav header .menu-toggle {
                display: none;
                margin-right: auto;
            }
            .dashboard-nav header img {
                width: 100%;
            }
            .dashboard-nav a {
                color: #515151;
            }
            .dashboard-nav a:hover {
                text-decoration: none;
            }
            .dashboard-nav {
                background-color: #0e1c36;
            }
            .dashboard-nav a {
                color: #fff;
            }
            .brand-logo {
                font-family: "Nunito", sans-serif;
                font-weight: bold;
                font-size: 20px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                color: #515151;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .brand-logo:focus, .brand-logo:active, .brand-logo:hover {
                color: #dbdbdb;
                text-decoration: none;
            }
            .brand-logo i {
                color: #d2d1d1;
                font-size: 27px;
                margin-right: 10px;
            }
            .dashboard-nav-list {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
            }
            .dashboard-nav-item {
                min-height: 56px;
                padding: 8px 20px 8px 70px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                letter-spacing: 0.02em;
                transition: ease-out 0.5s;
            }
            .dashboard-nav-item i {
                width: 36px;
                font-size: 19px;
                margin-left: -40px;
            }
            .dashboard-nav-item:hover {
                background: rgba(255, 255, 255, 0.1);
            }
            .active {
                background: rgba(0, 0, 0, 0.5);
            }
            .nav {
                display: inline;
            }
            .menu-toggle {
                position: relative;
                float: left;
                margin: 0;
                width: 10%;
                width: 42px;
                height: 42px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
                cursor: pointer;
                color: #0e1c36;
            }
            .menu-toggle:hover, .menu-toggle:active, .menu-toggle:focus {
                text-decoration: none;
                color: #6c757d;
            }
            .menu-toggle i {
                font-size: 20px;
            }
            .dashboard-toolbar {
                min-height: 50px;
                background-color: #dfdfdf;
                align-items: center;
                padding: 8px 27px;
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                z-index: 1000;
            }
            .nav_menu {
                float: left;
                background-color: #e8e8e8;
                background-image: linear-gradient(45deg, #fafafa, #dbdbdb);
                margin-bottom: 10px;
                width: 100%;
                position: relative;
            }
            .dashboard-toolbar .navbar-right{
                margin: 0;
                float: right;
            }
            .navbar-right{
                padding-top: 10px;
                margin-right: 0;
            }
            .navbar-right >ul >li {
                margin-left: 20px;
            }
            .navbar-right ul li {
                list-style-type: none;
                display: inline;
            }
            .dropdown-toggle {
                background-color: #dfdfdf;
                border: none;
                outline: none;
            }
            .dropdown img, 
            .lang img {
                height: 20px;
                width: 20px;
                overflow: hidden;
            }
            .nav-item-divider {
                height: 1px;
                margin: 1rem 0;
                overflow: hidden;
                background-color: rgba(236, 238, 239, 0.3);
            }
            .footer-container {
                text-align: center;
                margin-top: 50px;
                margin-bottom: 50px;
                position: sticky;
                bottom: 0;
                width: 100%;
            }
            #userTable_processing,
            #courseTable_processing,
            #employeeTable_processing {
                border: #dfdfdf 1px solid;
                border-radius: 5px;
                background-color: #fff;
                padding: 7px;
                position: absolute;
                z-index: 2000;
            }
            #userTable_processing div,
            #courseTable_processing div,
            #employeeTable_processing div {
                display: none;
            }
            .dataTables_length {
                font-weight: normal;
                margin-bottom: 10px;
            }
            .title {
                background-image: linear-gradient(0, #c1e3d6, #d7ebe1, #d7ebe1, #d7ebe1);
            }
            label {
                cursor: pointer;
            }
            @media (min-width: 992px) {
                .dashboard-app {
                    margin-left: 238px;
                }
                .dashboard-compact .dashboard-app {
                    margin-left: 0;
                }
            }
            @media (max-width: 768px) {
                .dashboard-content {
                    padding: 15px 0px;
                }
                .footer-container {
                    margin-top: 20px;
                }
            }
            @media (max-width: 992px) {
                .dashboard-nav {
                    display: none;
                    position: fixed;
                    top: 0;
                    right: 0;
                    left: 0;
                    bottom: 0;
                    z-index: 1070;
                }
                .dashboard-nav.mobile-show {
                    display: block;
                }
            }
            @media (max-width: 992px) {
                .dashboard-nav header .menu-toggle {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                }
            }
            @media (min-width: 992px) {
                .dashboard-toolbar {
                    left: 238px;
                }
                .dashboard-compact .dashboard-toolbar {
                    left: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class='dashboard'>
            <div class="dashboard-nav">
                <header>
                    <div class="menu-toggle" style="color: #dfdfdf;"><i class="fas fa-bars"></i></div>
                    <a href="#" class="brand-logo">
                        <img src="<?php echo base_url('images/icon-8.png'); ?>" alt="">
                    </a>
                </header>
                <div class="nav-item-divider"></div>
                <nav class="dashboard-nav-list">
                    <a href="#" class="dashboard-nav-item <?php if ($this->uri->segment('1') === 'Home') echo 'active';?>">
                        <i class="fas fa-home"></i>
                        <?php echo lang('home'); ?>
                    </a>
                    <a href="<?php echo base_url('User_list/list'); ?>" class="dashboard-nav-item <?php if ($this->uri->segment('1') === 'User_list') echo 'active';?>">
                        <i class="fas fa-list"></i>
                        <?php echo lang('user_list'); ?>
                    </a>
                    <a href="<?php echo base_url('Courses/courses'); ?>" class="dashboard-nav-item <?php if ($this->uri->segment('1') === 'Courses') echo 'active';?>">
                        <i class="fas fa-graduation-cap"></i>
                        <?php echo lang('courses'); ?>
                    </a>
                </nav>
            </div>
            <div class='dashboard-app'>
                <header class='dashboard-toolbar'>
                    <div class="nav-menu">
                        <nav>
                            <div class="menu-toggle"><i class="fas fa-bars"></i></div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                        <?php echo '<img src="' . base_url('images/') . $this->session->userdata('site_lang') . '.png" alt="">';?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="lang">
                                            <a href="<?php echo base_url('Language_switcher/switchLang/vietnamese'); ?>">
                                                <img src="<?php echo base_url('images/vietnamese.png'); ?>" alt="">
                                                <?php echo lang('vietnamese'); ?>
                                            </a>
                                        </li>
                                        <li class="lang">
                                            <a href="<?php echo base_url('Language_switcher/switchLang/english'); ?>">
                                                <img src="<?php echo base_url('images/english.png'); ?>" alt="">
                                                <?php echo lang('english'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <?php echo ' ' . $this->session->userdata('name'); ?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('User_list/edit/'. $this->session->userdata('id')); ?>"><?php echo lang('account'); ?></a></li>
                                        <li><a href="<?php echo base_url('Authentication/logout'); ?>"><?php echo lang('logout'); ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        
                    </div>
                </header>
                <div class='dashboard-content'>
                    <?php echo $content; ?>
                </div>
                <footer>
                    <div class="footer-container">
                        <span>Copyright © 2023 Pham Cong Hau.</span>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    <script>
        const mobileScreen = window.matchMedia("(max-width: 990px )");
        $(document).ready(function () {
            $(".menu-toggle").click(function () {
                if (mobileScreen.matches) {
                    $(".dashboard-nav").toggleClass("mobile-show");
                } else {
                    $(".dashboard").toggleClass("dashboard-compact");
                }
            });
        });
    </script>
</html>