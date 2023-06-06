var timeOut = setTimeout(display, 3000);
function display() {
    document.getElementById("message").style.visibility = hidden;
}

// Initialize variable to validate
const loginIdEle = document.getElementById('loginId');
const fullnameEle = document.getElementById('fullname');
const emailEle = document.getElementById('email');
const employeeIdEle = document.getElementById('employeeId');
const btnEdit = document.getElementById('edit-btn');

// Validate Login ID
function validateLoginId()
{
    let parentEle = loginIdEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnEdit.disabled = false;
    let loginIdValid = checkLoginId();
    if (!loginIdValid) {
        btnEdit.disabled = true;
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

// Validate Fullname
function validateFullname()
{
    let parentEle = fullnameEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnEdit.disabled = false;
    let fullnameValid = checkFullname();
    if (!fullnameValid) {
        btnEdit.disabled = true;
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
    btnEdit.disabled = false;
    let emailValid = checkEmail();
    if (!emailValid) {
        btnEdit.disabled = true;
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

// Validate Employee ID
function validateEmployeeId()
{
    let parentEle = employeeIdEle.parentNode;
    parentEle.classList.remove('success', 'error');
    btnEdit.disabled = false;
    let employeeIdValid = checkEmployeeId();
    if (!employeeIdValid) {
        btnEdit.disabled = true;
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

// Set status (success or error)
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