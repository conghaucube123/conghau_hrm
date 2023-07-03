<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/icon-9.png'); ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>COURSE MANAGEMENT SYSTEM</title>
        <style>
            body {
                background: #2c3338;
                color: #606468;
                font: 87.5%/1.5em 'Open Sans', sans-serif;
                margin: 0;
            }
            #page-title {
                margin: 200px 0px 0px 0px;
                text-align: center;
                color: white;
                font-size: 15px;
            }
            .profile-image-pic {
                height: 40px;
                width: 40px;
                object-fit: cover;
                background-color: none;
            }
            .title {
                color: white;
                font-size: 30px;
                vertical-align: middle;
            }
            .container {
                display: flex;
                justify-content: center;
            }
            .row {
                display: flex;
                justify-content: center;
                width: 75%;
            }
            .my-5 {
                background: #2c3338;
                border: none;
                margin: 20px!important;
                margin-top: 30px!important;
            }
            .card-body {
                margin: auto;
                padding: 22px 22px 22px 22px;
                width: 100%;
                border-radius: 5px;
                background: #ebf2fa;
                /* border-top: 3px solid #434a52;
                border-bottom: 3px solid #434a52; */
            }
            .btn-color {
                background-color: #212529;
                color: #fff;
            }
            .btn-color:hover,
            .btn-color:active {
                background-color: #495057;
                color: #fff;
            }
            .mb-5 {
                margin-bottom: 1rem!important;
            }
            #forgot-pasword {
                margin-bottom: 0!important;
            }
            .forgot {
                color: #212529;
            }
            a {
                text-decoration: none;
            }
            .forgot:hover,
            .forgot:active {
                color: #495057;
            }
            .from-group.success input {
                border-color: #2ecc71;
            }
            .mb-3.error input {
                border-color: red;
            }
            .mb-3 span {
                color: red;
                display: none;
            }
            .mb-3.error span {
                display: inline;
            }
            .footer-container {
                color: #fff;
                text-align: center;
                margin-top: 100px;
                position: sticky;
                width: 100%;
            }
            @media (min-width: 992px) {
                .p-lg-5 {
                    padding: 10px!important;
                    padding-top: 30px!important;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="page-title" class="text-center">
                        <img src="<?php echo base_url('images/icon-7.png'); ?>" class="img-fluid profile-image-pic my-3" alt="logo">
                        <span class="title">Course Management System</span>
                    </div>
                    <div class="card my-5">
                        <p style="color:#d42a38; text-align: center;"><?php if ($this->session->flashdata('message')){echo $this->session->flashdata('message'); $this->session->set_flashdata('message', "");} else {echo '';} ?></p>
                        <form class="card-body p-lg-5" action="<?php echo base_url('Authentication/login'); ?>" method="post" onsubmit="return validate()">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="loginId" name="loginId" onblur="validateLoginId()" value="<?php if ($this->session->flashdata('loginIdr')) {echo $this->session->flashdata('loginIdr');} ?>" placeholder="<?php echo lang('login_id_1'); ?>">
                                <span>Error message</span>
                                <?php echo form_error('loginId'); ?>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" onblur="validatePassword()" value="<?php if ($this->session->flashdata('passwordr')) {echo $this->session->flashdata('passwordr');} ?>" placeholder="<?php echo lang('password'); ?>">
                                <span>Error message</span>
                                <?php echo form_error('password'); ?>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-color px-5 mb-5 w-100"><?php echo lang('login'); ?></button>
                            </div>
                            <div id="forgot-pasword" class="form-text text-center">
                                <a href="#" class="fw-bold forgot"><?php echo lang('forgot_password'); ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <span>Copyright © 2023 Pham Cong Hau.</span>
        </div>
        
        <script>
            // Initialize variable to validate
            const loginIdEle = document.getElementById('loginId');
            const passwordEle = document.getElementById('password');

            // Validate when user click "Login" button and don't enter Login ID and Password
           function validate() {
                let loginId = validateLoginId();
                let password = validatePassword();
                if (!loginId || !password) {
                    return false;
                }
                return true;
            };

            // Validate Login ID
            function validateLoginId() {
                let parentEle = loginIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkLoginId();
            }

            function checkLoginId()
            {
                let loginIdValue = loginIdEle.value;
                let isCheck = true;

                if (loginIdValue === '') {
                    setError(loginIdEle, '<?php echo lang('LOGINID001'); ?>');
                    isCheck = false;
                } else {
                    setSuccess(loginIdEle);
                }

                return isCheck;
            }

            // Validate Password
            function validatePassword() {
                let parentEle = passwordEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkPassword();
            }

            function checkPassword()
            {
                let passwordValue = passwordEle.value;
                let isCheck = true;

                if (passwordValue === '') {
                    setError(passwordEle, '<?php echo lang('PASSWORD001'); ?>');
                    isCheck = false;
                } else {
                    setSuccess(passwordEle);
                }

                return isCheck;
            }

            // Set status (success or error)
            function setSuccess(ele) {
                ele.parentNode.classList.add('success');
            }

            function setError(ele, message) {
                let parentEle = ele.parentNode;
                parentEle.classList.add('error');
                parentEle.querySelector('span').innerHTML = message;
            }
        </script>
    </body>
</html>