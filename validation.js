//Password Validation

let passwordInput = document.getElementById('password');
let passwordError = document.getElementById('password-error');
let submitButton = document.getElementById('signupBtn');

let charValidation = document.createElement('span');
let uppercaseSpan = document.createElement('span');
let numberSpan = document.createElement('span');
let specialCharSpan = document.createElement('span');


//Validate if the password has atleast 8 characters, 1 uppercase, 1 number and 1 special character
function passwordValidation() {
    let passwordValue = passwordInput.value;

    let isValid = true;
    let hasUpperCase = false;
    let hasNumber = false;
    let hasSpecialChar = false;

    passwordError.innerHTML = '';
    
    for (let char of passwordValue) {
        if (char >= 'A' && char <= 'Z') {
            hasUpperCase = true;
        } else if (char >= '0' && char <= '9') {
            hasNumber = true;
        } else if ("!@#$%^&*()_+{}|:\"<>?.,'".includes(char)) {
            hasSpecialChar = true;
        }
    }

    if (!hasUpperCase) {
        uppercaseSpan.textContent = 'Password must contain at least one uppercase letter. ';
        uppercaseSpan.style.color = "red";
        passwordError.appendChild(uppercaseSpan);
        isValid = false;
    } else {
        uppercaseSpan.textContent = 'Password contains at least one uppercase letter. ';
        uppercaseSpan.style.color = "green";
        passwordError.appendChild(uppercaseSpan);
    }
    
    if (passwordValue.length < 8) {
        charValidation.textContent = 'Password must be at least 8 characters long. ';
        charValidation.style.color = "red";
        passwordError.appendChild(charValidation);
        isValid = false;
    } else {
        charValidation.textContent = 'Password is at least 8 characters long. ';
        charValidation.style.color = "green";
        passwordError.appendChild(charValidation);
    }


    if (!hasNumber) {
        numberSpan.textContent = 'Password must contain at least one number. ';
        numberSpan.style.color = "red";
        passwordError.appendChild(numberSpan);
        isValid = false;
    } else {
        numberSpan.textContent = 'Password contains at least one number. ';
        numberSpan.style.color = "green";
        passwordError.appendChild(numberSpan);
    }

    if (!hasSpecialChar) {
        specialCharSpan.textContent = 'Password must contain at least one special character. ';
        specialCharSpan.style.color = "red";
        passwordError.appendChild(specialCharSpan);
        isValid = false;
    } else {
        specialCharSpan.textContent = 'Password contains at least one special character. ';
        specialCharSpan.style.color = "green";
        passwordError.appendChild(specialCharSpan);
    }

    return isValid;
}
passwordInput.addEventListener('input', passwordValidation);


//Confirm password Validation if matched
let confirmPasswordInput = document.getElementById('password2');
let confirmPasswordError = document.getElementById('confirm-password-error');

function confirmPasswordValidation() {
    let confirmPasswordValue = confirmPasswordInput.value;
    let passwordValue = passwordInput.value;

    if (confirmPasswordValue !== passwordValue) {
        confirmPasswordError.textContent = 'Passwords do not match';
        confirmPasswordError.style.color = "red";
        return false;
    } else {
        confirmPasswordError.textContent = 'Passwords match';
        confirmPasswordError.style.color = "green";
        return true;
    }
}

confirmPasswordInput.addEventListener('input', confirmPasswordValidation);



// Email Validation 

// Check if the email ends with "@math.com"
function validateEmail(email) {
    if (email.endsWith("@math.com")) {
        return true;
        } else {
            return false;
        }
        }

        let emailInput = document.getElementById('email');
        let emailError = document.getElementById('email-error');

        function emailValidation() {
            let email = emailInput.value;
            if (validateEmail(email)) {
                emailError.textContent = '';
            } else {
                emailError.textContent = 'Email must end with "@math.com"';

            }
        }
        //email Event Listener
        emailInput.addEventListener('input', emailValidation);
        
        
        //Enable the button when conditions are met
        function validateForm() {
            let isPasswordValid = passwordValidation();
            let isConfirmPasswordValid = confirmPasswordValidation();
        
            submitButton.disabled = !(isPasswordValid && isConfirmPasswordValid);
        }
        
        passwordInput.addEventListener('input', validateForm);
        confirmPasswordInput.addEventListener('input', validateForm);