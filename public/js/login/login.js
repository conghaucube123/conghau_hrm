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