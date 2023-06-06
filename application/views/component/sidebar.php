
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            html {
                background-color: #ffffff;
                color: #000000;
                font-family: 'Lato', sans-serif;
                font-size: 15px;
                text-rendering: optimizeLegibility;
            }
            .clearfix::after {
                clear: both;
            }
            /* The side navigation menu */
            .sidebar {
                margin-top: 8.2%;
                padding: 0px;
                width: 300px;
                background-color: #f1f1f1;
                position: fixed;
                height: 100%;
                overflow: auto;
            }

            /* Sidebar links */
            .sidebar a {
                display: block;
                color: black;
                padding: 16px;
                text-decoration: none;
            }

            /* Active/current link */
            .sidebar a.active {
                background-color: #04AA6D;
                color: white;
            }

            /* Links on mouse-over */
            .sidebar a:hover:not(.active) {
                background-color: #555555;
                color: white;
            }

            /* Page content. The value of the margin-left property should match the value of the sidebar's width property */
            div.content {
                margin-left: 200px;
                padding: 1px 16px;
                height: 1000px;
            }

            /* On screens that are less than 700px wide, make the sidebar into a topbar */
            @media screen and (max-width: 700px) {
                .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
                }
                .sidebar a {float: left;}
                div.content {margin-left: 0;}
            }

            /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
            @media screen and (max-width: 400px) {
                .sidebar a {
                    text-align: center;
                    float: none;
                }
            }
            @media screen and (max-width: 455px) {
                .h3 {
                    font-size:16px;
                }
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
            <a href="#"><?php echo lang('home'); ?></a>
            <a class="active" href="<?php echo base_url(); ?>User_list/list"><?php echo lang('user_list'); ?></a>
            <a href="#"><?php echo lang('courses'); ?></a>
        </div>
        <!-- <div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width: 180px; display: block;" id="mySidebar">
            <div class="w3-bar w3-dark-grey">
                <span class="w3-bar-item w3-padding-16">Content</span>
                <button onclick="w3_close()" class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">×</button>
            </div>
            <div class="w3-bar-block">
                <a class="w3-bar-item w3-button w3-green" href="javascript:void(0)">Home</a>
                <a class="w3-bar-item w3-button" href="javascript:void(0)">About</a>
                <a class="w3-bar-item w3-button" href="javascript:void(0)">Contact</a>
                <div class="w3-dropdown-hover">
                    <a class="w3-button" href="javascript:void(0)">Dropdown <i class="fa fa-caret-down"></i></a>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 1</a>
                        <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 2</a>
                        <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 3</a>
                    </div>
                </div>
                <a class="w3-bar-item w3-button" href="javascript:void(0)">Support</a>
            </div>
        </div> -->
    </body>
</html>
