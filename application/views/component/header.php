
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
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
            header {
                background-color: #f1f1f1;
                padding-bottom: 20px;
                padding-top: 20px;
                position: fixed; /* Set the navbar to fixed position */
                top: 0; /* Position the navbar at the top of the page */
                width: 100%; /* Full width */
            }
            .logo-container {
                color: #000000;
                float: left;
                margin-left: 5%;
            }
            .logo {
                font-size: 400%;
            }
            .right-container {
                color: #000000;
                float: right;
                display: inline;
                margin-right: 3%;
            }
            .user-control {
                font-size: 400%;
                cursor: pointer;
            }
            .user-dropdown-menu {
                border-radius: 10px;
                border: 0.5px solid #e5e5e5;
                background-color: white;
                display: none;
                position: absolute;
                top: 60%;
                right: 3%;
                overflow: hidden;
            }
            .user-dropdown-menu a {
                display: block;
                color: black;
                text-decoration: none;
            }
            .user-info,
            .logout{
                background-color: white;
                border: none;
                border-radius: 10px;
                color: black;
                cursor: pointer;
                display: block;
                font-size: 100%;
                padding: 12px 16px;
                text-align: center;
                width: 200px;
            }
            .user-info:hover,
            .user-info:active,
            .logout:hover,
            .logout:active {
                background-color: #f1f1f1;
            }
            .user-container:hover .user-dropdown-menu {
                display: block;
                animation: down linear 0.2s;
            }
            .user-control img{
                height: 70px;
                width: 70px;
                border-radius: 50%;
                overflow: hidden;
            }
        </style>
    </head>
    <header>
        <div class="logo-container">
            <h1 class="logo">LOGO</h1>
        </div>
        <div class="right-container">
            <div class="user-container">
                <div class="user-control">
                    <?php
                        if (!empty($this->session->userdata('img'))) {
                            echo '<img src="'.base_url('public/images/').$this->session->userdata('img').'" alt="Avatar">';
                        } else {
                            echo '<iconify-icon icon="mdi:user-circle"></iconify-icon>';
                        }   
                    ?>
                </div>
                <div class="user-dropdown-menu">
                    <a href="#" class="user-info"><?php echo lang('account'); ?></a>
                    <form method="post" action="<?php echo base_url(); ?>Authentication/logout">
                        <input class="logout" type="submit" value="<?php echo lang('logout'); ?>" name="logout-submit">
                    </form>
                </div>
            </div>
            <div class="lang-control">
                <select class="lang-selected" id="language" onchange="change()">
                    <option value="english" <?php if (get_cookie('language') === 'english') echo 'selected'; ?>>EN</option>
                    <option value="vietnamese" <?php if (get_cookie('language') === 'vietnamese') echo 'selected'; ?>>VI</option>
                </select>
            </div>
        </div>
        <div class="clearfix"></div>
    </header>
    <script>
        function change()
        {
            language();
            redirect();
        }
        function redirect()
        {
            window.location = location.href;
        }
        function language()
        {
            document.cookie = 'language='+String($("#language").val());
        }
        // $('#category').change(function() {
        //     var language = String($("#language").val());
        //     $.ajax({
        //         url: 'http://localhost/conghau_hrm/switchLanguage/switch',
        //         data: {language: language},
        //         type: 'GET',
        //         datatype: 'json',
        //     });
        // });
    </script>
</html>