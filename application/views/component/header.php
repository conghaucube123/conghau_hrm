
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            body {
                font-family: "Lato", sans-serif;
            }
            .nav-menu {
                background-color: #111;
                color: #ffffff;
            }
            .navbar.navbar-inverse {
                border: none;
                border-radius: 0px;
            }
            .navbar-header img {
                border: red 2px solid;
                width: 10%;
            }
            .lang img {
                height: 20px;
                width: 20px;
                overflow: hidden;
            }
            .dropdown img {
                height: 40px;
                width: 40px;
                border-radius: 50%;
            }

            /* Add a black background color to the top navigation */
            .topnav {
                background-color: #333;
                overflow: hidden;
                position: fixed;
                top: 0;
                width: 100%;
            }

            /* Style the links inside the navigation bar */
            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }

            /* Change the color of links on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            /* Add a color to the active/current link */
            .topnav a.active {
                background-color: #04AA6D;
                color: white;
            }

            /* Right-aligned section inside the top navigation */
            .topnav-right {
                float: right;
            }
            
            .sidenav {
                height: 100%;
                width: 160px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #222;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                padding: 6px 8px 6px 16px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .main {
                margin-left: 160px; /* Same as the width of the sidenav */
                font-size: 28px; /* Increased text to enable scrolling */
                padding: 0px 10px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
        </style>
    </head>
    <body>
        <div class="top-nav">
            <div class="nav-menu">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <!-- <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <img src="<?php echo base_url(); ?>images/logo-04.png" alt="">
                                Logo
                            </a>
                        </div> -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="lang">
                                <a href='<?php echo base_url(); ?>Language_switcher/switchLang/vietnamese'>
                                    <img src="<?php echo base_url(); ?>images/vietnam-s.png" alt=""> Vietnamese
                                </a>
                            </li>
                            <li class="lang">
                                <a href='<?php echo base_url(); ?>Language_switcher/switchLang/english'>
                                    <img src="<?php echo base_url(); ?>images/united-kingdom-s.png" alt=""> English
                                </a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="glyphicon glyphicon-user"></span>
                                    <?php echo ' ' . $this->session->userdata('name'); ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><?php echo lang('account'); ?></a></li>
                                    <li><a href="<?php echo base_url('Authentication/logout'); ?>"><?php echo lang('logout'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <div class="topnav-right">
                <a href="#search">Search</a>
                <a href="#about">About</a>
            </div>
        </div> -->
        <div class="sidenav bg-dark">
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#clients">Clients</a>
            <a href="#contact">Contact</a>
        </div>
    </body>
</html>