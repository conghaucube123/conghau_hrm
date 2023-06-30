<style>
    .clearfix::after {
        clear: both;
    }
    .body-container {
        margin-bottom: 50px;
        width: 100%;
    }
    .form-input {
        border: #f1f1f1f1 2px solid;
        border-radius: 10px;
        padding-top: 30px;
        padding-left: 50px;
        margin-top: 30px;
    }
    #left-container {
        margin-right: 50px;
    }
    #image-container #image,
    #image-container #upload {
        display: flex;
        justify-content: center;
    }
    .col-md-3 img {
        border-radius: 50%;
        height: 200px;
        width: 200px; 
    }
    .custom-file {
        text-align: center;
        width: 200px;
    }
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
        .col-md-3 img {
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
        .col-md-3 img {
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
        <form role="form" action="<?php echo $this->uri->segment('3'); ?>" method="post" enctype="multipart/form-data" onsubmit="return validate()">
            <div class="row">
                <div class="col-md-11">
                    <h3><?php echo lang('user_info'); ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11" style="text-align: right; margin-left: 50px;">
                    <div class="form-group">
                        <button type="button" class="btn btn-info" style="color:#ffffff;" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?></button>
                        <button type="submit" class="btn btn-primary" style="color:#ffffff;"><i class="far fa-save"></i> <?php echo lang('save'); ?></button>
                        <a class="btn btn-warning" href="<?php echo base_url('User/logout'); ?>" style="color:#ffffff;"><i class="fas fa-sign-out-alt"></i> <?php echo lang('logout'); ?></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" id="left-container">
                    <div class="form-group" id="image-container">
                        <div id="image">
                            <?php
                                if (!empty($profile['image'])) {
                                    echo '
                                        <img src="'. base_url('public/images/').$profile['image'] .'" class="img-responsive" id="face-image">
                                        <img src="'. base_url('public/images/').$profile['image'] .'" class="img-responsive" id="face-image-backup" style="display:none">
                                    ';
                                } else {
                                    echo '
                                        <img src="'. base_url('images/user-2.png') .'" class="img-responsive" id="face-image">
                                        <img src="'. base_url('images/user-2.png') .'" class="img-responsive" id="face-image-backup" style="display:none">
                                    ';
                                }
                            ?>
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
                    <div class="form-group">
                        <label for="password"><?php echo lang('password'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                        <span>Error message</span>
                        <?php
                            if (isset($password) && !empty($password)) {
                                echo '<div style="color:red">'.$password.'</div>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="newPassword"><?php echo lang('new_password'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" value="" onblur="validateNewPassword()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"><?php echo lang('confirm_password'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="" onblur="validateConfirmPassword()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="profileId" value="<?php echo $profile['id']; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="loginId"><?php echo lang('login_id_1'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="text" class="form-control" id="loginId" name="loginId" value="<?php if (isset($loginIdr)) {echo $loginIdr;} else {echo $user['login_id'];} ?>" onblur="validateLoginId()">
                        <span>Error message</span>
                        <?php
                            if (isset($loginId) && !empty($loginId)) {
                                echo '<div style="color:red">'.$loginId.'</div>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="fullname"><?php echo lang('fullname_1'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php if (isset($namer)) {echo $namer;} else {echo $profile['name'];} ?>" onblur="validateFullname()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="birthday"><?php echo lang('birthday_1'); ?>:</label>          
                        <input type="date" class="form-control" id="birthday" name="birthday" style="cursor: pointer;" value="<?php if (isset($birthdayr)) {echo $birthdayr;} else {echo $profile['birthday'];} ?>">
                    </div>
                    <div class="form-group">   
                        <label><?php echo lang('gender_1'); ?>:</label>     
                        <div class="">
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="1" <?php if(($profile['gender'] === '1') | (isset($genderr) && ($genderr === '1'))) echo 'checked="checked"'; ?>>
                                <label for="male"><?php echo lang('male'); ?></label>
                            </div>
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="2" <?php if(($profile['gender'] === '2') | (isset($genderr) && ($genderr === '2'))) echo 'checked="checked"'; ?>>
                                <label for="female"><?php echo lang('female'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo lang('email_1'); ?><sup style="color: red;">*</sup>:</label>          
                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($emailr)) {echo $emailr;} else {echo $profile['email'];} ?>" onblur="validateEmail()">
                        <span>Error message</span>
                        <?php
                            if (isset($email) && !empty($email)) {
                                echo '<div style="color:red">'.$email.'</div>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="mobile"><?php echo lang('mobile_1'); ?>:</label>          
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php if (isset($mobiler)) {echo $mobiler;} else {echo $profile['mobile'];} ?>" onblur="validateMobile()">
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="telephone"><?php echo lang('telephone'); ?>:</label>          
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?php if (isset($telephoner)) {echo $telephoner;} else {echo $profile['telephone'];} ?>" onblur="validateTelephone()">
                        <span>Error message</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="employeeId"><?php echo lang('employee_id_1'); ?><sup style="color: red;">*</sup>:</label>
                        <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?php echo $profile['employee_id']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="contractTypeId"><?php echo lang('contract_type'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="contractTypeId" name="contractTypeId" disabled>
                            <?php
                                foreach ($contractTypes as $contractType) {
                                    if ($user['contract_type_id'] === $contractType['id']) {
                                        echo '<option value="'.$contractType['id'].'" selected>'.$contractType['name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <span>Error message</span>
                    </div>
                    <div class="form-group">
                        <label for="positionId"><?php echo lang('position'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="positionId" name="positionId" disabled>
                            <?php
                                foreach ($positions as $position) {
                                    if ($profile['position_id'] === $position['id']) {
                                        echo '<option value="'.$position['id'].'" selected>'.$position['name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">   
                        <label><?php echo lang('status_1'); ?>:</label>  
                        <div class="">
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="status" id="available" value="1" <?php if($profile['status'] === '1') echo 'checked="checked"'; ?> disabled>
                                <label for="available"><?php echo lang('available'); ?></label>
                            </div>
                            <div class="checkbox radio-inline">
                                <input class="form-check-input" type="radio" name="status" id="unavailable" value="2" <?php if($profile['status'] === '2') echo 'checked="checked"'; ?> disabled>
                                <label for="unavailable"><?php echo lang('unavailable'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departmentId"><?php echo lang('department'); ?><sup style="color: red;">*</sup>:</label>
                        <select class="form-control" id="departmentId" name="departmentId" disabled>
                            <?php
                                foreach ($departments as $department) {
                                    if ($profile['department_id'] === $department['id']) {
                                        echo '<option value="'.$department['id'].'" selected>'.$department['name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="probation-date"><?php echo lang('probation_date'); ?>:</label>          
                        <input type="date" class="form-control" id="probation-date" name="probationDate" style="cursor: pointer;" value="<?php echo $profile['probation_date'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="official-date"><?php echo lang('official_date'); ?>:</label>          
                        <input type="date" class="form-control" id="official-date" name="officialDate" style="cursor: pointer;" value="<?php echo $profile['official_date'] ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8" style="margin-left: 50px;">
                    <div class="form-group">
                        <label for="address"><?php echo lang('address_1'); ?>:</label>          
                        <textarea class="form-control" id="address" name="address" rows="3" onblur="validateAddress()"><?php if (isset($addressr)) {echo $addressr;} else {echo $profile['address'];} ?></textarea>
                        <span>Error message</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
        var src = document.getElementById('face-image-backup').src;
        if (event.target.files[0]) {
            output.src = URL.createObjectURL(event.target.files[0]);
        } else {
            output.src = src;
        }
    });

    // Initialize variable to validate
    const loginIdEle = document.getElementById('loginId');
    const passwordEle = document.getElementById('password');
    const newPasswordEle = document.getElementById('newPassword');
    const confirmPasswordEle = document.getElementById('confirmPassword');
    const fullnameEle = document.getElementById('fullname');
    const emailEle = document.getElementById('email');
    const addressEle = document.getElementById('address');
    const telephoneEle = document.getElementById('telephone');
    const mobileEle = document.getElementById('mobile');

    // Validate when user click "Save" button and have some error
    function validate() {
        let loginId = validateLoginId();
        // let password = validatePassword();
        let newPassword = validateNewPassword();
        let confirmPassword = validateConfirmPassword();
        let fullname = validateFullname();
        let email = validateEmail();
        let address = validateAddress();
        let telephone = validateTelephone();
        let mobile = validateMobile();
        if (!loginId ||
            !newPassword ||
            !confirmPassword ||
            !fullname ||
            !email ||
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
        } else {
            setSuccess(passwordEle);
        }

        return isCheck;
    }

    // Validate New Password
    function validateNewPassword() {
        let parentEle = newPasswordEle.parentNode;
        parentEle.classList.remove('success', 'error');
        return checkNewPassword();
    }

    function checkNewPassword()
    {
        let newPasswordValue = newPasswordEle.value;
        let passwordValue = passwordEle.value;
        let isCheck = true;

        if (passwordValue != '') {
            if (newPasswordValue === '') {
                setError(newPasswordEle, '<?php echo lang('PASSWORD006'); ?>');
                isCheck = false;
            } else if (newPasswordValue.length < 8) {
                setError(newPasswordEle, '<?php echo lang('PASSWORD002'); ?>');
                isCheck = false;
            } else if (newPasswordValue.length > 255) {
                setError(newPasswordEle, '<?php echo lang('PASSWORD003'); ?>');
                isCheck = false;
            } else if (!isPassword(newPasswordValue)) {
                setError(newPasswordEle, '<?php echo lang('PASSWORD004'); ?>');
                isCheck = false;
            } else {
                setSuccess(newPasswordEle);
            }
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
        let newPasswordValue = newPasswordEle.value;
        let isCheck = true;

        if (confirmPasswordValue != newPasswordValue) {
            setError(confirmPasswordEle, '<?php echo lang('PASSWORD005'); ?>');
            isCheck = false;
        } else {
            setSuccess(confirmPasswordEle);
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