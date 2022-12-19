document.querySelector(".container .suggestionpw").style.display = 'none';
function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//start
var x = document.getElementById("password")
    , x1 = document.getElementById("confirm_password");

function validatePassword() {
    if (x.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        x1.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
//end
var x = document.getElementById("password");
var clicker = document.getElementById("click");
var clickss = document.getElementById("clicks");
clicker.addEventListener("click", function () {
    if (x.type === "password") {
        x.type = "text";
        clickss.className = "bi bi-eye";

    } else {
        x.type = "password";
        clickss.className = "bi bi-eye-slash";
    }
});
//for confirm password
var x1 = document.getElementById("confirm_password");
var clicker1 = document.getElementById("click1");
var clickss1 = document.getElementById("clicks1");
clicker1.addEventListener("click", function () {
    if (x1.type === "password") {
        x1.type = "text";
        clickss1.className = "bi bi-eye";

    } else {
        x1.type = "password";
        clickss1.className = "bi bi-eye-slash";
    }
});
//for current password
var x2 = document.getElementById("current_password");
var clicker2 = document.getElementById("click2");
var clickss2 = document.getElementById("clicks2");
clicker2.addEventListener("click", function () {
    if (x2.type === "password") {
        x2.type = "text";
        clickss2.className = "bi bi-eye";

    } else {
        x2.type = "password";
        clickss2.className = "bi bi-eye-slash";
    }
});

function getPasswordStrength(password) {
    let s = 0;
    let criteriasuggest = document.querySelectorAll(".container .suggestionpw .text");
    let passwordStrengthSpans = document.querySelectorAll(".container .pw-strength span");
    if (password.length > 1 && password.length < 8) {
        passwordStrengthSpans[0].innerText = "Not Enough";
    }
    if (password.length >= 8) {
        s++;
        criteriasuggest[0].style.opacity = 1;
    }
    else {
        criteriasuggest[0].style.opacity = 0.3;
    }
    if (password.length >= 16) {
        s++;
    }
    if (/[a-z]/.test(password)) {
        if (password.length >= 8) {
            s++;
        }
        criteriasuggest[1].style.opacity = 1;
    }
    else {
        criteriasuggest[1].style.opacity = 0.3;
    }
    if (/[A-Z]/.test(password)) {
        if (password.length >= 8) {
            s++;
        }
        criteriasuggest[2].style.opacity = 1;
    }
    else {
        criteriasuggest[2].style.opacity = 0.3;
    }
    if (/[0-9]/.test(password)) {
        if (password.length >= 8) {
            s++;
        }
        criteriasuggest[3].style.opacity = 1;
    }
    else {
        criteriasuggest[3].style.opacity = 0.3;
    }
    if (/[^A-Za-z0-9]/.test(password)) {
        if (password.length >= 8) {
            s++;
        }
        criteriasuggest[4].style.opacity = 1;
    }
    else {
        criteriasuggest[4].style.opacity = 0.3;
    }
    if (/[^A-Za-z0-9]/.test(password)) {
        if (password.length >= 16) {
            s++;
        }
        criteriasuggest[4].style.opacity = 1;
    }
    else {
        criteriasuggest[4].style.opacity = 0.3;
    }
    return s;
}

document.querySelector(".container #password").addEventListener("focus", function () {
    document.querySelector(".container .pw-strength").style.display = "block";
    document.querySelector(".container .suggestionpw").style.display = 'block';
    //alert("ranish");
});
document.querySelector(".container .pw-display-toggle-btn").addEventListener("click", function () {
    let el = document.querySelector(".container .pw-display-toggle-btn");
    if (el.classList.contains("active")) {
        document.querySelector(".container #password").setAttribute("type", "password");
        el.classList.remove("active");
    } else {
        document.querySelector(".container #password").setAttribute("type", "text");
        el.classList.add("active");
    }
});

document.querySelector(".container #password").addEventListener("keyup", function (e) {
    let password = e.target.value;
    let strength = getPasswordStrength(password);

    let passwordStrengthSpans = document.querySelectorAll(".container .pw-strength span");
    strength = Math.max(strength, 1);
    passwordStrengthSpans[1].style.width = strength * 14.28 + "%";
    //code to set bar to 0 if no input is there
    if (strength < 2) {
        if (password.length == 0) {
            passwordStrengthSpans[0].innerText = "Type a password";
            passwordStrengthSpans[1].style.width = strength * 0 + "%";
        }
        else {
            passwordStrengthSpans[0].innerText = "Weak";
            passwordStrengthSpans[0].style.color = "#111";
        }

        passwordStrengthSpans[1].style.background = "#d13636";
    } else if (strength >= 2 && strength <= 4) {
        passwordStrengthSpans[0].innerText = "Medium";
        passwordStrengthSpans[0].style.color = "#111";
        passwordStrengthSpans[1].style.background = "#e6da44";

    } else if (strength == 5) {
        passwordStrengthSpans[0].innerText = "Strong";
        passwordStrengthSpans[0].style.color = "#111";
        passwordStrengthSpans[1].style.background = "#5CFF5C";
    }
    else {
        passwordStrengthSpans[0].innerText = "Very Strong";
        passwordStrengthSpans[0].style.color = "#000";
        passwordStrengthSpans[1].style.background = "#5CFF5C";
    }
});