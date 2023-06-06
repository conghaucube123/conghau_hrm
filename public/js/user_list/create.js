// Initialize variable to validate
const loginIdEle = document.getElementById('loginId');
const passwordEle = document.getElementById('password');
const contractTypeIdEle = document.getElementById('contractTypeId');
const employeeIdEle = document.getElementById('employeeId');
const fullnameEle = document.getElementById('fullname');
const emailEle = document.getElementById('email');
const positionIdEle = document.getElementById('positionId');
const departmentIdEle = document.getElementById('departmentId');
const telephoneEle = document.getElementById('telephone');
const mobileEle = document.getElementById('mobile');
const btnCreate = document.getElementById('create-btn');

// Validate when user click "Create" button and don't enter all fields
btnLogin.onclick = function () {
    validateLoginId();
    validatePassword();
    validateContractTypeId();
    validateEmployeeId();
    validateFullname();
    validateEmail();
    validatePositionId();
    validateDepartmentId();
    validateTelephoneId();
    validateMobileId();
};

// Validate Login ID
function validateLoginId()
{
    let parentEle = loginIdEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnCreate.disabled = false;
    let loginIdValid = checkLoginId();
    if (!loginIdValid) {
        btnCreate.disabled = true;
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
    btnCreate.disabled = false;
    let passwordValid = checkPassword();
    if (!passwordValid) {
        btnCreate.disabled = true;
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

// Check Confirm Password
function validateConfirmPassword() {
    let parentEle = confirmPasswordEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnCreate.disabled = false;
    let confirmPasswordValid = checkConfirmPassword();
    if (!confirmPasswordValid) {
        btnCreate.disabled = true;
    }
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
    btnCreate.disabled = false;
    let contractTypeIdValid = checkContractTypeId();
    if (!contractTypeIdValid) {
        btnCreate.disabled = true;
    }
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
    btnCreate.disabled = false;
    let employeeIdValid = checkEmployeeId();
    if (!employeeIdValid) {
        btnCreate.disabled = true;
    }
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
        setError(employeeIdEle, 'The maximum length of Password is 15 character');
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
    btnCreate.disabled = false;
    let fullnameValid = checkFullname();
    if (!fullnameValid) {
        btnCreate.disabled = true;
    }
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
    btnCreate.disabled = false;
    let emailValid = checkEmail();
    if (!emailValid) {
        btnCreate.disabled = true;
    }
}

function checkEmail()
{
    let emailValue = emailEle.value;
    let isCheck = true;

    if (emailValue == '') {
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
    btnCreate.disabled = false;
    let positionIdValid = checkPositionId();
    if (!positionValid) {
        btnCreate.disabled = true;
    }
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
    btnCreate.disabled = false;
    let departmentIdValid = checkDepartmentId();
    if (!departmentIdValid) {
        btnCreate.disabled = true;
    }
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

// Validate Telephone
function validateTelephone()
{
    let parentEle = telephoneEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnCreate.disabled = false;
    let telephoneValid = checkTelephone();
    if (!telephoneValid) {
        btnCreate.disabled = true;
    }
}

function checkTelephone()
{
    let telephoneValue = telephoneEle.value;
    let isCheck = true;

    if (!isTelephone(telephoneValue)) {
        setError(telephoneEle, 'Telephone invalidate');
        isCheck = false;
    } else if (telephoneValue.length > 20) {
        setError(telephoneEle, 'The maximum length of Telephone is 20 character');
        isCheck = false;
    } else {
        setSuccess(telephoneEle);
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
    btnCreate.disabled = false;
    let mobileValid = checkMobile();
    if (!mobileValid) {
        btnCreate.disabled = true;
    }
}

function checkMobile()
{
    let mobileValue = mobileEle.value;
    let isCheck = true;

    if (!isMobile(mobileValue)) {
        setError(mobileEle, 'Mobile invalidate');
        isCheck = false;
    } else if (mobileValue.length > 20) {
        setError(mobileEle, 'The maximum length of Mobile is 20 character');
        isCheck = false;
    } else {
        setSuccess(mobileEle);
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