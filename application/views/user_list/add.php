<style>
    .body-container {
        width: 100%;
    }
    .form-input {
        border: #f1f1f1f1 2px solid;
        border-radius: 10px;
        padding-top: 30px;
        margin-top: 30px;
    }
    .col-md-2 img {
        border-radius: 50%;
        height: 200px;
        width: 200px;  
    }
    .custom-file {
        text-align: center;
        width: 200px;
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
    .alert a {
        text-decoration: none;
    }
    @media (max-width: 768px) {
        form {
            margin: 0px 30px;
        }
        .col-md-2 img {
            height: 250px;
            width: 250px; 
        }
        .custom-file {
            width: 250px;
        }
        #upload,
        #image {
            display: flex;
            justify-content: center;
        }
    }
    @media (max-width: 425px) {
        .col-md-2 img {
            height: 150px;
            width: 150px; 
        }
        .custom-file {
            width: 200px;
        }
    }
</style>

<div class="body-container">
    <div class="form-input">
        <form role="form" action="add" method="post" enctype="multipart/form-data" onsubmit="return validate()">
            <div class="row">
                <div class="col-md-10  col-md-offset-1">
                    <h3><?php echo lang('add_new_user'); ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="text-align: right;">
                    <div class="form-group">
                        <button type="button" class="btn btn-info" style="color:#ffffff;" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?></button>
                        <button type="submit" class="btn btn-primary" style="color:#ffffff;"><i class="fas fa-plus"></i> <?php echo lang('add'); ?></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                        <div id="image">
                            <img src="<?php echo base_url('images/user-2.png'); ?>" class="img-responsive" id="face-image">
                        </div>
                        <div id="upload">
                            <div class="custom-file">
                                <input type="file" class="form-control" id="customFile" name="avatar" style="visibility: hidden;">
                                <label class="form-control btn btn-default" id="form-label" for="customFile" style="font-weight: normal;">
                                    <i class="fas fa-upload"></i>
                                    <?php echo lang('IMAGE001'); ?>
                                </label>
                            </div>
                            <?php
                                if (isset($imageSize) && !empty($imageSize)) {
                                    echo '<div style="color:red">'.$imageSize.'</div>';
                                }
                                if (isset($imageType) && !empty($imageType)) {
                                    echo '<div style="color:red">'.$imageType.'</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="loginId"><?php echo lang('login_id_1'); ?><sup style="color: red;">*</sup>:</label>
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
                        <label for="fullname"><?php echo lang('fullname_1'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php if (isset($namer)) {echo $namer;} ?>" onblur="validateFullname()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="birthday"><?php echo lang('birthday_1'); ?>:</label>          
                        <input type="date" class="form-control" id="birthday" name="birthday" style="cursor: pointer;" value="<?php if (isset($birthdayr)) {echo $birthdayr;} ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="employeeId"><?php echo lang('employee_id_1'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?php if (isset($employeeIdr)) {echo $employeeIdr;} ?>" onblur="validateEmployeeId()">
                        <span>Error message</span>
                        <?php
                            if (isset($employeeId) && !empty($employeeId)) {
                                echo '<div style="color:red">'.$employeeId.'</div>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo lang('email_1'); ?><sup style="color: red;">*</sup>:</label>          
                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($emailr)) {echo $emailr;} ?>" onblur="validateEmail()">
                        <span>Error message</span>
                        <?php
                            if (isset($email) && !empty($email)) {
                                echo '<div style="color:red">'.$email.'</div>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="contractTypeId"><?php echo lang('contract_type'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="contractTypeId" name="contractTypeId" style="cursor: pointer;" onblur="validateContractTypeId()">
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
                        <label for="positionId"><?php echo lang('position'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="positionId" name="positionId" style="cursor: pointer;" onblur="validatePositionId()">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1"></div>
                <div class="col-md-2">
                    <div class="form-group">   
                        <label><?php echo lang('gender_1'); ?>:</label>     
                        <div class="">
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="1" <?php if(isset($genderr) && ($genderr === '1')) echo 'checked="checked"'; ?>>
                                <label for="male"><?php echo lang('male'); ?></label>
                            </div>
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="2" <?php if(isset($genderr) && ($genderr === '2')) echo 'checked="checked"'; ?>>
                                <label for="female"><?php echo lang('female'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">   
                        <label><?php echo lang('status_1'); ?>:</label>  
                        <div class="">
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="status" id="available" value="1" <?php if(isset($statusr) && ($statusr === '1')) echo 'checked="checked"'; ?>>
                                <label for="available"><?php echo lang('available'); ?></label>
                            </div>
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="status" id="unavailable" value="2" <?php if(isset($statusr) && ($statusr === '2')) echo 'checked="checked"'; ?>>
                                <label for="unavailable"><?php echo lang('unavailable'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="departmentId"><?php echo lang('department'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="departmentId" name="departmentId" style="cursor: pointer;" onblur="validateDepartmentId()">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile"><?php echo lang('mobile_1'); ?>:</label>          
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php if (isset($mobiler)) {echo $mobiler;} ?>" onblur="validateMobile()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="telephone"><?php echo lang('telephone'); ?>:</label>          
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?php if (isset($telephoner)) {echo $telephoner;} ?>" onblur="validateTelephone()">
                        <span>Error message</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="probation-date"><?php echo lang('probation_date'); ?>:</label>          
                        <input type="date" class="form-control" id="probation-date" name="probationDate" style="cursor: pointer;" value="<?php if (isset($probationDater)) {echo $probationDater;} ?>">
                    </div>
                    <div class="form-group">
                        <label for="official-date"><?php echo lang('official_date'); ?>:</label>          
                        <input type="date" class="form-control" id="official-date" name="officialDate" style="cursor: pointer;" value="<?php if (isset($officialDater)) {echo $officialDater;} ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-1"></div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="address"><?php echo lang('address_1'); ?>:</label>          
                        <textarea class="form-control" id="address" name="address" rows="3" onblur="validateAddress()"><?php if (isset($addressr)) {echo $addressr;} ?></textarea>
                        <span>Error message</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
            
<script>
    // Show avatar and add file name to input box
    $('.form-control').on('change', function() {
        var fileName = $(this).val().split("\\").pop();
        if (fileName) {
            $(this).siblings('#form-label').addClass('selected').html(fileName);
        } else {
            $(this).siblings('#form-label').addClass('selected').html('<i class="fas fa-upload"></i> <?php echo lang('IMAGE001'); ?>');
        }
        var output = document.getElementById('face-image');
        if (event.target.files[0]) {
            output.src = URL.createObjectURL(event.target.files[0]);
        } else {
            output.src = '<?php echo base_url('images/user-2.png'); ?>';
        }
    });

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

    // Validate when user click "Add" button and have some error
    function validate() {
        let loginId = validateLoginId();
        let password = validatePassword();
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
        return true;
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
            setError(loginIdEle, '<?php echo lang('LOGINID001'); ?>');
            isCheck = false;
        } else if (loginIdValue.length < 6) {
            setError(loginIdEle, '<?php echo lang('LOGINID002'); ?>');
            isCheck = false;
        } else if (loginIdValue.length > 30) {
            setError(loginIdEle, '<?php echo lang('LOGINID003'); ?>');
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
        } else if (passwordValue.length < 8) {
            setError(passwordEle, '<?php echo lang('PASSWORD002'); ?>');
            isCheck = false;
        } else if (passwordValue.length > 255) {
            setError(passwordEle, '<?php echo lang('PASSWORD003'); ?>');
            isCheck = false;
        } else if (!isPassword(passwordValue)) {
            setError(passwordEle, '<?php echo lang('PASSWORD004'); ?>');
            isCheck = false;
        } else {
            setSuccess(passwordEle);
        }

        return isCheck;
    }

    function isPassword(password) {
        return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s)/.test(password);
    }

    // Validate Confirm Password
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
            setError(confirmPasswordEle, '<?php echo lang('PASSWORD005'); ?>');
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
            setError(contractTypeIdEle, '<?php echo lang('CONTRACTTYPE001'); ?>');
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
            setError(employeeIdEle, '<?php echo lang('EMPLOYEEID001'); ?>');
            isCheck = false;
        } else if (employeeIdValue.length < 6) {
            setError(employeeIdEle, '<?php echo lang('EMPLOYEEID002'); ?>');
            isCheck = false;
        } else if (employeeIdValue.length > 15) {
            setError(employeeIdEle, '<?php echo lang('EMPLOYEEID003'); ?>');
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
            setError(fullnameEle, '<?php echo lang('FULLNAME001'); ?>');
            isCheck = false;
        } else if (fullnameValue.length > 255) {
            setError(fullnameEle, '<?php echo lang('FULLNAME002'); ?>');
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
            setError(emailEle, '<?php echo lang('EMAIL001'); ?>');
            isCheck = false;
        } else if (!isEmail(emailValue)) {
            setError(emailEle, '<?php echo lang('EMAIL002'); ?>');
            isCheck = false;
        } else if (emailValue.length > 255) {
            setError(emailEle, '<?php echo lang('EMAIL003'); ?>');
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
            setError(positionIdEle, '<?php echo lang('POSITION001'); ?>');
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
            setError(departmentIdEle, '<?php echo lang('DEPARTMENT001'); ?>');
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
            setError(addressEle, '<?php echo lang('ADDRESS001'); ?>');
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
                setError(telephoneEle, '<?php echo lang('TELEPHONE001'); ?>');
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
                setError(mobileEle, '<?php echo lang('MOBILE001'); ?>');
                isCheck = false;
            } else {
                setSuccess(mobileEle);
            }
        }

        return isCheck;
    }

    function isMobile(number)
    {
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