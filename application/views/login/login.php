<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/icon-9.png'); ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>
        <title>Login</title>
        <style>
            body {
                background-color: #212529;
            }
            h1 {
                color: #fff;
                margin-top: 15%;
            }
            .btn-color {
                background-color: #212529;
                color: #fff;
            }
            .btn-color:hover,
            .btn-color:active {
                background-color: #343a40;
                color: #fff;
            }
            .profile-image-pic {
                height: 200px;
                width: 200px;
                object-fit: cover;
                background-color: none;
            }
            .cardbody-color {
                background-color: #ebf2fa;
            }
            a {
                text-decoration: none;
            }
            /* .from-group.success input {
                border-color: #2ecc71;
            } */
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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-center">Course Management System</h1>
                    <div class="card my-5">
                        <form class="card-body cardbody-color p-lg-5" action="<?php echo base_url('Authentication/login'); ?>" method="post" onsubmit="return validate()">
                            <div class="text-center">
                                <img src="<?php echo base_url('images/icon-7.png'); ?>" class="img-fluid profile-image-pic my-3" alt="logo">
                            </div>
                            <div class="mb-3">
                                <?php
                                    if (isset($loginFail) && !empty($loginFail)) {
                                        echo '
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <strong><i class="fas fa-exclamation-triangle"></i> '.$loginFail.'</strong>
                                            </div>';
                                    }
                                ?>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="loginId" name="loginId" onblur="validateLoginId()" value="<?php if (isset($loginId)) {echo $loginId;} ?>" placeholder="<?php echo lang('login_id_1'); ?>">
                                <span>Error message</span>
                                <?php echo form_error('loginId'); ?>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" onblur="validatePassword()" value="<?php if (isset($password)) {echo $password;} ?>" placeholder="<?php echo lang('password'); ?>">
                                <span>Error message</span>
                                <?php echo form_error('password'); ?>
                            </div>
                            <div class="text-center">
                                <!-- <input type="submit" class="btn btn-color px-5 mb-5 w-100" value="Login" name="submit" id="login"> -->
                                <button type="submit" class="btn btn-color px-5 mb-5 w-100"><?php echo lang('login'); ?></button>
                            </div>
                            <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                                <a href="#" class="text-dark fw-bold"><?php echo lang('forgot_password'); ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                // } else if (loginIdValue.length < 6) {
                //     setError(loginIdEle, '<?php echo lang('LOGINID002'); ?>');
                //     isCheck = false;
                // } else if (loginIdValue.length > 30) {
                //     setError(loginIdEle, '<?php echo lang('LOGINID003'); ?>');
                //     isCheck = false;
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
                // } else if (passwordValue.length < 5) {
                //     setError(passwordEle, '<?php echo lang('PASSWORD002'); ?>');
                //     isCheck = false;
                // } else if (passwordValue.length > 255) {
                //     setError(passwordEle, '<?php echo lang('PASSWORD003'); ?>');
                //     isCheck = false;
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