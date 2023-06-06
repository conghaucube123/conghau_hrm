<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

        <!-- JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                <style>
            .clearfix::after {
                clear: both;
            }
            .body-container {
                margin-bottom: 50px;
                width: 100%;
            }
            .left {
                float: left;
                width: 20%;
            }
            .right {
                overflow: hidden;
                float: right;
                margin-top: 10%;
                margin-right: 100px;
                width: 70%;
            }
            .right h2 {
                font-weight: 600;
                text-align: center;
            }
            /* .form-group.success select,
            .form-group.success input {
                border-color: #2ecc71;
            } */
            .form-group.error textarea,
            .form-group.error select,
            .form-group.error input {
                border-color: red;
            }
            .form-group span {
                color: red;
                display: none;
            }
            .form-group.error span {
                display: inline;
            }
            .form-radio {
                margin-left: 60px;
            }
            .alert a {
                text-decoration: none;
            }
            /* #message {
                display: none;
            } */
        </style>
    </head>
    <body>
        <header>
            <?php
                $this->load->view($header);
            ?>
        </header>

        <div class="body-container">
            <div class="left">
                <?php
                    $this->load->view($sidebar);
                ?>
            </div>
            
            <div class="right">
                <h2><?php echo lang('add_info'); ?></h2>
                <div class="media">
                    <div class="media-left media-top">
                        <img src="" class="media-object" id="face-image" style="width:300px; display:none">
                    </div>
                    <div class="media-body">
                        <form role="form" style="margin:50px" action="create" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                            <div class="form-group">
                                <label for="employeeId"><?php echo lang('employee_id'); ?><sup style="color: red;">*</sup>:</label>
                                <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?php if (isset($employeeIdr)) {echo $employeeIdr;} ?>" onblur="validateEmployeeId()">
                                <span>Error message</span>
                                <?php
                                    if (isset($employeeId) && !empty($employeeId)) {
                                        echo '<div style="color:red">'.$employeeId.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="loginId"><?php echo lang('loginid'); ?><sup style="color: red;">*</sup>:</label>
                                <input type="text" class="form-control" id="loginId" name="loginId" value="<?php if (isset($loginIdr)) {echo $loginIdr;} ?>" onblur="validateLoginId()">
                                <span>Error message</span>
                                <?php
                                    if (isset($loginId) && !empty($loginId)) {
                                        echo '<div style="color:red">'.$loginId.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo lang('password'); ?><sup style="color: red;">*</sup>:</label>
                                <input type="password" class="form-control" id="password" name="password" value="" onblur="validatePassword()">
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword"><?php echo lang('confirm_password'); ?><sup style="color: red;">*</sup>:</label>
                                <input type="password" class="form-control" id="confirmPassword" value="" onblur="validateConfirmPassword()">
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="fullname"><?php echo lang('full_name'); ?><sup style="color: red;">*</sup>:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php if (isset($namer)) {echo $namer;} ?>" onblur="validateFullname()">
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="image"><?php echo lang('fimage'); ?>:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                    <label class="custom-file-label" for="customFile"><?php echo lang('choose_image'); ?></label>
                                </div>
                                <?php
                                    if (isset($imageSize) && !empty($imageSize)) {
                                        echo '<div style="color:red">'.$imageSize.'</div>';
                                    }
                                    if (isset($imageType) && !empty($imageType)) {
                                        echo '<div style="color:red">'.$imageType.'</div>';
                                    }
                                    if (isset($imageExist) && !empty($imageExist)) {
                                        echo '<div style="color:red">'.$imageExist.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="birthday"><?php echo lang('birthday'); ?>:</label>          
                                <input type="datetime-local" class="form-control" id="birthday" name="birthday" value="<?php if (isset($birthdayr)) {echo $birthdayr;} ?>">
                            </div>
                            <div class="form-group">   
                                <label><?php echo lang('sex'); ?>:</label>     
                                <div class="form-radio">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="1" <?php if(isset($genderr) && ($genderr === '1')) echo 'checked="checked"'; ?>>
                                        <label class="form-check-label" for="male"><?php echo lang('male'); ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="2" <?php if(isset($genderr) && ($genderr === '2')) echo 'checked="checked"'; ?>>
                                        <label class="form-check-label" for="female"><?php echo lang('female'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo lang('email'); ?><sup style="color: red;">*</sup>:</label>          
                                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($emailr)) {echo $emailr;} ?>" onblur="validateEmail()">
                                <span>Error message</span>
                                <?php
                                    if (isset($email) && !empty($email)) {
                                        echo '<div style="color:red">'.$email.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="address"><?php echo lang('address'); ?>:</label>          
                                <textarea class="form-control" id="address" name="address" rows="3" onblur="validateAddress()"><?php if (isset($addressr)) {echo $addressr;} ?></textarea>
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="telephone"><?php echo lang('telephone'); ?>:</label>          
                                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php if (isset($telephoner)) {echo $telephoner;} ?>" onblur="validateTelephone()">
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="mobile"><?php echo lang('mobile'); ?>:</label>          
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php if (isset($mobiler)) {echo $mobiler;} ?>" onblur="validateMobile()">
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="positionId"><?php echo lang('position_id'); ?><sup style="color: red;">*</sup>:</label>
                                <select class="form-select" id="positionId" name="positionId" onblur="validatePositionId()">
                                    <option value="" selected>--<?php echo lang('select'); ?>--</option>
                                    <?php
                                        foreach ($positions as $position) {
                                            if (isset($positionIdr) && ($positionIdr === $position['id'])) {
                                                echo '<option value="'.$position['id'].'" selected>'.$position['name'].'</option>';
                                            } else {
                                                echo '<option value="'.$position['id'].'">'.$position['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="departmentId"><?php echo lang('department_id'); ?><sup style="color: red;">*</sup>:</label>
                                <select class="form-select" id="departmentId" name="departmentId" onblur="validateDepartmentId()">
                                    <option value="" selected>--<?php echo lang('select'); ?>--</option>
                                    <?php
                                        foreach ($departments as $department) {
                                            if (isset($departmentIdr) && ($departmentIdr === $department['id'])) {
                                                echo '<option value="'.$department['id'].'" selected>'.$department['name'].'</option>';
                                            } else {
                                                echo '<option value="'.$department['id'].'">'.$department['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="contractTypeId"><?php echo lang('contract_type'); ?><sup style="color: red;">*</sup>:</label>
                                <select class="form-select" id="contractTypeId" name="contractTypeId" onblur="validateContractTypeId()">
                                    <option value="" selected>--<?php echo lang('select'); ?>--</option>
                                    <?php
                                        foreach ($contractTypes as $contractType) {
                                            if (isset($contractTypeIdr) && ($contractTypeIdr === $contractType['id'])) {
                                                echo '<option value="'.$contractType['id'].'" selected>'.$contractType['name'].'</option>';
                                            } else {
                                                echo '<option value="'.$contractType['id'].'">'.$contractType['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <span>Error message</span>
                            </div>
                            <div class="form-group">
                                <label for="official-date"><?php echo lang('official_date'); ?>:</label>          
                                <input type="date" class="form-control" id="official-date" name="officialDate" value="<?php if (isset($officialDater)) {echo $officialDater;} ?>">
                            </div>
                            <div class="form-group">
                                <label for="probation-date"><?php echo lang('probation_date'); ?>:</label>          
                                <input type="date" class="form-control" id="probation-date" name="probationDate" value="<?php if (isset($probationDater)) {echo $probationDater;} ?>">
                            </div>
                            <div class="form-group">   
                                <label><?php echo lang('status'); ?>:</label>  
                                <div class="form-radio">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="available" value="1" <?php if(isset($statusr) && ($statusr === '1')) echo 'checked="checked"'; ?>>
                                        <label class="form-check-label" for="available"><?php echo lang('ava'); ?></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="unavailable" value="2" <?php if(isset($statusr) && ($statusr === '2')) echo 'checked="checked"'; ?>>
                                        <label class="form-check-label" for="unavailable"><?php echo lang('unava'); ?></label>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group">        
                                <input type="submit" class="btn btn-success" style="background-color: #04AA6D; color:#ffffff" value="<?php echo lang('create'); ?>" name="create-submit" id="create-btn">
                                <a class="btn btn-warning" style="color:#ffffff" href="<?php echo base_url(); ?>User_list/list" name="back"><?php echo lang('back'); ?></a>
                            </div>
                            <?php
                                if (isset($message) && !empty($message)) {
                                    echo '
                                        <div class="form-group" id="message">        
                                            <div class="alert alert-success alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>'.$message.'</strong>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <footer>
            <?php $this->load->view($footer); ?>
        </footer>

        <script>
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                var output = document.getElementById('face-image');
                if (event.target.files[0]) {
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.style.display = 'block';
                } else {
                    output.style.display = 'none';
                }
            });
            

            var timeOut = setTimeout(display, 3000);
            function display() {
                document.getElementById("message").style.visibility = hidden;
            }

            // Initialize variable to validate
            const loginIdEle = document.getElementById('loginId');
            const passwordEle = document.getElementById('password');
            const confirmPasswordEle = document.getElementById('confirmPassword');
            const contractTypeIdEle = document.getElementById('contractTypeId');
            const employeeIdEle = document.getElementById('employeeId');
            const fullnameEle = document.getElementById('fullname');
            const emailEle = document.getElementById('email');
            const positionIdEle = document.getElementById('positionId');
            const departmentIdEle = document.getElementById('departmentId');
            const addressEle = document.getElementById('address');
            const telephoneEle = document.getElementById('telephone');
            const mobileEle = document.getElementById('mobile');

            // Validate when user click "Create" button and have some error
            function validate() {
                let check = true;
                let loginId = validateLoginId();
                let password = validatePassword();
                let confirmPassword = validateConfirmPassword();
                let contractTypeId = validateContractTypeId();
                let employeeId = validateEmployeeId();
                let fullname = validateFullname();
                let email = validateEmail();
                let positionId = validatePositionId();
                let departmentId = validateDepartmentId();
                let address = validateAddress();
                let telephone = validateTelephone();
                let mobile = validateMobile();
                if (!loginId ||
                    !password ||
                    !confirmPassword ||
                    !contractTypeId ||
                    !employeeId ||
                    !fullname ||
                    !email ||
                    !positionId ||
                    !departmentId ||
                    !address ||
                    !telephone ||
                    !mobile) {
                        return false;
                    }
                console.log(check);
                return check;
            };

            // Validate Login ID
            function validateLoginId()
            {
                let parentEle = loginIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkLoginId();
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
                return checkPassword();
            }

            function checkPassword()
            {
                let passwordValue = passwordEle.value;
                let isCheck = true;

                if (passwordValue === '') {
                    setError(passwordEle, 'Please enter your Password');
                    isCheck = false;
                } else if (passwordValue.length < 8) {
                    setError(passwordEle, 'Password must have at least 8 character');
                    isCheck = false;
                } else if (passwordValue.length > 255) {
                    setError(passwordEle, 'The maximum length of Password is 255 character');
                    isCheck = false;
                } else if (!isPassword(passwordValue)) {
                    setError(passwordEle, 'Password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character');
                    isCheck = false;
                } else {
                    setSuccess(passwordEle);
                }

                return isCheck;
            }

            function isPassword(password) {
                return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s)/.test(password);
            }

            // Check Confirm Password
            function validateConfirmPassword() {
                let parentEle = confirmPasswordEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkConfirmPassword();
            }

            function checkConfirmPassword()
            {
                let confirmPasswordValue = confirmPasswordEle.value;
                let passwordValue = passwordEle.value;
                let isCheck = true;

                if (confirmPasswordValue != passwordValue) {
                    setError(confirmPasswordEle, 'Confirm Password does not match Password');
                    isCheck = false;
                } else {
                    setSuccess(confirmPasswordEle);
                }

                return isCheck;
            }

            // Validate Contract Type ID
            function validateContractTypeId()
            {
                let parentEle = contractTypeIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkContractTypeId();
            }

            function checkContractTypeId()
            {
                let contractTypeIdValue = contractTypeIdEle.value;
                let isCheck = true;

                if (contractTypeIdValue === '') {
                    setError(contractTypeIdEle, 'Please choose your Contract Type ID');
                    isCheck = false;
                } else {
                    setSuccess(contractTypeIdEle);
                }

                return isCheck;
            }

            // Validate Employee ID
            function validateEmployeeId()
            {
                let parentEle = employeeIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkEmployeeId();
            }

            function checkEmployeeId()
            {
                let employeeIdValue = employeeIdEle.value;
                let isCheck = true;

                if (employeeIdValue === '') {
                    setError(employeeIdEle, 'Please enter your Employee ID');
                    isCheck = false;
                } else if (employeeIdValue.length < 6) {
                    setError(employeeIdEle, 'Employee ID must have at least 6 character');
                    isCheck = false;
                } else if (employeeIdValue.length > 15) {
                    setError(employeeIdEle, 'The maximum length of Employee ID is 15 character');
                    isCheck = false;
                } else {
                    setSuccess(employeeIdEle);
                }

                return isCheck;
            }

            // Validate Fullname
            function validateFullname()
            {
                let parentEle = fullnameEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkFullname();
            }

            function checkFullname()
            {
                let fullnameValue = fullnameEle.value;
                let isCheck = true;

                if (fullnameValue === '') {
                    setError(fullnameEle, 'Please enter your Fullname');
                    isCheck = false;
                } else if (fullnameValue.length > 255) {
                    setError(fullnameEle, 'The maximum length of Fullname is 255 character');
                    isCheck = false;
                } else {
                    setSuccess(fullnameEle);
                }

                return isCheck;
            }

            // Validate Email
            function validateEmail()
            {
                let parentEle = emailEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkEmail();
            }

            function checkEmail()
            {
                let emailValue = emailEle.value;
                let isCheck = true;

                if (emailValue === '') {
                    setError(emailEle, 'Please enter your Email');
                    isCheck = false;
                } else if (!isEmail(emailValue)) {
                    setError(emailEle, 'Email invalidate');
                    isCheck = false;
                } else if (emailValue.length > 255) {
                    setError(emailEle, 'The maximum length of Email is 255 character');
                    isCheck = false;
                } else {
                    setSuccess(emailEle);
                }

                return isCheck;
            }

            function isEmail(email) {
                return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                    email
                );
            }

            // Validate Positon ID
            function validatePositionId()
            {
                let parentEle = positionIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkPositionId();
            }

            function checkPositionId()
            {
                let positionIdValue = positionIdEle.value;
                let isCheck = true;

                if (positionIdValue === '') {
                    setError(positionIdEle, 'Please choose your Position ID');
                    isCheck = false;
                } else {
                    setSuccess(positionIdEle);
                }

                return isCheck;
            }

            // Validate Department ID
            function validateDepartmentId()
            {
                let parentEle = departmentIdEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkDepartmentId();
            }

            function checkDepartmentId()
            {
                let departmentIdValue = departmentIdEle.value;
                let isCheck = true;

                if (departmentIdValue === '') {
                    setError(departmentIdEle, 'Please choose your Department ID');
                    isCheck = false;
                } else {
                    setSuccess(departmentIdEle);
                }

                return isCheck;
            }

            // Validate Address
            function validateAddress()
            {
                let parentEle = addressEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkAddress();
            }

            function checkAddress()
            {
                let addressValue = addressEle.value;
                let isCheck = true;

                if (addressValue.length > 255) {
                    setError(addressEle, 'The maximum length of Address is 255 character');
                    isCheck = false;
                } else {
                    setSuccess(addressEle);
                }

                return isCheck;
            }

            // Validate Telephone
            function validateTelephone()
            {
                let parentEle = telephoneEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkTelephone();
            }

            function checkTelephone()
            {
                let telephoneValue = telephoneEle.value;
                let isCheck = true;
                if (telephoneValue != '') {
                    if (telephoneValue.length > 20) {
                        setError(telephoneEle, 'The maximum length of Telephone is 20 character');
                        isCheck = false;
                    } else {
                        setSuccess(telephoneEle);
                    }
                }

                return isCheck;
            }

            function isTelephone(number) {
                return /(((\+|)84)|0)(24|28|2[0-9]{2})+([0-9]{8})\b/.test(number);
            }

            // Validate Mobile
            function validateMobile()
            {
                let parentEle = mobileEle.parentNode;
                parentEle.classList.remove('success', 'error');
                return checkMobile();
            }

            function checkMobile()
            {
                let mobileValue = mobileEle.value;
                let isCheck = true;
                if (mobileValue != '') {
                    if (mobileValue.length > 20) {
                        setError(mobileEle, 'The maximum length of Mobile is 20 character');
                        isCheck = false;
                    } else {
                        setSuccess(mobileEle);
                    }
                }

                return isCheck;
            }

            function isMobile(number) {
                return /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(number);
            }

            function setSuccess(ele)
            {
                ele.parentNode.classList.add('success');
            }

            function setError(ele, message)
            {
                let parentEle = ele.parentNode;
                parentEle.classList.add('error');
                parentEle.querySelector('span').innerHTML = message;
            }
        </script>
    </body>
</html>