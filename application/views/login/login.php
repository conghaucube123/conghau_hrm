<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->

        <!-- jQuery -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->

        <!-- JS -->
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
        <title>Login</title>
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
            .container {
                width: 100%;
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .form-container {
                /* border: solid black 2px; */
                margin-top: 200px;
                height: 400px;
                width: 30%;
            }
            .logo-container {
                background-color: #508FC7;
                align-items: center;
                display: flex;
                justify-content: center;
                float: left;
                height: 400px;
                width: 35%;
            }
            .login-container {
                border: solid black 2px;
                float: right;
                height: 400px;
                width: 65%;
            }
            .form-control {
                margin-top: 100px;
                width: 100%;
            }
            /* .form-group {
                border: solid black 2px;
                margin-top: 50px;
            } */
            .form-label {
                color: black;
                margin-top: 30px;
                margin-left: 20px;
                font-weight: 300;
                font-size: 18px;
            }
            .form-input {
                border: solid black 2px;
                background-color: #FFFFFF;
                width: 200px;
                height: 30px;
                margin-top: 30px;
                margin-left: 30px;
                padding: 5px;
            }
            #loginId {
                margin-left: 40px;
            }
            .login-btn {
                background-color: #77B04F;
                color: #FFFFFF;
                cursor: pointer;
                font-weight: 300;
                font-size: 18px;
                line-height: 30px;
                width: 200px;
                margin-top: 30px;
                margin-left: 135px;
                border: solid #307536 1.5px;
                outline: none;
                text-decoration: none;
            }
            .forgot-pwd {
                color: #508FC7;
                margin-top: 100px;
                margin-left: 180px;
                text-decoration: none;
            }
            /* .from-group.success input {
                border-color: #2ecc71;
            } */
            .from-group.error input {
                border-color: #e74c3c;
            }
            .from-group span {
                color: #e74c3c;
                bottom: -20px;
                margin-left: 130px;
                padding: 5px;
                visibility: hidden;
                font-size: 15px;
            }
            .from-group.error span {
                visibility: visible;
            }
            @media screen and (max-width: 700px) {
                .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
                }
                .sidebar a {float: left;}
                div.content {margin-left: 0;}
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <div class="logo-container">
                    <h1 class="logo">LOGO</h1>
                </div>
                <div class="login-container">
                    <!-- <form class="form-horizontal" action="<?php echo base_url(); ?>Authentication/login" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="loginId">Login ID<sup style="color: red;">*</sup>:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="loginId" name="loginId" onblur="validateLoginId()">
                                <span>Error message</span>
                                <?php echo form_error('loginId'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="password">Password<sup style="color: red;">*</sup>:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" onblur="validatePassword()">
                                <span>Error message</span>
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="login-btn" value="Login" name="submit" id="login">
                            </div>
                        </div>
                    </form> -->
                    <form action="<?php echo base_url(); ?>Authentication/login" method="post" class="form-control">
                        <div class="from-group">
                            <label for="loginId" class="form-label">Login ID<sup style="color: red;">*</sup></label>
                            <input type="text" class="form-input" id="loginId" name="loginId" onblur="validateLoginId()">
                            <span>Error message</span>
                            <?php echo form_error('loginId'); ?>
                        </div>
                        <div class="from-group">
                            <label for="pwd" class="form-label">Password<sup style="color: red;">*</sup></label>
                            <input type="password" class="form-input" id="password" name="password" onblur="validatePassword()">
                            <span>Error message</span>
                            <?php echo form_error('password'); ?>
                        </div>
                        <input type="submit" class="login-btn" value="Login" name="submit" id="login">
                    </form>
                    <br>
                    <a href="#" class="forgot-pwd">Forgot password</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <script>
            // Initialize variable to validate
            const loginIdEle = document.getElementById('loginId');
            const passwordEle = document.getElementById('password');
            const btnLogin = document.getElementById('login');

            // Validate when user click "Login" button and don't enter Login ID and Password
            btnLogin.onclick = function () {
                validateLoginId();
                validatePassword();
            };

            // Validate Login ID
            function validateLoginId() {
                let parentEle = loginIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                btnLogin.disabled = false;
                let loginIdValid = checkLoginId();
                if (!loginIdValid) {
                    btnLogin.disabled = true;
                }
            }

            function checkLoginId()
            {
                let loginIdValue = loginIdEle.value;
                let isCheck = true;

                if (loginIdValue === '') {
                    setError(loginIdEle, 'Please enter your Login ID');
                    isCheck = false;
                } else if (loginIdValue.length < 6) {
                    setError(loginIdEle, 'Login ID must have at least 6 character');
                    isCheck = false;
                } else if (loginIdValue.length > 30) {
                    setError(loginIdEle, 'The maximum length of Login ID is 30 character');
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
                btnLogin.disabled = false;
                let passwordValid = checkPassword();
                if (!passwordValid) {
                    btnLogin.disabled = true;
                }
            }

            function checkPassword()
            {
                let passwordValue = passwordEle.value;
                let isCheck = true;

                if (passwordValue === '') {
                    setError(passwordEle, 'Please enter your Password');
                    isCheck = false;
                } else if (passwordValue.length < 5) {
                    setError(passwordEle, 'Password must have at least 6 character');
                    isCheck = false;
                } else if (passwordValue.length > 255) {
                    setError(passwordEle, 'The maximum length of Password is 255 character');
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